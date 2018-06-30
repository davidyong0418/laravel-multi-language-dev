<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <title>@yield('title')</title>
    <link href="{{URL::asset('css/main.css')}}" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="{{URL::asset('js/main.js')}}"></script>
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="{{URL::asset('images/favicon/favicon-152.png')}}">
    <link rel="icon" type="image/png" href="{{URL::asset('images/favicon/favicon-32.png')}}">
    <link rel="icon" type="image/x-icon" href="{{URL::asset('images/favicon/favicon-32.ico')}}">
    <link rel="apple-touch-icon" href="{{URL::asset('images/favicon/favicon-152.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{URL::asset('images/favicon/favicon-152.png')}}">
</head>
<body class="body-block body-block--content">
@include('layouts.includes.header-wrapper')
@yield('content')
{!! AppSettings::get('cms.analytics'); !!}
</body>
</html>