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

        /* Efek hover pada tombol */
        .dt-buttons .dt-button:hover {
            background-color: #374151; /* bg-gray-700 */
        }
    </style>
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __("Data Nilai Calon Siswa") }}
        </h2>
    </x-slot>

    <div
        x-data="nilaiTesModalLogic()"
        class="container w-full mx-auto px-4 sm:px-6 lg:px-8"
    >
        <div class="py-10">
            <div class="sm:px-6 lg:px-8">
                {{-- Pesan Sukses dari Laravel Session --}}
                @if (session('success'))
                <div
                    class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700"
                    role="alert"
                >
                    {{ session("success") }}
                </div>
                @endif
                {{-- Pesan Error Umum dari Laravel Session (jika ada) --}}
                @if (session('error'))
                <div
                    class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700"
                    role="alert"
                >
                    {{ session("error") }}
                </div>
                @endif
                {{-- Pesan Warning dari Laravel Session (jika ada) --}}
                @if (session('warning'))
                <div
                    class="mb-4 rounded-lg bg-yellow-100 p-4 text-sm text-yellow-700"
                    role="alert"
                >
                    {{ session("warning") }}
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
                                    <th class="px-6 py-3">Berkas</th>
                                    <th class="px-6 py-3">Pembayaran</th>
                                    <th class="px-6 py-3">Total Nilai</th>
                                    <th class="px-6 py-3">Keterangan</th>
                                    <th class="px-6 py-3">Aksi Kelulusan</th>
                                    {{-- NEW COLUMN HEADER --}}
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($calonSiswa as $index => $siswa)
                                <tr id="calon-siswa-row-{{ $siswa->id }}">
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
                                        {{ $siswa->nomor_pendaftaran }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $siswa->nama_lengkap }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $siswa->nisn }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="px-3 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full"
                                        >
                                            {{ ucfirst($siswa->status_pendaftaran) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="px-3 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full"
                                        >
                                            {{ ucfirst($siswa->pembayaran->status_pembayaran) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <button
                                            @click="openModal(
                                                {{ $siswa->id }},
                                                '{{ $siswa->nama_lengkap }}',
                                                '{{ old('jumlah_nilai', $siswa->nilai->jumlah_nilai ?? '') }}',
                                                '{{ old('keterangan', $siswa->nilai->keterangan ?? '') }}',
                                                '{{ old('nilai_tes_id', $siswa->nilai->id ?? '') }}'
                                            )"
                                            class="text-left text-purple-600 hover:text-purple-800 font-medium inline-block w-full"
                                            id="jumlah-nilai-btn-{{ $siswa->id }}"
                                            data-calon-siswa-id="{{ $siswa->id }}"
                                            data-nilai-tes="{{ $siswa->nilai->jumlah_nilai ?? '' }}"
                                            data-keterangan-tes="{{ $siswa->nilai->keterangan ?? '' }}"
                                            data-nilai-tes-id="{{ $siswa->nilai->id ?? '' }}"
                                        >
                                            <span
                                                id="display-jumlah-nilai-{{ $siswa->id }}"
                                            >
                                                @if($siswa->nilai)
                                                {{ $siswa->nilai->jumlah_nilai }}
                                                @else
                                                <span
                                                    class="text-gray-500 px-2 py-1 rounded-lg bg-blue-200"
                                                    >Input Nilai</span
                                                >
                                                @endif
                                            </span>
                                        </button>
                                    </td>
                                    <td class="px-4 py-2">
                                        <button
                                            @click="openModal(
                                                {{ $siswa->id }},
                                                '{{ $siswa->nama_lengkap }}',
                                                '{{ old('jumlah_nilai', $siswa->nilai->jumlah_nilai ?? '') }}',
                                                '{{ old('keterangan', $siswa->nilai->keterangan ?? '') }}',
                                                '{{ old('nilai_tes_id', $siswa->nilai->id ?? '') }}'
                                            )"
                                            class="text-left font-medium inline-block w-full"
                                            id="keterangan-btn-{{ $siswa->id }}"
                                            data-calon-siswa-id="{{ $siswa->id }}"
                                            data-nilai-tes="{{ $siswa->nilai->jumlah_nilai ?? '' }}"
                                            data-keterangan-tes="{{ $siswa->nilai->keterangan ?? '' }}"
                                            data-nilai-tes-id="{{ $siswa->nilai->id ?? '' }}"
                                        >
                                            <span
                                                id="display-keterangan-{{ $siswa->id }}"
                                                class="text-gray-900"
                                            >
                                                @php $keteranganText =
                                                $siswa->nilai->keterangan ??
                                                '-'; $keteranganClass = ''; if
                                                (strtolower($keteranganText) ==
                                                'mencukupi') { $keteranganClass
                                                = 'text-green-600'; } elseif
                                                (strtolower($keteranganText) ==
                                                'tidak mencukupi') {
                                                $keteranganClass =
                                                'text-red-600'; } @endphp
                                                <span
                                                    class="{{
                                                        $keteranganClass
                                                    }}"
                                                >
                                                    {{ $keteranganText }}
                                                </span>
                                            </span>
                                        </button>
                                    </td>
                                    {{-- NEW COLUMN FOR GRADUATION ACTION --}}
                                    <td class="px-4 py-2 text-center">
                                        @if($siswa->nilai &&
                                        (strtolower($siswa->nilai->keterangan)
                                        == 'mencukupi' ||
                                        strtolower($siswa->nilai->keterangan) ==
                                        'tidak mencukupi'))
                                        <form
                                            id="form-email-{{ $siswa->id }}"
                                            action="{{ route('nilai.send_graduation_email', $siswa->id) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            <button
                                                type="button"
                                                @click="confirmAndSubmitEmail({{ $siswa->id }}, '{{ strtolower($siswa->nilai->keterangan) }}', '{{ $siswa->nama_lengkap }}')"
                                                class="px-3 py-1 text-sm font-semibold leading-tight rounded-full @if(strtolower($siswa->nilai->keterangan) == 'mencukupi') text-blue-700 bg-blue-100 hover:bg-blue-200 @elseif(strtolower($siswa->nilai->keterangan) == 'tidak mencukupi') text-red-700 bg-red-100 hover:bg-red-200 @endif"
                                            >
                                                @if(strtolower($siswa->nilai->keterangan)
                                                == 'mencukupi') Kirim Notifikasi
                                                Kelulusan
                                                @elseif(strtolower($siswa->nilai->keterangan)
                                                == 'tidak mencukupi') Kirim
                                                Notifikasi Tidak Lulus @else
                                                Status Belum Valid @endif
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-gray-500 text-xs"
                                            >Menunggu Finalisasi</span
                                        >
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td
                                        colspan="10"
                                        {{--
                                        Tambah
                                        colspan
                                        karena
                                        ada
                                        kolom
                                        baru
                                        --}}
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
        @include('nilai._input-nilai')
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('nilaiTesModalLogic', () => ({
                showModal: false,
                modalCalonSiswaId: null,
                modalNilaiTesId: null,
                modalJumlahNilai: "",
                modalKeterangan: "",
                modalSiswaName: "",

                init() {
                    @if ($errors->any() && session('open_modal_on_error'))
                        this.showModal = true;
                        this.modalCalonSiswaId = "{{ old('calon_siswa_id') }}";
                        this.modalJumlahNilai = "{{ old('jumlah_nilai') }}";
                        this.modalKeterangan = "{{ old('keterangan') }}";
                        this.modalNilaiTesId = "{{ old('nilai_tes_id', '') }}";

                        const calonSiswaRow = document.getElementById(`calon-siswa-row-${this.modalCalonSiswaId}`);
                        if (calonSiswaRow) {
                            this.modalSiswaName = calonSiswaRow.children[3].textContent.trim();
                        } else {
                            this.modalSiswaName = "Tidak Diketahui";
                        }

                        this.setupForm();
                    @endif
                },

                openModal(calonSiswaId, siswaName, currentNilaiTes, currentKeteranganTes, nilaiTesId) {
                    this.modalCalonSiswaId = calonSiswaId;
                    this.modalSiswaName = siswaName;
                    this.modalJumlahNilai = currentNilaiTes;
                    this.modalKeterangan = currentKeteranganTes;
                    this.modalNilaiTesId = nilaiTesId;

                    this.setupForm();
                    this.showModal = true;
                },

                setupForm() {
                    const nilaiTesForm = document.getElementById("nilaiTesForm");
                    if (!nilaiTesForm) return;

                    if (this.modalNilaiTesId) {
                        nilaiTesForm.action = `/nilai/${this.modalNilaiTesId}`;
                        let methodInput = nilaiTesForm.querySelector('input[name="_method"]');
                        if (!methodInput) {
                            methodInput = document.createElement("input");
                            methodInput.type = "hidden";
                            methodInput.name = "_method";
                            nilaiTesForm.appendChild(methodInput);
                        }
                        methodInput.value = "PUT";
                    } else {
                        nilaiTesForm.action = `{{ route('nilai.store') }}`;
                        const existing = nilaiTesForm.querySelector('input[name="_method"]');
                        if (existing) existing.remove();
                    }
                },

            confirmAndSubmitEmail(siswaId, keterangan, siswaName) {
                    let text = `Apakah Anda yakin ingin mengirimkan email hasil seleksi untuk siswa bernama "${siswaName}"?`;

                    if (keterangan === 'mencukupi') {
                        text = `Apakah Anda yakin ingin mengirimkan email informasi kelulusan (LULUS) untuk siswa bernama "${siswaName}"?`;
                    } else if (keterangan === 'tidak mencukupi') {
                        text = `Apakah Anda yakin ingin mengirimkan email informasi hasil seleksi (TIDAK LULUS) untuk siswa bernama "${siswaName}"?`;
                    }

                    Swal.fire({
                        title: 'Konfirmasi Pengiriman Email',
                        text: text,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Kirim!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById(`form-email-${siswaId}`);
                            if (form) form.submit();
                        }
                    });
                },

                updateKeteranganDisplay(calonSiswaId, newKeterangan) {
                    const displayElement = document.getElementById(`display-keterangan-${calonSiswaId}`);
                    if (displayElement) {
                        let keteranganClass = '';
                        if (newKeterangan.toLowerCase() === 'mencukupi') {
                            keteranganClass = 'text-green-600';
                        } else if (newKeterangan.toLowerCase() === 'tidak mencukupi') {
                            keteranganClass = 'text-red-600';
                        }
                        displayElement.innerHTML = `<span class="${keteranganClass}">${newKeterangan}</span>`;
                    }
                }
            }));
        });

        $(document).ready(function () {
            $('#table').DataTable({
                responsive: true,
                autoWidth: false,
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10', '25', '50', 'Semua'],
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
                initComplete: function () {
                    document.querySelectorAll(".dt-buttons .dt-button").forEach(button => {
                        button.classList.remove("dt-button");
                    });
                },
            });
        });
    </script>
    @endpush
</x-app-layout>
