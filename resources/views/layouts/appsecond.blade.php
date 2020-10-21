<!doctype html>
<html>
<head>
    @include('layouts.head')
</head>
<body class="pace-done">
    <div class id="app">
        @include('layouts.header')

        <div class="page-container row-fluid container-fluid">
            @if(auth()->user()->hasRole('admin'))
                @include('layouts.sidebar', ['menu' => $menu])
            @endif

            <!-- START CONTENT -->
            @if(auth()->user()->hasRole('admin'))
                <section id="main-content" class="">
            @endif
            @if(auth()->user()->hasRole('care taker'))
                <section id="main-content" class="" style="margin-left: auto;">
            @endif
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
    </div>
    
    @include('layouts.foot')

    @yield('script')

</body>
</html>