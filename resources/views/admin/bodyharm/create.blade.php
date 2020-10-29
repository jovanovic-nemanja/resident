@extends('layouts.app3d', ['menu' => 'residents'])

@section('content')
    <!-- START CONTENT -->
		<div id="container"></div>
		<button id="takeScreenshot" style="top: 10%; position: absolute; right: 2%;" class="btn btn-white">Screen Shot</button>

		<!-- modal start -->
        <div class="modal fade col-xs-12" id="commentsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                	<form action="{{ route('bodyharm.store') }}" method="POST" enctype="multipart/form-data">
                		@csrf

	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                        <h4 class="modal-title">Body Harm</h4>
	                    </div>

	                    <div class="modal-body">
	                    	<select name="comment" id="comment" class="form-control comment">
	                    		
	                    	</select>

	                    	<br>

	                    	<div class="form-group">
                                <label for="name" class="form-label">{{ __('Screen Shot') }}</label>
                                <div class="controls">
                                    <span>
                                        <input type="file" name="screenshot_3d" id="file" onchange="loadPreview(this, 'preview_img');" class="inputfile">
                                        <label for="file" @click="onClick" inputId="1" style="" id='preview_img'><i class="fa fa-plus-circle"></i></label>
                                    </span>
                                </div>
                            </div>

	                    	<input type="hidden" name="resident" value="{{ $resident }}">
	                    </div>

                        <button type="submit" class="btn btn-info save_harm" style="display: none;">Submit</button>
                   	</form>
                   	<div class="modal-footer">
                   		<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
	                   	<button type="button" id="shot" class="btn btn-info save_harm_prev">Submit</button>
                   	</div>
                </div>
            </div>
        </div>
        <!-- modal end -->

	<!-- END CONTENT -->
@stop

@section('script')
	<script type="module" src="{{ asset('js/3d.js') }}"></script>

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