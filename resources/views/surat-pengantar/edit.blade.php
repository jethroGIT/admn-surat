@extends('layout.layout')
@section('title', 'Pengajuan Surat Pengantar')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Container dengan lebar lebih besar -->
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header Section -->
            <div class="bg-indigo-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Pengajuan Surat Pengantar Mata Kuliah</h2>
                <p class="text-indigo-100">Silakan isi form berikut untuk pengajuan surat pengantar</p>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <!-- Form Title -->
                <form method="POST" action="{{ route('updateSuratPengantar', $suratPengantar->id) }}">
                    @csrf
                    <!-- Surat Ditujukan Kepada Field -->
                    <div class="mb-6">
                        <label for="tujuan_surat" class="block text-lg font-medium text-gray-700 mb-2">
                            Surat Ditujukan kepada <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="tujuan_surat" 
                            id="tujuan_surat"
                            class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required
                            placeholder="Contoh: Ibu Susi Susanti; Kepala Personalia PT. X; Jl. Cibogo no. 10 Bandung"
                            value="{{ old('tujuan_surat', $suratPengantar->tujuan_surat) }}">
                        <p class="mt-1 text-gray-500">Informasikan secara lengkap nama, jabatan, nama perusahaan, dan alamat perusahaan</p>
                    </div>
                
                    <!-- Mata Kuliah Field -->
                    <div class="mb-6">
                        <label for="mata_kuliah" class="block text-lg font-medium text-gray-700 mb-2">
                            Nama Mata Kuliah - Kode Mata Kuliah <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="mata_kuliah" 
                            id="mata_kuliah"
                            class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required
                            placeholder="Contoh: Proses Bisnis - IN255"
                            value="{{ old('mata_kuliah', $suratPengantar->mata_kuliah) }}">
                    </div>
                
                    <!-- Semester Field -->
                    <div class="mb-6">
                        <label for="semester" class="block text-lg font-medium text-gray-700 mb-2">
                            Semester <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="semester" 
                            id="semester"
                            class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required
                            placeholder="Contoh: Semester Genap 23/24"
                            value="{{ old('semester', $suratPengantar->semester) }}">
                    </div>
                
                    <!-- Data Mahasiswa Field -->
                    <div class="mb-6">
                        <label for="data_mahasiswa" class="block text-lg font-medium text-gray-700 mb-2">
                            Data Mahasiswa <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="data_mahasiswa" 
                            id="data_mahasiswa"
                            rows="3"
                            class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required
                            placeholder="Contoh: Mahasiswa 1 - 15720xx; Mahasiswa 2 - 15720xx">{{ old('data_mahasiswa', $suratPengantar->data_mahasiswa) }}</textarea>
                        <p class="mt-1 text-gray-500">Informasikan nama dan NRP tiap mahasiswa</p>
                    </div>
                
                    <!-- Keperluan Field -->
                    <div class="mb-6">
                        <label for="keperluan" class="block text-lg font-medium text-gray-700 mb-2">
                            Alasan Keperluan <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="keperluan" 
                            id="keperluan"
                            rows="4"
                            class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required
                            placeholder="Masukkan alasan keperluan pembuatan surat">{{ old('keperluan', $suratPengantar->keperluan) }}</textarea>
                    </div>
                
                    <!-- Topik Field -->
                    <div class="mb-6">
                        <label for="topik" class="block text-lg font-medium text-gray-700 mb-2">
                            Topik <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="topik" 
                            id="topik"
                            class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required
                            placeholder="Masukkan topik surat"
                            value="{{ old('topik', $suratPengantar->topik) }}">
                    </div>
                
                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4 mt-8">
                        <a href="{{ route('surat-pengantar') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-lg">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3 border border-transparent rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-lg">
                            Update Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection