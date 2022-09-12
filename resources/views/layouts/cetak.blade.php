<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
    @livewireStyles
</head>

<body>
    {{ $slot }}
    <script src="{{ asset('js/tailwindelement.js') }}"></script>
    @livewireScripts
</body>

</html>
