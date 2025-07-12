<div
    x-show="showModal"
    @keydown.escape.window="showModal = false"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none"
>
    {{-- Background overlay --}}
    <div
        x-show="showModal"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 transition-opacity"
        aria-hidden="true"
    >
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    {{-- Modal panel --}}
    <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
        <span
            class="hidden sm:inline-block sm:align-middle sm:h-screen"
            aria-hidden="true"
            >&#8203;</span
        >

        {{-- KONTEN MODAL ANDA SEKARANG ADA DI SINI --}}
        <div
            x-show="showModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative z-50"
        >
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                    >
                        <h3
                            class="text-lg leading-6 font-medium text-gray-900"
                            id="modal-title"
                        >
                            Form Input Nilai(<span
                                x-text="modalSiswaName"
                            ></span
                            >)
                        </h3>
                        <div class="mt-2">
                            {{-- FORM DIMULAI DI SINI --}}
                            <form
                                id="nilaiTesForm"
                                method="POST"
                                action="{{ route('nilai.store') }}"
                                {{--
                                Form
                                akan
                                POST
                                ke
                                rute
                                store
                                --}}
                            >
                                @csrf

                                {{-- Input tersembunyi untuk calon_siswa_id --}}
                                <input
                                    type="hidden"
                                    name="calon_siswa_id"
                                    x-model="modalCalonSiswaId"
                                />
                                {{-- Input tersembunyi untuk nilai_tes_id, hanya ada jika sedang mode edit --}}
                                {{-- Ini akan memberi tahu controller apakah ini update atau store baru --}}
                                <input
                                    type="hidden"
                                    name="nilai_tes_id"
                                    x-model="modalNilaiTesId"
                                />

                                {{-- Tambahkan _method PUT/PATCH secara kondisional dengan Alpine.js --}}
                                <template x-if="modalNilaiTesId">
                                    @method('PUT')
                                </template>

                                <div class="mb-4">
                                    <label
                                        for="modal_jumlah_nilai"
                                        class="block text-sm font-medium text-gray-700"
                                        >Jumlah Nilai Tes</label
                                    >
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="jumlah_nilai"
                                        id="modal_jumlah_nilai"
                                        x-model="modalJumlahNilai"
                                        class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2 text-base"
                                        min="0"
                                        max="999.99"
                                        required
                                        placeholder="Masukkan jumlah nilai siswa"
                                    />
                                    {{-- Display error from Laravel validation --}}
                                    @error('jumlah_nilai')
                                    <p class="text-red-500 text-xs mt-1">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label
                                        for="modal_keterangan"
                                        class="block text-sm font-medium text-gray-700"
                                        >Keterangan</label
                                    >
                                    <select
                                        name="keterangan"
                                        id="modal_keterangan"
                                        x-model="modalKeterangan"
                                        class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2 text-base"
                                    >
                                        <option value="">
                                            Pilih Keterangan
                                        </option>
                                        <option value="Mencukupi">
                                            Mencukupi
                                        </option>
                                        <option value="Tidak Mencukupi">
                                            Tidak Mencukupi
                                        </option>
                                    </select>
                                    {{-- Display error from Laravel validation --}}
                                    @error('keterangan')
                                    <p class="text-red-500 text-xs mt-1">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <button
                                        type="button"
                                        @click="showModal = false"
                                        class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-3"
                                    >
                                        Batal
                                    </button>
                                    <button
                                        type="submit"
                                        {{--
                                        Type
                                        submit
                                        untuk
                                        pengiriman
                                        form
                                        standar
                                        --}}
                                        class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150"
                                    >
                                        Simpan Nilai Tes
                                    </button>
                                </div>
                            </form>
                            {{-- FORM BERAKHIR DI SINI --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
