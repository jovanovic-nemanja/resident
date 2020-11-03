<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{ $general_setting->site_name }}</title>
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('newdesign/login/nicepage.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('newdesign/login/Page-1.css') }}" media="screen">
    <script class="u-script" type="text/javascript" src="{{ asset('newdesign/login/jquery.js') }}" defer=""></script>
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700">
</head>
<body class=" login_page">
	<div class id='app'>
		<div class="container-fluid">
	        <div class="login-wrapper row">
			    <section class="u-clearfix u-image u-section-1" id="carousel_35ff" data-image-width="1529" data-image-height="972">
			      	<div class="u-clearfix u-sheet u-sheet-1">
			        	<div class="u-container-style u-expanded-width-xs u-group u-group-1">
				            @yield('content')
				        </div>
			      	</div>
			    </section>

			    <section class="u-backlink u-clearfix u-grey-80">
			      <a class="" href="https://nicepage.com/" target="_blank">
			        <span>Copyright © <?= date('Y'); ?></span>
			      </a>. 
			      <a class="" href="https://nicepage.com/html-templates" target="_blank">
			        <span>Powered by Solaris Dubai</span>
			      </a>
			    </section>
			</div>
		</div>
	</div>

    @include('layouts.foot')

    @yield('script')
</body>
</html>