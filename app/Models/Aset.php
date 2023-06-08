<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'merk',
        'jenis',
        'jumlah',
        'kapasitas',
        'kodeUnit',
        'tahun',
        'rangka',
        'mesin',
        'status',
        'kebersihan',
        'bahanBakar',
        'keterangan',
        'isHide'
    ];

    public function booked(){
        return $this->hasMany(Booking::class, 'aset_id', 'id');
    }
}
