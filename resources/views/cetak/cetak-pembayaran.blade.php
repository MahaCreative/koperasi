@extends('cetak.ap', [($title = 'Anggota Koperasi')])
@section('content')
    <div class="border-b border-gray-600/50 py-3 w-full">
        <p>Nama Pinjaman :<span class="font-bold text-right">{{ $lihatpembayaran->profile->nama_lengkap }}</span></p>
        <p>Kode Pinjaman :<span class="font-bold text-right">{{ $lihatpembayaran->kode_pinjaman }}</span></p>
        <p>Tanggal Pinjaman :<span class="font-bold text-right">{{ $lihatpembayaran->tanggal_pengajuan }}</span></p>
    </div>
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
                                    Kode Pembayaran
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Tanggal Pembayaran
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Pinjaman
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Total Pembayaran
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Sisa Pinjaman
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Petugas
                                </th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php $nor = 0;
                            $count = count($lihatpembayaran->pembayaran_user->detail_pembayaran_user); ?>

                            @foreach ($lihatpembayaran->pembayaran_user->detail_pembayaran_user()->get() as $no => $item)
                                <?php $nor = $no + 1; ?>
                                <tr class="border-b border-gray-400/50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $nor }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $lihatpembayaran->profile->nama_lengkap }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $lihatpembayaran->pembayaran_user->kode_pembayaran }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Rp. {{ format_uang($item->total_pinjaman) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Rp. {{ format_uang($item->pembayaran) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Rp. {{ format_uang($item->sisa_pinjaman) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->user->username }} </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
