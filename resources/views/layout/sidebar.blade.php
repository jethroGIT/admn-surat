<!-- resources/views/layout/sidebar.blade.php -->
<div class="sidebar bg-gradient-to-b from-blue-600 to-blue-150 shadow-lg w-64 min-h-screen fixed transition-all duration-300 z-10 overflow-y-auto h-[calc(100vh-6rem)] hide-scrollbar">
    <!-- Logo/Site Name -->
    <div class="p-4 flex items-center justify-center border-b border-blue-400">
        <div class="text-center">
            <img src="{{ asset('image/logofakultas.png') }}" alt="">
            <p class="text-blue-200 text-xs mt-1">Management System</p>
        </div>
    </div>
    
    <!-- Menu Items -->
    <ul class="space-y-2 p-4">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ url('/dashboard') }}" class="flex items-center p-3 text-white rounded-lg hover:bg-blue-500/30 transition-colors duration-200 group">
                <i class="bi bi-speedometer2 mr-3 text-lg group-hover:text-blue-100"></i>
                <span class="font-medium">Dashboard</span>
            </a>
        </li>

        @if (auth()->user()->role->role_name == 'admin')
            <li class="nav-item">
                <a href="{{ route('prodi') }}" class="flex items-center p-3 text-white rounded-lg hover:bg-blue-500/30 transition-colors duration-200 group">
                    <i class="bi bi-building mr-3 text-lg group-hover:text-blue-100"></i>
                    <span class="font-medium">Program Studi</span>
                </a>
            </li>
        @endif

        <!-- Kelola Akun - Accordion -->
        @if (in_array(auth()->user()->role->role_name, ['admin', 'tu']))
            <li class="nav-item">
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-3 text-white rounded-lg hover:bg-blue-500/30 transition-colors duration-200 group">
                        <div class="flex items-center">
                            <i class="bi bi-people-fill mr-3 text-lg group-hover:text-blue-100"></i>
                            <span class="font-medium">Kelola Akun</span>
                        </div>
                        <i class="bi bi-chevron-down transition-transform duration-200 group-hover:text-blue-100" :class="{ 'transform rotate-180': open }"></i>
                    </button>

                    <ul x-show="open" x-collapse class="ml-8 mt-1 space-y-2">
                        @if (auth()->user()->role->role_name == 'admin')
                            <li>
                                <a href="{{ route('indexUser', ['tipe' => 'tu']) }}" class="flex items-center p-2 text-blue-100 rounded hover:bg-blue-400/40 hover:text-white transition-colors duration-200">
                                    <i class="bi bi-person-vcard mr-2"></i>
                                    Akun TU
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role->role_name == 'admin' || auth()->user()->role->role_name == 'tu')
                            <li>
                                <a href="{{ route('indexUser', ['tipe' => 'kaprodi']) }}" class="flex items-center p-2 text-blue-100 rounded hover:bg-blue-400/40 hover:text-white transition-colors duration-200">
                                    <i class="bi bi-person-gear mr-2"></i>
                                    Akun Kaprodi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('indexUser', ['tipe' => 'mahasiswa']) }}" class="flex items-center p-2 text-blue-100 rounded hover:bg-blue-400/40 hover:text-white transition-colors duration-200">
                                    <i class="bi bi-person-video3 mr-2"></i>
                                    Akun Mahasiswa
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif
        
        <li class="nav-item">
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between p-3 text-white rounded-lg hover:bg-blue-500/30 transition-colors duration-200 group">
                    <div class="flex items-center">
                        <i class="bi bi-file-earmark-text-fill mr-3 text-lg group-hover:text-blue-100"></i>
                        <span class="font-medium">Form Surat</span>
                    </div>
                    <i class="bi bi-chevron-down transition-transform duration-200 group-hover:text-blue-100" :class="{ 'transform rotate-180': open }"></i>
                </button>
                
                <ul x-show="open" x-collapse class="ml-8 mt-1 space-y-2">
                    <li>
                        <a href="{{ route('surat-aktif') }}" class="flex items-center p-2 text-blue-100 rounded hover:bg-blue-400/40 hover:text-white transition-colors duration-200">
                            <i class="bi bi-file-text mr-2"></i>
                            Surat Keterangan Aktif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('surat-lulus') }}" class="flex items-center p-2 text-blue-100 rounded hover:bg-blue-400/40 hover:text-white transition-colors duration-200">
                            <i class="bi bi-file-check mr-2"></i>
                            Surat Keterangan Lulus
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('surat-lhs') }}" class="flex items-center p-2 text-blue-100 rounded hover:bg-blue-400/40 hover:text-white transition-colors duration-200">
                            <i class="bi bi-file-bar-graph mr-2"></i>
                            Surat LHS
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('surat-pengantar') }}" class="flex items-center p-2 text-blue-100 rounded hover:bg-blue-400/40 hover:text-white transition-colors duration-200">
                            <i class="bi bi-file-earmark-arrow-up mr-2"></i>
                            Surat Pengantar
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>