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
		<style>
			#preloader {
			display: block;
			transition: all 0.5s ease-in-out;
			z-index: 1001;
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
			width: 100%;
			height: 100%;
			background: #fff
		}
		
		#preloader img {
			margin: auto;
			transition: all 1s ease-in-out;
			z-index: 1001;
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto
		}
		
		.preload div#preloader {
			position: fixed;
			left: 0;
			top: 0;
			z-index: 999;
			width: 100%;
			height: 100%;
			overflow: visible;
			background: #333 url(http://files.mimoymima.com/images/loading.gif) no-repeat center center
		}</style>

		<link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />
		<script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    </head>
    

    <body class="d-flex flex-column h-100">
        <div id="app">
                <div id="preloader">
                        <img src="https://bardizba.com/themes/bardizba-blog/assets/images/loader.gif " alt="">
                    </div>
        </div>
        <script>
        window.api_url ='{{url('')}}/api';
        </script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
