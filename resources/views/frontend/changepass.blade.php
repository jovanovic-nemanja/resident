@extends('layouts.appsecond', ['menu' => ''])

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
                    <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Change the Password</h2>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-muted">home &nbsp;</a>
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
                <form action="{{ route('account.updatePassword') }}" method="POST">
                  @csrf

                  <input type="hidden" name="_method" value="put">

                  <div class="form-group row">
						        <label for="old_password" class="col-sm-3 col-form-label">{{ __('Current Password') }}</label>
						        <div class="col-sm-9">
						          <input type="password" class="form-control" id="old_password" name="old_password" placeholder="{{ __('Current Password') }}" />
						        </div>
						        @if ($errors->has('old_password'))
                      <span class="help-block">
                        <strong>{{ $errors->first('old_password') }}</strong>
                      </span>
                    @endif
		              </div>
				              
						      <div class="form-group row">
						        <label for="password" class="col-sm-3 col-form-label">{{ __('New Password') }}</label>
						        <div class="col-sm-9">
						          <input type="password" class="form-control" id="password" name="password" required placeholder="{{ __('New Password') }}" />
						        </div>
						        @if ($errors->has('password'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
						      </div>

						      <div class="form-group row">
						        <label for="password_confirmation" class="col-sm-3 col-form-label">{{ __('Repeat New Password') }}</label>
						        <div class="col-sm-9">
						          <input type="password" class="form-control" id="password_confirmation" required name="password_confirmation" placeholder="{{ __('Repeat New Password') }}" />
						        </div>
						        @if ($errors->has('password_confirmation'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
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
@endsection