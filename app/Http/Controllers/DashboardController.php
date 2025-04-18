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
    // public function index()
    // {
    //     $suratAktif = S_Aktif::latest()->Paginate(5); 
    //     $totalSuratAktif = S_Aktif::where('status', 'Pengajuan')->count();

    //     $suratLulus = S_Lulus::latest()->Paginate(5);
    //     $totalSuratLulus = S_Lulus::where('status', 'Pengajuan')->count();

    //     $suratLHS = S_LHS::latest()->Paginate(5);
    //     $totalSuratLHS = S_LHS::where('status', 'Pengajuan')->count();
        
    //     $suratPengantar = S_Pengantar::latest()->Paginate(5);
    //     $totalSuratPengantar = S_Pengantar::where('status', 'Pengajuan')->count();

    //     $currentUser = Auth::user();
    //     $nrps = User::where('id_prodi', $currentUser->id_prodi)->pluck('username');

    //     if ($currentUser->id_role == 0) {
    //         return view('dashboard.general', compact('suratAktif', 'totalSuratAktif', 
    //                                                 'suratLulus', 'totalSuratLulus', 
    //                                                 'suratLHS', 'totalSuratLHS', 
    //                                                 'suratPengantar', 'totalSuratPengantar'));
    //     }
    //     elseif ($currentUser->id_role == 1) {
    //         $suratAktif = S_Aktif::whereIn('nrp', $nrps)->latest()->Paginate(5);
    //         $totalSuratAktif = $suratAktif->where('status', 'Pengajuan')->count();

    //         $suratLulus = S_Lulus::whereIn('nrp', $nrps)->latest()->Paginate(5);
    //         $totalSuratLulus = $suratLulus->where('status', 'Pengajuan')->count();

    //         $suratLHS = S_LHS::whereIn('nrp', $nrps)->latest()->Paginate(5);
    //         $totalSuratLHS = $suratLHS->where('status', 'Pengajuan')->count();

    //         $suratPengantar = S_Pengantar::whereIn('nrp', $nrps)->latest()->Paginate(5);
    //         $totalSuratPengantar = $suratPengantar->where('status' , 'Pengajuan')->count();
            
    //         return view('dashboard.kaprodi', compact('suratAktif', 'totalSuratAktif', 
    //                                                'suratLulus', 'totalSuratLulus', 
    //                                                'suratLHS', 'totalSuratLHS', 
    //                                                'suratPengantar', 'totalSuratPengantar'));
    //     }
    //     elseif ($currentUser->id_role == 2) {            
    //         $suratAktif = S_Aktif::whereIn('nrp', $nrps)->where('status', 'Disetujui')->latest()->Paginate(5);
    //         $totalSuratAktif = $suratAktif->where('status', 'Disetujui')->count();

    //         $suratLulus = S_Lulus::whereIn('nrp', $nrps)->where('status', 'Disetujui')->latest()->Paginate(5);
    //         $totalSuratLulus = $suratLulus->where('status', 'Disetujui')->count();

    //         $suratLHS = S_LHS::whereIn('nrp', $nrps)->where('status', 'Disetujui')->latest()->Paginate(5);
    //         $totalSuratLHS = $suratLHS->where('status', 'Disetujui')->count();

    //         $suratPengantar = S_Pengantar::whereIn('nrp', $nrps)->where('status', 'Disetujui')->latest()->Paginate(5);
    //         $totalSuratPengantar = $suratPengantar->where('status' , 'Disetujui')->count();
            
    //         return view('dashboard.tu', compact('suratAktif', 'totalSuratAktif', 
    //                                                'suratLulus', 'totalSuratLulus', 
    //                                                'suratLHS', 'totalSuratLHS', 
    //                                                'suratPengantar', 'totalSuratPengantar'));
    //     }
    //     elseif ($currentUser->id_role == 3){
    //         $suratAktif = S_Aktif::where('nrp', $currentUser->username)->latest()->Paginate(5);
    //         $totalSuratAktif = $suratAktif->total();
            
    //         $suratLulus = S_Lulus::where('nrp', $currentUser->username)->latest()->Paginate(5);
    //         $totalSuratLulus = $suratLulus->total();

    //         $suratLHS = S_LHS::where('nrp', $currentUser->username)->latest()->Paginate(5);
    //         $totalSuratLHS = $suratLHS->total();

    //         $suratPengantar = S_Pengantar::where('nrp', $currentUser->username)->latest()->Paginate(5);
    //         $totalSuratPengantar = $suratPengantar->total();
    //         return view('dashboard.mahasiswa', compact('suratAktif', 'totalSuratAktif', 
    //                                                'suratLulus', 'totalSuratLulus', 
    //                                                'suratLHS', 'totalSuratLHS', 
    //                                                'suratPengantar', 'totalSuratPengantar'));
    //     } 

    // }


    public function index()
    {
        $currentUser = Auth::user();
        $view = 'dashboard.general';
        $nrps = USER::where('id_prodi', $currentUser->id_prodi)->pluck('username');
        
        // Query untuk semua role
        $suratAktif = S_Aktif::query();
        $suratLulus = S_Lulus::query();
        $suratLHS = S_LHS::query();
        $suratPengantar = S_Pengantar::query();
    
        if ($currentUser->id_role == 0) {        
            $view = 'dashboard.general';
        }
        elseif ($currentUser->id_role == 1){
            $suratAktif->whereIn('nrp', $nrps);
            $suratLulus->whereIn('nrp', $nrps);
            $suratLHS->whereIn('nrp', $nrps);
            $suratPengantar->whereIn('nrp', $nrps);
    
            $view = 'dashboard.kaprodi';
        }
        elseif ($currentUser->id_role == 2){
            $suratAktif->whereIn('nrp', $nrps)->where('status', 'Disetujui');
            $suratLulus->whereIn('nrp', $nrps)->where('status', 'Disetujui');
            $suratLHS->whereIn('nrp', $nrps)->where('status', 'Disetujui');
            $suratPengantar->whereIn('nrp', $nrps)->where('status', 'Disetujui');
    
            $view = 'dashboard.tu';
        }
        elseif ($currentUser->id_role == 3){
            $suratAktif->where('nrp', $currentUser->username);
            $suratLulus->where('nrp', $currentUser->username);
            $suratLHS->where('nrp', $currentUser->username);
            $suratPengantar->where('nrp', $currentUser->username);
    
            $view = 'dashboard.mahasiswa';
        }
        
        // Pagination
        $suratAktif = $suratAktif->latest()->paginate(5);
        $suratLulus = $suratLulus->latest()->paginate(5);
        $suratLHS = $suratLHS->latest()->paginate(5);
        $suratPengantar = $suratPengantar->latest()->paginate(5);

        // Query Total Surat
        $totalAktif = S_Aktif::query();
        $totalLulus = S_Lulus::query();
        $totalLHS = S_LHS::query();
        $totalPengantar = S_Pengantar::query();
    
        if ($currentUser->id_role == 1 || $currentUser->id_role == 0) {
            $totalAktif->where('status', 'Pengajuan');
            $totalLulus->where('status', 'Pengajuan');
            $totalLHS->where('status', 'Pengajuan');
            $totalPengantar->where('status', 'Pengajuan');
        }
        elseif ($currentUser->id_role == 2) {
            $totalAktif->where('status', 'Disetujui')->where('file', null);
            $totalLulus->where('status', 'Disetujui')->where('file', null);
            $totalLHS->where('status', 'Disetujui')->where('file', null);
            $totalPengantar->where('status', 'Disetujui')->where('file', null);
        }
        elseif ($currentUser->id_role == 3) {
            $totalAktif->where('nrp', $currentUser->username);
            $totalLulus->where('nrp', $currentUser->username);
            $totalLHS->where('nrp', $currentUser->username);
            $totalPengantar->where('nrp', $currentUser->username);
        }
    
        if ($currentUser->id_role == 1 || $currentUser->id_role == 2) {
            $totalAktif->whereIn('nrp', $nrps);
            $totalLulus->whereIn('nrp', $nrps);
            $totalLHS->whereIn('nrp', $nrps);
            $totalPengantar->whereIn('nrp', $nrps);
        } 

        // Count Total Surat Baru
        $totalSuratAktif = $totalAktif->count();
        $totalSuratLulus = $totalLulus->count();
        $totalSuratLHS = $totalLHS->count();
        $totalSuratPengantar = $totalPengantar->count();
    
    
        return view($view, compact(
            'suratAktif', 'totalSuratAktif', 
            'suratLulus', 'totalSuratLulus',
            'suratLHS', 'totalSuratLHS',
            'suratPengantar', 'totalSuratPengantar'
        ));
        
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
