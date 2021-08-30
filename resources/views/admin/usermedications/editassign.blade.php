@extends('layouts.appsecond', ['menu' => 'residents'])

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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Assign Medication</h2>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('usermedications.indexusermedication', $result['user']->id) }}" class="text-muted">Medications &nbsp;</a>
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
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <!--begin::Details-->
                        <div class="d-flex mb-9">
                            <!--begin: Pic-->
                            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                <div class="symbol symbol-50 symbol-lg-120">
                                    <img src="{{ asset('uploads/').'/'.$result['user']->profile_logo }}" alt="image" class="custom_img_tag">
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
                                        <a href="{{ route('resident.show', $result['user']->id) }}" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $result['user']->firstname }}</a>
                                        <a href="{{ route('resident.show', $result['user']->id) }}">
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

                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Assign Medication</h3>
                        </div>
                    </div>
                        
                    <div class="card-body" id="kt_wizard">
                        <form action="{{ route('usermedications.update', $result['usermedications']->id) }}" method="POST" id="kt_form" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="assign" value="1">
                            <input type="hidden" name="resident" value="{{ $result['user']->id }}">

                            <div class="row" >
                                <div class="col-lg-3">
                                    <div class="form-group {{ $errors->has('medications') ? 'has-error' : '' }}">
                                        <label class="col-form-label">Medications</label>
                                        <select class="form-control medications" name="medications" required>
                                            <option value="">Choose Medication</option>
                                            @foreach($result['allmedications'] as $ac)
                                                <option <?php if($ac->id==$result["medication"]->id){echo 'selected';} ?> value="{{ $ac->id }}">{{ $ac->name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('medications'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('medications') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                    
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Dose</label>
                                        <input type="text" class="form-control" name='dose' placeholder="Dose" value="{{ $result['usermedications']->dose }}" id="dose">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group {{ $errors->has('units') ? 'has-error' : '' }}">
                                        <label class="col-form-label">Unit </label>
                                        <select class="form-control" id="units" name="units">
                                            <?php 
                                                foreach ($result['units'] as $unit) { ?>
                                                    <option <?php if($result['usermedications']->units == $unit['id']){echo 'selected';} ?> value="<?= $unit['id'] ?>"><?= $unit['title'] ?></option>
                                            <?php } ?>
                                        </select>

                                        @if ($errors->has('units'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('units') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                                        <label class="col-form-label">Time </label>
                                        <input type="time" class="form-control" id="time" name="time" placeholder="Time" value="{{ $result['usermedications']->time }}" required>
                                        @if ($errors->has('time'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('time') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-lg-3">
                                    <div class="form-group {{ $errors->has('start_day') ? 'has-error' : '' }}">
                                        <label class="col-form-label">Start Day</label>
                                        <input type="date" name="start_day" id="start_day" class="form-control start_day" required value="{{ $result['usermedications']->start_day }}">

                                        @if ($errors->has('start_day'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('start_day') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group {{ $errors->has('end_day') ? 'has-error' : '' }}">
                                        <label class="col-form-label">End day</label>
                                        <input type="date" name="end_day" id="end_day" class="form-control end_day" required value="{{ $result['usermedications']->end_day }}">
                                        
                                        @if ($errors->has('end_day'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('end_day') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <!--begin::Group-->
                                    <div class="form-group row {{ $errors->has('photo') ? 'has-error' : '' }}">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-left">Photo</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <?php 
                                                if(@$result['usermedications']->photo) {
                                                    $path = asset('uploads/') . "/" . $result['usermedications']->photo;
                                                }else{
                                                    $path = "";
                                                }
                                            ?>

                                            <div class="image-input image-input-outline" id="kt_medication_avatar" style="background-image: url(<?= $path ?>);">
                                                <div class="image-input-wrapper"></div>
                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change photo">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="medication_photo_remove" />
                                                </label>
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="fv-plugins-message-container"></div>

                                        @if ($errors->has('photo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('photo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <!--end::Group-->
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group {{ $errors->has('route') ? 'has-error' : '' }}">
                                        <label class="col-form-label">Route </label>
                                        <select class="form-control" id="route" name="route">
                                            <?php 
                                                foreach ($result['routes'] as $com) { ?>
                                                    <option <?php if($result['usermedications']->route == $com['id']){echo 'selected';} ?> value="<?= $com['id'] ?>"><?= $com['name'] ?></option>
                                            <?php } ?>
                                        </select>

                                        @if ($errors->has('route'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('route') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Remarks</label>
                                        <textarea class="form-control" name='remarks' placeholder="Remarks" id="remarks" rows="6">{{ $result['usermedications']->remarks }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="padding-bottom-30" style="text-align: center; padding-top: 5%;">
                                <div class="">
                                    <button type="button" data-wizard-type="action-submit" class="btn btn-primary gradient-blue">Submit</button>
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

@section('script')
<script src="{{ asset('finaldesign/assets/js/pages/custom/user/edit-assign-medication.js') }}"></script>
@endsection