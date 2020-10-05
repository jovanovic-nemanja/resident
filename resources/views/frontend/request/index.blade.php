@extends('layouts.dashboards')

@section('content')

<!-- Map and From Area --> 
<div class="card">
  <div class="card-body" style="padding: 5%;">
    <div class="row">
      <div class="col-12"> 
        <div class="table-responsive" style="text-align: left;">
          @if(auth()->user()->hasRole('buyer'))
            <h3>My Sent Requests</h3><br/>
            @if($user_status == 1)
              <p style="color: red;">Your account was blocked by admin!</p>
            @endif
            <br>
            <table id="order-listing" class="table">
              <thead>
                <tr>
                  <th width="10%">ID</th>
                  <th width="10%">Product Name</th>
                  <th width="10%">Volume</th>
                  <th width="10%">Unit</th>
                  <!-- <th width="10%">Destination</th>
                  <th width="20%">Additional information</th> -->
                  <th width="20%">Attached file</th>
                  <th width="10%">Status</th>
                  <th width="10%">Created Date</th>
                  @if($user_status == 0)
                    <th width="5%">View</th>
                    <th width="5%">Delete</th>
                  @endif

                  @if($user_status == 1)
                  @endif
                </tr>
              </thead>
                    
              <tbody>
                @foreach($requests as $request)
                  <tr>
                    <td style="vertical-align: middle;"><?= date('Y')."/".date('m')."/" ?>{{ $request['id'] }}</td>
                    <td style="vertical-align: middle;">{{ $request['product_name'] }}</td>
                    <td style="vertical-align: middle;">{{ $request['volume'] }}</td>
                    <td style="vertical-align: middle;">
                      <h4 style='display: none;' class="unit_val">{{ $request['unit'] }}</h4>
                      {{ $request->getunit($request['unit']) }}
                    </td>
                    <!-- <td style="vertical-align: middle;">{{ $request['port_of_destination'] }}</td>
                    <td style="vertical-align: middle;"><?= nl2br($request['additional_information']); ?></td> -->
                    <td style="vertical-align: middle;">
                      @if($request->getfiles($request['id']))
                        <a href="{{ $request->getfiles($request['id']) }}" class="" target="_blank">view</a>
                      @endif
                    </td>
                    
                    @if($request['status'] == 1) 
                      <td style="vertical-align: middle;">Pending</td>

                    @elseif($request['status'] == 2) 
                      <td style="vertical-align: middle;">Approved</td>

                    @elseif($request['status'] == 3) 
                      <td style="vertical-align: middle;">Canceled</td>

                    @endif
                    
                    <td style="vertical-align: middle;">{{ $request['sign_date'] }}</td>

                    @if($user_status == 0)
                      @if($request['status'] == 1)
                        <td style="vertical-align: middle;"><a class="btn btn-success" href="{{ route('request.change', $request['id']) }}" id="{{ $request['id'] }}">Edit</a></td>

                      @elseif($request['status'] == 2)
                        <td style="vertical-align: middle;"><a class="btn btn-success" href="{{ route('request.view', $request['id']) }}" id="{{ $request['id'] }}" style="color: #fff;">View</a></td>

                      @elseif($request['status'] == 3)
                        <td style="vertical-align: middle;"><a class="btn btn-success" href="{{ route('request.view', $request['id']) }}" id="{{ $request['id'] }}" style="color: #fff;">View</a></td>

                      @endif

                      @if($request['status'] == 1)
                        <td style="vertical-align: middle;"><a class="btn btn-danger delete" href="{{ url('/request/destroy', $request->id) }}" style="color: #fff;">Cancel</a></td>
                        
                      @elseif($request['status'] == 2)
                        <td style="vertical-align: middle;"><a class="btn btn-danger" readonly style="cursor: not-allowed; color: #fff;" id="{{ $request['id'] }}">Cancel</a></td>

                      @elseif($request['status'] == 3)
                        <td style="vertical-align: middle;"><a class="btn btn-danger" readonly style="cursor: not-allowed; color: #fff;" id="{{ $request['id'] }}">Cancel</a></td>

                      @endif
                    @endif

                    @if($user_status == 1)
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif

          @if(auth()->user()->hasRole('seller'))
            <h3>My Received Requests</h3><br/>
            @if($user_status == 1)
              <p style="color: red;">Your account was blocked by admin!</p>
            @endif
            <br>
            <table id="order-listing" class="table">
              <thead>
                <tr>
                  <th width="10%">ID</th>
                  <th>Sent Date</th>
                  <th>Product Name</th>
                  <th>Volume</th>
                  <!-- <th>Unit</th>
                  <th>Destination</th>
                  <th>Additional information</th> -->
                  <th width="20%">Attached file</th>
                  @if($user_status == 0)
                    <th>Detail</th>
                    <th>Reply</th>
                  @endif

                  @if($user_status == 1)
                  @endif
                </tr>
              </thead>
                    
              <tbody>
                @foreach($requests as $request)
                  <?php $date = date_create($request['sign_date']);
                        $dt = date_format($date, 'Y-m-d');
                   ?>
                  <tr>
                    <td style="vertical-align: middle;"><?= date('Y')."/".date('m')."/" ?>{{ $request['id'] }}</td>
                    <td style="vertical-align: middle;">{{ $dt }}</td>
                    <td style="vertical-align: middle;">{{ $request['product_name'] }}</td>
                    <td style="vertical-align: middle;">{{ $request['volume'] }}</td>
                    <!-- <td style="vertical-align: middle;">
                      <h4 style='display: none;' class="unit_val">{{ $request['unit'] }}</h4>
                      {{ $request->getunit($request['unit']) }}
                    </td>
                    <td style="vertical-align: middle;">{{ $request['port_of_destination'] }}</td>
                    <td style="vertical-align: middle;"><?= nl2br($request['additional_information']); ?></td> -->

                    <td style="vertical-align: middle;">
                      @if($request->getfiles($request['id']))
                        <a href="{{ $request->getfiles($request['id']) }}" class="" target="_blank">view</a>
                      @endif
                    </td>

                    @if($user_status == 0)
                      <td style="vertical-align: middle;">

                        <a class="btn btn-success detail" href="{{ route('request.view', $request['id']) }}" id="{{ $request['id'] }}">Detail</a>
                      </td>
                      @if($request->is_quotes($request['id']) == 1)
                        <td style="vertical-align: middle;">
                          <a class="btn btn-success" id="{{ $request['id'] }}" style="color: #fff; cursor: not-allowed;">Send</a>
                        </td>
                      @else
                        <td style="vertical-align: middle;"><a class="btn btn-success" href="{{ url('/quote/reply', $request['id']) }}" id="{{ $request['id'] }}" style="color: #fff;">Send</a></td>
                      @endif
                    @endif

                    @if($user_status == 1)
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif

          <a class="btn btn-medium btn-success rfq" data-toggle="modal" data-target="#myModal" style='display: none;'></a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Map and From Area --> 
@stop