@extends('layouts.product')

@section('section')
<div class="card rounded-0">
  <div class="card-body" style="padding: 5%;">
    <div class="row">
      <div class="col-md-9">
        <h3>{{ __('My Product') }}</h3>  
      </div>
      <div class="col-md-3" style="text-align: right;">
        @if($user_status == 0)
          <a class="ps-btn ps-btn--lg" href="{{ route('product.create') }}">
            Add Product
          </a>
        @endif

        @if($user_status == 1)
          <p style="color: red;">Your account was blocked by admin!</p>
        @endif
      </div>
    </div>
      
    <br>
    <div class="row">
      <div class="col-12">
        <input type="hidden" class="url" value="{{ Route('products.deleteproductsbychoosing') }}" />
				<input type="hidden" class="checkVals" />

        <div class="table-responsive" style="text-align: left;">
          <table id="order-listing" class="table">
            <thead>
              <tr>
                <th><input type='checkbox' id="selectAll" /></th>
                <th width="10%">ID</th>
                <th width="10%">Product Name</th>
                <th width="10%">Date</th>
                <th width="10%">Image</th>
                <th width="10%">Status</th>
                @if($user_status == 0)
                  <th width="5%">View</th>
                  <th width="5%">Edit</th>
                  <th width="5%">Delete</th>
                @endif

                @if($user_status == 1)
                @endif
              </tr>
            </thead>
                  
            <tbody>
              @foreach($products as $product)
                <tr>
                  <td><input type='checkbox' class='checks' name='checks' value='{{ $product->id }}' /></td>
                  <td style="vertical-align: middle;">{{ $product->id }}</td>
                  <td style="vertical-align: middle;">{{ $product->name }}</td>
                  <td style="vertical-align: middle;">{{ $product->sign_date }}</td>
                  <td style="vertical-align: middle;">
                    <img class="img-fluid" width="100" src="{{ asset('uploads/') }}/{{ $product->images->first()->url }}" alt="">
                  </td>
                  <td style="vertical-align: middle;">
                    {{ $product->getstatuesname($product->status) }}
                  </td>
                  
                  @if($user_status == 0)
                    <td style="vertical-align: middle;">
                      <a class="btn btn-success" href="{{ route('product.show', $product->slug) }}">{{ __('View') }}</a>
                    </td>
                    <td style="vertical-align: middle;">
                      <a class="btn btn-success" href="{{ route('product.edit', $product->slug) }}">{{ __('Edit') }}</a>
                    </td>
                    <td style="vertical-align: middle;">
                      <a class="btn btn-danger" href=""
                         onclick="event.preventDefault();
                                       document.getElementById('delete-form-{{$product->slug}}').submit();">
                          {{ __('Delete') }}
                      </a>
                      <form id="delete-form-{{$product->slug}}" action="{{ route('product.destroy', $product->slug) }}" method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        @csrf
                      </form>
                    </td>
                  @endif

                  @if($user_status == 1)
                    <p style="color: red;"></p>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<br>
@endsection

@section('script')
	<script>
		$(document).ready(function () {
			var alls = $('#order-listing tbody').children();

			$('body').on('click', '#selectAll', function () {
				if ($(this).hasClass('allChecked')) {
					$('input[type="checkbox"]', alls).prop('checked', false);
					
					$('.checkVals').val('');

					$('.submit_checkbox').remove();
				} else {
					$('input[type="checkbox"]', alls).prop('checked', true);
					var ids = [];

					$('#order-listing input:checked').each(function() {
						if($(this).attr('id') == 'selectAll'){

						}else 
							ids.push($(this).val());
					});

					$('.checkVals').val(ids);

					$('#order-listing_filter label').after('<button class="ps-btn submit_checkbox" style="padding: 15px 30px; margin-left: 2%;">Delete</button>');
				}
				$(this).toggleClass('allChecked');

				$('.submit_checkbox').click(function() {
					submitcheck();
				});
			})
		});

		function submitcheck() {
			var ids = $('.checkVals').val();
			if(!ids) {
				alert('There are not any chosen items now.');
				return;
			}

			var href = $('.url').val();
			
			$.ajax({
				url: href,
				type: 'GET',
				data: { ids: ids },
				success: function(result, status) {
					if(result.status == 200) {
						window.location.href = window.location.href;
					}else{
						alert(result.msg);
					}
				}
			})
		};
	</script>
@endsection