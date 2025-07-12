<x-app-layout>
    @if($siswa->status_pendaftaran === 'diverifikasi' &&
    $siswa->pembayaran->status_pembayaran === 'diverifikasi')

    <div
        class="container w-full max-w-md mx-auto p-6 my-10 bg-white rounded shadow"
    >
        {{-- Header --}}
        <div class="text-center mb-6">
            <img
                src="{{ config('app.url') . '/logo/logo.png' }}"
                alt="Logo Sekolah"
                class="mx-auto h-14 mb-2"
            />
            <h2 class="text-lg font-bold">Informasi Hasil Seleksi</h2>
            <p class="text-sm text-gray-600">
                Penerimaan Peserta Didik Baru {{ date("Y") }}
            </p>
        </div>

        {{-- Data Siswa --}}
        <div class="bg-gray-50 p-4 rounded mb-4 text-sm">
            <p><strong>Nama Lengkap:</strong> {{ $siswa->nama_lengkap }}</p>
            <p>
                <strong>Nomor Pendaftaran:</strong>
                {{ $siswa->nomor_pendaftaran }}
            </p>
            <p>
                <strong>Total Nilai:</strong>
                {{ optional($siswa->nilai)->jumlah_nilai ?? '-' }}
            </p>

            @php $keterangan = strtolower(optional($siswa->nilai)->keterangan);
            @endphp

            <p>
                <strong>Keterangan Nilai:</strong>
                @if ($keterangan === 'mencukupi')
                <span class="text-green-600 font-semibold">Mencukupi</span>
                @elseif ($keterangan === 'tidak mencukupi')
                <span class="text-red-600 font-semibold">Tidak Mencukupi</span>
                @else
                <span class="text-gray-600 font-semibold"
                    >Belum Diverifikasi</span
                >
                @endif
            </p>

            <p>
                <strong>Status Kelulusan:</strong>
                @if ($siswa->status_kelulusan === 'lulus')
                <span class="text-green-600 font-semibold">LULUS</span>
                @elseif ($siswa->status_kelulusan === 'tidak_lulus')
                <span class="text-red-600 font-semibold">TIDAK LULUS</span>
                @else
                <span class="text-gray-600 font-semibold"
                    >Belum Ditentukan</span
                >
                @endif
            </p>
        </div>

        {{-- Pesan Berdasarkan Status --}}
        @if ($siswa->status_kelulusan === 'lulus')
        <div class="bg-green-100 p-4 rounded text-green-800 text-sm">
            <p>Selamat! Anda dinyatakan <strong>LULUS</strong>.</p>
            <p>
                Silakan menunggu informasi lebih lanjut terkait pendaftaran
                daftar ulang.
            </p>
            <!-- <a
                href="{{ config('app.url') }}"
                class="inline-block mt-3 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500 text-sm"
            >
                Kunjungi Website Sekolah
            </a> -->
        </div>
        @elseif ($siswa->status_kelulusan === 'tidak_lulus')
        <div class="bg-red-100 p-4 rounded text-red-800 text-sm">
            <p>
                Mohon maaf, Anda <strong>TIDAK LULUS</strong> dalam seleksi ini.
            </p>
            <p>Tetap semangat dan jangan berhenti belajar.</p>
        </div>
        @else
        <div class="bg-gray-100 p-4 rounded text-gray-800 text-sm">
            <p>Status kelulusan Anda <strong>belum ditentukan</strong>.</p>
            <p>Silakan cek secara berkala atau hubungi panitia jika perlu.</p>
        </div>
        @endif

        {{-- Footer --}}
        <div class="mt-6 text-center text-xs text-gray-500">
            <p>Hormat kami,</p>
            <p>Panitia {{ config("app.name") }}</p>
            <!-- <p>
                &copy; {{ date("Y") }} {{ config("app.name") }}. Semua Hak
                Dilindungi.
            </p> -->
        </div>
    </div>

    @else
    {{-- Jika belum diverifikasi --}}
    <div
        class="w-full h-full flex mt-12 max-w-md mx-auto rounded shadow p-6 bg-white"
    >
        <div
            class="border border-blue-200 bg-blue-50 rounded-lg p-4 text-sm text-blue-800 w-full"
        >
            <strong>Informasi:</strong>
            <p class="mt-2">
                Kartu kelulusan belum tersedia. Pastikan status
                <strong>pendaftaran</strong> dan
                <strong>pembayaran</strong> Anda telah diverifikasi oleh
                panitia.
            </p>
        </div>
    </div>
    @endif
</x-app-layout>
