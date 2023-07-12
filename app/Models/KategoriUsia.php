<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUsia extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'dari',
        'hingga',
    ];
}
