@extends('cetak.ap', [($title = 'Cetak Histori Penarikan Simpanan')])
@section('content')
    <table class="min-w-full">
        <thead class="border-b border-black">
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
                    Besar Simpanan
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Tanggal Penarikan
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Besar Penarikan
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Sisa Simpanan
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Petugas Menangani
                </th>

            </tr>
        </thead>
        <tbody>
            @if ($histori !== null)
                @for ($i = 0; $i < count($histori); $i++)
                    <tr class="border-b border-gray-400/50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $i + 1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $histori[$i]['nama_lengkap'] }}
                            {{-- {{ $histori[$i]['penarikan_simpanan']->simpanan_user }} --}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $histori[$i]['kode_simpanan'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ format_uang($histori[$i]['simpanan']) }}

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $histori[$i]['tanggal_penarikan'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp. {{ format_uang($histori[$i]['jumlah_penarikan']) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp. {{ format_uang($histori[$i]['sisa_simpanan']) }}
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
