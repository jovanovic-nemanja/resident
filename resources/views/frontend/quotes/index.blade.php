@extends('layouts.dashboards')

@section('content')

<!-- Map and From Area --> 
<div class="card">
  <div class="card-body" style="padding: 5%;">
    <div class="row">
      <div class="col-12">  
        <div class="table-responsive" style="text-align: left;">
          @if(auth()->user()->hasRole('buyer'))
            <h3>My Received Quotes</h3><br/>
            @if($user_status == 1)
              <p style="color: red;">Your account was blocked by admin!</p>
            @endif
            <br>
            <table id="order-listing" class="table">
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
                      <i class="fa fa-plus"></i> {{ App\Quotes::getRequestNumber($quote[0]->request_id) }}
                    </td>
                    <td style="color: red;">
                      {{ $dt }}
                    </td>
                    <td style="color: red;">
                      {{ $user[0]->getUsername($quote[0]->seller_id) }}
                    </td>
                    <td style="color: red;">
                      {{ $quote[0]->product_name }}
                    </td>
                  </tr>
                <tbody>
                  @foreach($quote as $qu)
                    <?php $date = date_create($qu->sign_date);
                      $dt = date_format($date, 'Y-m-d');
                    ?>
                    <tr>
                      <td colspan="8" class="hiddenRow" style="border-top: none; padding: 0;">
                        <div class="accordian-body collapse" id="demo<?= $quote[0]->id ?>"> 
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Received Date</th>
                                <th>Seller Name</th>
                                <th>Product Name</th>
                                <th>Alternative Product Name</th>
                                <th>Product Price</th>
                                <th>Alternative Product Price</th>
                                <th>Total Price</th>
                                @if($user_status == 0)
                                  <th>Actions</th>
                                @endif

                                @if($user_status == 1)
                                @endif
                              </tr>
                            </thead>
                            <tbody>
                              <?php $date = date_create($qu->sign_date);
                                  $dt = date_format($date, 'Y-m-d');
                                ?>
                              <tr>
                                <td style="vertical-align: middle;">{{ $dt }}</td>
                                <td style="vertical-align: middle;">
                                  <a href="{{ url('/purchaseorders/userreview', $qu->seller_id) }}" id="{{ $qu->seller_id }}">{{ $qu->username }}</a>
                                </td>
                                <td style="vertical-align: middle;">{{ $qu->product_name }}</td>
                                <td style="vertical-align: middle;">{{ $qu->alternative_product }}</td>
                                <td style="vertical-align: middle;"><?= number_format(round($qu->product_price, 3, PHP_ROUND_HALF_UP), 2); ?></td>
                                <td style="vertical-align: middle;"><?= number_format(round($qu->alternative_product_price, 3, PHP_ROUND_HALF_UP), 2); ?></td>   
                                <td style="vertical-align: middle;"><?= number_format(round($qu->total_price, 3, PHP_ROUND_HALF_UP), 2); ?></td>

                                @if($user_status == 0)
                                  <td style="vertical-align: middle;">
                                    <a class="btn btn-success" href="{{ url('/quote/detailview', $qu->main_id) }}" id="{{ $qu->main_id }}" style="color: #fff;">Detail</a>
                                  </td>
                                @endif

                                @if($user_status == 1)
                                @endif
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                
                @endforeach
              </tbody>
            </table>
          @endif
          @if(auth()->user()->hasRole('seller'))
            <h3>My Sent Quotes</h3><br/>
            @if($user_status == 1)
              <p style="color: red;">Your account was blocked by admin!</p>
            @endif
            <br>
            <table id="order-listing" class="table">
              <thead>
                <tr>
                  <th>Request ID</th>
                  <th>Date</th>
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
                      <i class="fa fa-plus"></i> {{ App\Quotes::getRequestNumber($quote[0]->request_id) }}
                    </td>
                    <td style="color: red;">
                      {{ $dt }}
                    </td>
                    
                    <td style="color: red;">
                      {{ $quote[0]->product_name }}
                    </td>
                  </tr>
                <tbody>
                  @foreach($quote as $qu)
                    <?php $date = date_create($qu->sign_date);
                      $dt = date_format($date, 'Y-m-d');
                    ?>
                    <tr>
                      <td colspan="7" class="hiddenRow" style="border-top: none; padding: 0;">
                        <div class="accordian-body collapse" id="demo<?= $quote[0]->id ?>"> 
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Sent Date</th>
                                <th>Product Name</th>
                                <th>Alternative Product Name</th>
                                <th>Product Price</th>
                                <th>Alternative Product Price</th>
                                <th>Total Price</th>
                                @if($user_status == 0)
                                  <th>Actions</th>
                                @endif

                                @if($user_status == 1)
                                @endif
                              </tr>
                            </thead>
                            <tbody>
                              <td style="vertical-align: middle; border-top: none;">{{ $dt }}</td>
                              <td style="vertical-align: middle; border-top: none;">{{ $qu->product_name }}</td>
                              <td style="vertical-align: middle; border-top: none;">{{ $qu->alternative_product }}</td>
                              <td style="vertical-align: middle; border-top: none;"><?= number_format(round($qu->product_price, 3, PHP_ROUND_HALF_UP), 2); ?></td>
                              <td style="vertical-align: middle; border-top: none;"><?= number_format(round($qu->alternative_product_price, 3, PHP_ROUND_HALF_UP), 2); ?></td>
                              <td style="vertical-align: middle; border-top: none;"><?= number_format(round($qu->total_price, 3, PHP_ROUND_HALF_UP), 2); ?></td>
                              
                              @if($user_status == 0)
                                <td style="vertical-align: middle; border-top: none;">
                                  @if($qu->status == 1)
                                    <a class="btn btn-success" href="{{ url('/quote/change', $qu->main_id) }}" id="{{ $qu->main_id }}" style="color: #fff;">Edit</a>
                                    <a class="btn btn-danger delete" href="{{ url('/quote/destroy', $qu->main_id) }}" style="color: #fff;">Delete</a>
                                  @endif
                                  @if($qu->status == 2 || $qu->status == 3)
                                    <a class="btn btn-success" href="{{ url('/quote/detailview', $qu->main_id) }}" id="{{ $qu->main_id }}" style="color: #fff;">Detail</a>
                                  @endif
                                </td>
                              @endif

                              @if($user_status == 1)
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Map and From Area --> 
@stop