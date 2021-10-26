<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')
    <title>{{ !empty($htmltitle) ? $htmltitle : "notitle" }}</title>

    @yield('css')

    @yield('customjs')

    <style>
        body {
            padding-top: 40px;
        }
    </style>
</head>
<body>


<!-- menu content -->
<nav>

</nav>
<section id="navspace">
<br>
</section>


<!-- menusub content -->
<nav>

</nav>
<section id="navspace">
    <br>
</section>



<div class="container">
    @yield('title')
    @yield('menu_action')
    @yield('content')
</div>



<!-- App scripts -->
@stack('scripts')
</body>
</html>