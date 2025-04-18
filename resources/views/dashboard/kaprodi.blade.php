@extends('dashboard.dashboard')

@section('quickStats')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Card: Surat Keterangan Aktif -->
        <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
            <div class="flex justify-between items-center">
                <div class="pr-4"> <!-- Tambahkan padding right -->
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
                        @if ($suratA->status == 'Pengajuan')
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($totalSuratAktif == 0)
            <div class="p-4 border-t flex justify-between items-center">
                <div class="text-sm text-gray-600 mt-2">
                    <span class="font-medium">Tidak ada pengajuan</span>
                </div>
            </div>
        @else
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
        @endif
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
                        @if ($suratL->status == 'Pengajuan')
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($totalSuratLulus == 0)
            <div class="p-4 border-t flex justify-between items-center">
                <div class="text-sm text-gray-600 mt-2">
                    <span class="font-medium">Tidak ada pengajuan</span>
                </div>
            </div>
        @else
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
        @endif
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
                        @if ($suratLH->status == 'Pengajuan')
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($totalSuratLHS == 0)
            <div class="p-4 border-t flex justify-between items-center">
                <div class="text-sm text-gray-600 mt-2">
                    <span class="font-medium">Tidak ada pengajuan</span>
                </div>
            </div>
        @else
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
        @endif
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
                        @if ($suratP->status == 'Pengajuan')
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($totalSuratPengantar == 0)
            <div class="p-4 border-t flex justify-between items-center">
                <div class="text-sm text-gray-600 mt-2">
                    <span class="font-medium">Tidak ada pengajuan</span>
                </div>
            </div>
        @else
            <div class="p-4 border-t flex justify-between items-center">
                <div class="text-sm text-gray-600 mt-2">
                    <span class="font-medium">{{ $totalSuratPengantar }}</span>
                    pengajuan belum diproses. Halaman ini hanya menampilkan
                    <span class="font-medium">1 sampai 5</span> data terbaru.
                </div>
                <a href="{{ route('surat-lhs') }}" class="px-3 py-1 border rounded-md">
                    Lihat Selengkapnya
                </a>
            </div>
        @endif
    </div>
@endsection
