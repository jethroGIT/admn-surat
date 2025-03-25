<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Prodi;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'username';
    protected $keyType = 'string';
    public $incrementing = 'false';

    protected $fillable = [
        'username',
        'password',
        'id_role',
        'id_prodi',
        'nama',
        'alamat',
        'email',
        'no_tlp',
        'status'
    ];

    protected $hidden = 'password';

    protected $casts = [
        'password' => 'hashed'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi'); // Pastikan 'id_prodi' ada di tabel users
    }
}
