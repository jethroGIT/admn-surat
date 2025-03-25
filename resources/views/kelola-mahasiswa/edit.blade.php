@extends('layout.layout')
@section('title', 'Update Mahasiswa')

@section('content')

    <form action="{{ url('kelola-mahasiswa/' . $mahasiswa->nrp . '/update') }}" method="POST">
        @csrf
        <label for="nrp">NRP:</label>
        <input type="text" id="nrp" name="nrp" value="{{ $mahasiswa->nrp }}" required><br>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="{{ $mahasiswa->nama }}"required><br>

        <label for="alamat">Alamat:</label>
        <input id="alamat" name="alamat" value="{{ $mahasiswa->alamat }}" required></input><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $mahasiswa->email }}" required><br>

        <label for="no_tlp">Nomor Telepon:</label>
        <input type="tel" id="no_tlp" name="no_tlp" value="{{ $mahasiswa->no_tlp }}" required><br>

        <label for="status_mhs">Status:</label>
        <select id="status_mhs" name="status_mhs" required>
            <option value="aktif">Aktif</option>
            <option value="cuti">Cuti</option>
            <option value="lulus">Lulus</option>
        </select><br>

        <button type="submit">Simpan</button>
    </form>
@endsection
