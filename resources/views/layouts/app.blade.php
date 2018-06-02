<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PHP Laravel Project') }}</title>

    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ticker-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">


    <script src="{{ asset('js/jquery.min.js') }}"></script>

</head>
<body>

    <div id="app">
        @include('inc.nav')
        <div class="container">
                <br/><br/><br/>
        @include('inc.messages')
        @yield('search-main')
        @yield('content')
        <h6 class="text-center"><span id="copyrightDate">date</span></h6>
        </div>
    </div>

    <!-- Scripts -->
   <!--<script src="{{ asset('js/app.js') }}"></script>-->
   <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome-all.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/jquery.newsTicker.min.js') }}"></script>
    <script src="{{ asset('js/myapp.js') }}"></script>

    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'post-ckeditor' );
</script>

<script>
        var year= new Date().getFullYear();
   document.getElementById('copyrightDate').innerHTML=year;
   </script>
</body>
</html>


