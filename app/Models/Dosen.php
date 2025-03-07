<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primarykey = 'nip';
    protected $keytype = 'string';
    public $incrementing = 'false';

    protected $fillable = [
        'nip',
        'nama',
        'fakultas',
        'prodi',
        'jabatan',
        'alamat',
        'email',
        'no_tlp',
        'status_dosen'
    ];
}
