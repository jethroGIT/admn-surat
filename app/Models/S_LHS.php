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

    public function user()
    {
        return $this->belongsTo(User::class, 'nrp', 'username'); // Pastikan 'nrp' ada di tabel S_LHS dan 'username' ada di tabel users
    }
}
