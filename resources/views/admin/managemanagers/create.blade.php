@extends('layouts.dashboards')

@section('content')
<div class="card">
  	<div class="card-body" style="padding: 5%;">
        <div class="row">
          	<div class="col-12">
				<form action="{{ route('managemanagers.store') }}" method="POST">
					@csrf
					<h4> Create Manager </h4>
					<br>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
				                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required>
				                <span class="glyphicon glyphicon-user form-control-feedback"></span>
				                @if ($errors->has('name'))
				                    <span class="help-block">
				                        <strong>{{ $errors->first('name') }}</strong>
				                    </span>
				                @endif
				            </div>  
				            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
				                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
				                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				                @if ($errors->has('email'))
				                    <span class="help-block">
				                        <strong>{{ $errors->first('email') }}</strong>
				                    </span>
				                @endif
				            </div>
				            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">   
				                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}" required> 
				                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
				                @if ($errors->has('password'))
				                    <span class="help-block">
				                        <strong>{{ $errors->first('password') }}</strong>
				                    </span>
				                @endif
				            </div>
				            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">   
				                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password Confirm" value="{{ old('password') }}" required> 
				                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
				                @if ($errors->has('password_confirmation'))
				                    <span class="help-block">
				                        <strong>{{ $errors->first('password_confirmation') }}</strong>
				                    </span>
				                @endif
				            </div>
				            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">   
				                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number" value="{{ old('phone_number') }}" required> 
				                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
				                @if ($errors->has('phone_number'))
				                    <span class="help-block">
				                        <strong>{{ $errors->first('phone_number') }}</strong>
				                    </span>
				                @endif
				            </div>
				            <div class="form-group" style="text-align: center;">
				                <button class="btn btn-primary btn-flat pull-right" type="submit">Add</button> 
				            </div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@stop