<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmpPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tempatLahir',
        'tanggalLahir',
        'noPegawai',
        'unitKerja_id',
        'unitKerja',
        'golonganPangkat',
        'tmtGolongan',
        'eselon',
        'namaJabatan',
        'tmtJabatan',
        'statusPegawai',
        'tmtPegawai',
        'masaKerjaTahun',
        'masaKerjaBulan',
        'jenisKelamin',
        'agama',
        'perkawinan',
        'pendidikanAwal',
        'jurusanPendidikanAwal',
        'pendidikanAkhir',
        'jurusanPendidikanAkhir',
        'kategoriPendidikan',
        'noAkses',
        'noNpwp',
        'nik',
        'alamatRumah',
        'telp',
        'hp',
        'email',
        'kedudukanPegawai',
        'tglGabung',
        'tglPisah',
        'reasonPisah',
    ];
}
