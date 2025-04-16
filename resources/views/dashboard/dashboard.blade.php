@extends('layout.layout')
@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Monitor Pengajuan Surat</h1>
            <p class="text-gray-600">Monitor pengajuan surat mahasiswa</p>
        </div>

        <!-- Quick Stats -->
        @yield('quickStats')

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

        <!-- Refresh Data -->
        <div class="mb-4 flex justify-between items-center">
            <button onclick="window.location.reload()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-sync-alt mr-2"></i> Refresh Data
            </button>
        </div>

        @yield('contentSurat')
        
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
