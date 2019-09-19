<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @section('title')
        <title>{{ $title ?? '' }}</title>
        <meta name="keywords" content="{{ $keyword ??'' }}">
        <meta name="description" content="{{ $description??'' }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @show
    @section('theme_css')

    @show

    @yield('add_css')
    @section('font_css')

    @show
</head>
<body>
@yield('content')

@section('base_js')

@show
@yield('foot_js')
</body>
</html>