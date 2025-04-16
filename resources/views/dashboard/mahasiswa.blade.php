@extends('dashboard.dashboard')

@section('quickStats')
<div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
    <!-- Card: Surat Keterangan Aktif -->
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
        <div class="flex justify-between items-center">
            <div class="pr-4">
                <p class="text-gray-500 text-sm mb-1">Keterangan Aktif</p>
                <h2 class="text-2xl font-bold">
                    {{ $suratAktif->total() }}
                    <span class="text-sm font-normal text-red-600 ml-1">({{ $totalSuratAktif }} baru)</span>
                </h2>
            </div>
            <i class="fas fa-user-check text-blue-500 text-3xl"></i>
        </div>
    </div>

    <!-- Card: Surat Keterangan Lulus -->
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
        <div class="flex justify-between items-center">
            <div class="pr-4">
                <p class="text-gray-500 text-sm mb-1">Keterangan Lulus</p>
                <h2 class="text-2xl font-bold">
                    {{ $suratLulus->total() }}
                    <span class="text-sm font-normal text-red-600 ml-1">({{ $totalSuratLulus }} baru)</span>
                </h2>
            </div>
            <i class="fas fa-graduation-cap text-green-500 text-3xl"></i>
        </div>
    </div>

    <!-- Card: Laporan Hasil Studi -->
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500">
        <div class="flex justify-between items-center">
            <div class="pr-4">
                <p class="text-gray-500 text-sm mb-1">Laporan Hasil Studi</p>
                <h2 class="text-2xl font-bold">
                    {{ $suratLHS->total() }}
                    <span class="text-sm font-normal text-red-600 ml-1">({{ $totalSuratLHS }} baru)</span>
                </h2>
            </div>
            <i class="fas fa-file-alt text-yellow-500 text-3xl"></i>
        </div>
    </div>

    <!-- Card: Surat Pengantar Mata Kuliah -->
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-purple-500">
        <div class="flex justify-between items-center">
            <div class="pr-4">
                <p class="text-gray-500 text-sm mb-1">Pengantar Mata Kuliah</p>
                <h2 class="text-2xl font-bold">
                    {{ $suratPengantar->total() }}
                    <span class="text-sm font-normal text-red-600 ml-1">({{ $totalSuratPengantar }} baru)</span>
                </h2>
            </div>
            <i class="fas fa-book-open text-purple-500 text-3xl"></i>
        </div>
    </div>

    <!-- Card: Buat Pengajuan Surat -->
    <div class="bg-white p-4 rounded-lg shadow border-l-4 border-red-500">
        <div class="flex flex-col items-center justify-center h-full">
            <div class="dropdown relative">
                <button class="flex flex-col items-center focus:outline-none w-full">
                    <i class="fas fa-plus-circle text-red-500 text-3xl mb-2"></i>
                    <p class="text-gray-500 text-xs mb-1">Buat Pengajuan</p>
                    <span class="bg-red-500 text-white px-3 py-1 rounded inline-flex items-center text-sm">
                        <span>Surat Baru</span>
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </span>
                </button>
                <ul class="dropdown-menu absolute hidden w-full pt-1 z-10">
                    <li><a href="{{ route('createSuratAktif') }}" class="bg-gray-50 hover:bg-gray-100 py-1 px-3 block whitespace-no-wrap text-sm">Surat Aktif</a></li>
                    <li><a href="{{ route('createSuratLulus') }}" class="bg-gray-50 hover:bg-gray-100 py-1 px-3 block whitespace-no-wrap text-sm">Surat Lulus</a></li>
                    <li><a href="{{ route('createSuratLHS') }}" class="bg-gray-50 hover:bg-gray-100 py-1 px-3 block whitespace-no-wrap text-sm">LHS</a></li>
                    <li><a href="{{ route('createSuratPengantar') }}" class="bg-gray-50 hover:bg-gray-100 py-1 px-3 block whitespace-no-wrap text-sm">Pengantar MK</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</div>
