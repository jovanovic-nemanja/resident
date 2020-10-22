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
                <h1 class="title">Add Activity </h1>
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
                                <form action="{{ route('activities.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                        <label class="form-label">Type</label>
                                        <div class="controls">
                                            <select class="form-control" name="type" required>
                                                <option value="">Choose Type</option>
                                                <option value="1">Primary ADL</option>
                                                <option value="2">Secondary ADL</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                        <label class="form-label">Title</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name='title' placeholder="Title" value="{{ old('title') }}" required>
                                        </div>
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Comments</label>
                                        <div class="controls">
                                            <input type="text" name="comments" class="form-control" placeholder="Comments" id="tags">
                                        </div>
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