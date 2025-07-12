<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\CalonSiswa as Siswa;
use App\Models\Nilai;

class GraduationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $calonSiswa;
    public $nilai;

    /**
     * Create a new message instance.
     */
    public function __construct(Siswa $calonSiswa, Nilai $nilai = null)
    {
        $this->calonSiswa = $calonSiswa;
        $this->nilai = $nilai; // Nilai bisa null jika siswa belum punya nilai
    }


    public function envelope(): Envelope
    {
        // Subjek email akan berbeda tergantung status kelulusan
        $subject = 'Informasi Hasil Seleksi Penerimaan Siswa Baru';
        if ($this->nilai && strtolower($this->nilai->keterangan) === 'mencukupi') {
            $subject = 'Selamat! Anda Dinyatakan Lulus Seleksi Penerimaan Siswa Baru';
        } elseif ($this->nilai && strtolower($this->nilai->keterangan) === 'tidak mencukupi') {
            $subject = 'Informasi Hasil Seleksi Penerimaan Siswa Baru';
        }

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        // Mengarahkan ke view Blade untuk isi email
        return new Content(
            view: 'emails.graduation-info',
            with: [
                'siswa' => $this->calonSiswa, // Mengirim objek siswa ke view
                'nilai' => $this->nilai,     // Mengirim objek nilai ke view
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
