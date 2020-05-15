<!DOCTYPE HTML>
<html lang="en">
<head>
    @if(! empty($article->title))
        <title>Brilio.Net - {{ $article->title }}</title>
    @else 
        <title>Brilio.Net</title>
    @endif
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,600,700" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link href="{{config('app.url')}}user/plugin-frameworks/bootstrap.css" rel="stylesheet">
    <link href="{{config('app.url')}}user/fonts/ionicons.css" rel="stylesheet">
    <link href="{{config('app.url')}}user/common/styles.css" rel="stylesheet">
</head>
<body>
    @include('layouts.user.header')
    @yield('content')
    @include('layouts.user.footer')
    @stack('script')
</body>
</html>