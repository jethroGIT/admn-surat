<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\S_Lulus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SLulusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->search ?? '';
        $query = S_Lulus::where('nrp', 'LIKE', '%' . $id . '%')->simplePaginate(10);
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
            $suratLulus = S_Lulus::where('id', $id)->first();
            $user = User::where('username', $suratLulus->nrp)
                ->with('prodi')    
                ->first();
            return view('surat-lulus.view', compact('suratLulus', 'user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $idFinder = S_Lulus::find($id);
        if ($idFinder == null) {
            return back()->withErrors(['err_msg' => 'Data tidak ditemukan!']);
        }
        else {
            $suratLulus = S_Lulus::where('id', $id)->first();
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
            $idFinder->update([
                'tanggal_lulus' => $request->tanggal_lulus
            ]);
            session()->flash('success', 'Data berhasil diubah');
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
            $idFinder->delete();
            session()->flash('success', 'Data berhasil dihapus');
            return redirect()->route('surat-lulus');
        } 

    }
}

        // S_Lulus::create([
        //     'nrp' => '2372031',
        //     'tanggal_lulus' => '2023-10-01',
        //     'status' => 'approved',
        //     'file' => 'file.pdf'
        // ]);
        // Reset Increment
        // S_Lulus::truncate();
        // DB::statement('ALTER TABLE S_Lulus AUTO_INCREMENT = 1');