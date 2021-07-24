@extends('layouts.applogin')

@section('content')
    
    <!--begin::Aside-->
    <div class="login-aside d-flex flex-column flex-row-auto">
        <!--begin::Aside Bottom-->
        <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center align-items-center justify-content-center">
            <a href="{{ route('home') }}" class="text-center mb-10">
                <img src="{{ asset('images/logo1.jpg') }}" class="" alt="" style="width: 100%; height: 100%;" />
            </a>
        </div>
        <!--end::Aside Bottom-->
    </div>
    <!--begin::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
        <!--begin::Content body-->
        <div>
            <!--begin::Wizard-->
            <div id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
                <!--begin::Card-->
                <div class="card card-custom card-shadowless rounded-top-0">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        <div class="row justify-content-center">
                            <div class="col-xl-12 col-xxl-10">
                                <!--begin::Wizard Form-->
                                <form class="form" id="kt_form" action="{{ url(config('adminlte.register_url', 'register')) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row justify-content-center">
                                        <div class="col-xl-9">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-type-status="current">
                                                <h5 class="text-dark font-weight-bold mb-10">Health Care Facility's Profile Details:</h5>
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label text-left">Logo</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="image-input image-input-outline" id="kt_user_add_avatar">
                                                            <div class="image-input-wrapper"></div>
                                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                                <input type="file" name="profile_logo" accept=".png, .jpg, .jpeg" />
                                                                <input type="hidden" name="profile_avatar_remove" />
                                                            </label>
                                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row {{ $errors->has('clinic_name') ? 'has-error' : '' }}">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Clinic Name</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="clinic_name" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>

                                                    @if ($errors->has('clinic_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('clinic_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="firstname" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>

                                                    @if ($errors->has('firstname'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('firstname') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="lastname" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>

                                                    @if ($errors->has('lastname'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('lastname') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row {{ $errors->has('username') ? 'has-error' : '' }}">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">UserName</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" id="username" name="username" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>

                                                    @if ($errors->has('username'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="la la-at"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="email" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <!--end::Group-->
                                                
                                                <!--begin::Group-->
                                                <div class="form-group row {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Phone Number</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="phone_number" placeholder="Phone Number" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>

                                                    @if ($errors->has('phone_number'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Password</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="password" type="password" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Password Confirm</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="password_confirmation" type="password" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>

                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <!--end::Group-->
                                            </div>
                                            <!--end::Wizard Step 1-->
                                            
                                            <!--begin::Wizard Actions-->
                                            <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                                <div>
                                                    <button type="button" class="btn btn-success" data-wizard-type="action-submit" style="display: initial!important;">Submit</button>

                                                    <a href="{{ route('admin.general.redirectBack') }}" class="btn btn-danger">Cancel</a>
                                                </div>
                                            </div>
                                            <!--end::Wizard Actions-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Wizard-->
        </div>
        <!--end::Content body-->
        <!--begin::Content footer-->
        <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0 mt-10">
            <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                <span class="mr-1"><?= date('Y'); ?>©</span>
                <a href="https://solarisdubai.com/" target="_blank" class="text-dark-75 text-hover-primary">Powered by Solaris Dubai</a>
            </div>
        </div>
        <!--end::Content footer-->
    </div>
    <!--end::Content-->
@stop
@section('script')
    <script src="{{ asset('finaldesign/assets/js/pages/custom/user/add-clinic-owner.js') }}"></script>
@endsection