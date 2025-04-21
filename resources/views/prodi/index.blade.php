@extends('layout.layout')
@section('title', 'Kelola Prodi')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-indigo-800">Daftar Program Studi</h1>
                <p class="text-gray-600">Manajemen data program studi</p>
            </div>

            <button onclick="openAddProdiModal()"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Tambah Prodi
            </button>
        </div>

        <!-- Prodi Table Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            @if ($prodis->count() == 0)
                <div class="p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Data tidak ditemukan</h3>
                    <p class="mt-1 text-gray-500">Belum ada data program studi yang terdaftar.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                    ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                    Nama Program Studi</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($prodis as $prodi)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $prodi->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="font-medium">{{ $prodi->nama_prodi }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-4">
                                            <!-- Edit Button -->
                                            <button
                                                onclick="openEditProdiModal('{{ $prodi->id }}', '{{ $prodi->nama_prodi }}')"
                                                class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                                Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <form id="delete-form-{{ $prodi->id }}"
                                                action="{{ route('destroyProdi', $prodi->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ $prodi->id }}')"
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
            {{ $prodis->links() }}
        </div>
    </div>

    <!-- Add Prodi Modal -->
    <div id="addProdiModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-xl bg-white">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-indigo-800">Tambah Program Studi Baru</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form id="addProdiForm" action="{{ route('storeProdi') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_prodi" class="block text-sm font-medium text-gray-700 mb-1">Nama Program Studi</label>
                    <input type="text" id="nama_prodi" name="nama_prodi"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Masukkan nama program studi" required>
                    @error('nama_prodi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Prodi Modal -->
    <div id="editProdiModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-xl bg-white">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-indigo-800">Edit Program Studi</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form id="editProdiForm" method="POST">
                @csrf
                <input type="hidden" id="edit_prodi_id" name="id">

                <div class="mb-4">
                    <label for="edit_nama_prodi" class="block text-sm font-medium text-gray-700 mb-1">Nama Program
                        Studi</label>
                    <input type="text" id="edit_nama_prodi" name="nama_prodi"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Masukkan nama program studi" required>
                    @error('nama_prodi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('ExtraJS')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Add Modal Functions
        function openAddProdiModal() {
            document.getElementById('addProdiModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addProdiModal').classList.add('hidden');
        }

        // Edit Modal Functions
        function openEditProdiModal(id, nama_prodi) {
            document.getElementById('editProdiModal').classList.remove('hidden');
            document.getElementById('edit_prodi_id').value = id;
            document.getElementById('edit_nama_prodi').value = nama_prodi;

            // Set the form action to match your route
            document.getElementById('editProdiForm').action = `/prodi/${id}/update`;
        }

        function closeEditModal() {
            document.getElementById('editProdiModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const addModal = document.getElementById('addProdiModal');
            const editModal = document.getElementById('editProdiModal');

            if (event.target === addModal) {
                closeModal();
            }
            if (event.target === editModal) {
                closeEditModal();
            }
        }

        // Delete Confirmation
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Program studi ini akan dihapus secara permanen!",
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

        // Handle form submission success/error
        @if (session('success'))
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#4F46E5',
                customClass: {
                    popup: 'rounded-xl'
                }
            });
        @endif

        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                @if (isset($prodi) && $errors->has('nama_prodi'))
                    openEditProdiModal('{{ $prodi->id ?? '' }}', '{{ $prodi->nama_prodi ?? '' }}');
                @else
                    openAddProdiModal();
                @endif
            });
        @endif
    </script>
@endsection
