@extends('layouts.dashboards')

@section('content')

<!-- Map and From Area --> 
<div class="card">
  <div class="card-body" style="padding: 5%;">
    <div class="row">
      <div class="col-12">    
        <div class="table-responsive" style="text-align: left;">
          <h3>Completed Orders</h3><br/>
          @if($user_status == 1)
            <p style="color: red;">Your account was blocked by admin!</p>
          @endif
          <br>
          <table id="order-listing" class="table">
            <thead>
              <tr>
                <th>Purchase Date</th>

                @auth
                  @if(auth()->user()->hasRole('buyer'))
                    <th>Seller Name</th>
                  @elseif(auth()->user()->hasRole('seller'))
                    <th>Buyer Name</th>
                  @endif
                @endauth

                <th>Total Price</th>
                @if($user_status == 0)
                  <th>Actions</th>
                @endif

                @if($user_status == 1)
                @endif
              </tr>
            </thead>
                  
            <tbody>
              @foreach($quotes as $quote)
                @auth
                  @if(auth()->user()->hasRole('seller'))
                    <?php $date = date_create($quote->sign_date);
                      $dt = date_format($date, 'Y-m-d');
                    ?>  
                  @endif

                  @if(auth()->user()->hasRole('buyer'))
                    <?php $date = date_create($quote->sign_date);
                      $dt = date_format($date, 'Y-m-d');
                    ?> 
                  @endif
                @endauth
                <tr>
                  <td style="vertical-align: middle;">{{ $dt }}</td>
                  
                  @if(auth()->user()->hasRole('seller'))
                    <td style="vertical-align: middle;"><a href="{{ url('/purchaseorders/userreview', $quote->buyer_id) }}" id="{{ $quote->buyer_id }}">{{ $quote->username }}</a></td>
                  @elseif(auth()->user()->hasRole('buyer'))
                    <td style="vertical-align: middle;"><a href="{{ url('/purchaseorders/userreview', $quote->sender) }}" id="{{ $quote->sender }}">{{ $quote->username }}</a></td>
                  @endif

                  <td style="vertical-align: middle;"><?= number_format(round($quote->total_price, 3, PHP_ROUND_HALF_UP), 2); ?></td>

                  @if($user_status == 0)
                    <td style="vertical-align: middle;">
                      @if(auth()->user()->hasRole('buyer'))
                        @if($quote->payment_status == 1)
                          <a class="btn btn-success" style="color: #fff; cursor: not-allowed;">Payment Pending</a>
                        @elseif($quote->payment_status == 2)
                          <a class="btn btn-success" href="{{ url('/purchaseorders/paymentchange', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Payment Change</a>
                        @elseif($quote->payment_status == 3)
                          <?php 
                            if(@$reviews[0]) {
                                $record = $reviews[0]->Isreview($quote->p_id);
                            }else{
                                $record = false;
                            }
                            
                            if ($record == true) { ?>
                              <a class="btn btn-success" href="{{ url('/purchaseorders/viewreview', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">View Review</a>  
                          <?php }else{ ?>
                            <a class="btn btn-success" href="{{ url('/purchaseorders/addreview', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Add Review</a>
                          <?php } ?>
                        @endif

                        <a class="btn btn-primary" href="{{ url('/purchaseorders/comments', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Comments</a>
                      @endif
                      @if(auth()->user()->hasRole('seller'))
                        @if($quote->payment_status == 1)
                          <a class="btn btn-success" href="{{ url('/purchaseorders/paymentchange', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Payment Change</a>
                        @elseif($quote->payment_status == 2)
                          <a class="btn btn-success" style="color: #fff; cursor: not-allowed;">Delivery Pending</a>
                        @elseif($quote->payment_status == 3)
                          <?php 
                            if(@$reviews[0]) {
                                $record = $reviews[0]->Isreview($quote->p_id);
                            }else{
                                $record = false;
                            }
                            
                            if ($record == true) { ?>
                              <a class="btn btn-success" href="{{ url('/purchaseorders/viewreview', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">View Review</a>
                          <?php }else{ ?>
                            <a class="btn btn-success" href="{{ url('/purchaseorders/addreview', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Add Review</a>
                          <?php } ?>
                        @endif

                        <a class="btn btn-primary" href="{{ url('/purchaseorders/comments', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Comments</a>
                      @endif
                    </td>
                  @endif

                  @if($user_status == 1)
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
<!-- End Map and From Area --> 
@stop