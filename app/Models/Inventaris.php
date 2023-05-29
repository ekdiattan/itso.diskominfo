<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    // protected $table = "inventaries";
    
    protected $fillable = [
       'merk',
       'tipe',
       'namaBarang',
       'image',
       'kondisiBarang',
       'noSertifikat',
       'lokasi',
       'caraPerolehan',
       'bulanPerolehan',
       'tahunPerolehan',
       'kuantitas',
       'satuan',
       'hargaSatuan',
       'nilaiPerolehan',
       'umurEkonomis',
       'keterangan',
       'status',
       'pengguna',
       'noHp',
       'noBeritaAcara'
    ];
}
