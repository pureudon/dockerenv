<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <title>{{ !empty($htmltitle) ? $htmltitle : "notitle" }}</title>
    @yield('css')
    @yield('jquery')
    @yield('js')
    @yield('select2')
</head>
<body>
    @yield('title')
    @yield('menu_action')
    @yield('content')
</body>

@yield('script')
@stack('scripts')
</html>