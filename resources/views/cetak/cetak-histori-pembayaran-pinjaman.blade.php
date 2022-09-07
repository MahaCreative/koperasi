@extends('cetak.ap', [($title = 'Cetak Histori Pembayaran Pinjaman')])
@section('content')
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
                    Kode Simpanan
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Besar Pinjaman
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Tanggal Pembayaran
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Besar Pembayaran
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Sisa Pinjaman
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Petugas Menangani
                </th>

            </tr>
        </thead>
        <tbody>
            @if ($histori !== null)
                @forelse ($histori as $no => $item)
                    <tr class="border-b border-gray-400/50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $no + 1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->pembayaran_user->pinjaman_user->profile->nama_lengkap }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->pembayaran_user->pinjaman_user->kode_pinjaman }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                            Rp.
                            {{ format_uang($item->pembayaran_user->pinjaman_user->detail_data_pinjaman->data_pinjaman->pinjaman) }}

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->created_at->format('d-m-y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp. {{ format_uang($item->pembayaran) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp. {{ format_uang($item->sisa_pinjaman) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->user->username }}
                        </td>

                    </tr>
                @empty
                @endforelse
            @endif

        </tbody>
    </table>
@endsection
