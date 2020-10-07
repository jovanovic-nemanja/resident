<!doctype html>
<html>
<head>
    @include('layouts.head3d')
</head>
<body class="pace-done">
    @include('layouts.header')

    <div class="page-container row-fluid container-fluid">
        @include('layouts.sidebar')

        <!-- START CONTENT -->
        
        @yield('content')

        <!-- END CONTENT -->

        <div class="chatapi-windows ">

        </div>
    </div>

    @include('layouts.foot')

    @yield('script')
</body>
</html>