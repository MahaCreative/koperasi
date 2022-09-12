<div>
    @section('title')
        Dashboard
    @endsection
    {{-- Modals --}}

    @component('components.snippets.modals', ['title' => 'Filter', 'idModals' => 'modalsLarge', 'sizeModals' => 'modal'])
        @if ($statusViewModal == 'modalFilterPinjaman')
            <form wire:submit.prevent="filterPinjaman">
                <div class="flex flex-col">
                    <label for="">From Date</label>
                    <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2" type="date"
                        wire:model='from_date' placeholder="{{ $from_date }}">
                    @error('from_date')
                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="">From Date</label>
                    <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="date" wire:model='to_date' placeholder="to_date">
                    @error('to_date')
                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit">Proses Filter</button>
            </form>
        @else
            <form wire:submit.prevent="filterSimpanan">
                <div class="flex flex-col">
                    <label for="">From Date</label>
                    <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="date" wire:model='from_date' placeholder="{{ $from_date }}">
                    @error('from_date')
                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="">From Date</label>
                    <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="date" wire:model='to_date' placeholder="to_date">
                    @error('to_date')
                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit">Proses Filter</button>
            </form>
        @endif
    @endcomponent
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-2 mx-2 font-semibold">
        <div
            class="border border-gray-300/50 rounded-md shadow-md shadow-gray-400/50 p-3 text-white bg-yellow-600 flex items-center">
            <div class="flex items-center gap-x-2">
                <div class="flex justify-center items-center">
                    <div
                        class="flex items-center justify-center flex-col text-center border-2 border-white rounded-md p-3">
                        <i class="bi bi-person-hearts text-[24pt]"></i>
                        <h3>Data Pinjaman</h3>
                    </div>
                </div>
                <div class="">
                    <p>Total Anggota Koperasi</p>
                    <p>{{ $anggota }}</p>
                </div>
            </div>
        </div>
        <div
            class="border border-gray-300/50 rounded-md shadow-md shadow-gray-400/50 p-3 flex items-center bg-red-600 text-white">
            <div class="flex items-center justify-between gap-x-1">
                <div class="flex justify-center">
                    <div
                        class="flex items-center justify-center flex-col text-center border-2 border-white p-3 rounded-md">
                        <i class="bi bi-cash-coin text-[24pt]"></i>
                        <h3>Data Pinjaman</h3>
                    </div>
                </div>
                <div class="text-sm">
                    <p>Total Pinjaman : {{ $pinjamanCount }}</p>
                    <p>Jumlah Pinjaman Lunas: {{ $pinjamanLunas }}</p>
                    <p>Jumlah Pinjaman Belum Lunas : {{ $pinjamanBelumLunas }}</p>
                    <p>Total Rupiah : Rp. {{ format_uang($rupiahPinjaman) }}</p>
                </div>
            </div>
        </div>
        <div
            class="border border-gray-300/50 rounded-md shadow-md shadow-gray-400/50 p-3 flex items-center bg-green-600 text-white">
            <div class="flex items-center justify-between gap-x-1">
                <div class="flex justify-center">
                    <div
                        class="flex items-center justify-center flex-col text-center border-2 border-white p-3 rounded-md">
                        <i class="bi bi-wallet-fill text-[24pt]"></i>
                        <h3>Data Simpanan</h3>
                    </div>
                </div>
                <div class="text-sm">
                    <p>Total Simpanan : {{ $simpananCount }}</p>
                    <p>Total Rupiah : Rp. {{ format_uang($simpananRupiah) }}</p>
                </div>
            </div>
        </div>
        <div
            class="border border-gray-300/50 rounded-md shadow-md shadow-gray-400/50 p-3 flex items-center bg-blue-600 text-white">
            <div class="flex items-center justify-between gap-x-1">
                <div class="flex justify-center">
                    <div
                        class="flex items-center justify-center flex-col text-center border-2 border-white p-3 rounded-md">
                        <i class="bi bi-browser-chrome text-[24pt]"></i>
                        <h3>Data Artikel</h3>
                    </div>
                </div>
                <div class="text-sm">
                    <p>Total Artikel Di Post : {{ $artikelCount }}</p>
                    <p>Total Pengunjung : {{ $artikelVisitor }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="grid lg:grid-cols-2 gap-2">
        <div
            class="border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2 mx-2 ">
            <div class="m-2">
                <button type="button" wire:click="fiewModal('modalFilterPinjaman')" data-bs-toggle="modal"
                    data-bs-target="#modalsLarge"
                    class="border border-gray-400 shadow-md hover:cursor-pointer hover:bg-gray-400 hover:text-white rounded-md px-4">Filter
                    Tanggal</button>

            </div>

            <div class="mx-2">
                <h3>Grafik Total Pinjaman Anggota </h3>
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <div
            class="border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2 mx-2 ">
            <div class="m-2">
                <button type="button" wire:click="fiewModal('modalFilterSimpanan')" data-bs-toggle="modal"
                    data-bs-target="#modalsLarge"
                    class="border border-gray-400 shadow-md hover:cursor-pointer hover:bg-gray-400 hover:text-white rounded-md px-4">Filter
                    Tanggal</button>

            </div>

            <div class="mx-2">
                <h3>Grafik Total Simpanan Anggota</h3>
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var charData = JSON.parse(`<?php echo $pinjaman; ?>`);

            var dataSet = [];

            for (let i = 0; i < charData.length; i++) {
                dataSet.push({
                    x: charData[i].tanggal,
                    y: charData[i].pinjaman
                })
            }


            const data = {
                datasets: [{
                    label: 'Total Pinjaman Anggota',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: dataSet,
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    maintainAspectRatio: true,
                }
            };
            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
            window.addEventListener('updatedGrafikPinjaman', event => {
                var charData = event.detail.data;
                var dataSet = [];

                for (let i = 0; i < charData.length; i++) {
                    dataSet.push({
                        x: charData[i].tanggal,
                        y: charData[i].pinjaman
                    })
                }
                myChart.data.datasets.forEach((datasets) => {
                    datasets.data = dataSet
                })
                myChart.update()
            });
        </script>
        <script>
            var charData2 = JSON.parse(`<?php echo $simpanan; ?>`);
            var dataSet2 = [];

            for (let i = 0; i < charData2.length; i++) {
                dataSet2.push({
                    x: charData2[i].tanggal,
                    y: charData2[i].simpanan
                })
            }
            const data2 = {
                datasets: [{
                    label: 'Total simpanan Anggota',
                    backgroundColor: 'rgb(50, 120, 252)',
                    borderColor: 'rgb(50, 120, 252)',
                    data: dataSet2,
                }]
            };

            const config2 = {
                type: 'line',
                data: data2,
                options: {
                    maintainAspectRatio: true,
                }
            };
            const myChart2 = new Chart(
                document.getElementById('myChart2'),
                config2
            );

            window.addEventListener('updateGrafikSimpanan', event => {
                var charData2 = event.detail.data;
                var dataSet2 = [];

                for (let i = 0; i < charData2.length; i++) {
                    dataSet2.push({
                        x: charData2[i].tanggal,
                        y: charData2[i].simpanan
                    })
                }
                myChart2.data.datasets.forEach((datasets) => {
                    datasets.data = dataSet2
                })
                myChart2.update()
            });
        </script>
    @endpush
</div>
