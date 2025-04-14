@extends('layout.layout')
@section('title', 'Admin Panel - Detail Kelulusan')

@section('ExtraCSS')
    <style>
        .btn-success,
        .btn-danger {
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-1px);
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        .centered-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
    </style>
@endsection

@section('content')
    <!-- Main Content -->
    <div class="centered-container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Detail Pengajuan Surat Mahasiswa</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0">
                                <img src="https://ui-avatars.com/api/?name={{ $suratPengantar->user->nama }}&size=80&background=random"
                                    class="rounded-circle" alt="Profile">
                            </div>
                            <div class="flex-grow-1 ms-4">
                                <h4 class="mb-1">{{ $suratPengantar->user->nama }}</h4>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-id-card me-1"></i> NRP: {{ $suratPengantar->nrp }}
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-graduation-cap me-1"></i> Program Studi: {{ $suratPengantar->user->prodi->nama_prodi }}
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-envelope me-1"></i> Tujuan Surat: {{ $suratPengantar->tujuan_surat }}
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-book me-1"></i> Mata Kuliah: {{ $suratPengantar->mata_kuliah }}
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-calendar-alt me-1"></i> Semester: {{ $suratPengantar->semester }}
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-users me-1"></i> Data Mahasiswa: {{ $suratPengantar->data_mahasiswa }}
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-info-circle me-1"></i> Keperluan: {{ $suratPengantar->keperluan }}
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-tag me-1"></i> Topik: {{ $suratPengantar->topik }}
                                </p>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="alert alert-success p-3">
                                    <h5 class="alert-heading mb-2">
                                        <i class="fas fa-check-circle me-2"></i>Status Pengajuan
                                    </h5>
                                    <p class="mb-0">{{ $suratPengantar->status }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-info p-3">
                                    <h5 class="alert-heading mb-2">
                                        <i class="fas fa-file-alt me-2"></i>ID Surat
                                    </h5>
                                    <p class="mb-0">{{ $suratPengantar->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i> Terakhir diperbarui: {{ $suratPengantar->updated_at }}
                        </small>

                        @if($suratPengantar->file != null)
                            <a href="{{ route('downloadSuratLHS', $suratPengantar->id) }}" class="btn btn-sm btn-success float-end ms-2">
                                <i class="fas fa-download me-1"></i> Download Surat
                            </a>
                        @endif
                        
                        @if (auth()->user()->role->role_name == 'admin' || auth()->user()->role->role_name == 'tu')
                            @if($suratPengantar->status == 'Disetujui' && $suratPengantar->file == null)
                                <form action="{{ route('uploadSuratPengantar', $suratPengantar->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Upload Surat Kelulusan</label>
                                        <input class="form-control form-control-sm @error('file') is-invalid @enderror" 
                                               id="file" name="file" type="file" accept=".pdf">

                                        <div class="form-text">Format: PDF, Ukuran maksimal: 2MB</div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-upload me-1"></i> Upload
                                        </button>
                                    </div>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            @if (auth()->user()->role->role_name == 'admin' || auth()->user()->role->role_name == 'kaprodi')
                <div class="col-lg-4">
                    <!-- Approval Actions -->
                    <div class="card mb-4">
                        <form method="POST" action="{{ route('updateSuratPengantar', $suratPengantar->id) }}">
                            @csrf
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-clipboard-check me-2"></i>Persetujuan Kelulusan
                            </div>
                            <div class="card-body">
                                <button type="submit" value="Disetujui" name="status" class="btn btn-success w-100 mb-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i> Disetujui
                                </button>
                                <button type="submit" value="Ditolak" name="status" class="btn btn-danger w-100 py-2">
                                    <i class="fas fa-times-circle me-1"></i> Ditolak
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif   
        </div>
    </div>
@endsection