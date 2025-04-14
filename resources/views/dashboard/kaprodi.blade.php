@extends('layout.layout')
@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Kepala Program Studi</h1>
            <p class="text-gray-600">Monitor pengajuan surat mahasiswa</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Card: Surat Keterangan Aktif -->
            <div class="bg-white p-4 rounded-lg shadow border-l-4 border-blue-500">
                <div class="flex justify-between">
                    <div>
                        <p class="text-gray-500">Keterangan Aktif</p>
                        <h2 class="text-2xl font-bold">12 <span class="text-sm font-normal text-red-600">(5 baru)</span></h2>
                    </div>
                    <i class="fas fa-user-check text-blue-500 text-2xl mt-2"></i>
                </div>
            </div>

            <!-- Card: Surat Keterangan Lulus -->
            <div class="bg-white p-4 rounded-lg shadow border-l-4 border-green-500">
                <div class="flex justify-between">
                    <div>
                        <p class="text-gray-500">Keterangan Lulus</p>
                        <h2 class="text-2xl font-bold">8 <span class="text-sm font-normal text-red-600">(3 baru)</span></h2>
                    </div>
                    <i class="fas fa-graduation-cap text-green-500 text-2xl mt-2"></i>
                </div>
            </div>

            <!-- Card: Laporan Hasil Studi -->
            <div class="bg-white p-4 rounded-lg shadow border-l-4 border-yellow-500">
                <div class="flex justify-between">
                    <div>
                        <p class="text-gray-500">Laporan Hasil Studi</p>
                        <h2 class="text-2xl font-bold">6 <span class="text-sm font-normal text-red-600">(2 baru)</span></h2>
                    </div>
                    <i class="fas fa-file-alt text-yellow-500 text-2xl mt-2"></i>
                </div>
            </div>

            <!-- Card: Surat Pengantar Mata Kuliah -->
            <div class="bg-white p-4 rounded-lg shadow border-l-4 border-purple-500">
                <div class="flex justify-between">
                    <div>
                        <p class="text-gray-500">Pengantar Mata Kuliah</p>
                        <h2 class="text-2xl font-bold">15 <span class="text-sm font-normal text-red-600">(7 baru)</span>
                        </h2>
                    </div>
                    <i class="fas fa-book-open text-purple-500 text-2xl mt-2"></i>
                </div>
            </div>
        </div>

        <!-- Tab Navigation untuk 4 Jenis Surat -->
        <div class="mb-6 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px" id="suratTabs">
                <li class="mr-2" data-tab="keterangan-aktif">
                    <button class="inline-block p-4 border-b-2 border-blue-500 text-blue-600 font-medium">Keterangan
                        Aktif</button>
                </li>
                <li class="mr-2" data-tab="keterangan-lulus">
                    <button
                        class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300">Keterangan
                        Lulus</button>
                </li>
                <li class="mr-2" data-tab="laporan-hasil-studi">
                    <button
                        class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300">Laporan
                        Hasil Studi</button>
                </li>
                <li class="mr-2" data-tab="pengantar-matkul">
                    <button
                        class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300">Pengantar
                        Mata Kuliah</button>
                </li>
            </ul>
        </div>

        <!-- Filter Status -->
        <div class="mb-4 flex justify-between items-center">
            <div>
                <label class="mr-2">Filter:</label>
                <select class="border rounded-md px-3 py-1">
                    <option>Semua Status</option>
                    <option selected>Pengajuan Baru</option>
                    <option>Disetujui</option>
                    <option>Ditolak</option>
                </select>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-sync-alt mr-2"></i> Refresh Data
            </button>
        </div>

        <!-- Tabel Surat Pengajuan (Contoh untuk Surat Keterangan Aktif) -->
        <div id="keterangan-aktif" class="tab-content bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 bg-blue-600 text-white">
                <h2 class="font-bold">Pengajuan Surat Keterangan Aktif</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Pengajuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Mahasiswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Data 1 -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">SKAKT-2024-001</td>
                            <td class="px-6 py-4 whitespace-nowrap">21012345</td>
                            <td class="px-6 py-4 whitespace-nowrap">Andi Wijaya</td>
                            <td class="px-6 py-4 whitespace-nowrap">15 Mei 2024</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="text-green-600 hover:text-green-900 mr-3" title="Setujui">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900" title="Tolak">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Data lainnya -->
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t flex justify-between items-center">
                <span class="text-sm text-gray-600">Menampilkan 1-5 dari 12 pengajuan</span>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border rounded-md">Sebelumnya</button>
                    <button class="px-3 py-1 border rounded-md bg-blue-600 text-white">1</button>
                    <button class="px-3 py-1 border rounded-md">2</button>
                    <button class="px-3 py-1 border rounded-md">Selanjutnya</button>
                </div>
            </div>
        </div>

        <!-- Tab Lainnya (hidden by default) -->
        <div id="keterangan-lulus" class="tab-content hidden">
            <!-- Struktur sama dengan tab Keterangan Aktif -->
        </div>
        <div id="laporan-hasil-studi" class="tab-content hidden">
            <!-- Struktur sama -->
        </div>
        <div id="pengantar-matkul" class="tab-content hidden">
            <!-- Struktur sama -->
        </div>
    </div>
@endsection

@section('ExtraJS')
    <script>
        // Script untuk toggle tab
        document.querySelectorAll('[data-tab]').forEach(tab => {
            tab.addEventListener('click', () => {
                // Update active tab style
                document.querySelectorAll('[data-tab] button').forEach(btn => {
                    btn.classList.remove('border-blue-500', 'text-blue-600');
                    btn.classList.add('border-transparent', 'hover:text-gray-600');
                });
                tab.querySelector('button').classList.add('border-blue-500', 'text-blue-600');
                tab.querySelector('button').classList.remove('border-transparent', 'hover:text-gray-600');

                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });

                // Show selected tab
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(tabId).classList.remove('hidden');
            });
        });

        // Auto-refresh setiap 30 detik (opsional)
        setInterval(() => {
            console.log("Memperbarui data...");
            // Tambahkan logika fetch data terbaru di sini
        }, 30000);
    </script>
@endsection
