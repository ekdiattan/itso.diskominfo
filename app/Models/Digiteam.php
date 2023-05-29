<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Digiteam extends Model
{
    use HasFactory;

    protected $fillable = [
        "email",
        "fullname",
        "username",
        "birth_date",
        "id_divisi",
        "divisi",
        "id_jabatan",
        "jabatan",
        "is_admin",
    ];
}
