<?php

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Telegram\Bot\Api;

class NewDataReceived implements ShouldQueue
{
    use InteractsWithQueue;

    protected $telegram;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewDataReceived  $event
     * @return void
     */
    public function handle(NewDataReceived $event)
    {
        // Kirim pesan ke bot Telegram
        $this->telegram->sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => 'Data baru telah diterima!'
        ]);
    }
}

