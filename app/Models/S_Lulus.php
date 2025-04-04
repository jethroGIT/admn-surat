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

    public function getFileUrlAttribute()
    {
        return $this->file ? asset('storage/' . $this->file) : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nrp', 'username'); // Pastikan 'nrp' ada di tabel S_LHS dan 'username' ada di tabel users
    }
}
