<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'njab',
        'unitkerja_nama',
        'jenis_cuti',
        'tgl_mulai',
        'tgl_selesai',
        'uraian',
        'tgl_pengajuan',
        'atasan',
        'ket_proses'  
    ];
}
