<?php

namespace App\Mail;

use App\Models\CalonSiswa as Siswa; // Import model Siswa
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusPendaftaranMail extends Mailable
{
    use Queueable, SerializesModels;

    public Siswa $siswa;
    public string $pesan;

    /**
     * Create a new message instance.
     */
    public function __construct(Siswa $siswa, string $pesan)
    {
        $this->siswa = $siswa;
        $this->pesan = $pesan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Update Status Pendaftaran Anda',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.status_pendaftaran', // Path ke file template email
        );
    }
}
