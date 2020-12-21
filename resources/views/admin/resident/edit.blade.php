@extends('layouts.appsecond', ['menu' => 'manageresident'])

@section('content')
	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif
	<div class="col-xs-12">
        <div class="page-title">

            <div class="pull-left">
                <!-- PAGE HEADING TAG - START -->
                <h1 class="title">Edit Resident </h1>
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
                                <form action="{{ route('resident.update', $resident->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="_method" value="put">

                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label class="form-label">Name</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name='name' placeholder="Name" value="{{ $resident->name }}" required>
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label class="form-label">Email</label>
                                        <div class="controls">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $resident->email }}" required>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('birthday') ? 'has-error' : '' }}">
                                        <label class="form-label">Date of Birth</label>
                                        <div class="controls">
                                            <input type="date" value="{{ $resident->birthday }}" name="birthday" class="form-control datepicker" data-format="mm/dd/yyyy" required>
                                        </div>

                                        @if ($errors->has('birthday'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('birthday') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                        <label class="form-label">Gender</label>
                                        <select class="form-control" name="gender" required>
                                            <option value="male" <?php if($resident->gender == 0){echo 'selected';} ?>>Male</option>
                                            <option value="female" <?php if($resident->gender == 1){echo 'selected';} ?>>Female</option>
                                        </select>

                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">   
                                        <label class="form-label">Phone Number</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number" value="{{ $resident->phone_number }}" required> 
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
                                                <?php 
                                                    if(@$resident->profile_logo) {
                                                        $path = asset('uploads/') . "/" . $resident->profile_logo;
                                                    }else{
                                                        $path = "";
                                                    }
                                                ?>

                                                <label for="file" @click="onClick" inputId="1" style="background-image: url(<?= $path ?>);" id='preview_img'>
                                                    <i class="fa fa-plus-circle"></i>
                                                </label>
                                            </span>
                                        </div>

                                        @if ($errors->has('profile_logo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('profile_logo') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                        <label class="form-label">Address</label>
                                        <div class="controls">
                                            <textarea required class="form-control autogrow" name="address" cols="5" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 54px;">{{ $resident->address }}</textarea>
                                        </div>

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="padding-bottom-30">
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-primary gradient-blue">Save</button>
                                            <a href="{{ route('admin.general.redirectBack') }}" class="btn">Cancel</a>
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