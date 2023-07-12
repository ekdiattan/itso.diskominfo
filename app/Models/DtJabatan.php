<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtJabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_jabatan',
        'id_divisi',
        'divisi',
        'jabatan',
        'description',
    ];
}
