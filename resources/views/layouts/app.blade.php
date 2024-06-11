<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="{{$site->site_name}}">
<link rel="icon" href="{{URL::to($site->logo)}}">

<title>{{$site->site_name}} | @yield('title')</title>

<meta name="keywords" content="Church,bible, charity, christ, christian, church, churches, events, religion, religious, sermon">
<meta name="MobileOptimized" content="320" />
<!-- favicon-icon -->
<link rel="icon" type="image/icon" href="images/favicon/favicon.ico">
<!-- theme style -->
@include('layouts.css')
{{-- <style>
    .hidden {
        display: none;
    }
</style> --}}
@stack('css')
</head>
<!-- end head -->
<!--body start-->

<body>

    @include('layouts.loader')
    @include('layouts.nav')

    @if(Request::is('/'))
    @include('layouts.slider')
    @endif
    @yield('content')
@include('layouts.footer')
@include('layouts.js')
<script>
    @if(Session::has('success'))
    new Noty({
        type: 'success',
        layout: 'topRight',
        text: '{{Session::get('success')}}',
        timeout: 2000
    }).show();
    @endif

    @if(Session::has('fail'))
    new Noty({
        type: 'error',
        layout: 'topRight',
        text: '{{Session::get('fail')}}',
        timeout: 2000
    }).show();
    @endif

    @if(Session::has('error'))
    new Noty({
        type: 'error',
        layout: 'topRight',
        text: '{{Session::get('error')}}',
        timeout: 2000
    }).show();
    @endif

</script>
@yield('javascripts')

</body>
</html>
