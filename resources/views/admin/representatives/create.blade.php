@extends('layouts.appsecond', ['menu' => 'representatives'])

@section('content')
    @if(session('flash'))
        <div class="alert alert-primary">
            {{ session('flash') }}
        </div>
    @endif

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
            <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Add Resident Representative</h5>
                    <!--end::Title-->
                    
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-muted">Home &nbsp;</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->

                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Search Form-->
                    <div class="d-flex align-items-center" id="kt_subheader_search">
                        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter Resident Representative Info and submit</span>
                    </div>
                    <!--end::Search Form-->
                </div>
                <!--end::Details-->
            </div>
        </div>
        <!--end::Subheader-->
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <!--begin::Details-->
                    <div class="d-flex mb-9">
                        <!--begin: Pic-->
                        <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                            <div class="symbol symbol-50 symbol-lg-120">
                                <img src="{{ asset('uploads/').'/'.$user->profile_logo }}" alt="image" class="custom_img_tag">
                            </div>
                            <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between flex-wrap mt-1">
                                <div class="d-flex mr-3">
                                    <a href="{{ route('resident.show', $user->id) }}" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $user->firstname }}</a>
                                    <a href="{{ route('resident.show', $user->id) }}">
                                        <i class="flaticon2-correct text-success font-size-h5"></i>
                                    </a>
                                </div>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                </div>
            </div>
        </div>

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom card-transparent">
                    <div class="card-body p-0">
                        <!--begin::Wizard-->
                        <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
                            <!--begin::Card-->
                            <div class="card card-custom card-shadowless rounded-top-0">
                                <!--begin::Body-->
                                <div class="card-body p-0">
                                    <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                        <div class="col-xl-12 col-xxl-10">
                                            <!--begin::Wizard Form-->
                                            <form class="form" id="kt_form" action="{{ route('representative.store') }}" method="POST">
                                                @csrf

                                                <input type="hidden" name="resident" value="{{ $resident }}">

                                                <div class="row justify-content-center">
                                                    <div class="col-xl-9">
                                                        <!--begin::Wizard Step 1-->
                                                        <div class="my-5 step" data-wizard-type="step-content" data-type-status="current">
                                                            <h5 class="text-dark font-weight-bold mb-10">Resident Representative's Info:</h5>

                                                            <div class="form-group row {{ $errors->has('representative_type') ? 'has-error' : '' }}">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">Type<span style="color: red;">*</span> </label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control representative_type" name="representative_type" required>
                                                                        @if($types)
                                                                            @foreach($types as $type)
                                                                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>

                                                                <div class="fv-plugins-message-container"></div>

                                                                @if ($errors->has('representative_type'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('representative_type') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            <!--begin::Group-->
                                                            <div class="form-group row {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">First Name<span style="color: red;">*</span> </label>
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
                                                                <label class="col-xl-3 col-lg-3 col-form-label">Last Name<span style="color: red;">*</span> </label>
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
                                                            <div class="form-group row {{ $errors->has('street1') ? 'has-error' : '' }}">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">Street<span style="color: red;">*</span></label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="input-group input-group-solid input-group-lg">
                                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="street1" placeholder="Street" />
                                                                    </div>
                                                                </div>

                                                                <div class="fv-plugins-message-container"></div>

                                                                @if ($errors->has('street1'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('street1') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <!--end::Group-->

                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <div class="col-xl-3 col-lg-3"></div>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="input-group input-group-solid input-group-lg">
                                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="street2" />
                                                                    </div>
                                                                </div>

                                                                <div class="fv-plugins-message-container"></div>
                                                            </div>
                                                            <!--end::Group-->

                                                            <!--begin::Group-->
                                                            <div class="form-group row {{ $errors->has('city') ? 'has-error' : '' }}">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">City<span style="color: red;">*</span></label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="input-group input-group-solid input-group-lg">
                                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="city" placeholder="City" />
                                                                    </div>
                                                                </div>

                                                                <div class="fv-plugins-message-container"></div>

                                                                @if ($errors->has('city'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('city') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <!--end::Group-->

                                                            <!--begin::Group-->
                                                            <div class="form-group row {{ $errors->has('zip_code') ? 'has-error' : '' }}">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">Zip Code<span style="color: red;">*</span></label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="input-group input-group-solid input-group-lg">
                                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="zip_code" placeholder="Zip Code" />
                                                                    </div>
                                                                </div>

                                                                <div class="fv-plugins-message-container"></div>

                                                                @if ($errors->has('zip_code'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <!--end::Group-->

                                                            <!--begin::Group-->
                                                            <div class="form-group row {{ $errors->has('state') ? 'has-error' : '' }}">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">State<span style="color: red;">*</span></label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="input-group input-group-solid input-group-lg">
                                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="state" placeholder="State" />
                                                                    </div>
                                                                </div>

                                                                <div class="fv-plugins-message-container"></div>

                                                                @if ($errors->has('state'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('state') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <!--end::Group-->

                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">HOME PHONE </label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control form-control-solid form-control-lg" name="home_phone" type="text" />
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->

                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">CELL PHONE </label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control form-control-solid form-control-lg" name="cell_phone" type="text" />
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                        </div>
                                                        <!--end::Wizard Step 1-->
                                                        
                                                        <!--begin::Wizard Actions-->
                                                        <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                                            <div>
                                                                <button type="button" class="btn btn-success" data-wizard-type="action-submit" style="display: initial!important;">Submit</button>

                                                                <a href="{{ route('representative.indexrepresentative', $resident) }}" class="btn btn-danger">Cancel</a>
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
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@stop

@section('script')
    <script src="{{ asset('finaldesign/assets/js/pages/custom/user/add-representative.js') }}"></script>
@endsection