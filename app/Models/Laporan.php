<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tiket',
        'nippencatat',
        'namapencatat',
        'tanggalmencatat',
        'namapelapor',
        'namabidang',
        'nomorhp',
        'permasalahan',
        'image',
        'nipeksekutor',
        'namaeksekutor',
        'kategori',
        'status',
        'tanggalselesai',
        'solusi',
        'namavendor',
        'mulaiservice',
        'selesaiservice',
        'isDone'
    ];

    public function solusis(){
        return $this->hasMany(Solusi::class, 'tiket', 'tiket');
    }
}
