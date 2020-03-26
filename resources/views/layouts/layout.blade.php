<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/style.css" rel="stylesheet">
    @yield('header')
    <title>@yield('title')</title>
</head>
<body>
@include('layouts.nav')
@yield('content')
</body>
@include('layouts.footer')
@yield('footer')
</html>
