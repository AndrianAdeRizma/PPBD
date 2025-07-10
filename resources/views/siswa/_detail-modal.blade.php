{{-- KOMPONEN MODAL (Gunakan kode modal dari pertanyaan Anda) --}}
<x-modal name="detail-siswa" :show="false" maxWidth="2xl" focusable>
    <div class="p-6" x-show="!loading && siswa">
        {{-- BAGIAN HEADER KARTU --}}
        <div class="flex items-center pb-4 border-b border-gray-200">
            {{-- Foto Siswa --}}
            <img
                x-show="siswa.foto_siswa"
                :src="`/foto/siswa/${siswa.foto_siswa?.split('/').pop()}`"
                alt="Foto Siswa"
                class="w-20 h-20 rounded-full object-cover mr-6 border-2 border-gray-300 shadow-sm"
            />

            {{-- Placeholder jika tidak ada foto --}}
            <div
                x-show="!siswa.foto_siswa"
                class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center mr-6 border-2 border-gray-300 shadow-sm"
            >
                <svg
                    class="w-10 h-10 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    ></path>
                </svg>
            </div>

            {{-- Nama dan Nomor Pendaftaran --}}
            <div>
                <h2
                    class="text-2xl font-bold text-gray-800"
                    x-text="siswa.nama_lengkap"
                ></h2>
                <p class="text-sm text-gray-500">
                    No. Pendaftaran:
                    <span class="" x-text="`${siswa.nomor_pendaftaran}`"></span>
                </p>
            </div>
        </div>

        {{-- BAGIAN DETAIL DATA DIRI --}}
        <div class="py-5">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Biodata Siswa
            </h3>
            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm"
            >
                {{-- Kolom Kiri --}}
                <div class="space-y-3">
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >NISN</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.nisn || '-'"
                        ></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Jenis Kelamin</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.jenis_kelamin || '-'"
                        ></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Tempat, Tgl Lahir</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="`${siswa.tempat_lahir || ''}, ${formatTanggal(siswa.tanggal_lahir) || ''}`"
                        ></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Agama</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.agama || '-'"
                        ></span>
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="space-y-3">
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Asal Sekolah</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.asal_sekolah || '-'"
                        ></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >No. Telepon</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.nomor_telepon || '-'"
                        ></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Alamat</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.alamat || '-'"
                        ></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bagian Data Orang Tua --}}
        <div class="py-5 border-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Data Orang Tua
            </h3>
            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm"
            >
                {{-- Kolom Kiri --}}
                <div class="space-y-3">
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Nama Ayah</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.ortu.nama_ayah || '-'"
                        ></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Pekerjaan Ayah</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.ortu.pekerjaan_ayah || '-'"
                        ></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Tanggal Lahir</span
                        >
                        {{-- Memanggil fungsi formatTanggal yang sudah ada --}}
                        <span
                            class="text-gray-800"
                            x-text="formatTanggal(siswa.ortu.tanggal_lahir_ayah) || '-'"
                        ></span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-32 font-semibold text-gray-500"
                            >KTP Ayah</span
                        >
                        <template x-if="siswa.ortu?.dokumen_ktp_ayah">
                            <a
                                :href="`/ortu/${siswa.ortu.id}/dokumen/ktp_ayah`"
                                target="_blank"
                                class="text-blue-600 hover:underline"
                            >
                                Lihat Dokumen
                            </a>
                        </template>
                        <template x-if="!siswa.ortu?.dokumen_ktp_ayah">
                            <span class="text-gray-500">-</span>
                        </template>
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="space-y-3">
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Nama Ibu</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.ortu.nama_ibu || '-'"
                        ></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Pekerjaan Ibu</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.ortu.pekerjaan_ibu || '-'"
                        ></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Tanggal Lahir</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="formatTanggal(siswa.ortu.tanggal_lahir_ibu) || '-'"
                        ></span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-32 font-semibold text-gray-500"
                            >KTP Ibu</span
                        >
                        <template x-if="siswa.ortu?.dokumen_ktp_ibu">
                            <a
                                :href="`/ortu/${siswa.ortu.id}/dokumen/ktp_ibu`"
                                target="_blank"
                                class="text-blue-600 hover:underline"
                            >
                                Lihat Dokumen
                            </a>
                        </template>
                        <template x-if="!siswa.ortu?.dokumen_ktp_ibu">
                            <span class="text-gray-500">-</span>
                        </template>
                    </div>
                </div>

                {{-- Info Kontak di bawah grid --}}
                <div
                    class="mt-4 pt-4 border-t border-gray-100 col-span-1 md:col-span-2"
                >
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >No. Telepon Ortu</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.ortu.nomor_telepon_ortu || '-'"
                        ></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bagian Data Orang Tua --}}
        <div class="py-5 border-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Data Orang Tua Wali
            </h3>
            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm"
            >
                {{-- Kolom Kiri --}}
                <div class="space-y-3">
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Nama Wali</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.ortu.nama_wali || '-'"
                        ></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Pekerjaan Wali</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.ortu.pekerjaan_wali || '-'"
                        ></span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >Tanggal Lahir</span
                        >
                        {{-- Memanggil fungsi formatTanggal yang sudah ada --}}
                        <span
                            class="text-gray-800"
                            x-text="formatTanggal(siswa.ortu.tanggal_lahir_wali) || '-'"
                        ></span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-32 font-semibold text-gray-500"
                            >KTP Wali</span
                        >
                        <template x-if="siswa.ortu?.dokumen_ktp_wali">
                            <a
                                :href="`/ortu/${siswa.ortu.id}/dokumen/ktp_wali`"
                                target="_blank"
                                class="text-blue-600 hover:underline"
                            >
                                Lihat Dokumen
                            </a>
                        </template>
                        <template x-if="!siswa.ortu?.dokumen_ktp_wali">
                            <span class="text-gray-500">-</span>
                        </template>
                    </div>
                </div>

                {{-- Info Kontak di bawah grid --}}
                <div
                    class="mt-4 pt-4 border-t border-gray-100 col-span-1 md:col-span-2"
                >
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >No. Telepon Wali</span
                        >
                        <span
                            class="text-gray-800"
                            x-text="siswa.ortu.nomor_telepon_wali || '-'"
                        ></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN DOKUMEN --}}
        <div class="pt-5 border-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Kelengkapan Dokumen
            </h3>
            <div
                class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center text-sm"
            >
                <a
                    :href="`/siswa/${siswa.id}/dokumen/akta`"
                    target="_blank"
                    class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition"
                >
                    <svg
                        class="w-8 h-8 mx-auto text-blue-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        ></path>
                    </svg>
                    <span class="mt-2 block font-medium text-gray-600"
                        >Akta</span
                    >
                </a>
                <a
                    :href="`/siswa/${siswa.id}/dokumen/ijazah`"
                    target="_blank"
                    class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition"
                >
                    <svg
                        class="w-8 h-8 mx-auto text-green-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        ></path>
                    </svg>
                    <span class="mt-2 block font-medium text-gray-600"
                        >Ijazah</span
                    >
                </a>
                <a
                    :href="`/siswa/${siswa.id}/dokumen/kk`"
                    target="_blank"
                    class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition"
                >
                    <svg
                        class="w-8 h-8 mx-auto text-yellow-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        ></path>
                    </svg>
                    <span class="mt-2 block font-medium text-gray-600">KK</span>
                </a>
                <a
                    :href="`/siswa/${siswa.id}/dokumen/rapor`"
                    target="_blank"
                    class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition"
                >
                    <svg
                        class="w-8 h-8 mx-auto text-red-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        ></path>
                    </svg>
                    <span class="mt-2 block font-medium text-gray-600"
                        >Rapor</span
                    >
                </a>
            </div>
        </div>

        {{-- BAGIAN FOOTER / TOMBOL TUTUP --}}
        <div class="mt-8 flex justify-end">
            <button
                @click="$dispatch('close')"
                class="px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md hover:bg-gray-300 transition"
            >
                Tutup
            </button>
        </div>
    </div>

    {{-- Tampilan Loading --}}
    <div x-show="loading" class="p-10 text-center">
        <p class="text-gray-500">Memuat data detail siswa...</p>
    </div>
</x-modal>

{{-- SCRIPT ALPINE.JS UNTUK MODAL INI --}}
@push('scripts')
<script>
    // Pastikan x-data="siswaDetailModal()" ada di file index.
    function siswaDetailModal() {
        return {
            loading: false,
            siswa: null,
            getSiswaDetails(id) {
                this.loading = true;
                this.siswa = null;

                this.$dispatch("open-modal", "detail-siswa");

                fetch(`/siswa/detail/${id}`)
                    .then((response) => response.json())
                    .then((data) => {
                        this.siswa = data;
                    })
                    .catch((error) => {
                        console.error("Error fetching siswa details:", error);
                        alert("Gagal memuat data siswa.");
                        this.$dispatch("close");
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            // [BARU] Tambahkan fungsi helper ini
            formatTanggal(tanggal) {
                if (!tanggal) return ""; // Kembalikan string kosong jika tanggal tidak ada

                const options = {
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                };
                return new Date(tanggal).toLocaleDateString("id-ID", options);
            },
        };
    }
</script>
@endpush
