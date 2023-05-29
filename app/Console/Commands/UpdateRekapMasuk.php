<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use GuzzleHttp\Client;
use App\Models\RekapMasuk;


class UpdateRekapMasuk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateRekapMasuk:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penjadwalan copy data rekapitulasi masuk pegawai dari KMOB ke tabel rekap_masuks di lokal';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayDate = Carbon::now()->subDay(10)->format('l, d F Y');
        $yesterday = Carbon::yesterday();
        $previous = CarbonPeriod::create($todayDate, $yesterday);    
        
        foreach ($previous as $p){
            if($p->format('l') !== 'Saturday' && $p->format('l') !== 'Sunday'){
                $client = new Client();
                $response = $client->request ('GET', 'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian',
                [
                    'query' => ['tanggal'=>$p->format('Y-m-d')],
                    'auth' => ['diskominfo_presensi','diskominfo_presensi12345']
                ]);
                $body = $response->getBody();
                $body_array = json_decode($body);
                foreach ($body_array as $post){
                    $post = (array)$post;
                    RekapMasuk::updateOrCreate(
                        [
                            'nama' => $post['nama'],
                            'unitkerja_nama'=>$post['unitkerja_nama'],
                            'tanggal' => $p->format('d M Y')
                        ],
                        [
                            'masuk' => $post['masuk'],
                            'terlambat' => $post['terlambat']
                        ]   
                    );
                }
            }
        }
    }
}
