<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
    public function index(Request $request, $tipe)
    {
        $currentUser = Auth::user();
        $currentProdiId = $currentUser->id_prodi;

        if ($tipe == 'kaprodi') {
            $id = $request->search ?? '';
            $query = User::where('username', 'LIKE', '%' . $id . '%')
                ->where('id_role', 1)
                ->with('prodi');
            
            // Jika user bukan admin, filter berdasarkan prodi yang sama
            if ($currentUser->id_role != 0) { // Asumsi role 0 adalah admin/superadmin
                $query->where('id_prodi', $currentProdiId);
            }
            
            $users = $query->simplePaginate(10);
            return view('kelola-kaprodi.index', compact('id', 'users'));
        } 
        elseif ($tipe == 'tu') {
            // Jika user bukan admin
            if ($currentUser->id_role != 0) {
                abort(403, 'Akses ditolak.');
            }
            
            $id = $request->search ?? '';
            $query = User::where('username', 'LIKE', '%' . $id . '%')
                ->where('id_role', 2)
                ->with('prodi');
            
            $users = $query->simplePaginate(10);
            return view('kelola-tu.index', compact('id', 'users'));
        }
        elseif ($tipe == 'mahasiswa') {
            $id = $request->search ?? '';
            $query = User::where('username', 'LIKE', '%' . $id . '%')
                ->where('id_role', 3)
                ->with('prodi');
            
            // Jika user bukan admin, filter berdasarkan prodi yang sama
            if ($currentUser->id_role != 0) { // Asumsi role 0 adalah admin/superadmin
                $query->where('id_prodi', $currentProdiId);
            }
            
            $users = $query->simplePaginate(10);
            return view('kelola-mahasiswa.index', compact('id', 'users'));
        }
        else {
            return back()->withErrors(['err_msg' => 'Tipe user tidak valid!']);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($tipe)
    {   
        if ($tipe == 'mahasiswa') {
            return view('kelola-mahasiswa.create');
        } 
        elseif ($tipe == 'kaprodi') {
            return view('kelola-kaprodi.create');
        }
        elseif ($tipe == 'tu') {
            $currentUser = Auth::user();
            if ($currentUser->id_role != 0) {
                abort(403, 'Akses ditolak.');
            }

            return view('kelola-tu.create');
        } 
        else {
            return back()->withErrors(['err_msg' => 'Tipe user tidak valid!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $tipe)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            // 'id_prodi' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
        ]);

        $userFinder = User::find($request->username);
        if ($userFinder != null) {
            return back()->withErrors(['err_msg' => 'Data User sudah ada!'])->withInput();
        }

        $currentUser = Auth::user();

        if ($tipe == 'kaprodi') {
            if ($currentUser->id_role == 2) {
                User::create([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'id_role' => 1,
                    'id_prodi' => $currentUser->id_prodi,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'no_tlp' => $request->no_tlp,
                    'status' => 'Aktif',
                ]);
            }
            else {
                User::create([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'id_role' => 1,
                    'id_prodi' => $request->id_prodi,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'no_tlp' => $request->no_tlp,
                    'status' => 'Aktif',
                ]);
            }

            session()->flash('success', 'Kaprodi berhasil ditambahkan');
            return redirect()->route('indexUser', ['tipe' => 'kaprodi']);
        }
        elseif ($tipe == 'tu') {
            User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'id_role' => 2,
                'id_prodi' => $request->id_prodi,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'no_tlp' => $request->no_tlp,
                'status' => 'Aktif',
            ]);
            session()->flash('success', 'Tata Usaha berhasil ditambahkan');
            return redirect()->route('indexUser', ['tipe' => 'tu']);
        }
        elseif ($tipe == 'mahasiswa') {
            if ($currentUser->id_role == 2) {
                User::create([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'id_role' => 3,
                    'id_prodi' => $currentUser->id_prodi,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'no_tlp' => $request->no_tlp,
                    'status' => 'Aktif',
                ]);
            }
            else {
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
            }

            session()->flash('success', 'Mahasiswa berhasil ditambahkan');
            return redirect()->route('indexUser', ['tipe' => 'mahasiswa']);
            
        }
        elseif ($tipe == 'admin') {
            User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'id_role' => 0,
                'id_prodi' => 1,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'no_tlp' => $request->no_tlp,
                'status' => 'Aktif',
            ]);
            session()->flash('success', 'Admin berhasil ditambahkan');
            return redirect()->route('login');

        }
        else {
            return back()->withErrors(['err_msg' => 'Tipe user tidak valid!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($tipe, $username)
    {
        $user = User::where('username', $username)->first();
        if ($user == null) {
            return back()->withErrors(['err_msg' => 'Data User tidak ditemukan!']);
        }

        $this->checkProdiAccess($user->id_prodi);
        
        if ($tipe == 'kaprodi') {
            $kaprodi = User::where('username', $username)->with('prodi')->first();
            return view('kelola-kaprodi.view', compact('kaprodi'));
        }
        elseif ($tipe == 'tu') {
            $currentUser = Auth::user();
            if ($currentUser->id_role != 0) {
                abort(403, 'Akses ditolak.');
            }

            $tu = User::where('username', $username)->with('prodi')->first();
            return view('kelola-tu.view', compact('tu'));
        }
        elseif ($tipe == 'mahasiswa') {
            $mahasiswa = User::where('username', $username)->with('prodi')->first();
            return view('kelola-mahasiswa.view', compact('mahasiswa')); 
        }
        else {
            return back()->withErrors(['err_msg' => 'Tipe user tidak valid!']);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tipe, $username)
    {
        $user = User::where('username', $username)->first();
        if ($user == null) {
            return back()->withErrors(['err_msg' => 'Data User tidak ditemukan!']);
        }
        
        $this->checkProdiAccess($user->id_prodi);
        
        if ($tipe == 'mahasiswa') {
            $mahasiswa = User::where('username', $username)->with('prodi')->first();
            return view('kelola-mahasiswa.edit', compact('mahasiswa'));
        }
        elseif ($tipe == 'kaprodi') {
            $kaprodi = User::where('username', $username)->with('prodi')->first();
            return view('kelola-kaprodi.edit', compact('kaprodi'));
        }
        elseif ($tipe == 'tu') {
            $currentUser = Auth::user();
            if ($currentUser->id_role != 0) {
                abort(403, 'Akses ditolak.');
            }

            $tu = User::where('username', $username)->with('prodi')->first();
            return view('kelola-tu.edit', compact('tu'));
        }
        else {
            return back()->withErrors(['err_msg' => 'Tipe user tidak valid!']);
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
            return back()->withErrors(['err_msg' => 'Data User tidak ditemukan!']);
        }

        $this->checkProdiAccess($user->id_prodi);
        
        $user->update([
            'username' => $request->username,
            'id_prodi' => $request->id_prodi,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_tlp' => $request->no_tlp,
            'status' => $request->status
        ]);

        
        if ($tipe == 'kaprodi') {
            session()->flash('success', 'Kaprodi berhasil diperbarui');
            return redirect()->route('indexUser', ['tipe' => 'kaprodi']);
        }
        elseif ($tipe == 'tu') {
            session()->flash('success', 'Tata Usaha berhasil diperbarui');
            return redirect()->route('indexUser', ['tipe' => 'tu']);
        }
        elseif ($tipe == 'mahasiswa') {
            session()->flash('success', 'Mahasiswa berhasil diperbarui');
            return redirect()->route('indexUser', ['tipe' => 'mahasiswa']);
        }
        else {
            return back()->withErrors(['err_msg' => 'Tipe user tidak valid!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tipe, $username)
    {
        $user = User::find($username);
        if ($user == null) {
            return back()->withErrors(['err_msg' => 'Data User tidak ditemukan!']);
        } 

        $this->checkProdiAccess($user->id_prodi);

        $destroyUser = User::where('username', $username)->delete();
        session()->flash('success', 'User berhasil dihapus');
        
        
        if ($tipe == 'kaprodi') {
            return redirect()->route('indexUser', ['tipe' => 'kaprodi']);
        }
        elseif ($tipe == 'tu') {
            return redirect()->route('indexUser', ['tipe' => 'tu']);
        }
        elseif ($tipe == 'mahasiswa') {
            return redirect()->route('indexUser', ['tipe' => 'mahasiswa']);
        }
        else {
            return back()->withErrors(['err_msg' => 'Tipe user tidak valid!']);
        }
    }
}
