<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodis = Prodi::orderBy('id')->simplePaginate(5); 
        return view('prodi.index', compact('prodis'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required'
        ]);
    
        Prodi::create([
            'id' => 5,
            'nama_prodi' => $request->nama_prodi,
        ]);
    
        session()->flash('success', 'Prodi berhasil ditambahkan');
        return redirect()->route('prodi');
    }

    /**
     * Display the specified resource.
     */
    public function show(prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(prodi $prodi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idFinder = Prodi::find($id);
        if ($idFinder == null) {
            return back()->withErrors(['err_msg' => 'Data tidak ditemukan!']);
        }
        else {
            $request->validate([
                'nama_prodi' => 'required'
            ]);
        
            $idFinder->update([
                'nama_prodi' => $request->nama_prodi,
            ]);
        
            session()->flash('success', 'Prodi berhasil diperbarui');
            return redirect()->route('prodi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Prodi::where('id', $id)->delete();
        session()->flash('success', 'Prodi berhasil dihapus');
        return redirect()->route('prodi');
    }
}
