<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kehadiran;
use GuzzleHttp\Client;

class UpdateKehadiran extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateKehadiran:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penjadwalan copy data kehadiran dari KMOB ke tabel kehadirans di lokal';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
            $post = (array)$post;
            Kehadiran::updateOrCreate(
                [
                    'nip' => $post['nip'],
                    'nama' => $post['nama'],
                    'unitkerja_nama' => $post['unitkerja_nama'],
                    'masuk' => $post['masuk'],
                    'pulang' => $post['pulang'],
                    'terlambat' => $post['terlambat'],
                    'tanggal' => $todayDate
                ]
            );
        }
    }
}
