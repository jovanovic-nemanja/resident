@extends('layouts.appsecond', ['menu' => 'activities'])

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
                <h1 class="title">Add Reminder Config </h1>
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
                                <form action="{{ route('reminderconfigs.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group {{ $errors->has('minutes') ? 'has-error' : '' }}">
                                        <label class="form-label">Minutes</label>
                                        <div class="controls">
                                            <input type="number" class="form-control" name='minutes' placeholder="Minutes" value="{{ old('minutes') }}" required>
                                        </div>
                                        @if ($errors->has('minutes'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('minutes') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="padding-bottom-30">
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-primary gradient-blue">Save</button>
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

</script>
@endsection