<x-app-layout>
    @push('styles')

    <style>
        table.dataTable thead th {
            white-space: nowrap;
        }
        /* Gaya dasar untuk tombol */
        .dt-buttons .dt-button {
            background-color: #1f2937; /* bg-gray-800 */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem; /* rounded-md */
            border: none;
            margin-right: 0.5rem;
            transition: background-color 0.2s; /* Transisi untuk efek hover yang mulus */
        }

        /* [BARU] Efek hover pada tombol */
        .dt-buttons .dt-button:hover {
            background-color: #374151; /* bg-gray-700 */
        }
    </style>
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __("Data Siswa") }}
        </h2>
    </x-slot>

    <div
        x-data="siswaDetailModal()"
        class="container w-full mx-auto px-4 sm:px-6 lg:px-8"
    >
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="overflow-x-auto">
                        <table
                            id="table"
                            class="min-w-full text-sm text-left text-gray-700"
                        >
                            <thead
                                class="bg-gray-100 text-xs uppercase text-gray-600"
                            >
                                <tr>
                                    <th class="px-4 py-3">No</th>
                                    <th class="px-4 py-3">Foto</th>
                                    <th class="px-4 py-3">Nomor Pendaftaran</th>
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">NISN</th>
                                    <th class="px-4 py-3">Jenis Kelamin</th>
                                    <!--
                                    <th class="px-4 py-3">TTL</th>
                                    <th class="px-4 py-3">Agama</th>
                                    <th class="px-4 py-3">Alamat</th>
                                    <th class="px-4 py-3">No. Telepon</th>
                                    <th class="px-4 py-3">Asal Sekolah</th> -->
                                    <th class="px-4 py-3">Akta</th>
                                    <th class="px-4 py-3">Ijazah</th>
                                    <th class="px-4 py-3">KK</th>
                                    <th class="px-4 py-3">Rapor</th>
                                    <th class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($calonSiswa as $index => $siswa)
                                <tr>
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">
                                        @if ($siswa->foto_siswa)
                                        <img
                                            src="{{ route('foto.siswa', ['filename' => basename($siswa->foto_siswa)]) }}"
                                            alt="Foto"
                                            class="w-14 h-14 rounded-md object-cover"
                                        />
                                        @else
                                        <span class="text-gray-400 italic"
                                            >N/A</span
                                        >
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $siswa->nomor_pendaftaran }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $siswa->nama_lengkap }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $siswa->nisn }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $siswa->jenis_kelamin }}
                                    </td>
                                    <!-- <td class="px-4 py-2">
                                        {{ $siswa->tempat_lahir }},
                                        {{ $siswa->tanggal_lahir }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $siswa->agama }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $siswa->alamat }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $siswa->nomor_telepon }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $siswa->asal_sekolah }}
                                    </td> -->
                                    <td class="px-4 py-2">
                                        @if ($siswa->dokumen_akta)
                                        <a
                                            href="{{ route('dokumen.siswa.unduh', ['siswa' => $siswa->id, 'jenis' => 'akta']) }}"
                                            target="_blank"
                                        >
                                            <span
                                                class="bg-violet-500 text-white px-2 py-1 rounded-lg font-medium"
                                            >
                                                Akta
                                            </span>
                                        </a>
                                        @else
                                        <span class="text-gray-400 italic">
                                            N/A
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($siswa->dokumen_ijazah)
                                        <a
                                            href="{{ route('dokumen.siswa.unduh', ['siswa' => $siswa->id, 'jenis' => 'ijazah']) }}"
                                            target="_blank"
                                        >
                                            <span
                                                class="bg-violet-500 text-white px-2 py-1 rounded-lg font-medium"
                                            >
                                                Akta
                                            </span>
                                        </a>
                                        @else
                                        <span class="text-gray-400 italic">
                                            N/A
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($siswa->dokumen_kk)
                                        <a
                                            href="{{ route('dokumen.siswa.unduh', ['siswa' => $siswa->id, 'jenis' => 'kk']) }}"
                                            target="_blank"
                                        >
                                            <span
                                                class="bg-violet-500 text-white px-2 py-1 rounded-lg font-medium"
                                            >
                                                Akta
                                            </span>
                                        </a>
                                        @else
                                        <span class="text-gray-400 italic">
                                            N/A
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($siswa->dokumen_rapor)
                                        <a
                                            href="{{ route('dokumen.siswa.unduh', ['siswa' => $siswa->id, 'jenis' => 'rapor']) }}"
                                            target="_blank"
                                        >
                                            <span
                                                class="bg-violet-500 text-white px-2 py-1 rounded-lg font-medium"
                                            >
                                                Akta
                                            </span>
                                        </a>
                                        @else
                                        <span class="text-gray-400 italic">
                                            N/A
                                        </span>
                                        @endif
                                    </td>
                                    <td
                                        width="65%"
                                        class="px-4 py-4 my-2 text-center flex items-center0"
                                    >
                                        <div
                                            class="flex justify-center items-center space-x-2"
                                        >
                                            {{-- INI TOMBOL PEMICU MODAL --}}
                                            <button
                                                @click="getSiswaDetails({{ $siswa->id }})"
                                                class="px-2 py-2 rounded-md text-white bg-green-600 hover:bg-green-800"
                                                title="Detail"
                                            >
                                                <svg
                                                    class="h-5 w-5"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                                    />
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                            <!-- <a
                                                href="{{ route('siswa.edit', $siswa->id) }}"
                                                class="px-2 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-800"
                                                title="Edit"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                                                    />
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </a> -->

                                            <form
                                                action="{{ route('siswa.delete', $siswa->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus siswa ini?')"
                                            >
                                                @csrf @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="px-2 py-2 rounded-md text-white bg-red-600 hover:bg-red-800"
                                                    title="Hapus"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td
                                        colspan="13"
                                        class="px-4 py-4 text-center text-gray-500"
                                    >
                                        Tidak ada data siswa.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Panggil file partial modal di sini --}}
        @include('siswa._detail-modal')
    </div>

    @push('scripts')
    <script>
        // [PERBAIKAN] Menggunakan $(document).ready() dari jQuery agar lebih konsisten
        $(document).ready(function () {
            $("#table").DataTable({
                responsive: true,
                autoWidth: false,
                dom: '<"dt-buttons-container"B>rfrtip',
                buttons: [
                    {
                        extend: "excel",
                        text: '<i class="fa-solid fa-file-excel mr-1"></i> Excel',
                        className:
                            "inline-flex items-center px-2 py-1.5 mb-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md shadow",
                    },
                    {
                        extend: "pdf",
                        text: '<i class="fa-solid fa-file-pdf mr-1"></i> PDF',
                        className:
                            "inline-flex mx-1 items-center px-2 py-1.5 mb-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md shadow",
                    },
                    {
                        extend: "print",
                        text: '<i class="fa-solid fa-print mr-1"></i> Print',
                        className:
                            "inline-flex items-center px-2 py-1.5 mb-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow",
                    },
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    ["10", "25", "50", "Semua"],
                ],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "→",
                        previous: "←",
                    },
                    zeroRecords: "Tidak ada data yang ditemukan",
                },
                initComplete: function (settings, json) {
                    console.log(
                        "Tabel selesai dimuat, menjalankan skrip hapus kelas..."
                    );

                    // Cari semua elemen yang memiliki kelas .dt-button di dalam kontainer .dt-buttons
                    const buttons = document.querySelectorAll(
                        ".dt-buttons .dt-button"
                    );

                    // Lakukan loop dan hapus kelas 'dt-button' dari setiap tombol
                    buttons.forEach(function (button) {
                        button.classList.remove("dt-button");
                    });

                    console.log(
                        `Berhasil menghapus kelas 'dt-button' dari ${buttons.length} tombol.`
                    );
                },
            });
        });
    </script>
    @endpush
</x-app-layout>
