<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __("Dashboard") }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            {{-- STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-md rounded-lg p-5">
                    <h3 class="text-gray-600 text-sm">Total Calon Siswa</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $totalCalon }}
                    </p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-5">
                    <h3 class="text-gray-600 text-sm">Diterima</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">
                        {{ $totalDiterima }}
                    </p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-5">
                    <h3 class="text-gray-600 text-sm">Tidak Diterima</h3>
                    <p class="text-3xl font-bold text-red-600 mt-2">
                        {{ $totalDitolak }}
                    </p>
                </div>
            </div>

            {{-- CHART --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Pie Chart: Jenis Kelamin --}}
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">
                        Distribusi Jenis Kelamin
                    </h3>
                    <div id="chart-gender" class="h-64"></div>
                </div>

                {{-- Donut Chart: Usia --}}
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">
                        Rata-rata Usia
                    </h3>
                    <div id="chart-usia" class="h-64"></div>
                </div>
            </div>

            {{-- Bar Chart: Tahun --}}
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                    Jumlah Pendaftar per Tahun
                </h3>
                <div id="chart-tahun" class="h-72"></div>
            </div>
        </div>
    </div>

    {{-- Chart Script --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Pie Chart - Jenis Kelamin
        new ApexCharts(document.querySelector("#chart-gender"), {
            chart: { type: 'pie', height: '300' },
            series: @json(collect($jenisKelamin)->values()),
            labels: @json(collect($jenisKelamin)->keys()),
            colors: ['#3B82F6', '#F472B6'], // biru, pink
        }).render();

        // Donut Chart - Usia (simulasi)
        new ApexCharts(document.querySelector("#chart-usia"), {
            chart: { type: 'donut', height: '300' },
            series: [{{ $usiaRata2 }}, 100 - {{ $usiaRata2 }}],
            labels: ['Rata-rata Usia', 'Sisa'],
            colors: ['#F59E0B', '#E5E7EB'], // kuning, abu
        }).render();

        // Bar Chart - Tahun
        new ApexCharts(document.querySelector("#chart-tahun"), {
            chart: { type: 'bar', height: 300 },
            series: [{
                name: 'Jumlah Pendaftar',
                data: @json(collect($jumlahPerTahun)->values()),
            }],
            xaxis: {
                categories: @json(collect($jumlahPerTahun)->keys()),
            },
            colors: ['#10B981'],
        }).render();
    </script>
    @endpush
</x-app-layout>