@endsection

@section('contentSurat')
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Pengajuan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data 1 -->
                    @foreach ($suratAktif as $suratA)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratA->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratA->nrp }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratA->user->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($suratA->created_at)->format('d F Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($suratA->status === 'Disetujui')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $suratA->status }}
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        {{ $suratA->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t flex justify-between items-center">
            <div class="text-sm text-gray-600 mt-2">
                <span class="font-medium">{{ $totalSuratAktif }}</span>
                pengajuan belum diproses. Halaman ini hanya menampilkan
                <span class="font-medium">1 sampai 5</span> data terbaru.
            </div>
            <a href="{{ route('surat-aktif') }}" class="px-3 py-1 border rounded-md">
                Lihat Selengkapnya
            </a>
        </div>
    </div>


    <!-- Tab Lainnya (hidden by default) -->
    <div id="keterangan-lulus" class="tab-content bg-white rounded-lg shadow-md overflow-hidden hidden">
        <div class="p-4 bg-blue-600 text-white">
            <h2 class="font-bold">Pengajuan Surat Keterangan Lulus</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Pengajuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Pengajuan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data 1 -->
                    @foreach ($suratLulus as $suratL)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratL->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratL->nrp }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratL->user->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($suratL->created_at)->format('d F Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($suratL->status === 'Disetujui')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $suratL->status }}
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        {{ $suratL->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t flex justify-between items-center">
            <div class="text-sm text-gray-600 mt-2">
                <span class="font-medium">{{ $totalSuratLulus }}</span>
                pengajuan belum diproses. Halaman ini hanya menampilkan
                <span class="font-medium">1 sampai 5</span> data terbaru.
            </div>
            <a href="{{ route('surat-lulus') }}" class="px-3 py-1 border rounded-md">
                Lihat Selengkapnya
            </a>
        </div>
    </div>


    <div id="laporan-hasil-studi" class="tab-content bg-white rounded-lg shadow-md overflow-hidden hidden">
        <div class="p-4 bg-blue-600 text-white">
            <h2 class="font-bold">Pengajuan Surat Keterangan Laporan Hasil Studi</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Pengajuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Pengajuan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($suratLHS as $suratLH)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratLH->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratLH->nrp }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratLH->user->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($suratLH->created_at)->format('d F Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($suratLH->status === 'Disetujui')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $suratLH->status }}
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        {{ $suratLH->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t flex justify-between items-center">
            <div class="text-sm text-gray-600 mt-2">
                <span class="font-medium">{{ $totalSuratLHS }}</span>
                pengajuan belum diproses. Halaman ini hanya menampilkan
                <span class="font-medium">1 sampai 5</span> data terbaru.
            </div>
            <a href="{{ route('surat-lhs') }}" class="px-3 py-1 border rounded-md">
                Lihat Selengkapnya
            </a>
        </div>
    </div>

    <!-- Tab Pengantar Mata Kuliah -->
    <div id="pengantar-matkul" class="tab-content bg-white rounded-lg shadow-md overflow-hidden hidden">
        <div class="p-4 bg-blue-600 text-white">
            <h2 class="font-bold">Pengajuan Surat Pengantar Mata Kuliah</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Pengajuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Pengajuan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data 1 -->
                    @foreach ($suratPengantar as $suratP)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratP->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratP->nrp }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $suratP->user->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($suratP->created_at)->format('d F Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($suratP->status === 'Disetujui')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $suratP->status }}
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        {{ $suratP->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t flex justify-between items-center">
            <div class="text-sm text-gray-600 mt-2">
                <span class="font-medium">{{ $totalSuratLHS }}</span>
                pengajuan belum diproses. Halaman ini hanya menampilkan
                <span class="font-medium">1 sampai 5</span> data terbaru.
            </div>
            <a href="{{ route('surat-lhs') }}" class="px-3 py-1 border rounded-md">
                Lihat Selengkapnya
            </a>
        </div>
    </div>
@endsection
