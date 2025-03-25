<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <title>@yield('title', 'layout')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Tambahkan CSS Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    @yield('ExtraCSS')
</head>

<body>

    <!-- Include Sidebar -->
    @include('layout.sidebar')

    <!-- Include Navbar -->
    @include('layout.navbar')

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Welcome!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    <script src="{{ asset('js/layout.js') }}"></script>
    @yield('ExtraJS')
</body>

</html>
