<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $primarykey = 'id';
    protected $keyType = 'int';
    public $incrementing = 'false';

    protected $fillable = [
        'id',
        'role_name'
    ];

}
