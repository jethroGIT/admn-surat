<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perwalian extends Model
{
    use HasFactory;

    protected $table = 'perwalian';
    protected $primaryket = 'nik_dosen';
    protected $keytype = 'string';
    public $incrementing = 'false';

    protected $fillable = [
        'nik_dosen',
        'nama_dosen',
        'angkatan_mhs',
        'status'
    ];

}
