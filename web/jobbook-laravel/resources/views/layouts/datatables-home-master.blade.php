<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    @yield('meta')
    <title>{{ !empty($htmltitle) ? $htmltitle : "notitle" }}</title>
    @yield('css')
    @yield('customjs')
    <style>
    </style>
</head>
<body>

@include('navigation.menu')
@include('navigation.menusub')

@yield('title')
@yield('menu_action')
@yield('content')
@stack('scripts')
</body>
</html>