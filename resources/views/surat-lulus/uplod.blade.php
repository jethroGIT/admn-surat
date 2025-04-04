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
                                <img src="https://ui-avatars.com/api/?name={{ $suratLulus->user->nama }}&size=80&background=random"
                                    class="rounded-circle" alt="Profile">
                            </div>
                            <div class="flex-grow-1 ms-4">
                                <h4 class="mb-1">{{ $suratLulus->user->nama }}</h4>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-id-card me-1"></i> NRP: {{ $suratLulus->nrp }}
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-graduation-cap me-1"></i> Program Studi: {{ $suratLulus->user->prodi->nama_prodi }}
                                </p>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-calendar-alt me-1"></i> Tanggal Lulus: {{ $suratLulus->tanggal_lulus }}
                                </p>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="alert alert-success p-3">
                                    <h5 class="alert-heading mb-2">
                                        <i class="fas fa-check-circle me-2"></i>Status Pengajuan
                                    </h5>
                                    <p class="mb-0">{{ $suratLulus->status }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-info p-3">
                                    <h5 class="alert-heading mb-2">
                                        <i class="fas fa-file-alt me-2"></i>ID Surat
                                    </h5>
                                    <p class="mb-0">{{ $suratLulus->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i> Terakhir diperbarui: {{ $suratLulus->updated_at}}
                        </small>
                        <button class="btn btn-sm btn-primary float-end">
                            <i class="fas fa-print me-1"></i> Upload Surat
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Approval Actions -->
                <div class="card mb-4">
                    <form method="POST" action="{{ route('updateSuratLulus', $suratLulus->id) }}">
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
                </div>
            </div>
        </div>
    </div>
@endsection
