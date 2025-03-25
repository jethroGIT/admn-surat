<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class S_Pengantar extends Model
{
    use HasFactory;

    protected $table = 'S_Pengantar';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    // public $incrementing = 'false';

    protected $fillable = [
        'id',
        'nrp',
        'nama',
        'tujuan_surat',
        'mata_kuliah',
        'semester',
        'data_mahasiswa',
        'status',
        'file'
    ];
}
