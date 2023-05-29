<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Cuti;

class UpdateCuti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateCuti:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penjadwalan copy data cuti dari KMOB ke tabel cutis di lokal';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $thisYear = date('Y');
        $thisMonth = date('m');

        $now = Carbon::now();
            $client = new Client();
            $response = $client->request(
                'GET',
                'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/cuti-bulanan',
                [
                    'query' => ['tahun' => $thisYear, 'bulan' => $thisMonth],
                    'auth' => ['diskominfo_presensi', 'diskominfo_presensi12345']
                ]
            );
            $cuti = $response->getBody();
            $cuti_array = json_decode($cuti);
            foreach ($cuti_array as $post) {
                $post = (array)$post;
                Cuti::updateOrCreate(
                    [
                        'nama' => $post['nama'],
                        'tgl_mulai' => $post['tgl_mulai'],
                        'njab' => $post['njab'],
                        'unitkerja_nama' => $post['unitkerja_nama'],
                        'jenis_cuti' => $post['jenis_cuti'],
                        'tgl_selesai' => $post['tgl_selesai'],
                        'uraian' => $post['uraian'],
                        'tgl_pengajuan' => $post['tgl_pengajuan'],
                        'atasan' => $post['atasan'],
                        'ket_proses' => $post['ket_proses']
                    ]
                );
            }
        }
    }
