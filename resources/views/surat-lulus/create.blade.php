@extends('layout.layout')
@section('title', 'Ajukan Surat Lulus')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Container dengan lebar lebih besar -->
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header Section -->
            <div class="bg-indigo-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Pengajuan Surat Keterangan Lulus</h2>
                <p class="text-indigo-100">Silakan isi tanggal kelulusan Anda</p>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terdapat {{ $errors->count() }} kesalahan dalam pengisian form</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('storeSuratLulus') }}">
                    @csrf

                    <!-- Tanggal Lulus Field - Lebih besar -->
                    <div class="mb-8">
                        <label for="tanggal_lulus" class="block text-lg font-medium text-gray-700 mb-3">Tanggal Kelulusan <span class="text-red-500">*</span></label>
                        <input type="date" 
                               name="tanggal_lulus" 
                               id="tanggal_lulus"
                               class="block w-full px-5 py-3 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required
                               value="{{ old('tanggal_lulus') }}">
                        <p class="mt-2 text-gray-500">Masukkan tanggal resmi kelulusan Anda</p>
                    </div>

                    <!-- Submit Button - Lebih besar -->
                    <div class="flex justify-end space-x-4 mt-8">
                        <a href="{{ route('surat-lulus') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-lg">
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
        // Set max date to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_lulus').max = today;
        });
    </script>
@endsection