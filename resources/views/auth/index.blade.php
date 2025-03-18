<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<form action="{{ url('/login') }}" method="POST">
    @csrf
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>

</form>
<!-- SweetAlert2 Notification -->
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
