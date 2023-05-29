<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama',
        'unitkerja_nama',
        'masuk',
        'terlambat',
        'tanggal',
        'update'
    ];
}
