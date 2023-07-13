<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtKehadiran extends Model
{
    use HasFactory;

    protected $fillable = [
        "_id",
        "startDate",
        "endDate",
        "officeHours",
        "location",
        "message",
        "note",
        "mood",
        "fullname",
        "email",
        "username",
        "divisi",
        "jabatan",
        "date"
    ];
}
