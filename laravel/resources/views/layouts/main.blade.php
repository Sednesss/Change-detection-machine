<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <head>
        <link rel="stylesheet" href="{{ asset('css/CDM/App/styles.css') }}">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/CDM/App/script.js') }}"></script>
    </head>
    <title>@yield('title')</title>
</head>

<body>
    @include('includes.App.header')
    @yield('content')
</body>

</html>