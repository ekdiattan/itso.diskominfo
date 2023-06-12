<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'aset_id',
        'namaPemohon',
        'nip',
        'noTelp',
        'bidang',
        'tiket',
        'mulai',
        'selesai',
        'TTE',
        'keperluan',
        'perihal',
        'suratPermohonan',
        'tanggalPermohonan',
        'kebersihan',
        'bahanBakar',
        'penanggungJawab',
        'pengambilKunci',
        'pengembaliKunci',
        'keterangan',
        'status',
        'nama_email',
        'nipPenyetuju',
        'penyetuju',
        'waktu',
        'hostname',
        'ip',
        'alasan'
    ];

    public function aset(){
        return $this->hasOne(Aset::class, 'id', 'aset_id');
    }
}
