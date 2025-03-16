@extends('layout.layout')
@section('title', 'User')

@section('content')

    <form action="{{ url('kelola-mahasiswa/store') }}" method="POST">
        @csrf

        <label for="nrp">NRP:</label>
        <input type="text" id="nrp" name="nrp" value="{{ $nrp }}" readonly required><br>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br>

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required></textarea><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="no_tlp">Nomor Telepon:</label>
        <input type="tel" id="no_tlp" name="no_tlp" required><br>

        <button type="submit">Simpan</button>
    </form>


    <h1>{{ $nrp }}</h1>

@endsection
