<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ $general_setting->site_name }}</title>
<meta content="" name="description" />
<meta content="" name="author" />

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />
<!-- For iPhone -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('newdesign/assets/images/apple-touch-icon-57-precomposed.png') }}">
<!-- For iPhone 4 Retina display -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('newdesign/assets/images/apple-touch-icon-114-precomposed.png') }}">
<!-- For iPad -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('newdesign/assets/images/apple-touch-icon-72-precomposed.png') }}">
<!-- For iPad Retina display -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('newdesign/assets/images/apple-touch-icon-144-precomposed.png') }}">

<!-- CORE CSS FRAMEWORK - START -->
<link href="{{ asset('newdesign/assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen" />
<link href="{{ asset('newdesign/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('newdesign/assets/plugins/bootstrap/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('newdesign/assets/fonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('newdesign/assets/fonts/webfont/cryptocoins.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('newdesign/assets/css/animate.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('newdesign/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />
<!-- CORE CSS FRAMEWORK - END -->

<!-- CORE CSS TEMPLATE - START -->
<link href="{{ asset('newdesign/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('newdesign/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
<!-- CORE CSS TEMPLATE - END -->

<!-- Canbas WebGL Three.js -->
<link type="text/css" rel="stylesheet" href="{{ asset('3d/src/main.css') }}">