<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primarykey = 'nik';
    protected $keytype = 'string';
    public $incrementing = 'false';

    protected $fillable = [
        'nik',
        'nama',
        'jabatan',
        'alamat',
        'email',
        'no_tlp',
        'status'
    ];
}
