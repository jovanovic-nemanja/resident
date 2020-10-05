@extends('layouts.dashboards')

@section('content')
	
	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif
	<div class="card">
      	<div class="card-body" style="padding: 5%;">
            <div class="row">
              	<div class="col-12">
					<div class="table-responsive">
						<table id="order-listing" class="table table-bordered table-striped">
							<thead>
								<tr>
					              	<th>Request ID</th>
					              	<th>Date</th>
					              	<th>Seller Name</th>
					              	<th>Product Name</th>
					            </tr>
							</thead>

							@foreach($total as $quote)
								<?php 
									$date = date_create($quote[0]->sign_date);
				                  	$dt = date_format($date, 'Y-m-d');
				                ?>
				              	<tr role='row' data-toggle="collapse" data-target="#demo<?= $quote[0]->id ?>" class="odd accordion-toggle">
					                <td style="color: red;">
					                  	<i class="fa fa-plus"></i> {{ $quotes[0]->getRequestNumber($quote[0]->id) }}
					                </td>
					                <td style="color: red;">
					                  	{{ $dt }}
					                </td>
					                <td style="color: red;">
					                  	{{ $user[0]->getUsername($quote[0]->sender) }}
					                </td>
					                <td style="color: red;">
					                  	{{ $quote[0]->product_name }}
					                </td>
				              	</tr>
				            <tbody>
				              @foreach($quote as $qu)
				                <?php $date = date_create($qu->sign_date);
				                  	$dt = date_format($date, 'Y-m-d');
				                  	if ($qu->available == 0) {
					                    $str = "Available";
					                    $total_price = $qu->product_price*$qu->volume + $qu->shipping_price + $qu->other_price;
				                  	}else{
					                    $str = "Not Available";
					                    $total_price = $qu->alternative_product_price*$qu->volume + $qu->shipping_price + $qu->other_price;
				                  	}
				                ?>
				                <tr>
				                  <td colspan="5" class="hiddenRow" style="border-top: none; padding: 0;">
				                    <div class="accordian-body collapse" id="demo<?= $quote[0]->id ?>"> 
				                      <table class="table table-striped">
				                        <thead>
				                          	<tr>
					                            <th width="50px">No</th>
												<th>Date</th>
												<th>Product Name</th>
												<th>Total Price</th>
												<th width="150px">Action</th>
				                          	</tr>
				                        </thead>
				                        <tbody>
				                          	<?php $date = date_create($qu->sign_date);
				                              	$dt = date_format($date, 'Y-m-d');

				                              	if ($qu->available == 0) {
					                                $str = "Available";
					                                $total_price = $qu->product_price*$qu->volume + $qu->shipping_price + $qu->other_price;
				                              	}else{
					                                $str = "Not Available";
					                                $total_price = $qu->alternative_product_price*$qu->volume + $qu->shipping_price + $qu->other_price;
				                              	}
				                            ?>
				                          	<tr>
					                            <td>{{ $qu->id }}</td>
												<td>{{ $dt }}</td>
												<td><?= $qu->product_name ?></td>
												<td><?= number_format(round($qu->total_price, 3, PHP_ROUND_HALF_UP), 2); ?></td>
												<td>
													<a href="{{ url('/quote/detailview', $qu->id) }}" class="btn btn-success btn-sm btn-flat" title="Detail">
														<i class="fa fa-edit"></i>
													</a>

													<a href="{{ route('quotes.edit', $qu->id) }}" class="btn btn-danger btn-sm btn-flat" title="Delete">
														<i class="fa fa-trash"></i>
													</a>
												</td>
				                          	</tr>
				                        </tbody>
				                      </table>
				                    </div>
				                  </td>
				                </tr>
				              @endforeach
				            @endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop