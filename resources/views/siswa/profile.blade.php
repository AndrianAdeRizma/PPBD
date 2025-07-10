<x-app-layout>
    <div
        class="max-w-4xl h-full my-10 rounded-xl shadow-lg mx-auto sm:px-6 lg:px-8 bg-white flex flex-col"
    >
        <div class="p-6">
            {{-- HEADER KARTU --}}
            <div class="flex items-center pb-4 border-b border-gray-200">
                @if ($siswa->foto_siswa)
                <img
                    src="{{ route('foto.siswa', ['filename' => basename($siswa->foto_siswa)]) }}"
                    alt="Foto Siswa"
                    class="w-20 h-20 rounded-full object-cover mr-6 border-2 border-gray-300 shadow-sm"
                />
                @else
                <div
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
                @endif

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $siswa->nama_lengkap }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        No. Pendaftaran: {{ $siswa->nomor_pendaftaran }}
                    </p>
                </div>
            </div>

            {{-- BIODATA SISWA --}}
            <div class="py-5">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Biodata Siswa
                </h3>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm"
                >
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >NISN</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->nisn ?? '-' }}</span
                            >
                        </div>
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Jenis Kelamin</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->jenis_kelamin ?? '-' }}</span
                            >
                        </div>
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Tempat, Tgl Lahir</span
                            ><span class="text-gray-800"
                                >{{ $siswa->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</span
                            >
                        </div>
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Agama</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->agama ?? '-' }}</span
                            >
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Asal Sekolah</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->asal_sekolah ?? '-' }}</span
                            >
                        </div>
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >No. Telepon</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->nomor_telepon ?? '-' }}</span
                            >
                        </div>
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Alamat</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->alamat ?? '-' }}</span
                            >
                        </div>
                    </div>
                </div>
            </div>

            {{-- DATA ORANG TUA --}}
            <div class="py-5 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Data Orang Tua
                </h3>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm"
                >
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Nama Ayah</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->ortu->nama_ayah ?? '-' }}</span
                            >
                        </div>
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Pekerjaan Ayah</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->ortu->pekerjaan_ayah ?? '-' }}</span
                            >
                        </div>
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Tanggal Lahir</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->ortu->tanggal_lahir_ayah ? \Carbon\Carbon::parse($siswa->ortu->tanggal_lahir_ayah)->translatedFormat('d F Y') : '-' }}</span
                            >
                        </div>
                        <div class="flex items-center">
                            <span class="w-32 font-semibold text-gray-500"
                                >KTP Ayah</span
                            >
                            @if ($siswa->ortu->dokumen_ktp_ayah)
                            <a
                                href="{{ route('dokumen.ortu.unduh', ['ortu' => $siswa->ortu->id, 'jenis' => 'ktp_ayah']) }}"
                                target="_blank"
                                class="text-blue-600 hover:underline"
                                >Lihat Dokumen</a
                            >
                            @else
                            <span class="text-gray-500">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Nama Ibu</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->ortu->nama_ibu ?? '-' }}</span
                            >
                        </div>
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Pekerjaan Ibu</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->ortu->pekerjaan_ibu ?? '-' }}</span
                            >
                        </div>
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Tanggal Lahir</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->ortu->tanggal_lahir_ibu ? \Carbon\Carbon::parse($siswa->ortu->tanggal_lahir_ibu)->translatedFormat('d F Y') : '-' }}</span
                            >
                        </div>
                        <div class="flex items-center">
                            <span class="w-32 font-semibold text-gray-500"
                                >KTP Ibu</span
                            >
                            @if ($siswa->ortu->dokumen_ktp_ibu)
                            <a
                                href="{{ route('dokumen.ortu.unduh', ['ortu' => $siswa->ortu->id, 'jenis' => 'ktp_ibu']) }}"
                                target="_blank"
                                class="text-blue-600 hover:underline"
                                >Lihat Dokumen</a
                            >
                            @else
                            <span class="text-gray-500">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex">
                        <span class="w-32 font-semibold text-gray-500"
                            >No. Telepon Ortu</span
                        ><span
                            class="text-gray-800"
                            >{{ $siswa->ortu->nomor_telepon_ortu ?? '-' }}</span
                        >
                    </div>
                </div>
            </div>

            {{-- DATA WALI --}}
            <div class="py-5 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Data Wali
                </h3>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm"
                >
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Nama Wali</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->ortu->nama_wali ?? '-' }}</span
                            >
                        </div>
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Pekerjaan Wali</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->ortu->pekerjaan_wali ?? '-' }}</span
                            >
                        </div>
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >Tanggal Lahir</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->ortu->tanggal_lahir_wali ? \Carbon\Carbon::parse($siswa->ortu->tanggal_lahir_wali)->translatedFormat('d F Y') : '-' }}</span
                            >
                        </div>
                        <div class="flex items-center">
                            <span class="w-32 font-semibold text-gray-500"
                                >KTP Wali</span
                            >
                            @if ($siswa->ortu->dokumen_ktp_wali)
                            <a
                                href="{{ route('dokumen.ortu.unduh', ['ortu' => $siswa->ortu->id, 'jenis' => 'ktp_wali']) }}"
                                target="_blank"
                                class="text-blue-600 hover:underline"
                                >Lihat Dokumen</a
                            >
                            @else
                            <span class="text-gray-500">-</span>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 col-span-2">
                        <div class="flex">
                            <span class="w-32 font-semibold text-gray-500"
                                >No. Telepon Wali</span
                            ><span
                                class="text-gray-800"
                                >{{ $siswa->ortu->nomor_telepon_wali ?? '-' }}</span
                            >
                        </div>
                    </div>
                </div>
            </div>

            {{-- DOKUMEN SISWA --}}
            <div class="pt-5 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Kelengkapan Dokumen
                </h3>
                <div
                    class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center text-sm"
                >
                    @foreach(['akta', 'ijazah', 'kk', 'rapor'] as $jenis)
                    <a
                        href="{{ route('dokumen.siswa.unduh', ['siswa' => $siswa->id, 'jenis' => $jenis]) }}"
                        target="_blank"
                        class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition"
                    >
                        <svg
                            class="w-8 h-8 mx-auto @if($jenis == 'akta') text-blue-500 @elseif($jenis == 'ijazah') text-green-500 @elseif($jenis == 'kk') text-yellow-500 @elseif($jenis == 'rapor') text-red-500 @endif"
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
                            />
                        </svg>
                        <span class="mt-2 block font-medium text-gray-600">{{
                            ucfirst($jenis)
                        }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
