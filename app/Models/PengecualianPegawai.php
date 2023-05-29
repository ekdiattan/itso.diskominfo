<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengecualianPegawai extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nip',
        'nama',
        'unitkerja',
        'keterangan',
        'mulai',
        'selesai'
    ];
}
