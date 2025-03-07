<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $primarykey = 'id';
    protected $keytype = 'string';
    protected $incrementing = 'false';

    protected $fillable = [
        'id',
        'nrp',
        'nama',
        'fakultas',
        'prodi',
        'alamat',
        'email',
        'no_tlp',
        'periode',
        'kategori',
        'keterangan',
        'file',
        'status'
    ];
}
