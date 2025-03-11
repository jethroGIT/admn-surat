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
        $mahasiswas = Mahasiswa::where('nrp', 'LIKE', '%' . $id . '%')->simplePaginate(10);
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
            'dosen_wali' => 'required',
            'fakultas' => 'required',
            'prodi' => 'required',
            'angkatan_mhs' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
            'status_mhs' => 'required'
        ]);

        Mahasiswa::create([
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'dosen_wali' => $request->dosen_wali,
            'fakultas' => $request->fakultas,
            'prodi' => $request->prodi,
            'angkatan_mhs' => $request->angkatan_mhs,
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
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
