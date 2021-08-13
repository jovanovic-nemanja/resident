@extends('layouts.appsecond', ['menu' => 'clinicowners'])

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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Report of {{ $facility->clinic_name }} </h2>
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
                                </div>
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
                                    <!-- <button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-primary delete--modal_btn" title="Delete Facility">Delete Facility</button>

                                    <input type="hidden" name="" id="route" value="{{ route('facility.deleteFacility') }}" /> -->

                                    <!-- Modal-->
                                    <!-- <div class="modal fade deleteModal" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm to delete the Facility</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                    </button>
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}" class="modal_user_id" />
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this facility? <br> If yes, that will be removed to our records permanently.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-primary font-weight-bold" onclick="event.stopPropagation(); event.preventDefault(); showSwal('delete-msg', '{{$user->id}}')">Yes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- End Modal -->
                                </div>
                            </div>

                            <div class="card-body pt-5 pb-3 row">
                                <div class="pt-5 m-5">
                                    <h4>Residents Info</h4>
                                    <hr />

                                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Email</th>
                                                <th>Birthday</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Photo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if(@$residents) {
                                                    $i = 1;
                                                    foreach($residents as $resident) { ?>
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $resident->firstname }}</td>
                                                            <td>{{ App\User::getGender($resident->gender) }}</td>
                                                            <td>
                                                                <div class="">
                                                                    <h6><?= $resident->email; ?></h6>
                                                                </div>
                                                            </td>
                                                            <td>{{ $resident->birthday }}</td>
                                                            <td>{{ $resident->street1." ".$resident->street2." ".$resident->city }}</td>
                                                            <td>
                                                                <span class="badge round-primary">{{ $resident->phone_number }}</span>
                                                            </td>
                                                            <td>
                                                                @if($resident->profile_logo)
                                                                    <div class="symbol symbol-circle">
                                                                        <img src="{{ asset('uploads/').'/'.$resident->profile_logo }}" class="rad-50 center-block custom_img_tag" alt="">
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                            <?php $i++; } }else{ ?>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-body pt-5 pb-3 row">
                                <div class="pt-5 m-5">
                                    <h4>Caregivers Info</h4>
                                    <hr />

                                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_1" style="margin-top: 13px !important">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Email Address</th>
                                                <th>Phone Number</th>
                                                <th>Profile_photo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if(@$caretakers) {
                                                    $i = 1;
                                                    foreach($caretakers as $caretaker) { ?>
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $caretaker->firstname }}</td>
                                                            <td>{{ $caretaker->username }}</td>
                                                            <td>
                                                                <div class="">
                                                                    <h6><?= $caretaker->email; ?></h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span class="badge round-primary">{{ $caretaker->phone_number }}</span>
                                                            </td>
                                                            <td>
                                                                @if($caretaker->profile_logo)
                                                                    <div class="symbol symbol-circle">
                                                                        <img src="{{ asset('uploads/').'/'.$caretaker->profile_logo }}" class="rad-50 center-block custom_img_tag" alt="">
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                            <?php $i++; } }else{ ?>

                                            <?php } ?>
                                        </tbody>
                                    </table>
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

    <!-- Modal-->
    <!-- <div class="modal fade" id="spin-Modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="spin-Modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="overlay overlay-block">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deleting the facility to our records.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        Please wait a while for deleting to our records. <br> It can be takes some minutes.
                    </div>
                    <div class="modal-footer">
                        
                    </div>

                    <div class="overlay-layer bg-success-o-20">
                        <div class="spinner spinner-lg spinner-danger"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Modal-->
@stop

@section('script')
    <script type="text/javascript">
        // (function($) {
        //     showSwal = function(type, value) {
        //         'use strict';
        //         if (type === 'delete-msg') {
        //             $('.deleteModal').hide();
        //             $('.deleteModal').removeClass('show');
        //             $('#spin-Modal').show();
        //             $('#spin-Modal').addClass('show');
        //             var url = $('#route').val();

        //             $.ajaxSetup({
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 }
        //             });

        //             $.ajax({
        //                 url: url,
        //                 type: 'post',
        //                 data: { 'user_id' : value },
        //                 success: function(result, status) {
        //                     if(result.status == "success") {

        //                         var mes = result.msg;
        //                         var title = "Delete Facility Result...";
        //                         toastr.options = {
        //                             "closeButton": true,
        //                             "debug": false,
        //                             "newestOnTop": false,
        //                             "progressBar": false,
        //                             "positionClass": "toast-top-right",
        //                             "onclick": null,
        //                             "showDuration": "2000",
        //                             "hideDuration": "2000",
        //                             "timeOut": "1000",
        //                             "extendedTimeOut": "5000",
        //                         };
        //                         toastr.error(mes, title); //info, success, warning, error

        //                         // setTimeout(function () {

        //                         //     window.location.href = result.redirectLink;

        //                         // }, 2000);
        //                     }
        //                 }
        //             })
        //         }
        //     }
        // })(jQuery);
    </script>
@endsection