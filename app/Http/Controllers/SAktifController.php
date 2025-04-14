<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\S_Aktif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SAktifController extends Controller
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
            $query = S_Aktif::where('nrp', 'LIKE', '%' . $id . '%')
                            ->simplePaginate(10);
        }
        elseif ($currentUser->id_role == 1 || $currentUser->id_role == 2) {
            $usersSameProdi = User::where('id_prodi', $currentUser->id_prodi)
                             ->pluck('username');

            $query = S_Aktif::whereIn('nrp', $usersSameProdi)
                            ->where('nrp', 'LIKE', '%' . $id . '%')
                            ->simplePaginate(10);
        }
        elseif ($currentUser->id_role == 3) {
            $query = S_Aktif::where('nrp', $currentUser->username)
                            ->simplePaginate(10);
        } 

        return view('surat-aktif.index', compact('id','query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('surat-aktif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'keperluan' => 'required',
        ]);
        
        $currentUser = Auth::user();
        S_Aktif::create([
            'nrp' => $currentUser->username,
            'semester' => $request->semester,
            'alamat' => $currentUser->alamat,
            'keperluan' => $request->keperluan,
            'status' => 'Pengajuan',
        ]);

        session()->flash('success', 'Pengajuan Surat Berhasil Dibuat');
        return redirect()->route('surat-aktif');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $idFinder = S_Aktif::find($id);
        if ($idFinder == null) {
            return back()->withErrors(['err_msg' => 'Data tidak ditemukan!']);
        }
        else {
            $this->checkProdiAccess($idFinder->user->id_prodi);

            $suratAktif = S_Aktif::find($id);
            return view('surat-aktif.view', compact('suratAktif'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(S_Aktif $s_Aktif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idFinder = S_Aktif::find($id);
        if ($idFinder == null) {
            return back()->withErrors(['err_msg' => 'Data tidak ditemukan!']);
        }
        else {
            $this->checkProdiAccess($idFinder->user->id_prodi);

            $idFinder->update([
                'status' => $request->status,
            ]);
            session()->flash('success', 'Data berhasil diubah');
            return redirect()->route('surat-aktif');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idFinder = S_Aktif::find($id);
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
            return redirect()->route('surat-aktif');
        } 
    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:2048', // hanya PDF, max 2MB
        ]);

        $surat = S_Aktif::findOrFail($id);

        // Simpan file baru
        $filePath = $request->file('file')->storeAs('surat-aktif', 'SuratAktif-' . $surat->id . '.pdf', 'public');

        $surat->update([
            'file' => $filePath
        ]);

        session()->flash('success', 'File surat berhasil diupload');
        return redirect()->route('surat-aktif');
    }

    public function download($id)
    {
        $surat = S_Aktif::find($id);
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
        S_Aktif::truncate();
        DB::statement('ALTER TABLE S_Pengantar AUTO_INCREMENT = 1');
        session()->flash('success', 'Data berhasil direset');
        return redirect()->route('surat-aktif');
    }
}
