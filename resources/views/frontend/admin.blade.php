@extends('layouts.appsecond', ['menu' => 'clinicowners'])

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
            <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Health Care Facility</h5>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Search Form-->
                    <div class="d-flex align-items-center" id="kt_subheader_search">
                        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?= count($clinicowners); ?> Total</span>
                        
                    </div>
                    <!--end::Search Form-->
                </div>
                <!--end::Details-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Button-->
                    <a href="#" class=""></a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    @if(auth()->user()->hasRole('clinicowner'))
                    <!-- <a href="{{ route('resident.add') }}" class="btn btn-light-primary font-weight-bold ml-2">Add Resident</a> -->
                    @endif
                    <!--end::Button-->
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Row-->
                
                <?php if(count($clinicowners) > 0) { ?>
                    <div class="row">
                        @foreach($clinicowners as $clinicowner)
                            <!--begin::Col-->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b card-stretch">
                                    <!--begin::Body-->
                                    <div class="card-body pt-4">
                                        <!--begin::Toolbar-->
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                                            </div>
                                        </div>
                                        <!--end::Toolbar-->
                                        <!--begin::User-->
                                        <div class="d-flex align-items-end mb-7">
                                            <!--begin::Pic-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Pic-->
                                                <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                                                    <div class="symbol symbol-circle symbol-lg-75">
                                                        @if(@$clinicowner->profile_logo)
                                                            <?php $path = asset('uploads/').'/'.$clinicowner->profile_logo; ?>
                                                        @else
                                                            <?php $path = asset('images/nurse.jpg'); ?>
                                                        @endif

                                                        <img src="<?= $path; ?>" class="rad-50 center-block custom_img_tag" alt="image">
                                                    </div>
                                                    <div class="symbol symbol-lg-75 symbol-circle symbol-primary d-none">
                                                        <span class="font-size-h3 font-weight-boldest">JM</span>
                                                    </div>
                                                </div>
                                                <!--end::Pic-->
                                                <!--begin::Title-->
                                                <div class="d-flex flex-column">
                                                    <a href="{{ route('home') }}" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0 custom_a_tag">{{ $clinicowner->firstname }}</a>
                                                    <span class="text-muted font-weight-bold">Clinic Owner</span>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::Desc-->
                                        <p class="mb-7"><a href="{{ route('home') }}" class="text-primary pr-1">{{ $clinicowner->birthday }}</a></p>
                                        <!--end::Desc-->
                                        <!--begin::Info-->
                                        <div class="mb-7">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-dark-75 font-weight-bolder mr-2">Email:</span>
                                                <a href="{{ route('home') }}" class="text-muted text-hover-primary custom_a_tag">{{ $clinicowner->email }}</a>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-cente my-1">
                                                <span class="text-dark-75 font-weight-bolder mr-2">Phone:</span>
                                                <a href="{{ route('home') }}" class="text-muted text-hover-primary custom_a_tag">{{ $clinicowner->phone_number }}</a>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-dark-75 font-weight-bolder mr-2">Location:</span>
                                                <span class="text-muted font-weight-bold">{{ $clinicowner->street1 }}</span>
                                            </div>
                                        </div>
                                        <!--end::Info-->

                                        @if($clinicowner->status != 1)
                                            <a href="" class="btn btn-block btn-sm btn-success font-weight-bolder text-uppercase py-4" onclick="event.preventDefault(); document.getElementById('enable-form-{{$clinicowner->id}}').submit();">Enable</a>

                                            <form id="enable-form-{{$clinicowner->id}}" action="{{ route('clinic.status') }}" method="POST" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="clinic_id" value="{{ $clinicowner->id }}">
                                            </form>
                                        @else
                                            <a class="btn btn-block btn-sm btn-default font-weight-bolder text-uppercase py-4" style="cursor: not-allowed;">Enable</a>
                                        @endif

                                        @if($clinicowner->status == 1)
                                            <a href="" class="btn btn-block btn-sm btn-danger font-weight-bolder text-uppercase py-4 mt-3" onclick="event.preventDefault(); document.getElementById('disable-form-{{$clinicowner->id}}').submit();">Disable</a>

                                            <form id="disable-form-{{$clinicowner->id}}" action="{{ route('clinic.status') }}" method="POST" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="clinic_id" value="{{ $clinicowner->id }}">
                                            </form>
                                        @else
                                            <a class="btn btn-block btn-sm btn-default font-weight-bolder text-uppercase py-4 mt-3" style="cursor: not-allowed;">Disable</a>
                                        @endif
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                        @endforeach
                    </div>
                <?php } else { ?>
                    <div style="text-align: center;">
                        <br><br>
                        <h6>There is no resident at this moment</h6>
                    </div>
                <?php } ?>        

                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@stop
