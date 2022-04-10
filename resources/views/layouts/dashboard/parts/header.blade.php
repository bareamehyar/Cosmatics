<head>
    <meta name="description" content="ocean Resturant">

    <link rel="icon" href="https://dashboard.cosmatics.digisolapps.com/assets/Asset 1.svg">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ocean">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="https://dashboard.cosmatics.digisolapps.com/assets/Asset 1.svg">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @hasSection ('page-title')
        @yield('page-title') - {{ config("app.name") }}
        @else
            {{ config("app.name") }}
        @endif
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/main.css")}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/lib/all.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">

    <!-- Font-icon css-->
    @hasSection("css-links")
        @yield("css-links")
    @endif
</head>
