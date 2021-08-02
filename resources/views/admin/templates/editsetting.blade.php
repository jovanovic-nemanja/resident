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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Edit Setting</h2>
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
                        <form action="{{ route('templates.updatesetting', $result->id) }}" method="POST">
                            @csrf

                            <input type="hidden" name="_method" value="put">

                            <input type="hidden" name="template_id" value="{{ $templateID }}" />
                            <input type="hidden" name="setting_type" value="11" />

                            <div class="form-group {{ $errors->has('tab_id') ? 'has-error' : '' }}">
                                <label class="col-form-label">Tabs</label>
                                <div class="controls">
                                    <select class="form-control" name="tab_id" required>
                                        <option value="">Choose...</option>
                                        @if($setting_tabs)
                                            @foreach($setting_tabs as $st)
                                                <option value="{{ $st->id }}" <?php if($st->id == $result->tab_id) {echo "selected";} ?>>{{ $st->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('tab_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tab_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mt-4 field-form">
                                <div class="border pl-10 pr-10">
                                    <div class="form-group pt-2 {{ $errors->has('fieldName') ? 'has-error' : '' }}">
                                        <label class="col-form-label">Field Name</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="fieldName" placeholder="Field Name" required value="{{ $result->fieldName }}" />
                                        </div>

                                        @if ($errors->has('fieldName'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fieldName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('fieldValue') ? 'has-error' : '' }}">
                                        <label class="col-form-label">Field Type Value</label>
                                        <div class="controls field_type_input_area">
                                            @if($fieldtypes)
                                                @foreach($fieldtypes as $fieldtype)
                                                    <input type="text" class="form-control initial_type" name="fieldValue[]" placeholder="Field Type Value" required value="{{ $fieldtype->typeName }}" />
                                                    <br>
                                                @endforeach
                                            @endif
                                        </div>

                                        @if ($errors->has('fieldValue'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fieldValue') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="padding-bottom-30" style="text-align: center;">
                                <div class="">
                                    <button type="submit" class="btn btn-primary gradient-blue submit_btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@stop