@extends('layouts.appsecond', ['menu' => 'clone'])

@section('content')
	@if(session('flash'))
		<div class="alert alert-success">
			{{ session('flash') }}
		</div>
	@endif

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
            <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Templates</h2>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-muted">Home &nbsp;</a>
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
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Templates</h3>
                        </div>
                        <div class="card-toolbar">
                            <input type="hidden" name="" id="route" value="{{ route('clone.cloneSettings') }}" />
                        </div>
                    </div>
                        
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($templates) {
                                        $i = 1;
                                        foreach($templates as $template) { ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    {{ $template->name }}
                                                </td>
                                                <td>{{ $template->sign_date }}</td>
                                                <td>
                                                    <a href="{{ route('clone.show', $template->id) }}" class="btn btn-success">View</a>
                                                    <button type="button" data-toggle="modal" data-target="#cloneModal-{{ $template->id }}" class="btn btn-primary clone--modal_btn" title="Clone">Clone</button>

                                                    <!-- Modal-->
                                                    <div class="modal fade cloneModal" id="cloneModal-{{ $template->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm to clone the template</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                                    </button>
                                                                    <input type="hidden" name="template_id" value="{{ $template->id }}" class="modal_template_id" />
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to clone that as your settings? <br> If yes, that will be cloned with your settings and you wouldn't revert it again.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">No</button>
                                                                    <button type="button" class="btn btn-primary font-weight-bold" onclick="event.stopPropagation(); event.preventDefault(); showSwal('clone-msg', '{{$template->id}}')">Yes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                <?php $i++; } }else{ ?>

                                <?php } ?>
                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

    <!-- Modal-->
    <div class="modal fade" id="spin-Modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="spin-Modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="overlay overlay-block">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cloning the template to your settings</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        Please wait a while for cloning the settings information. <br> It can be takes some minutes.
                    </div>
                    <div class="modal-footer">
                        
                    </div>

                    <!--begin::Overlay Layer-->
                    <div class="overlay-layer bg-success-o-20">
                        <div class="spinner spinner-lg spinner-danger"></div>
                    </div>
                    <!--end::Overlay Layer-->
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        (function($) {
            showSwal = function(type, value) {
                'use strict';
                if (type === 'clone-msg') {
                    $('.cloneModal').hide();
                    $('.cloneModal').removeClass('show');
                    $('#spin-Modal').show();
                    $('#spin-Modal').addClass('show');
                    var url = $('#route').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: url,
                        type: 'post',
                        data: { 'template_id' : value },
                        success: function(result, status) {
                            if(status == "success") {
                                window.location.href = result;
                            }
                        }
                    })
                }
            }
        })(jQuery);
    </script>
@endsection