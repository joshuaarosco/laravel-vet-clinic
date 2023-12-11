<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>{{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="{{asset('web/cdn-cgi/apps/head/8jwJmQl7fEk_9sdV6OByoscERU8.js')}}"></script>
    <link rel="apple-touch-icon" href="{{asset('web/pages/ico/60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('web/pages/ico/76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('web/pages/ico/120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('web/pages/ico/152.png')}}">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    @include('frontend.web._includes.styles')
    @stack('css')

</head>
<body class="pace-dark">
    @include('frontend.web._components.nav',['header' => $header])
    <div class="{{$header?'p-t-60':''}}">
    @stack('content')
    </div>
    @include('frontend.web._components.footer')
    @include('frontend.web._components.search')
    @include('frontend.web._includes.scripts')
    @stack('js')
</body>
</html>
