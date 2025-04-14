<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\S_Aktif;
use App\Models\S_Lulus;
use App\Models\S_LHS;
use App\Models\S_Pengantar;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratAktif = S_Aktif::latest()->get(); // Urutkan berdasarkan created_at DESC
        $suratLulus = S_Lulus::latest()->get();
        $suratLHS = S_LHS::latest()->get();
        $suratPengantar = S_Pengantar::latest()->get();
    
        return view('dashboard.kaprodi', compact('suratAktif', 'suratLulus', 'suratLHS', 'suratPengantar'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
