@extends('layouts.appsecond')

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
                <h1 class="title">Add Resident </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <div class="add-header-wrapper gradient-blue curved-section text-center">
            <h2 class="uppercase bold w-text">Add new Resident</h2>
            <div class="before-text">add Resident</div>
            <p class="g-text">Please add new Resident</p>
        </div>
        <div class=" bg-w">
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
                                <form action="{{ route('resident.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label class="form-label">Name</label>
                                        <div class="controls">
                                            <input type="text" value="" class="form-control" name='name' placeholder="Name" value="{{ old('name') }}" required>
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
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
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