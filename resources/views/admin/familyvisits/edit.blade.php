@extends('layouts.appsecond', ['menu' => 'familyvisits'])

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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Edit Family Visit</h2>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('familyvisit.indexfamilyvisit', $result->resident) }}" class="text-muted">Family Visits &nbsp;</a>
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
                        <form action="{{ route('familyvisit.update', $result->id) }}" method="POST">
                            @csrf

                            <input type="hidden" name="_method" value="put">

                            <div class="form-group {{ $errors->has('sign_date') ? 'has-error' : '' }}">
                                <label class="col-form-label">Date</label>
                                <div class="controls">
                                    <input type="datetime-local" name="sign_date" class="form-control sign_date" id="sign_date" required value="{{ $result->sign_date }}" />
                                </div>
                                @if ($errors->has('sign_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sign_date') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('relation') ? 'has-error' : '' }}">
                                <label class="col-form-label">Type</label>
                                <div class="controls">
                                    <select class="form-control" name="relation" required>
                                        <option value="">Choose...</option>
                                        @if($relations)
                                            @foreach($relations as $rl)
                                                <option value="{{ $rl->id }}" <?php if($rl->id == $result->relation) { echo "selected"; } ?> >{{ $rl->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('relation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('relation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Comment</label>
                                <div class="controls">
                                    <textarea class="form-control" name="comment" rows="8" required>{{ $result->comment }}</textarea>
                                </div>
                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
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