@extends('layouts.app3d', ['menu' => 'residents'])

@section('content')
    <!-- START CONTENT -->
		<div id="container"></div>

		<!-- modal start -->
        <div class="modal fade col-xs-12" id="commentsModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Body Harm Comments</h4>
                    </div>

                    <div class="modal-body">
                    	<select name="comment" id="comment" class="form-control comment">
                    		
                    	</select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->

	<!-- END CONTENT -->
@stop

@section('script')
	<script type="module" src="{{ asset('js/3d.js') }}"></script>
@endsection