<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Masuk;
use App\Models\Libur;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

use Telegram;

class TelegramAbsenMasuk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TelegramAbsenMasuk:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim daftar pegawai belum absen masuk ke telegram';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = Carbon::now()->format('Y-m-d');
        $liburs = Libur::all();
        if($liburs->contains('tanggal', $today) == false){
            $todayDate = date('Y-m-d');
            $now = Carbon::now();
            DB::table('masuks')->truncate();
            $client = new Client();
            $response = $client->request(
                'GET',
                'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian',
                [
                    'query' => ['tanggal' => $todayDate],
                    'auth' => ['diskominfo_presensi', 'diskominfo_presensi12345']
                ]
            );
            $body = $response->getBody();
            $body_array = json_decode($body);
            foreach ($body_array as $post) {
                $post = (array)$post;
                Masuk::updateOrCreate(
                    [
                        'nip' => $post['nip'],
                        'nama' => $post['nama'],
                        'unitkerja_nama' => $post['unitkerja_nama'],
                        'tanggal' => $todayDate
                    ],
                    [
                        'masuk' => $post['masuk'],
                        'terlambat' => $post['terlambat'],
                        'update' => $now
                    ],
                );
            }
            $time = now()->format("Y-m-d");
            $last_update = DB::select("SELECT update FROM masuks ORDER BY update DESC LIMIT 1");
            $update = Carbon::parse($last_update[0]->update)->format('H:i:s');
            $absen_masuk = DB::select("SELECT nama FROM masuks WHERE masuk = '00:00:00' AND nama NOT IN (SELECT nama FROM cutis WHERE '$time' BETWEEN tgl_mulai AND tgl_selesai) AND nama NOT IN (SELECT nama FROM pengecualian_pegawais WHERE '$time' BETWEEN mulai AND selesai) AND tanggal='$time' ORDER BY nama ASC");
            
            $pegawai = array('');
            foreach($absen_masuk as $masuk){
                array_push($pegawai, '- '.$masuk->nama);
            }
            $strPegawai = implode(PHP_EOL, $pegawai);
            Telegram::sendMessage([
                'chat_id' => '-1001781912074',
                'message_thread_id' => '432',
                'text' => 'Assalamualaikum Warohmatullahi Wabarokatuh Bapak/Ibu..'. PHP_EOL. 'Semangat pagi'.PHP_EOL.'Disampaikan daftar pegawai yang belum melakukan presensi untuk skema masuk kerja sampai pukul '.$update.' WIB berikut :'.PHP_EOL.$strPegawai.PHP_EOL.'Terima kasih 🙏😊'.PHP_EOL.'Salam,'.PHP_EOL.'Tim Sekretariat Diskominfo'.PHP_EOL.'#ExcellentService'.PHP_EOL.'#DiskominfoJuara'.PHP_EOL.'#JabarJuaraLahirBatin'
            ]);
        }
    }
}
