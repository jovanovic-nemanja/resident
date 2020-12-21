@extends('layouts.appsecond', ['menu' => 'switchreminder'])

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
                <h1 class="title">Enable/Disable Notification </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left">Enable/Disable Notification</h2>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-xs-12">
                        @if($result)
                            <a href="" onclick="event.preventDefault(); document.getElementById('enable-form').submit();" class="btn btn-primary">Enable</a>

                            <form id="enable-form" action="{{ route('switchreminder.destroy', $result->id) }}" method="POST" style="display: none;">
                                <input type="hidden" name="_method" value="delete">
                                @csrf
                            </form>
                        @else
                            <a href="" onclick="event.preventDefault(); document.getElementById('disable-form').submit();" class="btn btn-primary">Disable</a>

                            <form id="disable-form" action="{{ route('switchreminder.store') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop