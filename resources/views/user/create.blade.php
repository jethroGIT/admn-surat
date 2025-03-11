@extends('layout.layout')
@section('title', 'User')

@section('ExtraCSS')
    <link rel="stylesheet" href="{{ asset('css/create-user.css')}}">
@endsection

@section('content')

    <div class="container">
        <div class="form-container mx-auto">
            <h1 class="form-title">Buat User Baru</h1>
            <form action="{{ url('user/3/store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>
                <div class="button-container">
                    <a href="{{ url('user') }}" class="btn btn-secondary"><b>Kembali</b></a>
                    <button type="submit" class="btn btn-primary"><b>Buat User</b></button>
                </div>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 Notification -->
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let errorMessages =
                    `@foreach ($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach`;
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