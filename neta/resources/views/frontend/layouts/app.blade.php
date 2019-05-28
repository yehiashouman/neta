<?php
function csrf_token(){}


?>
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Place this data between the <head> tags of your website -->
    <meta name="description" content="@yield('meta_description', 'K1 Hub')">
        
	<meta name="revisit-after" content="15 days">
    <meta name="robots" content="index,follow">
		
        <title>@yield('title', env('APP_NAME'))</title>

        <!-- Meta -->
        <meta name="description" content="">
        <meta name="author" content="">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')
 
		
		<!-- plugins css -->
		<link href="/css/frontend/bootstrap.min.css" rel="stylesheet">
		<link href="/css/frontend/core.css" rel="stylesheet">
		<!-- /plugins css -->
		
		
        @yield('after-styles')
        
        <!-- Scripts -->
        <script>
            function csrf_token(){
                
                return '';
            }
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body id="app-layout">
        <div id="app">
			<div class="site-wrapper">
				
				
					@yield('content')
				
			</div>
        </div><!--#app-->

        <!-- Scripts -->
        @yield('before-scripts')
        
		<script src="/js/frontend/jquery-3.2.1.min.js"></script>
		<script src='/js/frontend/jquery-ui.1.8.5.min.js'></script>
		<script src="/js/frontend/bootstrap.min.js"></script>
		
		
		@yield('after-scripts')

    </body>
</html>
