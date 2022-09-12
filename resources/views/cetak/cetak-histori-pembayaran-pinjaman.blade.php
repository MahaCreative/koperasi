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
                @for ($i = 0; $i < count($histori) - 1; $i++)
                    <tr class="border-b border-gray-400/50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $i + 1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $histori[$i]['nama_lengkap'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $histori[$i]['kode_pinjaman'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                            Rp.
                            {{ format_uang($histori[$i]['pinjaman']) }}

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $histori[$i]['created_at'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp. {{ format_uang($histori[$i]['pembayaran']) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp. {{ format_uang($histori[$i]['sisa_pinjaman']) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $histori[$i]['username'] }}
                        </td>

                    </tr>
                @endfor
            @endif

        </tbody>
    </table>
@endsection
