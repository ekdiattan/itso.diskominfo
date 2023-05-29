<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Pulang;

class UpdateBelumPulang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateBelumPulang:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penjadwalan copy data pegawai yang belum absen pulang dari KMOB ke tabel pulangs di lokal';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Jakarta');
        $todayDate = date('Y-m-d');
	    $now = Carbon::now();
	    DB::table('pulangs')->truncate();
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
            
            Pulang::updateOrCreate(
                [
                    'nip' => $post['nip'],
                    'nama' => $post['nama'],
                    'unitkerja_nama' => $post['unitkerja_nama'],
                    'tanggal' => $todayDate,
                    'pulang' => $post['pulang'],
                    'update' => $now
                ],
            );
        }
    }
}
