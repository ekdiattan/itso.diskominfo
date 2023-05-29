<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use GuzzleHttp\Client;
use App\Models\Rekapitulasi;
use App\Models\Pegawai;

class UpdateRekap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateRekap:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penjadwalan copy data rekapitulasi pegawai dari KMOB ke tabel rekapitulasis di lokal';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pegawais = Pegawai::select('nama', 'noPegawai', 'unitKerja')->orderBy('noPegawai', 'asc')->get()->toArray();
        $past = Carbon::now()->subDays(2)->format('l, d F Y');
        $today = Carbon::now();
        $previous = CarbonPeriod::create($past, $today);  
        foreach ($previous as $p){ // lakukan dengan tanggal yang berbeda selama 10 hari ke belakang
            if($p->format('l') !== 'Saturday' && $p->format('l') !== 'Sunday'){ // melakukan filter terhadap  hari sabtu dan minggu
                $client = new Client();
                $response = $client->request ('GET', 'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian',
                [
                    'query' => ['tanggal'=>$p->format('Y-m-d')],
                    'auth' => ['diskominfo_presensi','diskominfo_presensi12345']
                ]);
                $body = $response->getBody();
                $body_array = json_decode($body);

                foreach($pegawais as $pegawai){
                    foreach($body_array as $result){
                        $post = (array)$result;
                        if($pegawai['nama'] == $post['nama']){
                            if($pegawai['nama'] == $post['nama'] && $pegawai['unitKerja'] == $post['unitkerja_nama']){
                                Rekapitulasi::updateOrCreate([
                                    'nip' => $post['nip'],
                                    'nama' => $post['nama'],
                                    'unitkerja'=>$post['unitkerja_nama'],
                                    'tanggal' => $p->format('Y-m-d')
                                ], [
                                    'masuk' => $post['masuk'],
                                    'pulang' => $post['pulang'],
                                    'terlambat' => $post['terlambat']
                                ]);
                            } else {
                                Rekapitulasi::updateOrCreate([
                                    'nip' => $post['nip'],
                                    'nama' => $post['nama'],
                                    'unitkerja'=>$pegawai['unitKerja'],
                                    'tanggal' => $p->format('Y-m-d')
                                ], [
                                    'masuk' => $post['masuk'],
                                    'pulang' => $post['pulang'],
                                    'terlambat' => $post['terlambat']
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
}
