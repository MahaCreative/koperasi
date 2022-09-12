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
                                    Tempat Tanggal Lahir
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    No. Telp
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Pekerjaan
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Alamat
                                </th>


                            </tr>
                        </thead>
                        <tbody>

                            @for ($i = 0; $i < count($print); $i++)
                                <tr class="border-b border-gray-400/50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $i + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $print[$i]['nama_lengkap'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <p>{{ $print[$i]['tempat_lahir'] }},{{ $print[$i]['ttl'] }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <p>{{ $print[$i]['no_telp'] }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <p>{{ $print[$i]['pekerjaan']['pekerjaan'] }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <p>{{ $print[$i]['alamat'] }}</p>
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
