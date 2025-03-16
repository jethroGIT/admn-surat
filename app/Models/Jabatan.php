<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    // protected $incrementing = 'false';

    protected $fillable = [
        'id',
        'id_username',
        'jabatan',
        'tahun_ajar',
        'status'
    ];
}
