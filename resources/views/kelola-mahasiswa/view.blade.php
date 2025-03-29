@extends('layout.layout')
@section('title', 'Profil Mahasiswa')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4 sm:px-6 lg:px-8">
        <!-- Changed container width to be more responsive -->
        <div class="mx-auto w-full max-w-2xl lg:max-w-4xl">
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
                <!-- Profile Header -->
                <div class="bg-indigo-600 px-6 py-8 text-center">
                    <div
                        class="mx-auto h-24 w-24 rounded-full bg-white shadow-md overflow-hidden border-4 border-white mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->nama) }}&background=random&color=fff&size=128"
                            alt="{{ $mahasiswa->nama }}" class="h-full w-full object-cover">
                    </div>
                    <h1 class="text-2xl font-bold text-white">{{ $mahasiswa->nama }}</h1>
                    <p class="text-indigo-200 mt-1">{{ $mahasiswa->prodi->nama_prodi ?? 'Belum memiliki program studi' }}</p>
                    <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-semibold 
                        {{ $mahasiswa->status === 'Aktif' ? 'bg-green-100 text-green-800' : 
                           ($mahasiswa->status === 'Cuti' ? 'bg-blue-100 text-blue-800' : 
                           ($mahasiswa->status === 'Lulus' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800')) }}">
                        {{ $mahasiswa->status }}
                    </span>
                </div>

                <!-- Profile Details -->
                <div class="px-6 py-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Username -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 text-indigo-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">Username</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $mahasiswa->username }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 text-indigo-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $mahasiswa->email }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 text-indigo-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">Telepon</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $mahasiswa->no_tlp }}</p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 text-indigo-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">Alamat</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $mahasiswa->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('indexUser', ['tipe' => 'mahasiswa']) }}"
                            class="flex-1 bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-300 rounded-lg transition duration-200 flex items-center justify-center">
                            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                        <a href="{{ route('editUser', ['tipe' => 'mahasiswa', 'username' => $mahasiswa->username]) }}"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
