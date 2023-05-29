<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Pegawai;

class UpdatePegawai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdatePegawai:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penjadwalan copy data pegawai dari KMOB ke tabel pegawais di lokal';

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

        echo "<pre>";

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
                ], ['noPegawai'], ['nama', 'unitKerja']
            );
        }
    }
}
