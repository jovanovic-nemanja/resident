@extends('layouts.appsecond', ['menu' => 'templates'])

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
                            <a href="{{ route('templates.create') }}" class="btn btn-primary font-weight-bolder">Add</a>
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
                                                    <a href="{{ route('templates.show', $template->id) }}" class="btn btn-info" title="Edit">Edit</a>
                                                    <a href="{{ route('templates.viewTemplate', $template->id) }}" class="btn btn-success" title="View">View</a>
                                                    

                                                    <button onclick="event.stopPropagation(); event.preventDefault(); showSwal('duplicate-template', 'duplicate-template-form-{{$template->id}}')" class="btn btn-info" title="Duplicate">Duplicate</button>

                                                    <form id="duplicate-template-form-{{$template->id}}" action="{{ route('templates.duplicate') }}" method="POST" style="display: none;">
                                                        @csrf

                                                        <input type="hidden" name="template_id" value="{{ $template->id }}" />
                                                    </form>

                                                    
                                                    <button onclick="event.stopPropagation(); event.preventDefault(); showSwal('warning-message-and-cancel', 'delete-form-{{$template->id}}')" class="btn btn-primary" title="Delete">Delete</button>

                                                    <form id="delete-form-{{$template->id}}" action="{{ route('templates.destroy', $template->id) }}" method="POST" style="display: none;">
                                                        <input type="hidden" name="_method" value="delete">
                                                        @csrf
                                                    </form>
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
@stop

@section('script')
    <script type="text/javascript">
        (function($) {
            showSwal = function(type, value) {
                'use strict';
                if (type === 'warning-message-and-cancel') {
                    if(confirm('Are you sure you want to delete that into the database? If yes, that will be removed permanently.')) {
                        document.getElementById(value).submit();
                    }else{
                        console.log('cancelled');
                    }
                }if (type === 'duplicate-template') {
                    if(confirm('Are you sure you want to duplicate that into the database? If yes, that will be duplicate with same information.')) {
                        document.getElementById(value).submit();
                    }else{
                        console.log('cancelled');
                    }
                }
            }
        })(jQuery);
    </script>
@endsection