<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\TmpPegawai;
use App\Models\DtPegawai;
use App\Models\KategoriPendidikan;
use App\Models\UnitKerja;
use App\Models\DtPendidikan;
use App\Models\DtUnitKerja;
use App\Models\DtJabatan;
use App\Models\KategoriUsia;
use App\Models\TmpDtPegawai;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

use Telegram;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = Pegawai::all();
        $conflict = (TmpPegawai::all()->isNotEmpty() || TmpDtPegawai::all()->isNotEmpty());
        $nonpns = DtPegawai::where('is_active', 'true')->whereNot('jabatan', 'PNS')->get();
        return view('home.kepegawaian.data.master_pegawai.index', [ 'data' => $data, 'nonpns' => $nonpns,'title' => 'Pegawai', 'conflict' => $conflict]);
    }

    public function sync(){ // update data pegawai
        try {
            $message = '';
            $status = '';
            $users = [
                [
                    'username' => "yudiwardoyozz",
                    'password' => "yudiwardoyozz"
                ] , [
                    'username' => "kenisya09",
                    'password' => "kenisya09"
                ]
            ];
            foreach($users as $user){
                $client = new Client();
                $login = $client->request(
                    'POST', 'https://groupware-api.digitalservice.id/auth/admin/login/', [
                        'form_params' => [
                            'username' => $user['username'],
                            'password' => $user['password'], 
                        ]
                    ]
                );
                $result = json_decode($login->getBody()->getContents());
                $token = $result->auth_token;
        
                // pegawai Update pegawai and its pendidikans
                $page = 1;
                $maxPage = 2;
                while($page <= $maxPage){
                    $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/?page='.$page.'&is_active=&struktural=&search=', [
                        'headers' => [
                            'Authorization' => 'Bearer '. $token,
                            ]
                        ]);
                        $body = $response->getBody();
                        $user = json_decode($body);
                        $maxPage = $user->_meta->totalPage;
                        
                        foreach($user->results as $results){
                            // detail per user
                            $detailResponse = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/'.$results->id.'/', [
                                'headers' => [
                                    'Authorization' => 'Bearer '. $token,
                                    ]
                                ]);
                            $detailBody = json_decode($detailResponse->getBody());
                            if($detailBody->divisi != 'ASN'){
                                $local = DtPegawai::where('user_id', $detailBody->id)->first();
                                // data dari API belum ada di dalam database local
                                if($local == ''){
                                    if($detailBody->account_bank != ''){
                                        DtPegawai::upsert([
                                            "user_id" => $detailBody->id,
                                            "email" => $detailBody->email,
                                            "fullname" => $detailBody->fullname,
                                            "birth_place" => $detailBody->birth_place,
                                            "birth_date" => $detailBody->birth_date,
                                            "marital_status" => $detailBody->marital_status,
                                            "religion" => $detailBody->religion,
                                            "blood_type" => $detailBody->blood_type,
                                            "gender" => $detailBody->gender,
                                            "age" => $detailBody->age,
                                            "telephone" => $detailBody->telephone,
                                            "id_divisi" => $detailBody->id_divisi,
                                            "divisi" => $detailBody->divisi,
                                            "id_jabatan" => $detailBody->id_jabatan,
                                            "jabatan" => $detailBody->jabatan,
                                            "is_staff" => $detailBody->is_staff,
                                            "join_date" => $detailBody->join_date,
                                            'is_active' => $detailBody->is_active,
                                            "resign_date" => $detailBody->resign_date,
                                            "reason_resignation" => $detailBody->reason_resignation,
                                            "id_card_address" => $detailBody->id_card_address,
                                            "current_address" => $detailBody->current_address,
                                            "bank_account_number" => $detailBody->account_bank->bank_account_number,
                                            "bank_account_name" => $detailBody->account_bank->bank_account_name,
                                            "bank_branch" => $detailBody->account_bank->bank_branch,
                                            "npwp" => $detailBody->npwp,
                                        ], [
                                            "user_id",
                                        ], [
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
                                        ]);
                                    } else {
                                        DtPegawai::upsert([
                                            "user_id" => $detailBody->id,
                                            "email" => $detailBody->email,
                                            "fullname" => $detailBody->fullname,
                                            "birth_place" => $detailBody->birth_place,
                                            "birth_date" => $detailBody->birth_date,
                                            "marital_status" => $detailBody->marital_status,
                                            "religion" => $detailBody->religion,
                                            "blood_type" => $detailBody->blood_type,
                                            "gender" => $detailBody->gender,
                                            "age" => $detailBody->age,
                                            "telephone" => $detailBody->telephone,
                                            "id_divisi" => $detailBody->id_divisi,
                                            "divisi" => $detailBody->divisi,
                                            "id_jabatan" => $detailBody->id_jabatan,
                                            "jabatan" => $detailBody->jabatan,
                                            "is_staff" => $detailBody->is_staff,
                                            "join_date" => $detailBody->join_date,
                                            'is_active' => $detailBody->is_active,
                                            "resign_date" => $detailBody->resign_date,
                                            "reason_resignation" => $detailBody->reason_resignation,
                                            "id_card_address" => $detailBody->id_card_address,
                                            "current_address" => $detailBody->current_address,
                                            "npwp" => $detailBody->npwp,
                                        ], [
                                            "user_id",
                                        ], [
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
                                        ]);
                                    }
                                } else if ($local != '' && $detailBody->account_bank != ''){ // because account_bank variable is array, but if null it known as string variable
                                    if(
                                        ($detailBody->email != '' && $detailBody->email != $local->email) ||
                                        ($detailBody->fullname != '' && $detailBody->fullname != $local->fullname) ||
                                        ($detailBody->birth_place != '' && $detailBody->birth_place != $local->birth_place) ||
                                        ($detailBody->birth_date != '' && $detailBody->birth_date != $local->birth_date) ||
                                        ($detailBody->marital_status != '' && $detailBody->marital_status != $local->marital_status) ||
                                        ($detailBody->religion != '' && $detailBody->religion != $local->religion) ||
                                        ($detailBody->blood_type != '' && $detailBody->blood_type != $local->blood_type) ||
                                        ($detailBody->gender != '' && $detailBody->gender != $local->gender) ||
                                        ($detailBody->telephone != '' && $detailBody->telephone != $local->telephone) ||
                                        ($detailBody->id_divisi != '' && $detailBody->id_divisi != $local->id_divisi) ||
                                        ($detailBody->divisi != '' && $detailBody->divisi != $local->divisi) ||
                                        ($detailBody->id_jabatan != '' && $detailBody->id_jabatan != $local->id_jabatan) ||
                                        ($detailBody->jabatan != '' && $detailBody->jabatan != $local->jabatan) ||
                                        ($detailBody->is_staff != '' && $detailBody->is_staff != $local->is_staff) ||
                                        ($detailBody->join_date != '' && $detailBody->join_date != $local->join_date) ||
                                        ($detailBody->is_active != '' && $detailBody->is_active != $local->is_active) ||
                                        ($detailBody->resign_date != '' && $detailBody->resign_date != $local->resign_date) ||
                                        ($detailBody->reason_resignation != '' && $detailBody->reason_resignation != $local->reason_resignation) ||
                                        ($detailBody->id_card_address != '' && $detailBody->id_card_address != $local->id_card_address) ||
                                        ($detailBody->current_address != '' && $detailBody->current_address != $local->current_address) ||
                                        ($detailBody->account_bank->bank_account_number != '' && $detailBody->account_bank->bank_account_number != $local->bank_account_number) ||
                                        ($detailBody->account_bank->bank_account_name != '' && $detailBody->account_bank->bank_account_name != $local->bank_account_name) ||
                                        ($detailBody->account_bank->bank_branch != '' && $detailBody->account_bank->bank_branch != $local->bank_branch) ||
                                        ($detailBody->npwp != '' && $detailBody->npwp != $local->npwp)
                                    ){ // jika tidak ada data yang berbeda dari local dengan API
                                        TmpDtPegawai::upsert([
                                            "user_id" => $detailBody->id,
                                            "email" => $detailBody->email,
                                            "fullname" => $detailBody->fullname,
                                            "birth_place" => $detailBody->birth_place,
                                            "birth_date" => $detailBody->birth_date,
                                            "marital_status" => $detailBody->marital_status,
                                            "religion" => $detailBody->religion,
                                            "blood_type" => $detailBody->blood_type,
                                            "gender" => $detailBody->gender,
                                            "age" => $detailBody->age,
                                            "telephone" => $detailBody->telephone,
                                            "id_divisi" => $detailBody->id_divisi,
                                            "divisi" => $detailBody->divisi,
                                            "id_jabatan" => $detailBody->id_jabatan,
                                            "jabatan" => $detailBody->jabatan,
                                            "is_staff" => $detailBody->is_staff,
                                            "join_date" => $detailBody->join_date,
                                            'is_active' => $detailBody->is_active,
                                            "resign_date" => $detailBody->resign_date,
                                            "reason_resignation" => $detailBody->reason_resignation,
                                            "id_card_address" => $detailBody->id_card_address,
                                            "current_address" => $detailBody->current_address,
                                            "npwp" => $detailBody->npwp,
                                        ], [
                                            "user_id",
                                        ], [
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
                                        ]);
                                    }
                                } else if ($local != '' && $detailBody->account_bank == ''){
                                    if(
                                        ($detailBody->email != '' && $detailBody->email != $local->email) ||
                                        ($detailBody->fullname != '' && $detailBody->fullname != $local->fullname) ||
                                        ($detailBody->birth_place != '' && $detailBody->birth_place != $local->birth_place) ||
                                        ($detailBody->birth_date != '' && $detailBody->birth_date != $local->birth_date) ||
                                        ($detailBody->marital_status != '' && $detailBody->marital_status != $local->marital_status) ||
                                        ($detailBody->religion != '' && $detailBody->religion != $local->religion) ||
                                        ($detailBody->blood_type != '' && $detailBody->blood_type != $local->blood_type) ||
                                        ($detailBody->gender != '' && $detailBody->gender != $local->gender) ||
                                        ($detailBody->telephone != '' && $detailBody->telephone != $local->telephone) ||
                                        ($detailBody->id_divisi != '' && $detailBody->id_divisi != $local->id_divisi) ||
                                        ($detailBody->divisi != '' && $detailBody->divisi != $local->divisi) ||
                                        ($detailBody->id_jabatan != '' && $detailBody->id_jabatan != $local->id_jabatan) ||
                                        ($detailBody->jabatan != '' && $detailBody->jabatan != $local->jabatan) ||
                                        ($detailBody->is_staff != '' && $detailBody->is_staff != $local->is_staff) ||
                                        ($detailBody->join_date != '' && $detailBody->join_date != $local->join_date) ||
                                        ($detailBody->is_active != '' && $detailBody->is_active != $local->is_active) ||
                                        ($detailBody->resign_date != '' && $detailBody->resign_date != $local->resign_date) ||
                                        ($detailBody->reason_resignation != '' && $detailBody->reason_resignation != $local->reason_resignation) ||
                                        ($detailBody->id_card_address != '' && $detailBody->id_card_address != $local->id_card_address) ||
                                        ($detailBody->current_address != '' && $detailBody->current_address != $local->current_address) ||
                                        ($detailBody->npwp != '' && $detailBody->npwp != $local->npwp)
                                    ){ // jika tidak ada data yang berbeda dari local dengan API
                                        TmpDtPegawai::upsert([
                                            "user_id" => $detailBody->id,
                                            "email" => $detailBody->email,
                                            "fullname" => $detailBody->fullname,
                                            "birth_place" => $detailBody->birth_place,
                                            "birth_date" => $detailBody->birth_date,
                                            "marital_status" => $detailBody->marital_status,
                                            "religion" => $detailBody->religion,
                                            "blood_type" => $detailBody->blood_type,
                                            "gender" => $detailBody->gender,
                                            "age" => $detailBody->age,
                                            "telephone" => $detailBody->telephone,
                                            "id_divisi" => $detailBody->id_divisi,
                                            "divisi" => $detailBody->divisi,
                                            "id_jabatan" => $detailBody->id_jabatan,
                                            "jabatan" => $detailBody->jabatan,
                                            "is_staff" => $detailBody->is_staff,
                                            "join_date" => $detailBody->join_date,
                                            'is_active' => $detailBody->is_active,
                                            "resign_date" => $detailBody->resign_date,
                                            "reason_resignation" => $detailBody->reason_resignation,
                                            "id_card_address" => $detailBody->id_card_address,
                                            "current_address" => $detailBody->current_address,
                                            "npwp" => $detailBody->npwp,
                                        ], [
                                            "user_id",
                                        ], [
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
                                        ]);
                                    }
                                }
                            }
                            // get pendidikan by user_id
                            $pendidikanResponse = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/data/educations/'.$results->id.'/lists/', [
                                'headers' => [
                                    'Authorization' => 'Bearer '. $token,
                                    ]
                                ]);
                            $pendidikanBody = json_decode($pendidikanResponse->getBody());
                            foreach($pendidikanBody->results as $pendidikan){
                                if($pendidikan->file_diploma != '' && $pendidikan->file_grade_transcript != ''){ // jika ada file diploma dan transkrip
                                    DtPendidikan::updateOrCreate(
                                        [
                                            'pendidikan_id' => $pendidikan->id,
                                            'account' => $pendidikan->account,
                                        ], [
                                            'name_educational_institution' => $pendidikan->name_educational_institution,
                                            'education_degree' => $pendidikan->education_degree,
                                            'educational_level' => $pendidikan->educational_level,
                                            'graduation_year' => $pendidikan->graduation_year,
                                            'majors' => $pendidikan->majors,
                                            'file_diploma' => $pendidikan->file_diploma->file,
                                            'file_grade_transcript' => $pendidikan->file_grade_transcript->file,
                                        ]
                                    );
                                } else if($pendidikan->file_diploma != ''){ // jika hanya terdapat file diploma
                                    DtPendidikan::updateOrCreate(
                                        [
                                            'pendidikan_id' => $pendidikan->id,
                                            'account' => $pendidikan->account,
                                        ], [
                                            'name_educational_institution' => $pendidikan->name_educational_institution,
                                            'education_degree' => $pendidikan->education_degree,
                                            'educational_level' => $pendidikan->educational_level,
                                            'graduation_year' => $pendidikan->graduation_year,
                                            'majors' => $pendidikan->majors,
                                            'file_diploma' => $pendidikan->file_diploma->file,
                                            'file_grade_transcript' => $pendidikan->file_grade_transcript,
                                        ]
                                    );
                                } else if($pendidikan->file_grade_transcript != ''){ // jika hanya terdapat file transkrip
                                    DtPendidikan::updateOrCreate(
                                        [
                                            'pendidikan_id' => $pendidikan->id,
                                            'account' => $pendidikan->account,
                                        ], [
                                            'name_educational_institution' => $pendidikan->name_educational_institution,
                                            'education_degree' => $pendidikan->education_degree,
                                            'educational_level' => $pendidikan->educational_level,
                                            'graduation_year' => $pendidikan->graduation_year,
                                            'majors' => $pendidikan->majors,
                                            'file_diploma' => $pendidikan->file_diploma,
                                            'file_grade_transcript' => $pendidikan->file_grade_transcript->file,
                                        ]
                                    );
                                } else if ($pendidikan->file_diploma == '' && $pendidikan->file_grade_transcript == ''){ // jika file diploma dan transkrip tidak ada
                                    DtPendidikan::updateOrCreate(
                                        [
                                            'pendidikan_id' => $pendidikan->id,
                                            'account' => $pendidikan->account,
                                        ], [
                                            'name_educational_institution' => $pendidikan->name_educational_institution,
                                            'education_degree' => $pendidikan->education_degree,
                                            'educational_level' => $pendidikan->educational_level,
                                            'graduation_year' => $pendidikan->graduation_year,
                                            'majors' => $pendidikan->majors,
                                            'file_diploma' => $pendidikan->file_diploma,
                                            'file_grade_transcript' => $pendidikan->file_grade_transcript,
                                        ]
                                    );
                                }
                            }
                            // update Unitkerja
                            if($detailBody->divisi == 'Analisis' || $detailBody->divisi == 'Data' || $detailBody->divisi == 'Implementasi dan Pengelolaan' || $detailBody->divisi == 'IT Dev' || $detailBody->divisi == 'HRGA' || $detailBody->divisi == 'Implementasi dan Pengelolaan' || $detailBody->divisi == 'Komunikasi dan Konten' || $detailBody->divisi == 'Konten dan Komunikasi' || $detailBody->divisi == 'Petani Milenial' || $detailBody->divisi == 'SIPD'){
                                $namaUnit = 'UPTD PUSAT LAYANAN DIGITAL DATA DAN INFORMASI GEOSPASIAL';
                                $aliasUnit = 'UPTD PLDDIG';
                            }else if($detailBody->divisi == 'Aptika'){
                                $namaUnit = 'APLIKASI DAN INFORMATIKA';
                                $aliasUnit = 'APTIKA';
                            }else if($detailBody->divisi == 'e-Government'){
                                $namaUnit = 'E-GOVERNMENT';
                                $aliasUnit = 'E-GOV';
                            }else if($detailBody->divisi == 'IKP' || $detailBody->divisi == 'JQR' || $detailBody->divisi == 'JSH' || $detailBody->divisi == 'Komisi Informasi' || $detailBody->divisi == 'Komisi Informasi Jabar'){
                                $namaUnit = 'INFORMASI KOMUNIKASI PUBLIK';
                                $aliasUnit = 'IKP';
                            }else if($detailBody->divisi == 'Sandikami'){
                                $namaUnit = 'PERSANDIAN DAN KEAMANAN INFORMASI';
                                $aliasUnit = 'SANDIKAMI';
                            }else if($detailBody->divisi == 'Sekretariat'){
                                $namaUnit = 'SEKRETARIAT';
                                $aliasUnit = 'Sekretariat';
                            }else if($detailBody->divisi == 'Statistik'){
                                $namaUnit = 'STATISTIK';
                                $aliasUnit = 'Statistik';
                            } else {
                                $namaUnit = '';
                                $aliasUnit = '';
                            }
                            // update unitkerja when updating digiteam
                            DtUnitKerja::upsert([
                                'idUnitKerja' => $detailBody->id_divisi,
                                'namaUnit' => $namaUnit,
                                'aliasUnit' => $aliasUnit,
                                'unitKerjaApi' => $detailBody->divisi
                            ], [
                                'idUnitKerja'
                            ], [
                                'namaUnit',
                                'aliasUnit',
                                'unitKerjaApi'
                            ]);
                            // update all jabatan from digiteam (API LAGI ERROR)
                            // $page = 1;
                            // $maxPage = 2;
                            // while($page <= $maxPage){
                            //     $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/jabatan/?limit=10&page='.$page, [
                            //         'headers' => [
                            //             'Authorization' => 'Bearer '. $token,
                            //         ]
                            //     ]);
                            //     $body = $response->getBody();
                            //     $body_array = json_decode($body);
                            //     $maxPage = $body_array->_meta->totalPage;

                            //     foreach($body_array->results as $result){
                            //         DtJabatan::updateOrCreate([
                            //             'id_jabatan' => $result->id,
                            //             'id_divisi' => $result->satuan_kerja_id,
                            //             'divisi' => $result->name_satuan_kerja,
                            //             'jabatan' => $result->name_jabatan,
                            //             'description' => $result->description
                            //         ]);
                            //     }
                            // }
                        }
                    $page++;
                }
            }
            $todayDate = date('Y-m-d');
            $client = new Client();
            $response = $client->request ('GET', 'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian',
            [
                'query' => ['tanggal'=>$todayDate],
                'auth' => ['diskominfo_presensi','diskominfo_presensi12345']
            ]);
            $body = $response->getBody();
            $body_array = json_decode($body);
            foreach ($body_array as $post){
                $find = Pegawai::where('noPegawai', $post->nip)->first();
                if($find != null){ // kalo udah ada datanya
                    if($find->noPegawai != $post->nip || $find->nama != $post->nama || $find->unitKerja != $post->unitkerja_nama || $find->unitKerja_id != $post->id_unitkerja){ // kalo terdapat perbedaan data dari DB local sama API
                        TmpPegawai::upsert([ // simpan data dari API ke dalam database temporer
                            'nama' => $post->nama,
                            'tempatLahir' => null,
                            'tanggalLahir' => null,
                            'noPegawai' => $post->nip,
                            'unitKerja_id' => $post->id_unitkerja,
                            'unitKerja' => $post->unitkerja_nama,
                            'golonganPangkat' => null,
                            'tmtGolongan' => null,
                            'eselon' => null,
                            'namaJabatan' => null,
                            'tmtJabatan' => null,
                            'statusPegawai' => null,
                            'tmtPegawai' => null,
                            'masaKerjaTahun' => null,
                            'masaKerjaBulan' => null,
                            'jenisKelamin' => null,
                            'agama' => null,
                            'perkawinan' => null,
                            'pendidikanAwal' => null,
                            'jurusanPendidikanAwal' => null,
                            'pendidikanAkhir' => null,
                            'jurusanPendidikanAkhir' => null,
                            'noAkses' => null,
                            'noNpwp' => null,
                            'nik' => null,
                            'alamatRumah' => null,
                            'telp' => null,
                            'hp' => null,
                            'email' => null,
                            'kedudukanPegawai' => null
                            ], ['noPegawai'], ['nama', 'unitKerja', 'unitKerja_id']
                        );
                        $message = 'conflict';
                        $status = 'Terdapat data yang perlu ditinjau ulang ketika diupdate';
                    } else { // hapus data di temporer jika data dari API kembali menjadi data sebelumnya
                        TmpPegawai::where('noPegawai', $post->nip)->delete();
                    }
                } else { // kalo belum ada data pegawainya
                    Pegawai::upsert([ // simpan data dari API ke dalam database temporer
                        'nama' => $post->nama,
                        'tempatLahir' => null,
                        'tanggalLahir' => null,
                        'noPegawai' => $post->nip,
                        'unitKerja_id' => $post->id_unitkerja,
                        'unitKerja' => $post->unitkerja_nama,
                        'golonganPangkat' => null,
                        'tmtGolongan' => null,
                        'eselon' => null,
                        'namaJabatan' => null,   
                        'tmtJabatan' => null,   
                        'statusPegawai' => null,   
                        'tmtPegawai' => null,   
                        'masaKerjaTahun' => null,   
                        'masaKerjaBulan' => null,   
                        'jenisKelamin' => null,   
                        'agama' => null,   
                        'perkawinan' => null,   
                        'pendidikanAwal' => null,   
                        'jurusanPendidikanAwal' => null,   
                        'pendidikanAkhir' => null,   
                        'jurusanPendidikanAkhir' => null,
                        'kategoriPendidikan' => null,
                        'noAkses' => null,   
                        'noNpwp' => null,   
                        'nik' => null,   
                        'alamatRumah' => null,   
                        'telp' => null,   
                        'hp' => null,   
                        'email' => null,   
                        'kedudukanPegawai' => null,
                        'tglGabung' => null,
                        'tglPisah' => null,
                        'reasonPisah' => null,
                        'tanggalmasuk' => null,
                        'tanggalkeluar' => null,
                    ], [
                        'noPegawai',
                    ], [
                        'nama',
                        'tempatLahir',
                        'tanggalLahir',
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
                        'tanggalmasuk',
                        'tanggalkeluar',
                    ]);
                    $message = 'success';
                    $status = 'Berhasil mengupdate data!';
                }
            }
            session()->flash($message, $status);
            return redirect('/master-pegawai');
        } catch (ServerException $e) {
            session()->flash('error', 'Terjadi masalah pada API, silakan coba kembali');
            return redirect('/master-pegawai');
        } catch (ClientException $e) {
            session()->flash('error', 'Terjadi masalah pada API, silakan coba kembali');
            return redirect('/master-pegawai');
        } catch (BadResponseException $e) {
            session()->flash('error', 'Terjadi masalah pada API, silakan coba kembali');
            return redirect('/master-pegawai');
        }
    }

    public function pnsSync(){ // update data pegawai
        try {
            $message = '';
            $status = '';
            $todayDate = date('Y-m-d');
            $client = new Client();
            $response = $client->request ('GET', 'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian', [
                'query' => ['tanggal'=>$todayDate],
                'auth' => ['diskominfo_presensi','diskominfo_presensi12345']
            ]);
            $body = $response->getBody();
            $body_array = json_decode($body);
            foreach ($body_array as $post){
                $find = Pegawai::where('noPegawai', $post->nip)->first();
                if($find != null){ // kalo udah ada datanya
                    if($find->noPegawai != $post->nip || $find->nama != $post->nama || $find->unitKerja != $post->unitkerja_nama || $find->unitKerja_id != $post->id_unitkerja){ // kalo terdapat perbedaan data dari DB local sama API
                        TmpPegawai::upsert([ // simpan data dari API ke dalam database temporer
                            'nama' => $post->nama,
                            'tempatLahir' => null,
                            'tanggalLahir' => null,
                            'noPegawai' => $post->nip,
                            'unitKerja_id' => $post->id_unitkerja,
                            'unitKerja' => $post->unitkerja_nama,
                            'golonganPangkat' => null,
                            'tmtGolongan' => null,
                            'eselon' => null,
                            'namaJabatan' => null,
                            'tmtJabatan' => null,
                            'statusPegawai' => null,
                            'tmtPegawai' => null,
                            'masaKerjaTahun' => null,
                            'masaKerjaBulan' => null,
                            'jenisKelamin' => null,
                            'agama' => null,
                            'perkawinan' => null,
                            'pendidikanAwal' => null,
                            'jurusanPendidikanAwal' => null,
                            'pendidikanAkhir' => null,
                            'jurusanPendidikanAkhir' => null,
                            'noAkses' => null,
                            'noNpwp' => null,
                            'nik' => null,
                            'alamatRumah' => null,
                            'telp' => null,
                            'hp' => null,
                            'email' => null,
                            'kedudukanPegawai' => null
                            ], ['noPegawai'], ['nama', 'unitKerja', 'unitKerja_id']
                        );
                        $message = 'conflict';
                        $status = 'Terdapat data yang perlu ditinjau ulang ketika diupdate';
                    } else { // hapus data di temporer jika data dari API kembali menjadi data sebelumnya
                        TmpPegawai::where('noPegawai', $post->nip)->delete();
                    }
                } else { // kalo belum ada data pegawainya
                    Pegawai::upsert([ // simpan data dari API ke dalam database temporer
                        'nama' => $post->nama,
                        'tempatLahir' => null,
                        'tanggalLahir' => null,
                        'noPegawai' => $post->nip,
                        'unitKerja_id' => $post->id_unitkerja,
                        'unitKerja' => $post->unitkerja_nama,
                        'golonganPangkat' => null,
                        'tmtGolongan' => null,
                        'eselon' => null,
                        'namaJabatan' => null,   
                        'tmtJabatan' => null,   
                        'statusPegawai' => null,   
                        'tmtPegawai' => null,   
                        'masaKerjaTahun' => null,   
                        'masaKerjaBulan' => null,   
                        'jenisKelamin' => null,   
                        'agama' => null,   
                        'perkawinan' => null,   
                        'pendidikanAwal' => null,   
                        'jurusanPendidikanAwal' => null,   
                        'pendidikanAkhir' => null,   
                        'jurusanPendidikanAkhir' => null,
                        'kategoriPendidikan' => null,
                        'noAkses' => null,   
                        'noNpwp' => null,   
                        'nik' => null,   
                        'alamatRumah' => null,   
                        'telp' => null,   
                        'hp' => null,   
                        'email' => null,   
                        'kedudukanPegawai' => null,
                        'tglGabung' => null,
                        'tglPisah' => null,
                        'reasonPisah' => null,
                        'tanggalmasuk' => null,
                        'tanggalkeluar' => null,
                    ], [
                        'noPegawai',
                    ], [
                        'nama',
                        'tempatLahir',
                        'tanggalLahir',
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
                        'tanggalmasuk',
                        'tanggalkeluar',
                    ]);
                    $message = 'success';
                    $status = 'Berhasil mengupdate data!';
                }
                // Update Unit Kerja
                UnitKerja::upsert([
                    "idUnitKerja" => $post->id_unitkerja,
                    "namaUnit" => $post->unitkerja_nama,
                ], [
                    "idUnitKerja"
                ], [
                    "namaUnit"
                ]);
            }
            session()->flash($message, $status);
            return redirect('/pns');
        } catch (ServerException $e) {
            session()->flash('error', 'Terjadi masalah pada API, silakan coba kembali');
            return redirect('/pns');
        } catch (ClientException $e) {
            session()->flash('error', 'Terjadi masalah pada API, silakan coba kembali');
            return redirect('/pns');
        } catch (BadResponseException $e) {
            session()->flash('error', 'Terjadi masalah pada API, silakan coba kembali');
            return redirect('/pns');
        }
    }

    public function nonPnsSync(){ // update data pegawai
        try {
            $message = '';
            $status = '';
            $users = [
                [
                    'username' => "yudiwardoyozz",
                    'password' => "yudiwardoyozz"
                ] , [
                    'username' => "kenisya09",
                    'password' => "kenisya09"
                ]
            ];
            foreach($users as $user){
                $client = new Client();
                $login = $client->request(
                    'POST', 'https://groupware-api.digitalservice.id/auth/admin/login/', [
                        'form_params' => [
                            'username' => $user['username'],
                            'password' => $user['password'], 
                        ]
                    ]
                );
                $result = json_decode($login->getBody()->getContents());
                $token = $result->auth_token;
        
                // pegawai Update pegawai and its pendidikans
                $page = 1;
                $maxPage = 2;
                while($page <= $maxPage){
                    $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/?page='.$page.'&is_active=&struktural=&search=', [
                        'headers' => [
                            'Authorization' => 'Bearer '. $token,
                            ]
                        ]);
                        $body = $response->getBody();
                        $user = json_decode($body);
                        $maxPage = $user->_meta->totalPage;
                        
                        foreach($user->results as $results){
                            // detail per user
                            $detailResponse = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/'.$results->id.'/', [
                                'headers' => [
                                    'Authorization' => 'Bearer '. $token,
                                    ]
                                ]);
                            $detailBody = json_decode($detailResponse->getBody());
                            if($detailBody->divisi != 'ASN'){
                                $local = DtPegawai::where('user_id', $detailBody->id)->first();
                                // data dari API belum ada di dalam database local
                                if($local == ''){
                                    if($detailBody->account_bank != ''){
                                        DtPegawai::upsert([
                                            "user_id" => $detailBody->id,
                                            "email" => $detailBody->email,
                                            "fullname" => $detailBody->fullname,
                                            "birth_place" => $detailBody->birth_place,
                                            "birth_date" => $detailBody->birth_date,
                                            "marital_status" => $detailBody->marital_status,
                                            "religion" => $detailBody->religion,
                                            "blood_type" => $detailBody->blood_type,
                                            "gender" => $detailBody->gender,
                                            "age" => $detailBody->age,
                                            "telephone" => $detailBody->telephone,
                                            "id_divisi" => $detailBody->id_divisi,
                                            "divisi" => $detailBody->divisi,
                                            "id_jabatan" => $detailBody->id_jabatan,
                                            "jabatan" => $detailBody->jabatan,
                                            "is_staff" => $detailBody->is_staff,
                                            "join_date" => $detailBody->join_date,
                                            'is_active' => $detailBody->is_active,
                                            "resign_date" => $detailBody->resign_date,
                                            "reason_resignation" => $detailBody->reason_resignation,
                                            "id_card_address" => $detailBody->id_card_address,
                                            "current_address" => $detailBody->current_address,
                                            "bank_account_number" => $detailBody->account_bank->bank_account_number,
                                            "bank_account_name" => $detailBody->account_bank->bank_account_name,
                                            "bank_branch" => $detailBody->account_bank->bank_branch,
                                            "npwp" => $detailBody->npwp,
                                        ], [
                                            "user_id",
                                        ], [
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
                                        ]);
                                    } else {
                                        DtPegawai::upsert([
                                            "user_id" => $detailBody->id,
                                            "email" => $detailBody->email,
                                            "fullname" => $detailBody->fullname,
                                            "birth_place" => $detailBody->birth_place,
                                            "birth_date" => $detailBody->birth_date,
                                            "marital_status" => $detailBody->marital_status,
                                            "religion" => $detailBody->religion,
                                            "blood_type" => $detailBody->blood_type,
                                            "gender" => $detailBody->gender,
                                            "age" => $detailBody->age,
                                            "telephone" => $detailBody->telephone,
                                            "id_divisi" => $detailBody->id_divisi,
                                            "divisi" => $detailBody->divisi,
                                            "id_jabatan" => $detailBody->id_jabatan,
                                            "jabatan" => $detailBody->jabatan,
                                            "is_staff" => $detailBody->is_staff,
                                            "join_date" => $detailBody->join_date,
                                            'is_active' => $detailBody->is_active,
                                            "resign_date" => $detailBody->resign_date,
                                            "reason_resignation" => $detailBody->reason_resignation,
                                            "id_card_address" => $detailBody->id_card_address,
                                            "current_address" => $detailBody->current_address,
                                            "npwp" => $detailBody->npwp,
                                        ], [
                                            "user_id",
                                        ], [
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
                                        ]);
                                    }
                                } else if ($local != '' && $detailBody->account_bank != ''){ // because account_bank variable is array, but if null it known as string variable
                                    if(
                                        ($detailBody->email != '' && $detailBody->email != $local->email) ||
                                        ($detailBody->fullname != '' && $detailBody->fullname != $local->fullname) ||
                                        ($detailBody->birth_place != '' && $detailBody->birth_place != $local->birth_place) ||
                                        ($detailBody->birth_date != '' && $detailBody->birth_date != $local->birth_date) ||
                                        ($detailBody->marital_status != '' && $detailBody->marital_status != $local->marital_status) ||
                                        ($detailBody->religion != '' && $detailBody->religion != $local->religion) ||
                                        ($detailBody->blood_type != '' && $detailBody->blood_type != $local->blood_type) ||
                                        ($detailBody->gender != '' && $detailBody->gender != $local->gender) ||
                                        ($detailBody->telephone != '' && $detailBody->telephone != $local->telephone) ||
                                        ($detailBody->id_divisi != '' && $detailBody->id_divisi != $local->id_divisi) ||
                                        ($detailBody->divisi != '' && $detailBody->divisi != $local->divisi) ||
                                        ($detailBody->id_jabatan != '' && $detailBody->id_jabatan != $local->id_jabatan) ||
                                        ($detailBody->jabatan != '' && $detailBody->jabatan != $local->jabatan) ||
                                        ($detailBody->is_staff != '' && $detailBody->is_staff != $local->is_staff) ||
                                        ($detailBody->join_date != '' && $detailBody->join_date != $local->join_date) ||
                                        ($detailBody->is_active != '' && $detailBody->is_active != $local->is_active) ||
                                        ($detailBody->resign_date != '' && $detailBody->resign_date != $local->resign_date) ||
                                        ($detailBody->reason_resignation != '' && $detailBody->reason_resignation != $local->reason_resignation) ||
                                        ($detailBody->id_card_address != '' && $detailBody->id_card_address != $local->id_card_address) ||
                                        ($detailBody->current_address != '' && $detailBody->current_address != $local->current_address) ||
                                        ($detailBody->account_bank->bank_account_number != '' && $detailBody->account_bank->bank_account_number != $local->bank_account_number) ||
                                        ($detailBody->account_bank->bank_account_name != '' && $detailBody->account_bank->bank_account_name != $local->bank_account_name) ||
                                        ($detailBody->account_bank->bank_branch != '' && $detailBody->account_bank->bank_branch != $local->bank_branch) ||
                                        ($detailBody->npwp != '' && $detailBody->npwp != $local->npwp)
                                    ){ // jika tidak ada data yang berbeda dari local dengan API
                                        TmpDtPegawai::upsert([
                                            "user_id" => $detailBody->id,
                                            "email" => $detailBody->email,
                                            "fullname" => $detailBody->fullname,
                                            "birth_place" => $detailBody->birth_place,
                                            "birth_date" => $detailBody->birth_date,
                                            "marital_status" => $detailBody->marital_status,
                                            "religion" => $detailBody->religion,
                                            "blood_type" => $detailBody->blood_type,
                                            "gender" => $detailBody->gender,
                                            "age" => $detailBody->age,
                                            "telephone" => $detailBody->telephone,
                                            "id_divisi" => $detailBody->id_divisi,
                                            "divisi" => $detailBody->divisi,
                                            "id_jabatan" => $detailBody->id_jabatan,
                                            "jabatan" => $detailBody->jabatan,
                                            "is_staff" => $detailBody->is_staff,
                                            "join_date" => $detailBody->join_date,
                                            'is_active' => $detailBody->is_active,
                                            "resign_date" => $detailBody->resign_date,
                                            "reason_resignation" => $detailBody->reason_resignation,
                                            "id_card_address" => $detailBody->id_card_address,
                                            "current_address" => $detailBody->current_address,
                                            "npwp" => $detailBody->npwp,
                                        ], [
                                            "user_id",
                                        ], [
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
                                        ]);
                                    }
                                } else if ($local != '' && $detailBody->account_bank == ''){
                                    if(
                                        ($detailBody->email != '' && $detailBody->email != $local->email) ||
                                        ($detailBody->fullname != '' && $detailBody->fullname != $local->fullname) ||
                                        ($detailBody->birth_place != '' && $detailBody->birth_place != $local->birth_place) ||
                                        ($detailBody->birth_date != '' && $detailBody->birth_date != $local->birth_date) ||
                                        ($detailBody->marital_status != '' && $detailBody->marital_status != $local->marital_status) ||
                                        ($detailBody->religion != '' && $detailBody->religion != $local->religion) ||
                                        ($detailBody->blood_type != '' && $detailBody->blood_type != $local->blood_type) ||
                                        ($detailBody->gender != '' && $detailBody->gender != $local->gender) ||
                                        ($detailBody->telephone != '' && $detailBody->telephone != $local->telephone) ||
                                        ($detailBody->id_divisi != '' && $detailBody->id_divisi != $local->id_divisi) ||
                                        ($detailBody->divisi != '' && $detailBody->divisi != $local->divisi) ||
                                        ($detailBody->id_jabatan != '' && $detailBody->id_jabatan != $local->id_jabatan) ||
                                        ($detailBody->jabatan != '' && $detailBody->jabatan != $local->jabatan) ||
                                        ($detailBody->is_staff != '' && $detailBody->is_staff != $local->is_staff) ||
                                        ($detailBody->join_date != '' && $detailBody->join_date != $local->join_date) ||
                                        ($detailBody->is_active != '' && $detailBody->is_active != $local->is_active) ||
                                        ($detailBody->resign_date != '' && $detailBody->resign_date != $local->resign_date) ||
                                        ($detailBody->reason_resignation != '' && $detailBody->reason_resignation != $local->reason_resignation) ||
                                        ($detailBody->id_card_address != '' && $detailBody->id_card_address != $local->id_card_address) ||
                                        ($detailBody->current_address != '' && $detailBody->current_address != $local->current_address) ||
                                        ($detailBody->npwp != '' && $detailBody->npwp != $local->npwp)
                                    ){ // jika tidak ada data yang berbeda dari local dengan API
                                        TmpDtPegawai::upsert([
                                            "user_id" => $detailBody->id,
                                            "email" => $detailBody->email,
                                            "fullname" => $detailBody->fullname,
                                            "birth_place" => $detailBody->birth_place,
                                            "birth_date" => $detailBody->birth_date,
                                            "marital_status" => $detailBody->marital_status,
                                            "religion" => $detailBody->religion,
                                            "blood_type" => $detailBody->blood_type,
                                            "gender" => $detailBody->gender,
                                            "age" => $detailBody->age,
                                            "telephone" => $detailBody->telephone,
                                            "id_divisi" => $detailBody->id_divisi,
                                            "divisi" => $detailBody->divisi,
                                            "id_jabatan" => $detailBody->id_jabatan,
                                            "jabatan" => $detailBody->jabatan,
                                            "is_staff" => $detailBody->is_staff,
                                            "join_date" => $detailBody->join_date,
                                            'is_active' => $detailBody->is_active,
                                            "resign_date" => $detailBody->resign_date,
                                            "reason_resignation" => $detailBody->reason_resignation,
                                            "id_card_address" => $detailBody->id_card_address,
                                            "current_address" => $detailBody->current_address,
                                            "npwp" => $detailBody->npwp,
                                        ], [
                                            "user_id",
                                        ], [
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
                                        ]);
                                    }
                                }
                            }
                            // get pendidikan by user_id
                            $pendidikanResponse = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/data/educations/'.$results->id.'/lists/', [
                                'headers' => [
                                    'Authorization' => 'Bearer '. $token,
                                    ]
                                ]);
                            $pendidikanBody = json_decode($pendidikanResponse->getBody());
                            foreach($pendidikanBody->results as $pendidikan){
                                if($pendidikan->file_diploma != '' && $pendidikan->file_grade_transcript != ''){ // jika ada file diploma dan transkrip
                                    DtPendidikan::updateOrCreate(
                                        [
                                            'pendidikan_id' => $pendidikan->id,
                                            'account' => $pendidikan->account,
                                        ], [
                                            'name_educational_institution' => $pendidikan->name_educational_institution,
                                            'education_degree' => $pendidikan->education_degree,
                                            'educational_level' => $pendidikan->educational_level,
                                            'graduation_year' => $pendidikan->graduation_year,
                                            'majors' => $pendidikan->majors,
                                            'file_diploma' => $pendidikan->file_diploma->file,
                                            'file_grade_transcript' => $pendidikan->file_grade_transcript->file,
                                        ]
                                    );
                                } else if($pendidikan->file_diploma != ''){ // jika hanya terdapat file diploma
                                    DtPendidikan::updateOrCreate(
                                        [
                                            'pendidikan_id' => $pendidikan->id,
                                            'account' => $pendidikan->account,
                                        ], [
                                            'name_educational_institution' => $pendidikan->name_educational_institution,
                                            'education_degree' => $pendidikan->education_degree,
                                            'educational_level' => $pendidikan->educational_level,
                                            'graduation_year' => $pendidikan->graduation_year,
                                            'majors' => $pendidikan->majors,
                                            'file_diploma' => $pendidikan->file_diploma->file,
                                            'file_grade_transcript' => $pendidikan->file_grade_transcript,
                                        ]
                                    );
                                } else if($pendidikan->file_grade_transcript != ''){ // jika hanya terdapat file transkrip
                                    DtPendidikan::updateOrCreate(
                                        [
                                            'pendidikan_id' => $pendidikan->id,
                                            'account' => $pendidikan->account,
                                        ], [
                                            'name_educational_institution' => $pendidikan->name_educational_institution,
                                            'education_degree' => $pendidikan->education_degree,
                                            'educational_level' => $pendidikan->educational_level,
                                            'graduation_year' => $pendidikan->graduation_year,
                                            'majors' => $pendidikan->majors,
                                            'file_diploma' => $pendidikan->file_diploma,
                                            'file_grade_transcript' => $pendidikan->file_grade_transcript->file,
                                        ]
                                    );
                                } else if ($pendidikan->file_diploma == '' && $pendidikan->file_grade_transcript == ''){ // jika file diploma dan transkrip tidak ada
                                    DtPendidikan::updateOrCreate(
                                        [
                                            'pendidikan_id' => $pendidikan->id,
                                            'account' => $pendidikan->account,
                                        ], [
                                            'name_educational_institution' => $pendidikan->name_educational_institution,
                                            'education_degree' => $pendidikan->education_degree,
                                            'educational_level' => $pendidikan->educational_level,
                                            'graduation_year' => $pendidikan->graduation_year,
                                            'majors' => $pendidikan->majors,
                                            'file_diploma' => $pendidikan->file_diploma,
                                            'file_grade_transcript' => $pendidikan->file_grade_transcript,
                                        ]
                                    );
                                }
                            }
                            // update Unitkerja
                            if($detailBody->divisi == 'Analisis' || $detailBody->divisi == 'Data' || $detailBody->divisi == 'Implementasi dan Pengelolaan' || $detailBody->divisi == 'IT Dev' || $detailBody->divisi == 'HRGA' || $detailBody->divisi == 'Implementasi dan Pengelolaan' || $detailBody->divisi == 'Komunikasi dan Konten' || $detailBody->divisi == 'Konten dan Komunikasi' || $detailBody->divisi == 'Petani Milenial' || $detailBody->divisi == 'SIPD'){
                                $namaUnit = 'UPTD PUSAT LAYANAN DIGITAL DATA DAN INFORMASI GEOSPASIAL';
                                $aliasUnit = 'UPTD PLDDIG';
                            }else if($detailBody->divisi == 'Aptika'){
                                $namaUnit = 'APLIKASI DAN INFORMATIKA';
                                $aliasUnit = 'APTIKA';
                            }else if($detailBody->divisi == 'e-Government'){
                                $namaUnit = 'E-GOVERNMENT';
                                $aliasUnit = 'E-GOV';
                            }else if($detailBody->divisi == 'IKP' || $detailBody->divisi == 'JQR' || $detailBody->divisi == 'JSH' || $detailBody->divisi == 'Komisi Informasi' || $detailBody->divisi == 'Komisi Informasi Jabar'){
                                $namaUnit = 'INFORMASI KOMUNIKASI PUBLIK';
                                $aliasUnit = 'IKP';
                            }else if($detailBody->divisi == 'Sandikami'){
                                $namaUnit = 'PERSANDIAN DAN KEAMANAN INFORMASI';
                                $aliasUnit = 'SANDIKAMI';
                            }else if($detailBody->divisi == 'Sekretariat'){
                                $namaUnit = 'SEKRETARIAT';
                                $aliasUnit = 'Sekretariat';
                            }else if($detailBody->divisi == 'Statistik'){
                                $namaUnit = 'STATISTIK';
                                $aliasUnit = 'Statistik';
                            } else {
                                $namaUnit = '';
                                $aliasUnit = '';
                            }
                            // update unitkerja when updating digiteam
                            DtUnitKerja::upsert([
                                'idUnitKerja' => $detailBody->id_divisi,
                                'namaUnit' => $namaUnit,
                                'aliasUnit' => $aliasUnit,
                                'unitKerjaApi' => $detailBody->divisi
                            ], [
                                'idUnitKerja'
                            ], [
                                'namaUnit',
                                'aliasUnit',
                                'unitKerjaApi'
                            ]);
                            // update all jabatan from digiteam (API LAGI ERROR)
                            // $page = 1;
                            // $maxPage = 2;
                            // while($page <= $maxPage){
                            //     $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/jabatan/?limit=10&page='.$page, [
                            //         'headers' => [
                            //             'Authorization' => 'Bearer '. $token,
                            //         ]
                            //     ]);
                            //     $body = $response->getBody();
                            //     $body_array = json_decode($body);
                            //     $maxPage = $body_array->_meta->totalPage;

                            //     foreach($body_array->results as $result){
                            //         DtJabatan::updateOrCreate([
                            //             'id_jabatan' => $result->id,
                            //             'id_divisi' => $result->satuan_kerja_id,
                            //             'divisi' => $result->name_satuan_kerja,
                            //             'jabatan' => $result->name_jabatan,
                            //             'description' => $result->description
                            //         ]);
                            //     }
                            // }
                        }
                    $page++;
                }
            }
            session()->flash($message, $status);
            return redirect('/nonpns');
        } catch (ServerException $e) {
            session()->flash('error', 'Terjadi masalah pada API, silakan coba kembali');
            return redirect('/nonpns');
        } catch (ClientException $e) {
            session()->flash('error', 'Terjadi masalah pada API, silakan coba kembali');
            return redirect('/nonpns');
        } catch (BadResponseException $e) {
            session()->flash('error', 'Terjadi masalah pada API, silakan coba kembali');
            return redirect('/nonpns');
        }
    }

    public function conflict(){
        return view('home.kepegawaian.data.master_pegawai.conflict', [
            'title' => 'Pegawai',
            'conflicts' => TmpPegawai::all(),
            'dtConflicts' => TmpDtPegawai::all()
        ]);
    }

    public function resolving($nip){
        if(TmpPegawai::where('noPegawai', $nip)->first() != null){ // kondisi untuk mengecek apakah NIP ditemukan dalam model Pegawai
            $tmp = TmpPegawai::where('noPegawai', $nip)->first();
            $local = Pegawai::where('noPegawai', $nip)->first();
            $keys = collect($tmp->getAttributes())->keys()->all();
            return view('home.kepegawaian.data.master_pegawai.resolvePns', [
                'title' => 'Pegawai',
                'api' => $tmp,
                'local' => $local,
                'keys' => $keys
            ]);
        } else if(TmpDtPegawai::where('user_id', $nip)->first() != null){ // untuk mengecek apakah NIP ditemukan dalam model DtPegawai
            $tmp = TmpDtPegawai::select("nip","email","fullname","birth_place","birth_date","marital_status","religion","blood_type","gender","age","telephone","divisi","jabatan","join_date","resign_date","reason_resignation","id_card_address","current_address","bank_account_number","bank_account_name","bank_branch","npwp")->where('user_id', $nip)->first();
            $local = DtPegawai::where('user_id', $nip)->first();
            $keys = collect($tmp->getAttributes())->keys()->all();
            return view('home.kepegawaian.data.master_pegawai.resolveNonPns', [
                'title' => 'Pegawai',
                'api' => $tmp,
                'local' => $local,
                'keys' => $keys
            ]);
        }
    }

    public function resolved(Request $request, $id){
        if(TmpPegawai::where('noPegawai', $id)->first() != null){ // kondisi untuk mengecek apakah NIP ditemukan dalam model Pegawai
            $data = Pegawai::where('noPegawai', $id)->first();
            $data->update($request->except('_token'));
            $deleteData = TmpPegawai::where('noPegawai', $data->noPegawai)->first();
            $deleteData->delete();
        } else if(TmpDtPegawai::where('user_id', $id)->first() != null){ // untuk mengecek apakah NIP ditemukan dalam model DtPegawai
            $data = DtPegawai::where('user_id', $id)->first();
            $data->update($request->except('_token'));
            $deleteData = TmpDtPegawai::where('user_id', $data->user_id)->first();
            $deleteData->delete();
        }
        return redirect('/master-pegawai')->with('resolve', 'Berhasil meninjau data pegawai');
    }

    public function create(Request $request)
    {
        $bidang = Bidang::all();
        return view('home.kepegawaian.data.master_pegawai.create', ['bidangs' => $bidang, 'title' => 'Pegawai']);
    }

    public function store(Request $request)
    {
        Pegawai::create($request->all());

        $request->accepts('session');

        session()->flash('success', 'Berhasil menambahkan data!');
 
        return view('home.kepegawaian.data.master_pegawai.create', ['title' => 'Pegawai']);
    }

    public function update()
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $client = new Client();
        $response = $client->request ('GET', 'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian',
        [
            'query' => ['tanggal'=>$todayDate],
            'auth' => ['diskominfo_presensi','diskominfo_presensi12345']
        ]);
        $body = $response->getBody();
        $body_array = json_decode($body);

        foreach ($body_array as $post){
            $post = (array)$post;

            Pegawai::upsert([
                    'nama' => $post['nama'],
                    'tempatLahir' => null,
                    'tanggalLahir' => null,
                    'noPegawai' => $post['nip'],
                    'unitKerja' => $post['unitkerja_nama'],
                    'golonganPangkat' => null,
                    'tmtGolongan' => null,
                    'eselon' => null,
                    'namaJabatan' => null,
                    'tmtJabatan' => null,
                    'statusPegawai' => null,
                    'tmtPegawai' => null,
                    'masaKerjaTahun' => null,
                    'masaKerjaBulan' => null,
                    'jenisKelamin' => null,
                    'agama' => null,
                    'perkawinan' => null,
                    'pendidikanAwal' => null,
                    'jurusanPendidikanAwal' => null,
                    'pendidikanAkhir' => null,
                    'jurusanPendidikanAkhir' => null,
                    'noAkses' => null,
                    'noNpwp' => null,
                    'nik' => null,
                    'alamatRumah' => null,
                    'telp' => null,
                    'hp' => null,
                    'email' => null,
                    'kedudukanPegawai' => null
                ], ['noPegawai'], ['nama', 'unitKerja']);
        }
        return redirect()->action([PegawaiController::class, 'index']);
    }

    public function edit($id)
    {
        $edit = Pegawai::find($id);
        return view('home.kepegawaian.data.master_pegawai.editpns', [ 'edit' => $edit, 'title' => 'Pegawai']);
    }

    public function upd(Request $request, $id)
    {
        $edit = Pegawai::find($id);
        $edit->update($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/detail-pegawai/'.$id)->with('success', 'Berhasil Mengupdate Data');
    }

    public function delete($id)
    {
        $user = Pegawai::find($id);
        $user->delete();

        return back()->with('successDelete', 'Data has been deleted!');
    }

    // PNS
    public function pnsindex(Request $request)
    {
        $conflict = TmpPegawai::all()->isNotEmpty();
        $data = DB::table('pegawais')->orderBy('noPegawai', 'asc')->get();
        return view('home.kepegawaian.data.master_pegawai.pns', compact('data'), [ 'data' => $data, 'title' => 'Pegawai', 'search' => $request->search, 'conflict' => $conflict]);
    }
//  Detail PNS
     public function show($id){
        $pegawai= Pegawai::find($id);
        return view('home.kepegawaian.data.master_pegawai.show',['pegawai'=> $pegawai, 'title' => 'Detail Pegawai']);
    }

// NONPNS
    public function nonpns(Request $request)
    {
        $data = DtPegawai::whereNot('jabatan', 'PNS')->where('is_active', 'true')->get();
        $conflict = TmpPegawai::all()->isNotEmpty();
        $unitKerja = collect();
        $pegawai = collect();
        if($request->include == 'include') {
            foreach($data as $result){
                $result->birth_date = Carbon::parse($result->birth_date)->translatedFormat('d F Y');
                $result->join_date = Carbon::parse($result->join_date)->translatedFormat('d F Y');
                $unitKerja->push($result->unitKerja);
            }
            if($request->unitkerja != null && $request->divisi == null){ // hanya ada include atau tidak
                foreach($data as $result){
                    if($result->unitKerja->namaUnit == $request->unitkerja){
                        $pegawai->push($result);
                    }
                }
            } else if($request->unitkerja == null && $request->divisi != null){
                foreach($data as $result){
                    if($result->unitKerja->idUnitKerja == $request->divisi){
                        $pegawai->push($result);
                    }
                }
            } else if($request->unitkerja != null && $request->divisi != null){
                foreach($data as $result){
                    if($result->unitKerja->idUnitKerja == $request->divisi && $result->unitKerja->namaUnit == $request->unitkerja){
                        $pegawai->push($result);
                    }
                }
            }
        } else if($request->include == 'notInclude'){
            foreach($data as $result){
                $result->birth_date = Carbon::parse($result->birth_date)->translatedFormat('d F Y');
                $result->join_date = Carbon::parse($result->join_date)->translatedFormat('d F Y');
                $unitKerja->push($result->unitKerja);
            }
            if($request->unitkerja != null && $request->divisi == null){ // hanya ada include atau tidak
                foreach($data as $result){
                    if($result->unitKerja->namaUnit == $request->unitkerja){
                        // nothing
                    } else {
                        $pegawai->push($result);
                    }
                }
            } else if($request->unitkerja == null && $request->divisi != null){
                foreach($data as $result){
                    if($result->unitKerja->idUnitKerja == $request->divisi){
                        // nothing
                    } else {
                        $pegawai->push($result);
                    }
                }
            } else if($request->unitkerja != null && $request->divisi != null){
                foreach($data as $result){
                    if($result->unitKerja->idUnitKerja == $request->divisi && $result->unitKerja->namaUnit == $request->unitkerja){
                        // nothing
                    } else {
                        $pegawai->push($result);
                    }
                }
            }
        } else {
            foreach($data as $result){
                $result->birth_date = Carbon::parse($result->birth_date)->translatedFormat('d F Y');
                $result->join_date = Carbon::parse($result->join_date)->translatedFormat('d F Y');
                $unitKerja->push($result->unitKerja);
            }
            $pegawai = $data;
        }
        return view('home.kepegawaian.data.master_pegawai.nonpns', [ 'data' => $pegawai, 'title' => 'Pegawai', 'unitkerjas' => $unitKerja->unique('idUnitKerja')->unique('namaUnit'), 'divisis' => $unitKerja->unique('idUnitKerja'), 'before' => $request->all(), 'conflict' => $conflict]);
    }

//  Detail NON-PNS
    public function detail(Request $request, $id){
        $nonpns= DtPegawai::find($id);
        $perbandingan= KategoriUsia::all();
        $pendidikan = KategoriPendidikan::all();
        $hasil ='';
        $result='';

        $jabatan = $nonpns->deskripsiJabatan;
        if($jabatan != null){
            $jabatan->description = str_replace(';', '.', $jabatan->description);
            $jabatan->description = str_replace(PHP_EOL, '</br></br>', $jabatan->description);
        } else {
            $jabatan = null;
        }

        //untuk mengetahui kategori usia pekerja
        foreach ($perbandingan as $table) {
            if ($nonpns->age <= $table->hingga) {
                $hasil = $table->kategori;
                break; // Hentikan perulangan setelah menemukan kategori yang cocok
            }
        }
        
        //untuk mengetahui kategori pendidikan IT NON IT
        foreach ($pendidikan as $cek) {
            if (!is_null($nonpns->pendidikan) && $cek->jurusan == $nonpns->pendidikan->majors) {
                $result = $cek->kategori;
                break; // Hentikan perulangan setelah menemukan kategori yang cocok
            }
        }


        $nonpns->join_date = Carbon::parse($nonpns->join_date)->translatedFormat('d F Y');
        $nonpns->birth_date = Carbon::parse($nonpns->birth_date)->translatedFormat('d F Y');
        return view('home.kepegawaian.data.master_pegawai.detail',['result'=>$result ,'nonpns'=> $nonpns, 'perbandingan'=> $perbandingan, 'hasil'=> $hasil, 'title' => 'Detail Pegawai', 'jabatan' => $jabatan]);
    }

    
    public function editnon($id)
    {
        $edit = DtPegawai::find($id);
        return view('home.kepegawaian.data.master_pegawai.editnonpns', [ 'edit' => $edit, 'title' => 'Pegawai']);
    }

    public function updnon(Request $request, $id)
    {
        $edit = DtPegawai::find($id);
        $edit->update($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/detail-nonpns/'.$id)->with('success', 'Berhasil Mengupdate Data');
    }


// Tidak Aktif
    public function nonaktifindex(Request $request)
    {
        $data = DtPegawai::where('is_active', 'false')->get();
        // dd($data);
        foreach($data as $result){
            $result->birth_date = Carbon::parse($result->birth_date)->translatedFormat('d F Y');
        }
        return view('home.kepegawaian.data.master_pegawai.tidakaktif', [ 'data' => $data, 'title' => 'Pegawai Tidak Aktif', 'search' => $request->search]);
    }
    public function showtoregister()
    {
        $data = Pegawai::all();
        return view('register.register', ['data' => $data]);


    }
    //Join Table Pegawai dan Unit Kerja
    public function joinUnit(Request $request)
    {
        $name = $request->input('name');
        $pegawai = DB::table('pegawais')
                    ->join('unit_kerjas','pegawais.unitKerja_id','=','unit_kerjas.id')
                    ->where('pegawais.nama',$name)
                    ->select('pegawais.*','unit_kerjas.aliasUnit as aliasUnit')
                    ->first();
        if ($pegawai) {
            return response()->json([
                'unitKerja' => $pegawai->aliasUnit,
                'noPegawai' => $pegawai->no_pegawai,
                'hp' => $pegawai->hp,
                'email' => $pegawai->email,
            ]);
        } else {
            return response()->json([]);
        }
    }
}