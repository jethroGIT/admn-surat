<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prodi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $tipe)
    {
        if ($tipe == 'kaprodi') {
            $users = User::where('id_role', 1)->simplePaginate(10);
        } 
        if ($tipe == 'tu') {
            $users = User::where('id_role', 2)->simplePaginate(10);
        }
        if ($tipe == 'mahasiswa') {
            $id = $request->search ?? '';
            $users = User::where('username', 'LIKE', '%' . $id . '%')
                ->where('id_role', 3)
                ->with('prodi')
                ->simplePaginate(10);
            return view('kelola-mahasiswa.index', compact('id', 'users'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelola-mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $tipe)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'id_prodi' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
        ]);

        if ($tipe == 'mahasiswa') {
            $userFinder = User::find($request->username);
            if ($userFinder != null) {
                return back()->withErrors(['err_msg' => 'Data Mahasiswa sudah ada!'])->withInput();
            } else {
                User::create([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'id_role' => 3,
                    'id_prodi' => $request->id_prodi,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'no_tlp' => $request->no_tlp,
                    'status' => 'Aktif',
                ]);
                session()->flash('success', 'Mahasiswa berhasil ditambahkan');
                return redirect()->route('indexUser', ['tipe' => 'mahasiswa']);
            }
        }
        if ($tipe == 'kaprodi') {
            pass;
        }
        if ($tipe == 'tu') {
            pass;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($tipe, $username)
    {
        $user = User::where('username', $username)->first();
        if ($user == null) {
            return back()->withErrors(['err_msg' => 'Data Mahasiswa tidak ditemukan!']);
        } else {
            if ($tipe == 'mahasiswa') {
                $mahasiswa = User::where('username', $username)->with('prodi')->first();
                return view('kelola-mahasiswa.view', compact('mahasiswa')); 
            }
            if ($tipe == 'kaprodi') {
                pass;
            }
            if ($tipe == 'tu') {
                pass;
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tipe, $username)
    {
        $user = User::where('username', $username)->first();
        if ($user == null) {
            return back()->withErrors(['err_msg' => 'Data Mahasiswa tidak ditemukan!']);
        } else {
            if ($tipe == 'mahasiswa') {
                $mahasiswa = User::where('username', $username)->with('prodi')->first();
                $prodis = Prodi::all();
                return view('kelola-mahasiswa.edit', compact('mahasiswa', 'prodis'));
            }
            if ($tipe == 'kaprodi') {
                pass;
            }
            if ($tipe == 'tu') {
                pass;
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($tipe, $username, Request $request)
    {
        $request->validate([
            'username' => 'required',
            'id_prodi' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
        ]);

        $user = User::where('username', $username)->first();
        if ($user == null) {
            return back()->withErrors(['err_msg' => 'Data Mahasiswa tidak ditemukan!']);
        } else {
            if ($tipe == 'mahasiswa') {
                $user->update([
                    'username' => $request->username,
                    'id_prodi' => $request->id_prodi,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'no_tlp' => $request->no_tlp,
                    'status' => $request->status
                ]);
                session()->flash('success', 'Mahasiswa berhasil diubah');
                return redirect()->route('indexUser', ['tipe' => 'mahasiswa']);
            }
            if ($tipe == 'kaprodi') {
                pass;
            }
            if ($tipe == 'tu') {
                pass;
            }
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tipe, $username)
    {
        $user = User::find($username);
        if ($user == null) {
            return back()->withErrors(['err_msg' => 'Data Mahasiswa tidak ditemukan!']);
        } else {
            $destroyUser = User::where('username', $username)->delete();
            session()->flash('success', 'User berhasil dihapus');
            return redirect()->route('indexUser', ['tipe' => 'mahasiswa']);
        }

    }
}
