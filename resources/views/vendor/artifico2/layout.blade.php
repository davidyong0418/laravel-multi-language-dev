<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Zharov.info - @yield('title', 'Система управления сайтом')</title>
    {{--Tell the browser to be responsive to screen width--}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="{{URL::asset('images/favicon/favicon_cms-32.png')}}">
    <link rel="icon" type="image/ico" href="{{URL::asset('images/favicon/favicon_cms-32.ico')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <base href="/">

    @section('styles')
        {{--REQUIRED CSS--}}
        <link rel="stylesheet" href="{{ URL::asset('vendor/artifico2/artifico2.css') }}">
        {{--Font Awesome--}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        {{--Ionicons--}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    @show

    {{--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries--}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    {{--Main Header--}}
    @section('main_header')
        @include('artifico2::widgets/header')
    @show

    {{--Left side column--}}
    @section('left_sidebar')
        @include('artifico2::widgets/sidebar_left')
    @show

    {{--Content Wrapper. Contains page content--}}
    <div class="content-wrapper">
        {{--Content Header (Page header)--}}
        <section class="content-header">
            @if (array_key_exists('page_header', View::getSections()))
            <h1>
                @yield('page_header')
                <small>@yield('page_description')</small>
            </h1>
            @endif
            @section('breadcrumbs')
            @show
        </section>

        {{--Main content--}}
        <section class="content">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
            @endif
            @yield('content')
        </section>
    </div>

    {{--Main Footer--}}
    @section('footer')
        @include('artifico2::widgets/footer')
    @show

    {{--Control Sidebar--}}
    {{--@include('artifico2::widgets/sidebar_right')--}}

</div>

{{--REQUIRED JS SCRIPTS--}}
@section('javascripts')
    <script src="{{ URL::asset('vendor/artifico2/artifico2.js') }}"></script>
@show

</body>
</html>
