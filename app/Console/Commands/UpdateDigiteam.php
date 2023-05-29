<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use GuzzleHttp\Client;
use App\Models\Digiteam;

class UpdateRekapitulasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateDigiteam:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penjadwalan update data pegawai dari Digiteam ke tabel di lokal';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $login = $client->request(
            'POST', 'https://groupware-api.digitalservice.id/auth/admin/login/', [
                'form_params' => [
                    'username' => 'yudiwardoyozz',
                    'password' => 'yudiwardoyozz', 
                ]
            ]
        );
        $result = json_decode($login->getBody()->getContents());
        $token = $result->auth_token;
        $page = 1;
        $maxPage = 2;
        while($page <= $maxPage){
            $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/?page='.$page, [
                'headers' => [
                    'Authorization' => 'Bearer '. $token,
                ]
            ]);
            $body = $response->getBody();
            $body_array = json_decode($body);
            $maxPage = $body_array->_meta->totalPage;
            foreach($body_array->results as $results){
                Digiteam::updateOrCreate([
                    "username" => $results->username,
                ], [
                    "email" => $results->email,
                    "fullname" => $results->fullname,
                    "birth_date" => $results->birth_date,
                    "id_divisi" => $results->id_divisi,
                    "divisi" => $results->divisi,
                    "id_jabatan" => $results->id_jabatan,
                    "jabatan" => $results->jabatan,
                    "is_admin" => $results->is_admin,
                ]);
            }
            $page++;
        }
    }
}
