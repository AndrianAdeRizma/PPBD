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
                @if (session('success'))
                <div
                    class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700"
                    role="alert"
                >
                    {{ session("success") }}
                </div>
                @endif
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
                                    <th class="px-4 py-3">Akta</th>
                                    <th class="px-4 py-3">Ijazah</th>
                                    <th class="px-4 py-3">Kartu Keluarga</th>
                                    <th class="px-4 py-3">NIlai Rapor</th>
                                    <th class="px-6 py-3">Status Verifikasi</th>
                                    <th
                                        class="px-6 py-3 flex items-center justify-center"
                                    >
                                        Aksi
                                    </th>
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
                                            class="w-12 h-12 rounded-md object-cover"
                                        />
                                        @else
                                        <span class="text-gray-400 italic"
                                            >N/A</span
                                        >
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <button
                                            @click="getSiswaDetails({{ $siswa->id }})"
                                            class="text-left rounded-md text-green-600 hover:text-green-800"
                                        >
                                            {{ $siswa->nomor_pendaftaran }}
                                        </button>
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

                                    <td class="px-4 py-2">
                                        @if ($siswa->dokumen_akta)
                                        <a
                                            href="{{ route('dokumen.siswa.unduh', ['siswa' => $siswa->id, 'jenis' => 'akta']) }}"
                                            target="_blank"
                                        >
                                            <span
                                                class="bg-violet-500 text-xs text-white px-2 py-1 rounded-lg font-medium"
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
                                                class="bg-violet-500 text-xs text-white px-2 py-1 rounded-lg font-medium"
                                            >
                                                Ijazah
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
                                                class="bg-violet-500 text-xs text-white px-2 py-1 rounded-lg font-medium"
                                            >
                                                Kartu Keluarga
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
                                                class="bg-violet-500 text-xs text-white px-2 py-1 rounded-lg font-medium"
                                            >
                                                Nilai Rapor
                                            </span>
                                        </a>
                                        @else
                                        <span class="text-gray-400 italic">
                                            N/A
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($siswa->status_pendaftaran ==
                                        'ditolak')
                                        <span
                                            class="px-3 py-1 text-sm font-semibold leading-tight text-red-700 bg-red-100 rounded-full"
                                        >
                                            {{ ucfirst($siswa->status_pendaftaran) }}
                                        </span>
                                        @elseif ($siswa->status_pendaftaran ==
                                        'diverifikasi')
                                        <span
                                            class="px-3 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full"
                                        >
                                            {{ ucfirst($siswa->status_pendaftaran) }}
                                        </span>
                                        @else
                                        <span
                                            class="px-3 py-1 text-sm font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full"
                                        >
                                            {{ ucfirst($siswa->status_pendaftaran) }}
                                        </span>
                                        @endif
                                    </td>
                                    <td
                                        width="100%"
                                        class="text-center flex items-center"
                                    >
                                        {{-- Tampilkan tombol hanya jika statusnya masih 'menunggu_verifikasi' --}}
                                        @if ($siswa->status_pendaftaran ==
                                        'pending')
                                        <div class="flex items-center gap-x-2">
                                            <form
                                                action="{{ route('siswa.verifikasi', $siswa->id) }}"
                                                method="POST"
                                            >
                                                @csrf @method('PATCH')
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-x-2 text-xs rounded-md bg-green-600 px-2 py-2 text-white shadow-sm hover:bg-green-500"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                        class="h-5 w-5"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.052-.143Z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                    <span>Verifikasi</span>
                                                </button>
                                            </form>

                                            <form
                                                action="{{ route('siswa.tolak', $siswa->id) }}"
                                                method="POST"
                                            >
                                                @csrf @method('PATCH')
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-x-2 text-xs rounded-md bg-red-600 px-2 py-2 text-white shadow-sm hover:bg-red-500"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                        class="h-5 w-5"
                                                    >
                                                        <path
                                                            d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z"
                                                        />
                                                    </svg>
                                                    <span>Tolak</span>
                                                </button>
                                            </form>
                                        </div>
                                        @else
                                        <p class="mt-4 text-sm text-gray-600">
                                            Status pendaftaran siswa ini sudah
                                            diproses:
                                            <span
                                                class="font-bold"
                                                >{{ ucwords(str_replace('_', ' ', $siswa->status_pendaftaran)) }}</span
                                            >
                                        </p>
                                        @endif
                                        <div
                                            class="flex justify-center items-center space-x-2"
                                        >
                                            {{-- INI TOMBOL PEMICU MODAL --}}
                                            <!-- <button
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
                                            </button> -->
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

                                            <!-- <form
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
                                            </form> -->
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
