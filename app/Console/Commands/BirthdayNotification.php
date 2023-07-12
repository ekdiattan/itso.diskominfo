<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pegawai;
use App\Models\DtPegawai;

use Telegram;

class BirthdayNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BirthdayNotification:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command untuk mengirimkan notifikasi hari ulang tahun kepada pegawai';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pegawai = Pegawai::select('nama', 'noPegawai', 'tanggalLahir')->get();
        $dt = DtPegawai::select('fullname', 'nip', 'birth_date')->get();
        foreach($pegawai as $result){
            if($result->tanggalLahir != null && $result->tanggalLahir == date('Y-m-d')){
                Telegram::sendMessage([
                    'chat_id' => '-1001781912074',
                    'message_thread_id' => '3',
                    'text' => "Selamat ulang tahun ".$result->nama." Semoga panjang Umur dan Sehat selalu"
                ]);
            }
        }
        foreach($dt as $result){
            if($result->birth_date != null && $result->birth_date == date('Y-m-d')){
                Telegram::sendMessage([
                    'chat_id' => '-1001781912074',
                    'message_thread_id' => '3',
                    'text' => "Selamat ulang tahun ".$result->fullname." Semoga panjang Umur dan Sehat selalu"
                ]);
            }
        }
    }
}