<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingNotificationTimAssetAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $mulai;
    public $selesai;

    /**
     * Create a new message instance.
     *
     * @param  $booking
     * @param  $mulai
     * @param  $selesai
     * @return void
     */
    public function __construct($booking, $mulai, $selesai)
    {
        $this->booking = $booking;
        $this->mulai = $mulai;
        $this->selesai = $selesai;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Permohonan Booking Tim Aset')
            ->view('emails.booking-notification-timassetadmin')
            ->with([
                'booking' => $this->booking,
                'mulai' => $this->mulai,
                'selesai' => $this->selesai,
            ]);
    }
}
