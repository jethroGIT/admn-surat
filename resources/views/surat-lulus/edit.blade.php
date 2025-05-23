@extends('layout.layout')
@section('title', 'Update Surat Lulus')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Container dengan lebar lebih besar -->
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header Section -->
            <div class="bg-indigo-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Update Surat Keterangan Lulus</h2>
                <p class="text-indigo-100">Silakan perbarui tanggal kelulusan</p>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <!-- Form Title -->
                <form method="POST" action="{{ route('updateSuratLulus', $suratLulus->id) }}">
                    @csrf
                    <!-- Tanggal Lulus Field - Lebih besar -->
                    <div class="mb-8">
                        <label for="tanggal_lulus" class="block text-lg font-medium text-gray-700 mb-3">Tanggal Kelulusan <span class="text-red-500">*</span></label>
                        <input type="date" 
                               name="tanggal_lulus" 
                               id="tanggal_lulus"
                               class="block w-full px-5 py-3 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required
                               value="{{ old('tanggal_lulus', $suratLulus->tanggal_lulus) }}">
                        <p class="mt-2 text-gray-500">Perbarui tanggal resmi kelulusan</p>
                    </div>

                    <!-- Submit Button - Lebih besar -->
                    <div class="flex justify-end space-x-4 mt-8">
                        <a href="{{ route('surat-lulus') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-lg">
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