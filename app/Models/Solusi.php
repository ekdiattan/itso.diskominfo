<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function laporan(){
        return $this->hasMany(Laporan::class, 'tiket', 'tiket');
    }

    public function user(){
        return $this->hasMany(User::class, 'nip', 'nip');
    }
}
