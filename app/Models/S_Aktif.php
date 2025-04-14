<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class S_Aktif extends Model
{
    use HasFactory;

    protected $table = 'S_Aktif';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = 'false';

    protected $fillable = [
        'nrp',
        'semester',
        'alamat',
        'keperluan',
        'status',
        'file'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nrp', 'username'); // Pastikan 'nrp' ada di tabel S_LHS dan 'username' ada di tabel users
    }
}
