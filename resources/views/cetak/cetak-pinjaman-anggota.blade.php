@extends('cetak.ap', [($title = 'Anggota Koperasi')])
@section('content')
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
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

                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($print); $i++)
                                <tr class="border-b border-gray-400/50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $i + 1 }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $print[$i]['profile']['nama_lengkap'] }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $print[$i]['kode_pinjaman'] }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <p>Besar Pinjaman :
                                            Rp.
                                            {{ format_uang($print[$i]['detail_data_pinjaman']['data_pinjaman']['pinjaman']) }}
                                        </p>
                                        <p>Durasi Angsuran :
                                            {{ $print[$i]['detail_data_pinjaman']['data_angsuran']['durasi_angsuran'] }} X
                                        </p>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        Rp. {{ format_uang($print[$i]['detail_data_pinjaman']['angsuran']) }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        Rp. {{ format_uang($print[$i]['detail_data_pinjaman']['simpanan']) }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <p>Status Pinjaman :
                                            {{ $print[$i]['status_pinjaman'] ? 'Di setujui' : 'Belum di setujui' }}</p>
                                        <p>Status Lunas :
                                            {{ $print[$i]['status_lunas'] ? 'Di setujui' : 'Belum di setujui' }}</p>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        Rp. {{ $print[$i]['tanggal_pengajuan'] }}
                                    </td>
                                </tr>
                            @endfor

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
