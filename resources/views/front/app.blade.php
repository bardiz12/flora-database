<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <meta name="csrf-token" content="{{ csrf_token()}}">

        <!-- Styles -->
       
    </head>
    <body class="d-flex flex-column h-100">
        <div id="app"></div>
        <script>
        window.api_url ='{{url('')}}/api';
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
