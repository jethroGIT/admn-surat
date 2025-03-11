<form action="" method="POST">
    @csrf
    <label for="nrp">NRP:</label>
    <input type="text" id="nrp" name="nrp" required><br>
    
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required><br>
    
    <label for="dosen_wali">Dosen Wali:</label>
    <input type="text" id="dosen_wali" name="dosen_wali" required><br>
    
    <label for="fakultas">Fakultas:</label>
    <input type="text" id="fakultas" name="fakultas" required><br>
    
    <label for="prodi">Program Studi:</label>
    <input type="text" id="prodi" name="prodi" required><br>
    
    <label for="angkatan_mhs">Angkatan:</label>
    <input type="number" id="angkatan_mhs" name="angkatan_mhs" required><br>
    
    <label for="alamat">Alamat:</label>
    <textarea id="alamat" name="alamat" required></textarea><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    
    <label for="no_tlp">Nomor Telepon:</label>
    <input type="tel" id="no_tlp" name="no_tlp" required><br>
    
    <label for="status_mhs">Status:</label>
    <select id="status_mhs" name="status_mhs" required>
        <option value="aktif">Aktif</option>
        <option value="cuti">Cuti</option>
        <option value="lulus">Lulus</option>
    </select><br>
    
    <button type="submit">Simpan</button>
</form>