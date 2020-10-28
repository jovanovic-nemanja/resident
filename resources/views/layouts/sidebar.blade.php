<div class="page-sidebar fixedscroll">
   <!-- MAIN MENU - START -->
    <div class="page-sidebar-wrapper ps-container" id="main-menu-wrapper" style="height: 860px;">
        <ul class="wraplist" style="height: auto;">
            <li class="menusection">Main</li>
            <li class="<?= ($menu == 'residents') ? "open" : "" ?>">
                <a href="javascript:;">
                    <i class="img">
                        <img src="{{ asset('newdesign/assets/images/5.png') }}" alt="" class="width-20">
                    </i>
                    <span class="title">Residents</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a class="" href="{{ route('home') }}">All Residents</a>
                    </li>
                    @if(auth()->user()->hasRole('admin'))
                        <li>
                            <a class="" href="{{ route('resident.add') }}">Add Resident</a>
                        </li>
                    @endif
                </ul>
            </li>

            @if(auth()->user()->hasRole('admin'))
                <li class="<?= ($menu == 'caretaker') ? "open" : "" ?>">
                    <a href="{{ route('caretaker.index') }}">
                        <i class="img">
                            <img src="{{ asset('newdesign/data/hos-dash/icons/2.png') }}" alt="" class="width-20">
                        </i>
                        <span class="title">Care Takers</span>
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('home') }}">
                        <i class="img">
                            <img src="{{ asset('newdesign/data/hos-dash/icons/2.png') }}" alt="" class="width-20">
                        </i>
                        <span class="title">Vendors</span>
                    </a>
                </li>

                <li class="<?= ($menu == 'activities') ? "open" : "" ?>">
                    <a href="javascript:;">
                        <i class="img">
                            <img src="{{ asset('newdesign/data/crypto-dash/icons/13.png') }}" alt="" class="width-20">
                        </i>
                        <span class="title">Setup</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a class="" href="{{ route('activities.index') }}">Activities</a>
                        </li>
                        <li>
                            <a class="" href="{{ route('incidences.index') }}">Incidences</a>
                        </li>
                        <li>
                            <a class="" href="{{ route('medications.index') }}">Medications</a>
                        </li>
                        <li>
                            <a class="" href="{{ route('bodyharmcomments.index') }}">Body harm Comments</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
            <div class="ps-scrollbar-x" style="left: 0px; width: 0px;">
            </div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
            <div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div>
        </div>
    </div>
    <!-- MAIN MENU - END -->
</div>