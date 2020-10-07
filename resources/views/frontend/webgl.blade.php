@extends('layouts.app3d')

@section('content')
    <!-- START CONTENT -->
		<div id="container"></div>
	<!-- END CONTENT -->
@stop

@section('script')
	<script type="module" src="{{ asset('js/3d.js') }}"></script>
@endsection