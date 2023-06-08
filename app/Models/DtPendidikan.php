<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtPendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendidikan_id',
        'account',
        'name_educational_institution',
        'education_degree',
        'educational_level',
        'graduation_year',
        'majors',
        'file_diploma',
        'file_grade_transcript',
    ];
}
