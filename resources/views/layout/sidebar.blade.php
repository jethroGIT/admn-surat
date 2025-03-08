<!-- resources/views/layout/sidebar.blade.php -->
<div class="sidebar">
    <div class="text-center py-0">
        <h4 class="text-white">Menu</h4>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ url('/dashboard') }}" class="nav-link text-white">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="#" onclick="toggleSubMenu('kelola-akun')" class="nav-link text-white">Kelola Akun</a>
            <ul id="kelola-akun" class="submenu">
                <li><a href="#" class="nav-link text-white">Akun Karyawan</a></li>
                <li><a href="#" class="nav-link text-white">Akun Dosen</a></li>
                <li><a href="kelola-mahasiswa" class="nav-link text-white">Akun Mahasiswa</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" onclick="toggleSubMenu('kelola-surat')" class="nav-link text-white">Kelola Surat</a>
            <ul id="kelola-surat" class="submenu">
                <li><a href="#" class="nav-link text-white">Surat Keterangan Aktif</a></li>
                <li><a href="#" class="nav-link text-white">Surat Keterangan Lulus</a></li>
                <li><a href="#" class="nav-link text-white">Surat Laporan Hasil Studi</a></li>
                <li><a href="#" class="nav-link text-white">Surat Pengantar</a></li>

            </ul>
        </li>
    </ul>
</div>