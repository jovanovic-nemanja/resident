@extends('layouts.appsecond', ['menu' => 'templates'])

@section('content')

	@if(session('flash'))
		<div class="alert alert-primary">
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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Add Setting</h2>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('templates.viewTemplate', $templateID) }}" class="text-muted">Back &nbsp;</a>
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
                    <div class="card-body">
                        <div id="settings_form">
                            <div class="form-group pb-5">
                                <label class="col-form-label">Tabs</label>
                                <div class="controls">
                                    <select class="form-control tabs-control-dropdown" id="tabs-control-dropdown">
                                        @if($setting_tabs)
                                            @foreach($setting_tabs as $st)
                                                <option value="{{ $st->id }}">{{ $st->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="template_id" value="{{ $templateID }}" id="template_id" />

                            <div class="form_area"></div>

                            <button class="btn btn-warning add_more_field mr-2 mt-5" type="button">Add Field</button>
                        </div>

                        <div class="padding-bottom-30" style="text-align: center;">
                            <div class="">
                                <button type="button" class="btn btn-primary gradient-blue validate_btn">Submit</button>
                            </div>
                        </div>
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
    <script src="{{ asset('js/settings-admin.js') }}"></script>
@endsection