<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __("Pembayaran") }}
        </h2>
    </x-slot>

    <div class="container w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-10">
            <div class="sm:px-6 lg:px-8">
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
                                    <th class="px-4 py-3">
                                        Nama Pemilik Rekening
                                    </th>
                                    <th class="px-4 py-3">Nomor Rekening</th>
                                    <th class="px-4 py-3">Nama Bank</th>
                                    <th class="px-4 py-3">Jumlah Bayar</th>
                                    <th class="px-6 py-3">Bukti Bayar</th>
                                    <th class="px-4 py-3">
                                        Tanggal Pembayaran
                                    </th>
                                    <th class="px-6 py-3">Status Pembayaran</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pembayaran as $index => $row)
                                <tr>
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">
                                        @if ($row->calonSiswa->foto_siswa)
                                        <img
                                            src="{{ route('foto.siswa', ['filename' => basename($row->calonSiswa->foto_siswa)]) }}"
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
                                        {{ $row->calonSiswa->nomor_pendaftaran }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $row->calonSiswa->nama_lengkap }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $row->calonSiswa->nisn }}
                                    </td>
                                    <td>{{ $row->nama_pemilik_rekening }}</td>
                                    <td class="px-4 py-2">
                                        {{ $row->nomor_rekening }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $row->bank }}
                                    </td>
                                    <td class="px-4 py-2">
                                        Rp
                                        {{ number_format($row->jumlah_bayar, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ \Carbon\Carbon::parse($row->tanggal_pembayaran)->isoFormat('dddd, D MMMM Y') }}
                                    </td>
                                    <td class="px-4 py-2">
                                        @if (!empty($row->bukti_pembayaran))
                                        <a
                                            href="{{ route('pembayaran.bukti', ['filename' => basename($row->bukti_pembayaran)]) }}"
                                            target="_blank"
                                        >
                                            <span
                                                class="bg-violet-500 text-xs text-white px-2 py-1 rounded-lg font-medium"
                                            >
                                                Bukti Bayar
                                            </span>
                                        </a>
                                        @else
                                        <span class="text-gray-400 italic">
                                            N/A
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($row->status_pembayaran ==
                                        'diverifikasi')
                                        <span
                                            class="px-2 py-1 text-xs font-semibold leading-tight text-green-700 bg-green-100 rounded-full"
                                        >
                                            {{ ucfirst($row->status_pembayaran) }}
                                        </span>
                                        @elseif ($row->status_pembayaran ==
                                        'pending')
                                        <span
                                            class="px-2 py-1 text-xs font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full"
                                        >
                                            {{ ucfirst($row->status_pembayaran) }}
                                        </span>
                                        @elseif ($row->status_pembayaran ==
                                        'ditolak')
                                        <span
                                            class="px-2 py-1 text-xs font-semibold leading-tight text-red-700 bg-red-100 rounded-full"
                                        >
                                            {{ ucfirst($row->status_pembayaran) }}
                                        </span>
                                        @else
                                        <span
                                            class="px-2 py-1 text-xs font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full"
                                        >
                                            {{ ucfirst($row->status) }}
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->status_pembayaran ==
                                        'pending')
                                        <div class="flex items-center gap-x-4">
                                            <form
                                                action="{{ route('pembayaran.verifikasi', $row->id) }}"
                                                method="POST"
                                                id="form-verifikasi-pembayaran-{{ $row->id }}"
                                            >
                                                @csrf @method('PATCH')
                                                <button
                                                    type="button"
                                                    onclick="confirmVerifikasiPembayaran({{ $row->id }}, '{{ $row->calonSiswa->nama_lengkap ?? 'Siswa' }}')"
                                                    class="inline-flex items-center gap-x-2 rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500"
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
                                                action="{{ route('pembayaran.tolak', $row->id) }}"
                                                method="POST"
                                                id="form-tolak-pembayaran-{{ $row->id }}"
                                            >
                                                @csrf @method('PATCH')
                                                <button
                                                    type="button"
                                                    onclick="confirmTolakPembayaran({{ $row->id }}, '{{ $row->calonSiswa->nama_lengkap ?? 'Siswa' }}')"
                                                    class="inline-flex items-center gap-x-2 rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500"
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
                                            Status pembayaran ini sudah
                                            diproses:
                                            <span
                                                class="font-bold"
                                                >{{ ucfirst($row->status_pembayaran) }}</span
                                            >
                                        </p>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td
                                        colspan="13"
                                        class="px-4 py-4 text-center text-gray-500"
                                    >
                                        Tidak ada data pembayaran.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts') @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmVerifikasiPembayaran(id, nama) {
            Swal.fire({
                title: "Verifikasi Pembayaran?",
                text: `Apakah Anda yakin ingin memverifikasi pembayaran dari siswa: ${nama}?`,
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#16a34a",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Verifikasi!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    document
                        .getElementById("form-verifikasi-pembayaran-" + id)
                        .submit();
                }
            });
        }

        function confirmTolakPembayaran(id, nama) {
            Swal.fire({
                title: "Tolak Pembayaran?",
                text: `Apakah Anda yakin ingin menolak pembayaran dari siswa: ${nama}?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc2626",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Ya, Tolak!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    document
                        .getElementById("form-tolak-pembayaran-" + id)
                        .submit();
                }
            });
        }
    </script>
    @endpush

    <script>
        // [PERBAIKAN] Menggunakan $(document).ready() dari jQuery agar lebih konsisten
        $(document).ready(function () {
            $("#table").DataTable({
                responsive: true,
                autoWidth: false,
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
