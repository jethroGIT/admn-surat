@extends('layout.layout')
@section('title', 'Profil User')

@section('ExtraCSS')
<style>
    .profile-card {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px 20px;
        text-align: center;
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid white;
        object-fit: cover;
        margin-bottom: 15px;
        background-color: #f8f9fa;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #764ba2;
    }
    .profile-body {
        padding: 30px;
    }
    .profile-info {
        margin-bottom: 25px;
    }
    .profile-info h5 {
        color: #6c757d;
        margin-bottom: 5px;
        font-weight: 500;
    }
    .profile-info p {
        font-size: 18px;
        margin-bottom: 0;
        color: #343a40;
    }
    .badge-status {
        font-size: 14px;
        padding: 5px 15px;
        border-radius: 20px;
    }
    .status-active {
        background-color: #d4edda;
        color: #155724;
    }
    .status-inactive {
        background-color: #f8d7da;
        color: #721c24;
    }
    .section-title {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 10px;
        margin-bottom: 20px;
        color: #495057;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                    </div>
                    <h2>{{ $user->nama }}</h2>
                    <p class="mb-0">{{ $user->prodi->nama_prodi }}</p>
                </div>
                
                <div class="profile-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-info">
                                <h5>Username</h5>
                                <p>{{ $user->username }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-info">
                                <h5>Role</h5>
                                <p>
                                    @if($user->id_role == 0)
                                        Administrator
                                    @elseif($user->id_role == 1)
                                        Kepala Program Studi
                                    @elseif($user->id_role == 2)
                                        Tata Usaha
                                    @elseif($user->id_role == 3)
                                        Mahasiswa
                                    @else
                                        Lainnya
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="section-title mt-4">Informasi Kontak</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-info">
                                <h5>Email</h5>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-info">
                                <h5>Nomor Telepon</h5>
                                <p>{{ $user->no_tlp ?? 'Belum diisi' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="profile-info">
                        <h5>Alamat</h5>
                        <p>{{ $user->alamat ?? 'Belum diisi' }}</p>
                    </div>
                    
                    <div class="profile-info">
                        <h5>Status</h5>
                        <span class="badge-status {{ $user->status == 'active' ? 'status-active' : 'status-inactive' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('editUser', ['tipe' => 'user', 'username' => $user->username]) }}" 
                           class="btn btn-primary px-4">
                            <i class="fas fa-edit mr-2"></i>Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('ExtraJS')
<script>
    // Anda bisa menambahkan JavaScript jika diperlukan
    $(document).ready(function() {
        console.log('Profil page loaded');
    });
</script>
@endsection