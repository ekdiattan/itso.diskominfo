<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapMasuk extends Model
{
    protected $fillable = [
        'nama',
        'unitkerja_nama',
        'masuk',
        'terlambat',
        'tanggal'
    ];
}
