<?php

namespace App\Mail;

use App\Models\Pembayaran; // Import model Pembayaran
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusPembayaranMail extends Mailable
{
    use Queueable, SerializesModels;

    public Pembayaran $pembayaran;
    public string $pesan;

    /**
     * Buat instance pesan baru.
     */
    public function __construct(Pembayaran $pembayaran, string $pesan)
    {
        $this->pembayaran = $pembayaran;
        $this->pesan = $pesan;
    }

    /**
     * Dapatkan amplop pesan.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Update Status Pembayaran Anda',
        );
    }

    /**
     * Dapatkan definisi konten pesan.
     */
    public function content(): Content
    {
        // Tentukan view yang akan menjadi isi email
        return new Content(
            view: 'emails.status_pembayaran',
        );
    }
}
