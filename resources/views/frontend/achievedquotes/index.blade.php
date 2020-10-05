@extends('layouts.dashboards')

@section('content')

<!-- Map and From Area --> 
<div class="card">
  <div class="card-body" style="padding: 5%;">
    <div class="row">
      <div class="col-12">  
        <div class="table-responsive" style="text-align: left;">
          <h3>Achieved Quotes</h3><br/>
          @if($user_status == 1)
            <p style="color: red;">Your account was blocked by admin!</p>
          @endif
          <br>
          <table id="order-listing" class="table">
            <thead>
              <tr>
                <th>Purchase Date</th>
                <th>Product Name</th>
                <th>Alternative Product Name</th>
                <th>Volume</th>
                <th>Available</th>
                <th>Product Price</th>
                <th>Alternative Product Price</th>
                <th>Shipping Price</th>
                <th>Shipping Description</th>
                <th>Other Charge Price</th>
                <th>Other Charge Description</th>
                <th>Total Price</th>
                @if($user_status == 0)
                  <!-- <th>Actions</th> -->
                @endif

                @if($user_status == 1)
                @endif
              </tr>
            </thead>
                  
            <tbody>
              @foreach($quotes as $quote)
                <?php $date = date_create($quote->sign_date);
                    $dt = date_format($date, 'Y-m-d');

                    if ($quote->available == 0) {
                      $str = "Available";
                      $total_price = $quote->product_price*$quote->volume + $quote->shipping_price + $quote->other_price;
                    }else{
                      $str = "Not Available";
                      $total_price = $quote->alternative_product_price*$quote->volume + $quote->shipping_price + $quote->other_price;
                    }
                  ?>
                <tr>
                  <td style="vertical-align: middle;">{{ $dt }}</td>
                  <td style="vertical-align: middle;">{{ $quote->product_name }}</td>
                  <td style="vertical-align: middle;">{{ $quote->alternative_product }}</td>
                  <td style="vertical-align: middle;">{{ $quote->volume }}</td>
                  <td style="vertical-align: middle;">{{ $str }}</td>
                  <td style="vertical-align: middle;">{{ $quote->product_price }}</td>
                  <td style="vertical-align: middle;">{{ $quote->alternative_product_price }}</td>
                  <td style="vertical-align: middle;">{{ $quote->shipping_price }}</td>         
                  <td style="vertical-align: middle;">{{ $quote->shipping_desc }}</td>         
                  <td style="vertical-align: middle;">{{ $quote->other_price }}</td>         
                  <td style="vertical-align: middle;">{{ $quote->other_price_desc }}</td>         
                  <td style="vertical-align: middle;"><?= $total_price ?></td>

                  @if($user_status == 0)
                    <!-- <td style="vertical-align: middle;">
                      <a class="btn btn-success" href="{{ url('/purchaseorders/detailview', $quote->main_id) }}" id="{{ $quote->main_id }}" style="color: #fff; font-size: medium;">Detail</a>
                    </td> -->
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