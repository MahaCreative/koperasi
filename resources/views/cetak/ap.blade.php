<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ $title }}</title>
</head>

<body class="my-4 px-5">
    <div class="flex gap-x-2 my-2 border-b items-center">
        <img class="w-24 " src="{{ asset($profile->takeImage) }}" alt="">
        <div>
            <h4 class="font-semibold text-[24px]">{{ $profile->nama_koperasi }}</h4>
            <p>Cetak Laporan : {{ $title }}</p>
            <p>Tanggal Cetak : {{ now()->format('d-m-Y') }}</p>
        </div>
    </div>
    <div class="border-b-4 border-black"></div>
    @yield('content')
</body>

</html>
