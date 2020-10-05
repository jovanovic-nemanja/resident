<div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>

<div class="page-topbar gradient-blue1">
    <div class="logo-area crypto">
        
    </div>
    <div class="quick-area">
        <div class="pull-left">
            <ul class="info-menu left-links list-inline list-unstyled">
                <li class="sidebar-toggle-wrap">
                    <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="pull-right">
            <ul class="info-menu right-links list-inline list-unstyled">
                <li class="profile showopacity">
                    <a href="#" data-toggle="dropdown" class="toggle">
                        <img src="{{ asset('Dashboard_files/profile.jpg') }}" alt="user-image" class="img-circle img-inline">
                        <span>nurse <i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="dropdown-menu profile animated fadeIn">
                        @guest
                            <li class="last">
                                <a href="{{ route('login') }}"><i class="fa fa-wrench"></i>{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="last">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i>{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest 
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>