@extends('layout.layout')
@section('title', 'Update Kaprodi')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-10 mb-10">
        <h2 class="text-2xl font-semibold text-center mb-6">Update User</h2>
        <form action="{{ route('updateUser', ['tipe' => 'tu', 'username' => $tu->username]) }}" method="POST"
            class="space-y-4">
            @csrf
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">NRP:</label>
                <input type="text" id="username" name="username" value="{{ $tu->username }}"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="id_prodi" class="block text-sm font-medium text-gray-700">Program Studi:</label>
                <select id="id_prodi" name="id_prodi" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Program Studi</option>
                    <option value="2" {{ $tu->id_prodi == '2' ? 'selected' : '' }}>Teknik Informatika</option>
                    <option value="3" {{ $tu->id_prodi == '3' ? 'selected' : '' }}>Sistem Informasi</option>
                    <option value="4" {{ $tu->id_prodi == '4' ? 'selected' : '' }}>Magister Ilmu Komputer</option>
                </select>
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama:</label>
                <input type="text" id="nama" name="nama" value="{{ $tu->nama }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat:</label>
                <input type="text" id="alamat" name="alamat" value="{{ $tu->alamat }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="{{ $tu->email }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="no_tlp" class="block text-sm font-medium text-gray-700">Nomor Telepon:</label>
                <input type="tel" id="no_tlp" name="no_tlp" value="{{ $tu->no_tlp }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                <select id="status" name="status" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Status</option>
                    <option value="Aktif" {{ $tu->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ $tu->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            
            <div class="flex justify-between mt-6">
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-md"><a
                        href="{{ route('indexUser', ['tipe' => 'tu']) }}">Cancel</a></button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md">Simpan</button>
            </div>
        </form>
    </div>
@endsection

