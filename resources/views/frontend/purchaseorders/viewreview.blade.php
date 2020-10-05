@extends('layouts.dashboardsecond')

@section('content')

<!-- Map and From Area --> 
<div class="card">
  <div class="card-body" style="padding: 5%; font-size: medium;">
    <div class="row">
      <div class="col-md-12">    
        @if($user_status == 1)
          <p style="color: red;">Your account was blocked by admin!</p>
        @endif

        <div class="col-md-12">
          <div class="form-group">
            @csrf
            <h3>Your sent review</h3>To <a href="{{ url('/purchaseorders/userreview', $receiver->id) }}" id="{{ $receiver->id }}">{{ $receiver->name }}</a><br>
            <label>Rating</label>
            <?php 
                if (round($record->mark) == 0) { ?>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span> ( <?php echo number_format($record->mark, 1); ?> )
            <?php }elseif (round($record->mark) == 1) { ?>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span> ( <?php echo number_format($record->mark, 1); ?> )
            <?php }elseif (round($record->mark) == 2) { ?>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span> ( <?php echo number_format($record->mark, 1); ?> )
            <?php }elseif (round($record->mark) == 3) { ?>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span> ( <?php echo number_format($record->mark, 1); ?> )
            <?php }elseif (round($record->mark) == 4) { ?>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span> ( <?php echo number_format($record->mark, 1); ?> )
            <?php }elseif (round($record->mark) == 5) { ?>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span> ( <?php echo number_format($record->mark, 1); ?> )
            <?php } ?>
          </div>

          <div class="form-group">
            <label>Description</label>
            <textarea rows="6" class="form-control description" name="description" id="description" disabled>{{ $record->description }}</textarea>
          </div>
        </div>
        <br>
        <div class="col-md-12">
          <div class="form-group">
            @csrf
            <h3>Your received review</h3>From <a href="{{ url('/purchaseorders/userreview', $receiver->id) }}" id="{{ $receiver->id }}">{{ $receiver->name }}</a><br>
            <label>Rating</label>
            <?php 
              if(@$receiver_record) {
                if (round($receiver_record->mark) == 0) { ?>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span> ( <?php echo number_format($receiver_record->mark, 1); ?> )
                <?php }elseif (round($receiver_record->mark) == 1) { ?>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span> ( <?php echo number_format($receiver_record->mark, 1); ?> )
                <?php }elseif (round($receiver_record->mark) == 2) { ?>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span> ( <?php echo number_format($receiver_record->mark, 1); ?> )
                <?php }elseif (round($receiver_record->mark) == 3) { ?>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span> ( <?php echo number_format($receiver_record->mark, 1); ?> )
                <?php }elseif (round($receiver_record->mark) == 4) { ?>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span> ( <?php echo number_format($receiver_record->mark, 1); ?> )
                <?php }elseif (round($receiver_record->mark) == 5) { ?>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span> ( <?php echo number_format($receiver_record->mark, 1); ?> )
            <?php } } ?>
          </div>

          <div class="form-group">
            <label>Description</label>
            <?php 
                if (@$receiver_record) { ?>
                  <textarea rows="6" class="form-control description" name="description" id="description" disabled>{{ $receiver_record->description }}</textarea>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-8 h-100">
        <a class="ps-btn" href="{{ route('purchaseorders.create') }}" style="color: #fff; margin-left: 3%;">Back</a>
      </div>
    </div>
  </div>
</div>
<!-- End Map and From Area --> 
@stop