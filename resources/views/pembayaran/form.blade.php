<x-app-layout>
    <div class="grid grid-cols-2 gap-4 max-w-7xl mx-auto">
        @if(!empty($siswa->status_pendaftaran=="diverifikasi"))

        <div class="col-span-1">
            <div
                class="p-6 max-w-3xl mx-auto bg-white my-12 rounded-lg shadow-md"
            >
                <p
                    class="bg-blue-100 text-black p-2 border-2 border-gray-300 rounded mb-4"
                >
                    MEMBAYAR BIAYA PENDAFTARAN ONLINE UNTUK MENDAPATKAN KARTU
                    PESERTA UJIAN.
                    <br />
                    Biaya Pendaftaran Online
                    <strong> Rp 100.000,-</strong>. <br />
                    Transfer ke
                    <strong>BANK MANDIRI a/n SEKOLAH PAPUA KASIH II </strong
                    ><br />
                    No. Rek. 154-00-1301718-5
                </p>
            </div>
        </div>

        <div class="col-span-1">
            <div
                class="p-6 max-w-3xl mx-auto bg-white my-12 rounded-lg shadow-md"
            >
                @if(session('success'))
                <div class="bg-green-100 text-black p-4 rounded mb-4">
                    {{ session("success") }}
                </div>
                @endif @if ($pembayaran && !$isEditing)
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700">
                            Detail Pembayaran
                        </h2>
                        <div class="flex">
                            <h3 class="text-gray-700">Status:</h3>
                            <span>
                                @if ($pembayaran->status_pembayaran ==
                                'diverifikasi')
                                <span
                                    class="px-3 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full"
                                >
                                    {{-- Mengubah 'success' menjadi 'Success' --}}
                                    {{ ucfirst($pembayaran->status_pembayaran) }}
                                </span>
                                @elseif ($pembayaran->status_pembayaran ==
                                'pending')
                                <span
                                    class="px-3 py-1 text-sm font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full"
                                >
                                    {{ ucfirst($pembayaran->status_pembayaran) }}
                                </span>
                                @elseif ($pembayaran->status_pembayaran ==
                                'ditolak')
                                <span
                                    class="px-3 py-1 text-sm font-semibold leading-tight text-red-700 bg-red-100 rounded-full"
                                >
                                    {{ ucfirst($pembayaran->status_pembayaran) }}
                                </span>
                                @else
                                <span
                                    class="px-3 py-1 text-sm font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full"
                                >
                                    {{ ucfirst($pembayaran->status) }}
                                </span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <table class="w-full text-sm">
                        <tbody>
                            <tr class="border-b">
                                <td class="p-2 font-semibold w-1/3">
                                    Nama Pemilik Rekening
                                </td>
                                <td class="p-2">
                                    {{ $pembayaran->nama_pemilik_rekening }}
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-2 font-semibold">
                                    Nomor Rekening
                                </td>
                                <td class="p-2">
                                    {{ $pembayaran->nomor_rekening }}
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-2 font-semibold">Bank</td>
                                <td class="p-2">{{ $pembayaran->bank }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-2 font-semibold">Jumlah Bayar</td>
                                <td class="p-2">
                                    Rp
                                    {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-2 font-semibold">
                                    Tanggal Pembayaran
                                </td>
                                <td class="p-2">
                                    {{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d M Y') }}
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-2 font-semibold">
                                    Bukti Pembayaran
                                </td>
                                <td class="p-2">
                                    <a
                                        href="{{ route('pembayaran.bukti', ['filename' => basename($pembayaran->bukti_pembayaran)]) }}"
                                        target="_blank"
                                        class="text-blue-600 underline"
                                    >
                                        Lihat Bukti
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @if($pembayaran->status_pembayaran !== 'diverifikasi')
                    <div class="mt-4 flex justify-end">
                        <a
                            href="{{ route('pembayaran.edit') }}"
                            class="inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded"
                        >
                            Edit Pembayaran
                        </a>
                    </div>
                    @endif
                </div>
                @endif

                {{-- Tampilkan Form jika belum ada pembayaran atau dalam mode edit --}}
                @if (!$pembayaran || $isEditing)
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    {{ $isEditing ? "Edit Pembayaran" : "Form Pembayaran" }}
                </h2>

                <form
                    action="{{
                        $isEditing
                            ? route('pembayaran.update')
                            : route('pembayaran.submit')
                    }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf @if($isEditing) @method('PUT') @endif

                    <div class="space-y-4">
                        <div>
                            <x-input-label
                                for="nama_pemilik_rekening"
                                value="Nama Pemilik Rekening"
                            />
                            <x-text-input
                                name="nama_pemilik_rekening"
                                class="block w-full pl-10 py-2 bg-slate-200/50 text-bold border-slate-600 focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ old('nama_pemilik_rekening', $pembayaran->nama_pemilik_rekening ?? '') }}"
                                required
                            />
                            <x-input-error
                                :messages="$errors->get('nama_pemilik_rekening')"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label
                                for="nomor_rekening"
                                value="Nomor Rekening"
                            />
                            <x-text-input
                                name="nomor_rekening"
                                class="block w-full pl-10 py-2 bg-slate-200/50 text-bold border-slate-600 focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ old('nomor_rekening', $pembayaran->nomor_rekening ?? '') }}"
                                required
                            />
                            <x-input-error
                                :messages="$errors->get('nomor_rekening')"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label for="bank" value="Bank" />
                            <x-text-input
                                name="bank"
                                class="block w-full pl-10 py-2 bg-slate-200/50 text-bold border-slate-600 focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ old('bank', $pembayaran->bank ?? '') }}"
                                required
                            />
                            <x-input-error
                                :messages="$errors->get('bank')"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label
                                for="jumlah_bayar"
                                value="Jumlah Bayar"
                            />
                            <x-text-input
                                type="number"
                                name="jumlah_bayar"
                                class="block w-full pl-10 py-2 bg-slate-200/50 text-bold border-slate-600 focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar ?? '') }}"
                                required
                            />
                            <x-input-error
                                :messages="$errors->get('jumlah_bayar')"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label
                                for="tanggal_pembayaran"
                                value="Tanggal Pembayaran"
                            />
                            <x-text-input
                                type="date"
                                name="tanggal_pembayaran"
                                class="block w-full pl-10 py-2 bg-slate-200/50 text-bold border-slate-600 focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran ?? '') }}"
                                required
                            />
                            <x-input-error
                                :messages="$errors->get('tanggal_pembayaran')"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label
                                for="bukti_pembayaran"
                                value="Bukti Pembayaran (JPG, PNG, PDF)"
                            />
                            <input type="file" accept="application/pdf,
                            image/jpeg, image/png, image/jpg"
                            name="bukti_pembayaran" class="block w-full pl-10
                            py-3 bg-slate-200/50 text-bold border-slate-600
                            focus:border-indigo-500 focus:ring-indigo-500"
                            {{ $isEditing ? "" : "required" }}>

                            <x-input-error
                                :messages="$errors->get('bukti_pembayaran')"
                                class="mt-2"
                            />

                            @if($isEditing && $pembayaran->bukti_pembayaran)
                            <p class="mt-1 text-sm text-gray-500">
                                File sebelumnya:
                                <a
                                    href="{{ route('pembayaran.bukti', ['filename' => basename($pembayaran->bukti_pembayaran)]) }}"
                                    class="text-blue-500 underline"
                                    target="_blank"
                                    >Lihat</a
                                >
                            </p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-primary-button>
                            {{
                                $isEditing
                                    ? "Update Pembayaran"
                                    : "Submit Pembayaran"
                            }}
                        </x-primary-button>
                    </div>
                </form>
                @endif
            </div>
        </div>

        @else
        <div class="col-span-2">
            <div class="flex justify-center items-center max-w-3xl mx-auto">
                <div class="p-6 bg-white my-12 rounded-lg shadow-md">
                    Setelah status pendaftaran diverifikasi oleh panitia. Anda
                    dapat mendapatkan melakukan konfirmasi pembayaran dihalaman
                    form pembayaran untuk mendapatkan kartu peserta ujian.
                </div>
            </div>
        </div>
        @endiF
    </div>
</x-app-layout>
