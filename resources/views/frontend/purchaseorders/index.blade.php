@extends('layouts.dashboards')

@section('content')

<!-- Map and From Area --> 
<div class="card">
  <div class="card-body" style="padding: 5%;">
    <div class="row">
      <div class="col-12">    
        <div class="table-responsive" style="text-align: left;">
          <h3>Purchase Orders</h3><br/>
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
                  @endif
                @endauth

                <th>Purchase Status</th>
                <th>Purchase Information</th>
                <th>Product Name</th>
                <!-- <th>Alternative Product</th>
                <th>Volume</th>
                <th>Available</th>
                <th>Unit Price</th>
                <th>Alternative Price</th>
                <th>Shipping Price</th>
                <th>Shipping Description</th>
                <th>Other Charge Price</th>
                <th>Other Charge Description</th> -->
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

                      if ($quote->available == 0) {
                        $str = "Available";
                        $total_price = $quote->product_price*$quote->volume + $quote->shipping_price + $quote->other_price;
                      }else{
                        $str = "Not Available";
                        $total_price = $quote->alternative_product_price*$quote->volume + $quote->shipping_price + $quote->other_price;
                      }

                      switch ($quote->payment_status) {
                        case '1':
                          $status = "Payment Pending";
                          break;
                        case '2':
                          $status = "Payment Received";
                          break;
                        case '3':
                          $status = "Delivery Fine";
                          break;

                        default:
                          break;
                      }
                    ?>  
                  @endif

                  @if(auth()->user()->hasRole('buyer'))
                    <?php $date = date_create($quote->sign_date);
                      $dt = date_format($date, 'Y-m-d');

                      if ($quote->available == 0) {
                        $str = "Available";
                        $total_price = $quote->product_price*$quote->volume + $quote->shipping_price + $quote->other_price;
                      }else{
                        $str = "Not Available";
                        $total_price = $quote->alternative_product_price*$quote->volume + $quote->shipping_price + $quote->other_price;
                      }

                      switch ($quote->payment_status) {
                        case '1':
                          $status = "Payment Pending";
                          break;
                        case '2':
                          $status = "Delivery Pending";
                          break;
                        case '3':
                          $status = "Delivery Fine";
                          break;

                        default:
                          break;
                      }
                    ?> 
                  @endif
                @endauth
                <tr>
                  <td style="vertical-align: middle;">{{ $dt }}</td>
                  
                  @if(auth()->user()->hasRole('seller'))
                  @elseif(auth()->user()->hasRole('buyer'))
                    <td style="vertical-align: middle;"><a href="{{ url('/purchaseorders/userreview', $quote->sender) }}" id="{{ $quote->sender }}">{{ $quote->username }}</a></td>
                  @endif
                  
                  <td style="vertical-align: middle;">{{ $status }}</td>
                  <td style="vertical-align: middle;">{{ $quote->payment_information }}</td>
                  <td style="vertical-align: middle;">{{ $quote->product_name }}</td>
                  <!-- <td style="vertical-align: middle;">{{ $quote->alternative_product }}</td>
                  <td style="vertical-align: middle;">{{ $quote->volume }}</td>
                  <td style="vertical-align: middle;">{{ $str }}</td>
                  <td style="vertical-align: middle;">{{ $quote->product_price }}</td>
                  <td style="vertical-align: middle;">{{ $quote->alternative_product_price }}</td>
                  <td style="vertical-align: middle;">{{ $quote->shipping_price }}</td>         
                  <td style="vertical-align: middle;">{{ $quote->shipping_desc }}</td>         
                  <td style="vertical-align: middle;">{{ $quote->other_price }}</td>         
                  <td style="vertical-align: middle;">{{ $quote->other_price_desc }}</td>       -->   
                  <td style="vertical-align: middle;"><?= number_format(round($total_price, 3, PHP_ROUND_HALF_UP), 2); ?></td>

                  @if($user_status == 0)
                    <td style="vertical-align: middle;">
                      @if(auth()->user()->hasRole('buyer'))
                        @if($quote->payment_status == 1)
                          <a class="btn btn-success" style="color: #fff; cursor: not-allowed;">Payment Pending</a>
                        @elseif($quote->payment_status == 2)
                          <a class="btn btn-success" href="{{ url('/purchaseorders/paymentchange', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Payment Change</a>
                        @elseif($quote->payment_status == 3)
                          <a class="btn btn-success" href="{{ url('/purchaseorders/addreview', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Add Review</a>
                        @endif

                        <a class="btn btn-primary" href="{{ url('/purchaseorders/comments', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Comments</a>
                      @endif
                      @if(auth()->user()->hasRole('seller'))
                        @if($quote->payment_status == 1)
                          <a class="btn btn-success" href="{{ url('/purchaseorders/paymentchange', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Payment Change</a>
                        @elseif($quote->payment_status == 2)
                          <a class="btn btn-success" style="color: #fff; cursor: not-allowed;">Delivery Pending</a>
                        @elseif($quote->payment_status == 3)
                          <a class="btn btn-success" href="{{ url('/purchaseorders/addreview', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Add Review</a>
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