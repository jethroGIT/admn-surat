<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->title ?? '';
        $mahasiswas = Mahasiswa::where('nrp', 'LIKE', '%' . $id . '%')
            ->simplePaginate(10);
        return view('kelola-mahasiswa.index', compact('id', 'mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($nrp)
    {
        return view('kelola-mahasiswa.create', compact('nrp'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nrp' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
        ]);

        Mahasiswa::create([
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_tlp' => $request->no_tlp,
            'status_mhs' => 'Aktif'
        ]);
        return redirect()->route('indexMahasiswa')->with('success', 'Data Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nrp)
    {
        $mahasiswa = Mahasiswa::find($nrp);
        if ($mahasiswa == null) {
            return back()->withErrors(['err_msg' => 'Data Mahasiswa tidak ditemukan!']);
        }
        return view('kelola-mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nrp)
    {
        $mahasiswa = Mahasiswa::find($nrp);
        if ($mahasiswa == null) {
            return back()->withErrors(['err_msg' => 'Data Mahasiswa tidak ditemukan!']);
        }
        
        $request->validate([
            'nrp' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('indexMahasiswa')->with('success', 'Data Mahasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        
    }
}
