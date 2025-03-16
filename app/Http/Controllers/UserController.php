<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($role)
    {
        return view('user.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $role)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // $data = [$role, $request->username, bcrypt($request->password)];
        // return $data;

        User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'id_role' => $role,
                'id_prodi' => 0,
        ]);
        $username = $request->username;
        // return view('kelola-mahasiswa.create', compact('username'))
        return redirect()->route('createMahasiswa', ['nrp' => $username]);;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
