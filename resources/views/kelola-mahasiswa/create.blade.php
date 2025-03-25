@extends('layout.layout')
@section('title', 'User')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-10">
        <h2 class="text-2xl font-semibold text-center mb-6">Tambah User</h2>
        <form action="{{ route('storeUser', ['tipe' => 'mahasiswa']) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">NRP:</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="id_prodi" class="block text-sm font-medium text-gray-700">Program Studi:</label>
                <select id="id_prodi" name="id_prodi" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <<option value="" {{ old('id_prodi') === null ? 'selected' : '' }}>Pilih Program Studi</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->id }}" {{ old('id_prodi') == $prodi->id ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama:</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat:</label>
                <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="no_tlp" class="block text-sm font-medium text-gray-700">Nomor Telepon:</label>
                <input type="tel" id="no_tlp" name="no_tlp" value="{{ old('no_tlp') }}" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex justify-between mt-6">
                <button type="button"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-md">Kembali</button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md">Simpan</button>
            </div>
        </form>
    </div>
@endsection



@section('ExtraJS')
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let errorMessages = `
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            `;
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    html: errorMessages,
                    showConfirmButton: true
                });
            });
        </script>
    @endif
@endsection
