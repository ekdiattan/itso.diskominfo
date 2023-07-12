<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'namaUnit',
        'aliasUnit',
        'idUnitKerja',
        'unitKerjaApi',
        'unitKerjaApiLengkap',
        'alamat',
        'nipPimpinan'
    ];
}
