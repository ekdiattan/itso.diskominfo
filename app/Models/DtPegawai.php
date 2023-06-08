<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "email",
        "fullname",
        "birth_place",
        "birth_date",
        "marital_status",
        "religion",
        "blood_type",
        "gender",
        "age",
        "telephone",
        "id_divisi",
        "divisi",
        "id_jabatan",
        "jabatan",
        "is_staff",
        "join_date",
        'is_active',
        "resign_date",
        "reason_resignation",
        "id_card_address",
        "current_address",
        "bank_account_number",
        "bank_account_name",
        "bank_branch",
        "npwp",
    ];

    public function pendidikan(){
        return $this->hasOne(DtPendidikan::class, 'account', 'user_id');
    }
}
