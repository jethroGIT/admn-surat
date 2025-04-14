@extends('layout.layout')
@section('title', 'Profile User')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-10">
        <h2 class="text-2xl font-semibold text-center mb-6">Profile User</h2>
        <form action="{{ route('updateProfile') }}" method="POST" class="space-y-4">
            @csrf
            <!-- NRP (username) - disabled -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">NRP</label>
                <input type="text" id="username" name="username" value="{{ $user->username }}" readonly
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100">
            </div>

            <!-- Program Studi - disabled $user->id_prodi-->
            <div>
                <label for="id_prodi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                <input type="text" id="id_prodi" name="id_prodi" value="{{ $user->prodi->nama_prodi }}" readonly
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100">
            </div>

            <!-- Nama -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Alamat -->
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $user->alamat) }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Nomor Telepon -->
            <div>
                <label for="no_tlp" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="tel" id="no_tlp" name="no_tlp" value="{{ old('no_tlp', $user->no_tlp) }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex justify-between mt-6">
                <button type="button"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-md"><a href="{{ url()->previous() }}">Kembali</a></button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md">Update Profile</button>
            </div>
        </form>
    </div>

    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-10 mb-10">
        <form action="{{ route('updatePassword') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Password (opsional untuk diubah) -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru (kosongkan jika tidak ingin mengubah):</label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Minimal 8 karakter</p>
            </div>

            <div class="flex justify-between mt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md">Update Password</button>
            </div>
        </form>
    </div>
@endsection