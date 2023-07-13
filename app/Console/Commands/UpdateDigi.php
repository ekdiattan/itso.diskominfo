<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use GuzzleHttp\Client;
use App\Models\DtPegawai;
use App\Models\UnitKerja;
use App\Models\DtPendidikan;
use App\Models\DtJabatan;

class UpdateDigi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateDigi:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penjadwalan update data pegawai dari DtPegawai ke tabel di lokal';

    /**
     * Execute the console command.
     *
     * @return int
     */
    
            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/info', [ // Data User Login

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/menu/user/list/', [ // Menu List

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/satuan-kerja/?limit=50', [ // Satuan Kerja

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/attendance/?page=5', [ // Detail absensi

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/attendance/is/checkout', [ // Mengecek apakah sudah checkin

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/attendance/is/checkin', [ // Mengecek apakah sudah checkout

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/dashboard/report-user', [ // Gatau apa tapi reporting kayanya

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/dashboard/attendance-user?month=5&year=2023', [ // Gatau apa tapi reporting kayanya

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/?page_size=10&page=1&is_active=true&struktural=true&search=', [ // Ini untuk pegawai Aktif
            
            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/?page_size=10&page=1&is_active=false&struktural=&search=', [ // Pegawai nonaktif / alumni

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/?page_size=10&page=1&is_active=true&struktural=&search=', [ // Pegawai Non Asn
                
            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/monthly-report/?search=&start_date=&end_date=&id_divisi=&category_export=true&divisi=b5c01ae4-8352-441f-9ce1-cf036893eae4&page_size=100', [ // Gatau apa tapi reporting kayanya

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/jabatan/?satuan_kerja_id=57af1519-f286-406e-89da-da8dcc8d9bdd', [ // Detail untuk satuan kerja

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/0855fdc2-2209-47ae-9041-e3bddb371648/', [ // Detail untuk User

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/holiday-date/?year=2023&limit=100&page=1', [ // Hari libur nasional

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/dashboard/attendance-user?month=5&year=2023', [ // Rekapitulasi absen per bearer dari pengguna

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/monthly-report/?search=&start_date=2023-05-01&end_date=2023-05-31&id_divisi=&category_export=true&divisi=7f6b9830-78fd-4d09-bde0-fcde5e476db5&page_size=100', [ // Rekapitulasi progress laporan pegawai

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/export-pdf/report-by-user/download/34572763-c774-419d-b172-90be11cca711?start_date=2023-05-01&end_date=2023-05-31', [ // Export laporan by user id

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/jabatan/?limit=10&page=1', [ // Daftar jabatan dengan detailnya

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/project/?limit=10&block=-&page=1', [ // Daftar proyek dalam API
    public function handle()
    {
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
                    $body_array = json_decode($body);
                    $maxPage = $body_array->_meta->totalPage;
                    
                    foreach($body_array->results as $results){
                        // detail per user
                        $detailResponse = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/'.$results->id.'/', [
                            'headers' => [
                                'Authorization' => 'Bearer '. $token,
                                ]
                            ]);
                        $detailBody = json_decode($detailResponse->getBody());
                        if($detailBody->divisi != 'ASN'){
                            // because account_bank variable is array, but if null it known as string variable
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
                                    "age"
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
                                    "age"
                                ]);
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
                                    $namaUnit = 'UPTD PUSAT LAYANAN DIGITAL DAN GEOPASKAL';
                                    $aliasUnit = 'UPTD PLDDG';
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
                                UnitKerja::updateOrCreate([
                                    'idUnitKerja' => $detailBody->id_divisi,
                                ], [
                                    'namaUnit' => $namaUnit,
                                    'aliasUnit' => $aliasUnit,
                                    'unitKerjaApi' => $detailBody->divisi
                                ]);
                        }
                    }
                $page++;
            }
            // update all jabatan from digiteam
            $page = 1;
            $maxPage = 2;
            while($page <= $maxPage){
                $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/jabatan/?limit=10&page='.$page, [
                    'headers' => [
                        'Authorization' => 'Bearer '. $token,
                    ]
                ]);
                $body = $response->getBody();
                $body_array = json_decode($body);
                $maxPage = $body_array->_meta->totalPage;

                foreach($body_array->results as $result){
                    DtJabatan::updateOrCreate([
                        'id_jabatan' => $result->id,
                        'id_divisi' => $result->satuan_kerja_id,
                        'divisi' => $result->name_satuan_kerja,
                        'jabatan' => $result->name_jabatan,
                        'description' => $result->description,
                    ]);
                }
            }
            // update absensi kehadiran from digiteam
            $today = Carbon::now()->format('Y-m-d');
                $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/attendance/?limit=200&pageSize=200&date='.$today, [
                    'headers' => [
                        'Authorization' => 'Bearer '. $token,
                        ]
                    ]);
                $body = json_decode($response->getBody());
                foreach($body->results as $result){
                    DtKehadiran::upsert([
                        "_id" => $result->_id,
                        "startDate" => isset($result->startDate) ? $result->startDate : '',
                        "endDate" => isset($result->endDate) ? $result->endDate : '',
                        "officeHours" => isset($result->officeHours) ? $result->officeHours : '',
                        "location" => isset($result->location) ? $result->location : '',
                        "message" => isset($result->message) ? $result->message : '',
                        "note" => isset($result->note) ? $result->note : '',
                        "mood" => isset($result->mood) ? $result->mood : '',
                        "fullname" => isset($result->fullname) ? $result->fullname : '',
                        "email" => isset($result->email) ? $result->email : '',
                        "username" => isset($result->username) ? $result->username : '',
                        "divisi" => isset($result->divisi) ? $result->divisi : '',
                        "jabatan" => isset($result->jabatan) ? $result->jabatan : '',
                        "date" => $today,
                    ], [
                        "_id",
                    ], [
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
                    ]);
                }
        }
    }
}
