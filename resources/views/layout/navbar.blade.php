<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="profile">Profil</a>
                </li>
                <li class="nav-item">
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="display: inline;">Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
