@extends('layouts.dashboards')

@section('content')

<!-- Map and From Area --> 
<div class="card">
  <div class="card-body" style="padding: 5%;">
    <div class="row">
      <div class="col-12">    
        <div class="table-responsive" style="text-align: left;">
          <h4>Purchase Orders Status Change (<span style="color: red;">{{ $record->getstatus($record->payment_status) }}</span>) </h4><br/>
          @if($user_status == 1)
            <p style="color: red;">Your account was blocked by admin!</p>
          @endif

          <form action="{{ route('purchaseorders.update') }}" method="POST" id="payment_status_change">
            <h4>To change the payment status, please fill the payment information.</h4><br>
            <div class="form-group col-md-5">
              <label>Status</label>
              <select class="form-control status" id="status">
                <option value="">choose</option>
                @if($record->payment_status == 1)
                  <option value="1">Payment Received</option>
                @elseif($record->payment_status == 2)
                  <option value="1">Delivery Fine</option>
                @endif
              </select>
            </div>

            <div class="form-group col-md-10">
              <label>Information</label>
              @csrf
              <input type="hidden" name="id" value="{{ $record->id }}">
              <textarea rows="8" name="payment_information" id="payment_information" placeholder="How was the delivery?" class="form-control payment_information" required></textarea>
            </div>

            <button type="submit" class="btn btn-success" style="margin-left: 2%;">Submit</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Map and From Area --> 
@stop