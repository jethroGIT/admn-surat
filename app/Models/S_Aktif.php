<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class S_Aktif extends Model
{
    use HasFactory;

    protected $table = 'S_Aktif';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    // public $incrementing = 'false';

    protected $fillable = [
        'id',
        'nrp',
        'nama',
        'tanggal_lulus',
        'status',
        'file'
    ];
}
