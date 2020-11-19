<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <link type="text/css" href="{{ asset('@fullcalendar') }}/core/main.css" rel="stylesheet">
        <link type="text/css" href="{{ asset('@fullcalendar') }}/daygrid/main.css" rel="stylesheet">

        <link type="text/css" href="{{ asset('@fullcalendar') }}/bootstrap/main.css" rel="stylesheet">
        <link type="text/css" href="{{ asset('@fullcalendar') }}/list/main.css" rel="stylesheet">

        <link type="text/css" href="{{ asset('@fullcalendar') }}/timegrid/main.css" rel="stylesheet">
       <!-- <link type="text/css" href="{{ asset('bootstrap-table') }}/dist/bootstrap-table.min.css" rel="stylesheet">
       <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
       <link type="text/css" href="{{ asset('datatables.net-dt') }}/css/jquery.dataTables.css" rel="stylesheet">-->
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
        <script src="{{ asset('@fullcalendar') }}/core/main.js"></script>
        <script src="{{ asset('@fullcalendar') }}/daygrid/main.js"></script>

        <script src="{{ asset('@fullcalendar') }}/bootstrap/main.js"></script>
        <script src="{{ asset('@fullcalendar') }}/interaction/main.js"></script>
        <script src="{{ asset('@fullcalendar') }}/list/main.js"></script>
        <script src="{{ asset('@fullcalendar') }}/timegrid/main.js"></script>
        <script src="{{ asset('@fullcalendar') }}/moment/main.js"></script>
        <script src="{{ asset('@fullcalendar') }}/rrule/main.js"></script>
        <script src="{{ asset('@fullcalendar') }}/google-calendar/main.js"></script>
      <!--  <script src="{{ asset('bootstrap-table') }}/dist/bootstrap-table.min.js"></script>
      <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
      <script src="{{ asset('datatables.net-dt') }}/js/dataTables.dataTables.js"></script>-->

       

    </body>
</html>