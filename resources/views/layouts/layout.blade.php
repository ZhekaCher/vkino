<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/img/vkino-ico.ico" type="image/x-icon">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/libs/foundation-6.6.1/css/app.css" rel="stylesheet">
    {{--    <link rel="stylesheet" href="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">--}}
    <link href="/libs/fontawesome-pro-5.12.0-web/css/all.css" rel="stylesheet">
    @yield('header')
    <title>@yield('title')</title>
</head>
<body>
@include('layouts.nav')
@yield('content')
</body>
@include('layouts.footer')
<footer>

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
    <script>
        $(document).foundation();
    </script>
    @yield('footer')

</footer>
</html>
