<div class="m-6 p-6">
    <div class="mb-6 border-b-2 border-black p-3">
        <div class="flex gap-x-2 items-center">
            <img class="w-20" src="{{ asset($koperasi->takeImage) }}" alt="">
            <div class="flex flex-col justify-center">
                <h3 class="leading-5 font-bold text-[26pt] uppercase">{{ $koperasi->nama_koperasi }}</h3>
                <p class="leading-5 mt-1">Cetak Laporan Pinjaman Anggota</p>
                <p class="leading-5">Tanggal Cetak : {{ now()->format('d-m-y') }}</p>
            </div>
        </div>
    </div>
    <table class="min-w-full">
        <thead class="border-b border-gray-400/50">
            <tr>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    #
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Nama
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Kode Pinjaman
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Pinjaman
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Angsuran
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Simpanan
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Status
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Tanggal Pengajuan
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Aksi
                </th>

            </tr>
        </thead>
        <tbody>


        </tbody>
    </table>
</div>
