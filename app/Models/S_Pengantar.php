<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class S_Pengantar extends Model
{
    use HasFactory;

    protected $table = 'S_Pengantar';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = 'false';

    protected $fillable = [
        'nrp',
        'nama',
        'tujuan_surat',
        'mata_kuliah',
        'semester',
        'data_mahasiswa',
        'status',
        'file'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nrp', 'username'); // Pastikan 'nrp' ada di tabel S_LHS dan 'username' ada di tabel users
    }
}
