@extends('layouts.dashboardsecond')

@section('content')

<!-- Map and From Area --> 
<div class="card">
  <div class="card-body" style="padding: 5%;">
    <div class="row">
      <div class="col-12">    
        <div class="table-responsive" style="text-align: left;">
          <h4>Purchase Orders (<span style="color: red;">{{ $record->getstatus($record->payment_status) }}</span>) </h4><br/>
          @if($user_status == 1)
            <p style="color: red;">Your account was blocked by admin!</p>
          @endif

          <form action="{{ route('reviews.store') }}" method="POST" id="add_comments" style="width: 100%;">
            <div class="form-group">
              @csrf
              <input type="hidden" name="purchase_id" value="{{ $record->id }}">
              <input type="hidden" name="receiver" value="{{ $quotes[0]->sender }}">

              @if(auth()->user()->hasRole('seller'))
                <label><a href="{{ url('/purchaseorders/userreview', $quotes[0]->sender) }}" id="{{ $quotes[0]->sender }}"></a></label><br><br>
              @elseif(auth()->user()->hasRole('buyer'))
                <label><a href="{{ url('/purchaseorders/userreview', $quotes[0]->sender) }}" id="{{ $quotes[0]->sender }}">Seller Name: {{ $quotes[0]->username }}  &nbsp;  Seller Company Name: {{ $company }}</a></label><br><br>
              @endif

              
              <label>Rating</label>
              <select class="ps-rating" name="mark" autocomplete="off">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>

            <div class="form-group">
              <label>Description</label>
              <textarea rows="6" class="form-control description" name="description" id="description" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
            <a class="btn btn-danger" href="{{ route('purchaseorders.create') }}" style="color: #fff;">Back</a>

          </form>
        </div>
      </div>
      <div class="col-8 h-100">
        
      </div>
    </div>
  </div>
</div>
<!-- End Map and From Area --> 
@stop