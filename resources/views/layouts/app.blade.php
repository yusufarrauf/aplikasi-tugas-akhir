<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (Auth::user() != "")
    <meta name="user_id" content="{{ Auth::user()->id }}">
    <meta name="user_type" content="{{ Auth::user()->user_type }}">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env("APP_NAME") }} - @yield('title')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.1/examples/blog/blog.css">
</head>

<body class="@yield('body-class')">
    <div id="app">
        @yield('content')
    </div>
</body>
</html>
