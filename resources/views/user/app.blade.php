<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    <script src="{{ asset('js/tailwind.js') }}"></script>

    <title>Document</title>
    @livewireStyles
</head>

<body class="">

    @livewire('components.navbar')
    {{ $slot }}
    {{-- @livewire('footer') --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/tailwindjquery.js') }}"></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
