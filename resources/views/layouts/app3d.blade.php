<!doctype html>
<html>
<head>
    @include('layouts.head3d')
</head>
<body class="pace-done">
    <div class id="app">
        @include('layouts.header')

        <div class="page-container row-fluid container-fluid">
            @include('layouts.sidebar', ['menu' => $menu])

            <!-- START CONTENT -->
            
            @yield('content')

            <!-- END CONTENT -->

            <div class="chatapi-windows ">

            </div>
        </div>

    </div>

    @include('layouts.foot')

    @yield('script')
</body>
</html>