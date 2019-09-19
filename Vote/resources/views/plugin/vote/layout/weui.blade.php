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
        <link rel="stylesheet" href="{{ plugin_res('/vote/weui/weui.min.css') }}">
        <link rel="stylesheet" href="{{ plugin_res('/vote/js/dailog/css/dialog.css') }}">
    @show

    @yield('add_css')
    @section('font_css')

    @show
</head>
@section('body')

    <body>
    @show
    @yield('content')

    @section('base_js')
        <script src="{{ plugin_res('/vote/js/jquery.min.js') }}"></script>
        <script src="{{ plugin_res('/vote/js/dailog/js/dialog.js') }}"></script>
        <script>
            function msg(str) {
                $(document).dialog({
                    content: str,
                });
            }

            function toast(str, type) {
                type = type || 1;
                var icon = "{{plugin_res('/vote/js/dailog/images/icon/success.png')}}";
                if (type == 2) {
                    icon = "{{ plugin_res('/vote/js/dailog/images/icon/fail.png') }}"
                }
                $(document).dialog({
                    type: 'toast',
                    infoIcon: icon,
                    infoText: str,
                    autoClose: 2500
                });
            }
        </script>
    @show
    @yield('foot_js')
    </body>
</html>