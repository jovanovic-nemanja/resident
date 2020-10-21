@extends('layouts.appsecond', ['menu' => 'activities'])
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
                <h1 class="title">Add Medication </h1>
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
                                <form action="{{ route('medications.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label class="form-label">Name</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name='name' placeholder="Name" required>
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('dose') ? 'has-error' : '' }}">
                                        <label class="form-label">Dose</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name='dose' placeholder="Dose" value="{{ old('dose') }}" required>
                                        </div>
                                        @if ($errors->has('dose'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dose') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                        <label class="form-label">Photo</label>
                                        <div class="controls">
                                            <span>
                                                <input type="file" name="photo" id="file" onchange="loadPreview(this, 'preview_img');" class="inputfile">

                                                <label for="file" @click="onClick" inputId="1" style="" id='preview_img'>
                                                    <i class="fa fa-plus-circle"></i>
                                                </label>
                                            </span>
                                        </div>
                                        @if ($errors->has('photo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('photo') }}</strong>
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