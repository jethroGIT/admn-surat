<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\S_Lulus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SLulusController extends Controller
{
    private function checkProdiAccess($userProdiId)
    {
        $currentUser = Auth::user();

        if ($currentUser->id_role == 0) {
            return true;
        }
        elseif ($currentUser->id_prodi == $userProdiId) {
            return true;
        } 
        else {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        $currentProdiId = $currentUser->id_prodi;
        $id = $request->search ?? '';

        if ($currentUser->id_role == 0) {
            $query = S_Lulus::where('nrp', 'LIKE', '%' . $id . '%')->simplePaginate(10);
        }
        elseif ($currentUser->id_role == 1) {
            $usersSameProdi = User::where('id_prodi', $currentUser->id_prodi)
                             ->pluck('username');

            $query = S_Lulus::whereIn('nrp', $usersSameProdi)
                            ->where('nrp', 'LIKE', '%' . $id . '%')
                            ->simplePaginate(10);
        }
        elseif ($currentUser->id_role == 2) {
            $usersSameProdi = User::where('id_prodi', $currentUser->id_prodi)
                             ->pluck('username');

            $query = S_Lulus::whereIn('nrp', $usersSameProdi)
                            ->where('nrp', 'LIKE', '%' . $id . '%')
                            ->where('status', 'Disetujui')
                            ->simplePaginate(10);
        }
        elseif ($currentUser->id_role == 3) {
            $query = S_Lulus::where('nrp', $currentUser->username)
                            ->simplePaginate(10);
        } 

        return view('surat-lulus.index', compact('id','query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('surat-lulus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_lulus' => 'required|date',
        ]);

        $currentUser = Auth::user();
        S_Lulus::create([
            'nrp' => $currentUser->username,
            'tanggal_lulus' => $request->tanggal_lulus,
            'status' => 'Pengajuan',
        ]);

        session()->flash('success', 'Pengajuan Surat Berhasil Dibuat');
        return redirect()->route('surat-lulus');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $idFinder = S_Lulus::find($id);
        if ($idFinder == null) {
            return back()->withErrors(['err_msg' => 'Data tidak ditemukan!']);
        }
        else {
            $this->checkProdiAccess($idFinder->user->id_prodi);

            $suratLulus = $idFinder;
            return view('surat-lulus.view', compact('suratLulus'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $idFinder = S_Lulus::find($id);
        if ($idFinder == null) {
            return back()->withErrors(['err_msg' => 'Data tidak ditemukan!']);
        }
        else {
            $this->checkProdiAccess($idFinder->user->id_prodi);

            $suratLulus = $idFinder;
            return view('surat-lulus.edit', compact('suratLulus'));
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_lulus' => 'required|date',
        ]);
        
        $idFinder = S_Lulus::find($id);
        if ($idFinder == null) {
            return back()->withErrors(['err_msg' => 'Data tidak ditemukan!']);
        }
        else {
            $this->checkProdiAccess($idFinder->user->id_prodi);
            
            $idFinder->update([
                'tanggal_lulus' => $request->tanggal_lulus,
            ]);
            
            session()->flash('success', 'Data berhasil diperbarui');
            return redirect()->route('surat-lulus');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $idFinder = S_Lulus::find($id);
        if ($idFinder == null) {
            return back()->withErrors(['err_msg' => 'Data tidak ditemukan!']);
        }
        else {
            $this->checkProdiAccess($idFinder->user->id_prodi);

            $idFinder->update([
                'status' => $request->status,
            ]);
            session()->flash('success', 'Status berhasil diubah');
            return redirect()->route('surat-lulus');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idFinder = S_Lulus::find($id);
        if ($idFinder == null) {
            return back()->withErrors(['err_msg' => 'Data tidak ditemukan!']);
        }
        else {
            $this->checkProdiAccess($idFinder->user->id_prodi);
            
            if ($idFinder->file && Storage::disk('public')->exists($idFinder->file)) {
                Storage::disk('public')->delete($idFinder->file);
            }

            $idFinder->delete();
            session()->flash('success', 'Data berhasil dihapus');
            return redirect()->route('surat-lulus');
        } 

    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:2048', // hanya PDF, max 2MB
        ]);

        $surat = S_Lulus::findOrFail($id);

        // Hapus file lama jika ada
        // if ($surat->file) {
        //     Storage::delete('public/' . $surat->file);
        // }

        // Simpan file baru
        $filePath = $request->file('file')->storeAs('surat-lulus', 'SuratLulus-' . $surat->id . '.pdf', 'public');

        $surat->update([
            'file' => $filePath
        ]);

        session()->flash('success', 'File surat berhasil diupload');
        return redirect()->route('surat-lulus');
    }

    public function download($id)
    {
        $surat = S_Lulus::find($id);
        if ($surat == null) {
            return back()->withErrors(['err_msg' => 'Data tidak ditemukan!']);
        }

        if (!$surat->file) {
            return back()->withErrors(['err_msg' => 'File surat tidak ditemukan']);
        }

        $filePath = storage_path('app/public/' . $surat->file);

        if (!file_exists($filePath)) {
            return back()->withErrors(['err_msg' => 'File surat tidak ditemukan']);
        }

        return response()->download($filePath);
    }

    public function resetIncrement()
    {
        S_Lulus::truncate();
        DB::statement('ALTER TABLE S_Lulus AUTO_INCREMENT = 1');
        session()->flash('success', 'Data berhasil direset');
        return redirect()->route('surat-lulus');
    }
}