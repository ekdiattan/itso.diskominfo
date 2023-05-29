<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapUnit extends Model
{
    protected $fillable = [
        'nip',
        'nama',
        'unitkerja_nama',
        'tanggal'
    ];
}
