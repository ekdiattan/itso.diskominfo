<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Models\RekapPulang;

class UpdateRekapPulang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateRekapPulang:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penjadwalan copy data rekapitulasi masuk pegawai dari KMOB ke tabel rekap_pulangs di lokal';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayDate = Carbon::now()->subDay(7)->format('l, d F Y');
        $now = Carbon::yesterday();
        $previous = CarbonPeriod::create($todayDate, $now);

        foreach ($previous as $p) {
            if ($p->format('l') !== 'Saturday' && $p->format('l') !== 'Sunday') {
                $client = new Client();
                $response = $client->request(
                    'GET',
                    'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian',
                    [
                        'query' => ['tanggal' => $p->format('Y-m-d')],
                        'auth' => ['diskominfo_presensi', 'diskominfo_presensi12345']
                    ]
                );
                $body = $response->getBody();
                $body_array = json_decode($body);

                foreach ($body_array as $post) {
                    $post = (array)$post;

                    if ($post['pulang'] == '00:00:00') {
                        $hitung = DB::select("SELECT COUNT(nama) AS Jml FROM cutis WHERE nama='" . $post['nama'] . "' AND '" . $p->format('Y-m-d') . "' BETWEEN tgl_mulai AND tgl_selesai");

                        if ($hitung[0]->jml === 0) {
                            RekapPulang::updateOrCreate(
                                [
                                    'nip' => $post['nip'],
                                    'nama' => $post['nama'],
                                    'unitkerja_nama' => $post['unitkerja_nama'],
                                    'tanggal' => $p->format('Y-m-d'),
                                    'pulang' => $post['pulang']
                                ]
                            );
                        }
                    }
                }
            }
        }
    }
}
