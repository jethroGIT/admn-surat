<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class S_LHS extends Model
{
    use HasFactory;

    protected $table = 'S_LHS';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    // public $incrementing = 'false';

    protected $fillable = [
        'id',
        'nrp',
        'nama',
        'keperluan',
        'status',
        'file'
    ];
}
