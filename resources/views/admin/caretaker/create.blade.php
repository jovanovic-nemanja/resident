@extends('layouts.appsecond', ['menu' => 'caretaker'])

@section('content')
    <style>
        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .inputfile + label {
            font-size: 1.25em;
            font-weight: 700;
            color: white;
            background-color: #E9ECEF;
            padding: 50px;
            display: inline-block;
            cursor: pointer;
            background-size: cover;
        }

        .inputfile:focus + label,
        .inputfile + label:hover {
            background-color: #38C172ed;
        }

        .hidden {
            display: none !important;
        }
    </style>

	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif
	<div class="col-xs-12">
        <div class="page-title">

            <div class="pull-left">
                <!-- PAGE HEADING TAG - START -->
                <h1 class="title">Add Care taker </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <div class=" bg-w" style="padding-top: 1%;">
            <div class="col-lg-10 col-lg-offset-1 col-xs-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Basic Info</h2>
                        <div class="actions panel_actions pull-right">
                            <a class="box_toggle fa fa-chevron-down"></a>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <form action="{{ route('caretaker.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label class="form-label">Name</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name='name' placeholder="Name" value="{{ old('name') }}" required>
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                        <label class="form-label">Username</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name='username' placeholder="Username" value="{{ old('username') }}" required>
                                        </div>
                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label class="form-label">Email</label>
                                        <div class="controls">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label class="form-label">Password</label>
                                        <div class="controls">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}" required> 
                                        </div>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">   
                                        <label class="form-label">Password Confirm</label>
                                        <div class="controls">
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password Confirm" value="{{ old('password') }}" required> 
                                        </div>
                                        
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">   
                                        <label class="form-label">Phone Number</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number" value="{{ old('phone_number') }}" required> 
                                        </div>
                                        
                                        @if ($errors->has('phone_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group {{ $errors->has('profile_logo') ? 'has-error' : '' }}">
                                        <label for="name" class="form-label">{{ __('Profile Image') }}</label>
                                        <div class="controls">
                                            <span>
                                                <input type="file" name="profile_logo" id="file" onchange="loadPreview(this, 'preview_img');" class="inputfile">
                                                <label for="file" @click="onClick" inputId="1" style="" id='preview_img'><i class="fa fa-plus-circle"></i></label>
                                            </span>
                                        </div>

                                        @if ($errors->has('profile_logo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('profile_logo') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="padding-bottom-30">
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-primary gradient-blue">Save</button>
                                            <button type="button" class="btn">Cancel</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    function loadPreview(input, id) {
        id = "#" + id;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var path = "background-image: " + "url('" + e.target.result + "')";
                $(id).attr('style', path);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection