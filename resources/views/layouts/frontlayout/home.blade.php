<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopping</title>
    <link href="{{ asset('css/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front/css/font-awesome.min.css') }} " rel="stylesheet">
    <link href="{{ asset('css/front/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('css/front/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/front/css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	@include('layouts.frontlayout.header')
    <!--/header-->
	
	@if(\Request::is('/'))
        @include('layouts.frontlayout.slider')
    @endif
	
    <section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@include('layouts.frontlayout.sidebar')
				</div>
				
				<div class="col-sm-9 padding-right">
					@yield('content')
				</div>
			</div>
		</div>
	</section>
	
	
	@include('layouts.frontlayout.footer')
  
    <script src="{{ asset('css/front/js/jquery.js') }} "></script>
	<script src="{{ asset('css/front/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('css/front/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('css/front/js/price-range.js ') }}"></script>
    <script src="{{ asset('css/front/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('css/front/js/main.js') }}"></script>

    @yield('scripts')

</body>
</html>