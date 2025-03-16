<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primarykey = 'nrp';
    protected $keytype = 'string';
    public $incrementing = 'false';

    public $fillable = [
        'nrp',
        'nama',
        'alamat',
        'email',
        'no_tlp',
        'status_mhs'
    ];
}
