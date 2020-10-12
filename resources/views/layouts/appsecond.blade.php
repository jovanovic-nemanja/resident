<!doctype html>
<html>
<head>
    @include('layouts.head')
</head>
<body class="pace-done">
    @include('layouts.header')

    <div class="page-container row-fluid container-fluid">
        @include('layouts.sidebar', ['menu' => $menu])

        <!-- START CONTENT -->
        <section id="main-content" class="">
            <div class="wrapper main-wrapper row" style="">
                @yield('content')

                <div class="clearfix"></div>
                <!-- MAIN CONTENT AREA ENDS -->
            </div>
        </section>
        <!-- END CONTENT -->

        <div class="chatapi-windows ">

        </div>
    </div>

    @include('layouts.foot')

    @yield('script')
</body>
</html>