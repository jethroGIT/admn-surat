@extends('layout.layout')
@section('title', 'Ajukan Surat Pengantar')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Container dengan lebar lebih besar -->
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header Section -->
            <div class="bg-indigo-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Pengajuan Surat Keterangan Aktif</h2>
                <p class="text-indigo-100">Silakan isi form berikut untuk pengajuan surat keterangan akif</p>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <!-- Form Title -->
                <form method="POST" action="{{ route('storeSuratAktif') }}">
                    @csrf
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
                            placeholder="Contoh: Semester Genap 23/24"
                            value="{{ old('semester') }}">
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
                            placeholder="Masukkan alasan keperluan pembuatan surat">{{ old('keperluan') }}</textarea>
                    </div>
                
                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4 mt-8">
                        <a href="{{ route('surat-aktif') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-lg">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3 border border-transparent rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-lg">
                            Ajukan Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('ExtraJS')
    <script>
        // Any additional JavaScript can go here
    </script>
@endsection