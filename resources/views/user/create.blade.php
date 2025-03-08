@extends('layout.layout')
@section('title', 'User')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            margin-top: 50px;
            max-width: 400px; /* Lebar form diperkecil */
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 15px; /* Jarak antara setiap grup input */
        }

        .form-group label {
            display: block; /* Label di atas input */
            margin-bottom: 5px; /* Jarak antara label dan input */
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            padding: 8px 16px; /* Ukuran padding diperkecil */
            border-radius: 20px; /* Sudut tombol melengkung */
            font-size: 14px; /* Ukuran font diperkecil */
            margin: 0 5px; /* Jarak antara tombol */
            text-align: center;
            transition: background-color 0.3s ease; /* Animasi hover */
            width: auto; /* Lebar tombol disesuaikan dengan konten */
            min-width: 100px; /* Lebar minimal tombol */
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Warna hover */
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268; /* Warna hover */
        }

        .button-container {
            display: flex; /* Menggunakan flexbox untuk tata letak tombol */
            justify-content: space-between; /* Tombol Submit di kanan, Kembali di kiri */
            margin-top: 20px;
        }
    </style>

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