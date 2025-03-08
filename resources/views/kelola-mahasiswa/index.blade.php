@extends('layout.layout')
@section('title', 'Kelola Mahasiswa')

@section('content')
    <div class="container mt-1">
        <h1 class="text-3xl text-center font-bold text-dark mb-2">Daftar Mahasiswa</h1>

        @if (session('success'))
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            </script>
        @endif

        <a href="{{ url('user/3/create') }}" class="btn btn-primary mb-2">Tambah Mahasiswa</a>

        <form method="GET">
            <div class="input-group mb-2">
                <input type="text" name="search" value="{{ $id }}" class="form-control"
                    placeholder="Search by NRP" aria-label="Search by NRP" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>NRP</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($mahasiswas->count() == 0)
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endif

                    @foreach ($mahasiswas as $mahasiswa)
                        <tr>
                            <td>{{ $mahasiswa->nrp }}</td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>{{ $mahasiswa->prodi }}</td>
                            <td>{{ $mahasiswa->status_mhs }}</td>
                            <td>
                                <a href="{{ url('mahasiswa/' . $mahasiswa->nrp . '/view') }}">view</a>
                                <a href="{{ url('mahasiswa/' . $mahasiswa->nrp . '/edit') }}"> | edit | </a>
                                <a href="{{ url('mahasiswa/' . $mahasiswa->nrp . '/destroy') }}">delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $mahasiswas->links() }}
    </div>
@endsection
