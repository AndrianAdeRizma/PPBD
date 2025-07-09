<div class="container mx-auto max-w-4xl py-12 px-4">
    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-lg">
        <button
            onclick="window.location.href = '/'"
            class="bg-blue-200 hover:bg-blue-300 text-blue-800 p-3 rounded-full inline-flex items-center justify-center"
        >
            <svg
                class="w-6 h-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 19.5L8.25 12l7.5-7.5"
                />
            </svg>
        </button>
        <div
            class="flex justify-between items-center w-full max-w-xl mx-auto mb-6"
        >
            {{-- Step 1 --}}
            <div class="flex flex-col items-center flex-1 min-w-[100px]">
                <div
                    class="w-8 h-8 rounded-full flex items-center justify-center
        {{
                        $step === 1
                            ? 'bg-blue-600 text-white'
                            : 'bg-gray-300 text-gray-600'
                    }}"
                >
                    1
                </div>
                <span
                    class="mt-2 text-sm font-semibold text-center whitespace-nowrap"
                >
                    Data Siswa
                </span>
            </div>

            {{-- Line --}}
            <div class="w-full border-t-2 mx-4 mb-5 border-gray-300"></div>

            {{-- Step 2 --}}
            <div class="flex flex-col items-center flex-1 min-w-[100px]">
                <div
                    class="w-8 h-8 rounded-full flex items-center justify-center
        {{
                        $step === 2
                            ? 'bg-blue-600 text-white'
                            : 'bg-gray-300 text-gray-600'
                    }}"
                >
                    2
                </div>
                <span
                    class="mt-2 text-sm font-semibold text-center whitespace-nowrap"
                >
                    Data Ortu & Wali
                </span>
            </div>
        </div>

        <div class="text-center mb-5">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                Formulir Pendaftaran Siswa Baru
            </h1>
            <p class="text-gray-500 mt-2">
                Pastikan semua data diisi dengan benar.
            </p>
        </div>
        @if (session()->has('message'))
        <div class="p-4 bg-green-100 text-green-800 rounded mb-4">
            {{ session("message") }}
        </div>
        @endif @if ($step === 1)
        <h2 class="text-xl font-bold mb-4">Data Siswa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.input
                label="Nama Lengkap"
                name="nama_lengkap"
                wire:model.defer="nama_lengkap"
                required
                placeholder="Isi Nama Lengkap Siswa"
            />
            <x-form.input
                label="NISN"
                name="nisn"
                wire:model.defer="nisn"
                required
                placeholder="Isi NISN Siswa"
            />
            <x-form.select
                name="jenis_kelamin"
                label="Jenis Kelamin"
                :options="['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']"
                wire:model.defer="jenis_kelamin"
                required
            />
            <x-form.input
                label="Tempat Lahir"
                name="tempat_lahir"
                wire:model.defer="tempat_lahir"
                required
                placeholder="Isi Tempat Lahir Siswa"
            />
            <x-form.input
                label="Tanggal Lahir"
                name="tanggal_lahir"
                type="date"
                wire:model.defer="tanggal_lahir"
                required
                placeholder="Isi Tanggal Lahir Siswa"
            />
            <x-form.select
                name="agama"
                label="Agama"
                :options="[
                            'Islam' => 'Islam',
                            'Kristen' => 'Kristen',
                            'Katolik' => 'Katolik',
                            'Hindu' => 'Hindu',
                            'Buddha' => 'Buddha',
                            'Konghucu' => 'Konghucu',
                        ]"
                wire:model.defer="agama"
                required
            />

            <x-form.input
                label="Nomor Telepon Siswa"
                name="nomor_telepon"
                wire:model.defer="nomor_telepon"
                required
                placeholder="Isi Nomor Telepon Siswa"
            />
            <x-form.input
                label="Asal Sekolah"
                name="asal_sekolah"
                wire:model.defer="asal_sekolah"
                required
                placeholder="Isi Asal Sekolah Siswa"
            />
            <x-form.textarea
                label="Alamat"
                name="alamat"
                wire:model.defer="alamat"
                required
                placeholder="Isi Alamat Siswa"
            />
            <div class="flex flex-col space-y-2">
                <x-form.input
                    label="Foto Siswa"
                    name="foto_siswa"
                    type="file"
                    wire:model="foto_siswa"
                    required
                    placeholder="Isi Foto Siswa"
                />
                <x-form.preview-upload
                    :file="$foto_siswa"
                    label="Preview Foto Siswa"
                />
            </div>

            <div class="flex flex-col space-y-2">
                <x-form.input
                    label="Akta Kelahiran"
                    name="dokumen_akta"
                    type="file"
                    wire:model="dokumen_akta"
                    required
                    accept="application/pdf"
                />
                <x-form.preview-upload
                    :file="$dokumen_akta"
                    label="Preview Akta Kelahiran"
                />
            </div>

            <div class="flex flex-col space-y-2">
                <x-form.input
                    label="Ijazah"
                    name="dokumen_ijazah"
                    type="file"
                    wire:model="dokumen_ijazah"
                    required
                    accept="application/pdf"
                />
                <x-form.preview-upload
                    :file="$dokumen_ijazah"
                    label="Preview Ijazah"
                />
            </div>

            <div class="flex flex-col space-y-2">
                <x-form.input
                    label="Kartu Keluarga"
                    name="dokumen_kk"
                    type="file"
                    wire:model="dokumen_kk"
                    required
                    accept="application/pdf"
                />
                <x-form.preview-upload
                    :file="$dokumen_kk"
                    label="Preview Kartu Keluarga"
                />
            </div>

            <div class="flex flex-col space-y-2">
                <x-form.input
                    label="Rapor"
                    name="dokumen_rapor"
                    type="file"
                    wire:model="dokumen_rapor"
                    required
                    accept="application/pdf"
                />
                <x-form.preview-upload
                    :file="$dokumen_rapor"
                    label="Preview Nilai Rapor"
                />
            </div>
        </div>

        <div class="mt-6 flex justify-center border-t-2 border-gray-200">
            <button
                wire:click="nextStep"
                wire:loading.attr="disabled"
                wire:target="nextStep"
                class="px-6 py-2 mt-5 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center gap-2"
            >
                <svg
                    wire:loading
                    wire:target="nextStep"
                    class="animate-spin h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    ></circle>
                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8v8z"
                    ></path>
                </svg>
                Selanjutnya
            </button>
        </div>

        @elseif ($step === 2)
        <h2 class="text-xl font-bold mb-4">Data Orang Tua</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.input
                label="Nama Ayah"
                name="nama_ayah"
                wire:model.defer="nama_ayah"
                required
                placeholder="Isi Nama Ayah"
            />
            <x-form.input
                label="Tanggal Lahir Ayah"
                name="tanggal_lahir_ayah"
                type="date"
                wire:model.defer="tanggal_lahir_ayah"
                required
                placeholder="Isi Tanggal Lahir Ayah"
            />
            <x-form.input
                label="Pekerjaan Ayah"
                name="pekerjaan_ayah"
                wire:model.defer="pekerjaan_ayah"
                required
                placeholder="Isi Pekerjaan Ayah"
            />
            <x-form.input
                label="KTP Ayah"
                name="dokumen_ktp_ayah"
                type="file"
                wire:model="dokumen_ktp_ayah"
            />

            <x-form.input
                label="Nama Ibu"
                name="nama_ibu"
                wire:model.defer="nama_ibu"
                required
                placeholder="Isi Nama Ibu"
            />
            <x-form.input
                label="Tanggal Lahir Ibu"
                name="tanggal_lahir_ibu"
                type="date"
                wire:model.defer="tanggal_lahir_ibu"
                required
                placeholder="Isi Tanggal Lahir Ibu"
            />
            <x-form.input
                label="Pekerjaan Ibu"
                name="pekerjaan_ibu"
                wire:model.defer="pekerjaan_ibu"
                required
                placeholder="Isi Pekerjaan Ibu"
            />
            <x-form.input
                label="KTP Ibu"
                name="dokumen_ktp_ibu"
                type="file"
                wire:model="dokumen_ktp_ibu"
            />

            <x-form.input
                label="Nomor Telepon Orang Tua"
                name="nomor_telepon_ortu"
                wire:model.defer="nomor_telepon_ortu"
                required
                placeholder="Isi Nomor Telepon Orang Tua"
            />
        </div>

        <hr class="my-8" />

        <h2 class="text-xl font-semibold text-gray-700 mb-4">
            Data Wali (Opsional)
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.input
                label="Nama Wali"
                name="nama_wali"
                wire:model.defer="nama_wali"
                placeholder="Isi Nama Wali"
            />
            <x-form.input
                label="Tanggal Lahir Wali"
                name="tanggal_lahir_wali"
                type="date"
                wire:model.defer="tanggal_lahir_wali"
                placeholder="Isi Tanggal Lahir Wali"
            />
            <x-form.input
                label="Pekerjaan Wali"
                name="pekerjaan_wali"
                wire:model.defer="pekerjaan_wali"
                placeholder="Isi Pekerjaan Wali"
            />
            <x-form.input
                label="Nomor Telepon Wali"
                name="nomor_telepon_wali"
                wire:model.defer="nomor_telepon_wali"
                placeholder="Isi Nomor Telepon Wali"
            />
            <x-form.input
                label="KTP Wali"
                name="dokumen_ktp_wali"
                type="file"
                wire:model="dokumen_ktp_wali"
            />
        </div>

        <div class="mt-6 flex justify-between">
            <button
                wire:click="previousStep"
                class="px-6 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400"
            >
                Kembali
            </button>
            <button
                wire:click="submit"
                wire:loading.attr="disabled"
                wire:target="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center gap-2"
            >
                <svg
                    wire:loading
                    wire:target="nextStep"
                    class="animate-spin h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    ></circle>
                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8v8z"
                    ></path>
                </svg>
                Simpan
            </button>
        </div>
        @endif
    </div>
</div>
