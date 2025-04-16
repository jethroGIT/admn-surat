<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\S_LHS;
use App\Models\S_Aktif;
use App\Models\S_Lulus;
use App\Models\S_Pengantar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratAktif = S_Aktif::latest()->Paginate(5); 
        $totalSuratAktif = S_Aktif::where('status', 'Pengajuan')->count();

        $suratLulus = S_Lulus::latest()->Paginate(5);
        $totalSuratLulus = S_Lulus::where('status', 'Pengajuan')->count();

        $suratLHS = S_LHS::latest()->Paginate(5);
        $totalSuratLHS = S_LHS::where('status', 'Pengajuan')->count();
        
        $suratPengantar = S_Pengantar::latest()->Paginate(5);
        $totalSuratPengantar = S_Pengantar::where('status', 'Pengajuan')->count();

        $currentUser = Auth::user();
        if ($currentUser->id_role == 0) {
            return view('dashboard.general', compact('suratAktif', 'totalSuratAktif', 
                                                    'suratLulus', 'totalSuratLulus', 
                                                    'suratLHS', 'totalSuratLHS', 
                                                    'suratPengantar', 'totalSuratPengantar'));
        }
        elseif ($currentUser->id_role == 1 || $currentUser->id_role == 2) {
            $nrps = User::where('id_prodi', $currentUser->id_prodi)->pluck('username');
            
            $suratAktif = S_Aktif::whereIn('nrp', $nrps)->latest()->Paginate(5);
            $totalSuratAktif = $suratAktif->where('status', 'Pengajuan')->count();

            $suratLulus = S_Lulus::whereIn('nrp', $nrps)->latest()->Paginate(5);
            $totalSuratLulus = $suratLulus->where('status', 'Pengajuan')->count();

            $suratLHS = S_LHS::whereIn('nrp', $nrps)->latest()->Paginate(5);
            $totalSuratLHS = $suratLHS->where('status', 'Pengajuan')->count();

            $suratPengantar = S_Pengantar::whereIn('nrp', $nrps)->latest()->Paginate(5);
            $totalSuratPengantar = $suratPengantar->where('status' , 'Pengajuan')->count();
            
            return view('dashboard.general', compact('suratAktif', 'totalSuratAktif', 
                                                   'suratLulus', 'totalSuratLulus', 
                                                   'suratLHS', 'totalSuratLHS', 
                                                   'suratPengantar', 'totalSuratPengantar'));
        }
        elseif ($currentUser->id_role == 3){
            $suratAktif = S_Aktif::where('nrp', $currentUser->username)->latest()->Paginate(5);
            $totalSuratAktif = $suratAktif->total();
            
            $suratLulus = S_Lulus::where('nrp', $currentUser->username)->latest()->Paginate(5);
            $totalSuratLulus = $suratLulus->total();

            $suratLHS = S_LHS::where('nrp', $currentUser->username)->latest()->Paginate(5);
            $totalSuratLHS = $suratLHS->total();

            $suratPengantar = S_Pengantar::where('nrp', $currentUser->username)->latest()->Paginate(5);
            $totalSuratPengantar = $suratPengantar->total();
            return view('dashboard.mahasiswa', compact('suratAktif', 'totalSuratAktif', 
                                                   'suratLulus', 'totalSuratLulus', 
                                                   'suratLHS', 'totalSuratLHS', 
                                                   'suratPengantar', 'totalSuratPengantar'));
        } 

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
