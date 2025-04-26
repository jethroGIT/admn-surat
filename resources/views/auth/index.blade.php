<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Maranatha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan CSS untuk mengatur z-index -->
    <style>
        .swal2-container {
            z-index: 999999 !important;
        }
        body {
            overflow: auto !important;
        }
        .swal2-popup {
            font-size: 1rem !important;
        }
    </style>
</head>

<body class="h-screen overflow-hidden font-sans bg-gray-100">

    <div class="flex flex-col md:flex-row h-full">

        <!-- Left side image (2/3 width) -->
        <div class="w-full md:w-2/3 h-full">
            <img src="{{ asset('image/Universitas-Kristen-Maranatha.jpg') }}" alt="Maranatha"
                class="w-full h-full object-cover">
        </div>

        <!-- Right side login form (1/3 width) -->
        <div class="w-full md:w-1/3 flex items-center justify-center px-6 py-10 bg-white shadow-lg">
            <div class="w-full max-w-sm text-center">

                <!-- Logo -->
                <img src="{{ asset('image/logofakultas.png') }}" alt="Logo Fakultas Teknologi Informasi"
                    class="mx-auto w-52 h-auto mb-6" />

                <!-- Sign In Text -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Sign in</h2>

                <!-- Login Form -->
                <form action="{{ url('/login') }}" method="POST" class="space-y-4 text-left">
                    @csrf

                    <!-- Username -->
                    <div>
                        <input type="text" name="username" placeholder="Username"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required />
                    </div>

                    <!-- Password -->
                    <div>
                        <input type="password" name="password" placeholder="Password"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required />
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-150">
                        Login
                    </button>
                </form>

                <!-- Footer -->
                <p class="text-xs text-gray-400 mt-2">© Jethro Andersson Apriliano Ofe. All rights reserved.</p>

            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert2 for validation errors -->
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let errorMessages = `
            @foreach ($errors->all() as $error)
                {!! nl2br(e($error)) !!}<br>
            @endforeach
        `;
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    html: errorMessages,
                    confirmButtonColor: '#2563eb',
                    allowOutsideClick: false,
                    backdrop: true,
                    customClass: {
                        container: 'swal2-container',
                        popup: 'swal2-popup'
                    }
                });
            });
        </script>
    @endif

</body>

</html>