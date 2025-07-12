<x-app-layout>
    <div class="my-12">
        @if($siswa->status_pendaftaran == 'diverifikasi' &&
        $siswa->pembayaran->status_pembayaran == 'diverifikasi')
        <div
            class="w-full max-w-sm mx-auto h-full bg-white rounded-xl shadow-lg p-6"
        >
            <div class="text-center mb-4">
                <img
                    src="{{ asset('storage/logo/logo.png') }}"
                    alt="Logo Sekolah"
                    class="mx-auto h-16 mb-2 object-cover"
                />
                <h1 class="text-xl font-bold text-gray-800">
                    KARTU PESERTA UJIAN
                </h1>
                <p class="text-sm text-gray-600">
                    Penerimaan Peserta Didik Baru SMA Papua Kasih
                </p>
            </div>

            <div class="flex items-center space-x-4 mb-6">
                <div
                    class="w-24 h-32 bg-white border-2 border-gray-300 flex items-center justify-center"
                >
                    {{-- Ganti dengan path foto siswa jika ada --}}
                    @if($siswa->foto_siswa)
                    <img
                        src="{{ route('foto.siswa', ['filename' => basename($siswa->foto_siswa)]) }}"
                        alt="Foto"
                        class=""
                    />
                    @else
                    <span class="text-xs text-gray-500">Foto 3x4</span>
                    @endif
                </div>
                <div class="text-sm">
                    <p class="font-bold text-gray-800">Nomor Pendaftaran:</p>
                    <p class="mb-2">
                        {{ $siswa->nomor_pendaftaran }}
                    </p>

                    <p class="font-bold text-gray-800">Nama Lengkap:</p>
                    <p class="mb-2">{{ $siswa->nama_lengkap }}</p>

                    <p class="font-bold text-gray-800">Asal Sekolah:</p>
                    <p>{{ $siswa->asal_sekolah }}</p>
                </div>
            </div>

            <div
                class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm text-blue-800"
            >
                <!-- <h3 class="font-bold mb-2">Informasi Ujian</h3>
                <p><strong>Tanggal:</strong> Sabtu, 2 Agustus 2025</p>
                <p><strong>Waktu:</strong> 08:00 WIT - Selesai</p>
                <p><strong>Lokasi:</strong> Kampus SMA Papua Kasih</p> -->
                <p class="mt-2">
                    <strong>Informasi:</strong> Harap membawa kartu ini saat
                    seleksi ujian masuk PPDB.
                </p>
            </div>

            <div class="mt-6 text-center no-print">
                <a
                    href="{{ route('siswa.cetak.kartu.peserta') }}"
                    target="_blank"
                    class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700"
                >
                    <i class="fa-solid fa-file-pdf mr-1"></i> Download PDF
                </a>
            </div>
        </div>
        @else
        <div class="w-full h-full max-w-md mx-auto rounded-xl shadow-lg p-6">
            <div
                class="border border-blue-200 rounded-lg p-4 text-sm text-blue-800"
            >
                <p class="mt-2">
                    <strong>Informasi:</strong>
                    Kartu peserta ujian belum siap untuk dicetak. Pastikan
                    pendaftaraan dan pembayaran telah dikonfirmasi oleh panitia
                    sekolah.
                </p>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
