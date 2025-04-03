<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class S_Lulus extends Model
{
    use HasFactory;

    protected $table = 'S_Lulus';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    // public $incrementing = 'false';

    protected $fillable = [
        'id',
        'nrp',
        'tanggal_lulus',
        'status',
        'file'
    ];
}
