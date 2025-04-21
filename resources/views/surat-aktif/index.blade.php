@extends('layout.layout')
@section('title', 'Surat Lulus')

@section('content')
    <div class="container mx-auto px-4 py-8">
        @if (in_array(auth()->user()->role->role_name, ['admin', 'kaprodi', 'tu', 'mahasiswa']))
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-1">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-indigo-800">Pengajuan Surat Keterangan Aktif</h1>
                    <p class="text-gray-600">Manajemen data Surat Keterangan Aktif</p>
                </div>

                @if (auth()->user()->role->role_name == 'admin')
                    <a href="{{ route('createSuratAktif') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Pengajuan Surat
                    </a>
                @endif
            </div>

            <!-- Search Section -->
            @if (in_array(auth()->user()->role->role_name, ['admin', 'kaprodi', 'tu']))
                <div class="bg-white rounded-xl shadow-md p-6 mb-4">
                    <form method="GET">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-grow relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Cari berdasarkan NRP...">
                            </div>
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition-colors whitespace-nowrap">
                                Cari
                            </button>
                            @if (request()->has('search'))
                                <a href="{{ url()->current() }}"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg transition-colors flex items-center whitespace-nowrap">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            @endif

            @if (in_array(auth()->user()->role->role_name, ['admin', 'kaprodi', 'tu', 'mahasiswa']))
                <!-- Filter Section -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Filter berdasarkan tanggal</h3>
                    <form method="GET">
                        <div class="flex flex-col md:flex-row gap-4 items-end">
                            <!-- Month Filter -->
                            <div class="w-full md:w-48">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                                <select name="month"
                                    class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Semua Bulan</option>
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ $month }}"
                                            {{ request('month') == $month ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Year Filter -->
                            <div class="w-full md:w-48">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                                <select name="year"
                                    class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Semua Tahun</option>
                                    @foreach (range(date('Y'), date('Y') - 5, -1) as $year)
                                        <option value="{{ $year }}"
                                            {{ request('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-2 w-full md:w-auto">
                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition-colors whitespace-nowrap">
                                    Terapkan Filter
                                </button>
                                @if (request()->has('month') || request()->has('year'))
                                    <a href="{{ url()->current() }}?{{ http_build_query(request()->except('month', 'year')) }}"
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg transition-colors flex items-center whitespace-nowrap">
                                        Reset Filter
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @endif

        <!-- Letter Table Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            @if ($query->count() == 0)
                <div class="p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Data tidak ditemukan</h3>
                    <p class="mt-1 text-gray-500">Tidak ada data surat yang sesuai dengan pencarian Anda.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                    NO. PENGAJUAN</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                    NRP</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                    NAMA MAHASISWA</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                    File</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($query as $surat)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $surat->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $surat->nrp }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $surat->user->nama }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($surat->status === 'Disetujui')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $surat->status }}
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                {{ $surat->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($surat->file)
                                            <a href="{{ asset('storage/' . $surat->file) }}" target="_blank"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                Lihat File
                                            </a>
                                        @else
                                            <span class="text-gray-400">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-4">
                                            <a href="{{ route('showSuratAktif', $surat->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd"
                                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Lihat
                                            </a>

                                            @if (in_array(auth()->user()->role->role_name, ['admin', 'mahasiswa']))
                                                @if ($surat->status == 'Pengajuan')
                                                    <a href="{{ route('editSuratAktif', $surat->id) }}"
                                                        class="text-yellow-600 hover:text-yellow-900 flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                @endif
                                            @endif

                                            @if (in_array(auth()->user()->role->role_name, ['admin', 'mahasiswa']))
                                                <form id="delete-form-{{ $surat->id }}"
                                                    action="{{ route('destroySuratAktif', $surat->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete('{{ $surat->id }}')"
                                                        class="text-red-600 hover:text-red-900 flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $query->links() }}
        </div>
    </div>
@endsection

@section('ExtraJS')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data surat lulus ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-xl'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
