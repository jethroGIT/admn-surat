@extends('layout.layout')
@section('title', 'Kelola Mahasiswa')

@section('content')
    <div class="container mt-1">
        <h1 class="text-3xl text-center font-bold text-dark mb-2">Daftar Mahasiswa</h1>

        <a href="{{ route('createUser', ['tipe' => 'mahasiswa']) }}" class="btn btn-primary mb-2">Tambah Mahasiswa</a>

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
                    @if ($users->count() == 0)
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endif

                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->prodi->nama_prodi ?? 'Tidak ada' }}</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <a href="{{ route('showUser', ['tipe' => 'mahasiswa', 'username' => $user->username]) }}">view | </a>
                                <form id="delete-form-{{ $user->username }}"
                                    action="{{ route('destroyUser', ['tipe' => 'mahasiswa', 'username' => $user->username]) }}"
                                    method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="confirmDelete('{{ $user->username }}')"
                                        class="text-danger">delete</a>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $users->links() }}
    </div>
@endsection

@section('ExtraJS')
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

    <script>
        function confirmDelete(username) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + username).submit();
                }
            });
        }
    </script>
@endsection
