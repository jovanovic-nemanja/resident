@extends('layouts.appsecond', ['menu' => 'residents'])

@section('content')
	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
            <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center mr-1">
                    <!--begin::Mobile Toggle-->
                    <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                        <span></span>
                    </button>
                    <!--end::Mobile Toggle-->
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Quick Report (Resident's Profile) </h2>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-muted">Home</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Profile 4-->
                <div class="d-flex flex-row">
                    <!--begin::Aside-->
                    <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Body-->
                            <div class="card-body pt-4">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown dropdown-inline">
                                        <br>
                                    </div>
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::User-->
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                        @if($user->profile_logo)
                                            <div class="symbol-label" style="background-image:url('{{ asset('uploads/').'/'.$user->profile_logo }}')"></div>
                                            <i class="symbol-badge bg-success"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <a class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ $user->firstname." ".$user->lastname }}</a>
                                        <div class="mt-2">
                                            
                                        </div>
                                    </div>
                                </div>
                                <!--end::User-->
                                <!--begin::Contact-->
                                <div class="pt-8 pb-6">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold mr-2">Email:</span>
                                        <a class="text-muted text-hover-primary custom_a_tag">{{ $user->email }}</a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold mr-2">Phone:</span>
                                        <span class="text-muted">{{ $user->phone_number }}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="font-weight-bold mr-2">Location:</span>
                                        <span class="text-muted">{{ $user->street1 }}<br>{{ $user->street2 }}<br>{{ $user->city }}<br>{{ $user->zip_code }}<br>{{ $user->state }}</span>
                                    </div>
                                </div>
                                <!--end::Contact-->
                                <!--begin::Contact-->
                                <?php ($user->gender == 1) ? $gender = "Female" : $gender = "Male"; ?>
                                <div class="pb-6"><?= $gender ?> / {{ $user->birthday }}</div>
                                <!--end::Contact-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Aside-->
                    <!--begin::Content-->
                    <div class="flex-row-fluid ml-lg-8">
                        <!--begin::Advance Table Widget 8-->
                        <div class="card card-custom gutter-b">
                            <div class="row d-flex">
                                <div class="col-lg-9"></div>
                                <div class="col-lg-2 mt-5 pt-5">
                                    <a href="{{ route('resident.exportPDF', $user->id) }}" class="btn btn-block btn-sm btn-danger font-weight-bolder text-uppercase py-4">Export PDF</a>
                                </div>
                            </div>

                            <div class="card-body pt-5 pb-3 row">
                                <div class="col-lg-11 pt-5 m-5">
                                    <h4>Representatives Info</h4>
                                    <hr />

                                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Type</th>
                                                <th>Name</th>
                                                <th>Street</th>
                                                <th>City</th>
                                                <th>Zip Code</th>
                                                <th>State</th>
                                                <th>HOME PHONE</th>
                                                <th>CELL PHONE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($representatives)
                                                @foreach($representatives as $representative)
                                                    <tr>
                                                        <td>{{ $representative->id }}</td>
                                                        <td>{{ App\Representatives::getTypeasstring($representative->representative_type) }}</td>
                                                        <td>{{ $representative->firstname . " " . $representative->lastname }}</td>
                                                        <td>{{ $representative->street1." ".$representative->street2 }}</td>
                                                        <td>{{ $representative->city }}</td>
                                                        <td>{{ $representative->zip_code }}</td>
                                                        <td>{{ $representative->state }}</td>
                                                        <td>{{ $representative->home_phone }}</td>
                                                        <td>{{ $representative->cell_phone }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-body pt-5 pb-3 row">
                                <div class="col-lg-11 pt-5 m-5">
                                    <h4>Health Care Center Info</h4>
                                    <hr />

                                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_2" style="margin-top: 13px !important">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Type</th>
                                                <th>Name</th>
                                                <th>Street</th>
                                                <th>City</th>
                                                <th>CELL PHONE</th>
                                                <th>FAX</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($healthcarecenters)
                                                @foreach($healthcarecenters as $healthcarecenter)
                                                    <tr>
                                                        <td>{{ $healthcarecenter->id }}</td>
                                                        <td>{{ App\HealthCareCenters::getTypeasstring($healthcarecenter->health_care_center_type   ) }}</td>
                                                        <td>{{ $healthcarecenter->firstname . " " . $healthcarecenter->lastname }}</td>
                                                        <td>{{ $healthcarecenter->street1." ".$healthcarecenter->street2 }}</td>
                                                        <td>{{ $healthcarecenter->city }}</td>
                                                        <td>{{ $healthcarecenter->phone }}</td>
                                                        <td>{{ $healthcarecenter->fax }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-body pt-5 pb-3 row">
                                <div class="row pt-5 m-5">
                                    <h4>Settings Info</h4>

                                    <div class="row col-lg-12">
                                        @if($resident_settings)
                                            @foreach($resident_settings as $rs)
                                                <div class="col-lg-4 pt-5">
                                                    <label class="col-form-label">{{ $rs->tabName }}</label>
                                                </div>
                                                <div class="col-lg-4 pt-5">
                                                    <label class="col-form-label">{{ $rs->fieldName }}</label>
                                                </div>
                                                <div class="col-lg-4 pt-5">
                                                    <input class="form-control input-sm" disabled value="{{ $rs->typeName }}">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end::Advance Table Widget 8-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Profile 4-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@stop