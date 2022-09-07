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
                @forelse ($histori as $no => $item)
                    <tr class="border-b border-black">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $no + 1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->penarikan_simpanan->simpanan_user->profile->nama_lengkap }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->penarikan_simpanan->simpanan_user->kode_simpanan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            @if ($item->penarikan_simpanan->simpanan_user->jenis_simpanan_id)
                                Rp.
                                {{ format_uang($item->penarikan_simpanan->simpanan_user->jenis_simpanan->jumlah) }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->tanggal_penarikan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp. {{ format_uang($item->jumlah_penarikan) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp. {{ format_uang($item->sisa_simpanan) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->petugas->username }}
                        </td>

                    </tr>
                @empty
                @endforelse
            @endif

        </tbody>
    </table>
@endsection
