@extends('layouts.app')

@section('content')

<section class="u-align-left u-clearfix u-section-1" id="sec-b0e8" style="padding: 2%;">
  <div class="container">
    <div class="u-clearfix u-sheet u-sheet-1" style="min-height: auto!important;">
      @if($user_status == 0)
        <form class="from_main" action="{{ route('request.store') }}" method="post" id="phpcontactform" style="max-width: 100%;" enctype="multipart/form-data">
      @endif

      @if($user_status == 1)
        <form class="from_main" action="#" method="post" id="phpcontactform" style="max-width: 100%;">
      @endif
        @if($user_status == 0)
          <h4 class="title_name"> New Request </h4><br>
        @endif

        @if($user_status == 1)
          <h4 class=""> Sorry, You can not send the Quote, Because your account was blocked by Admin. </h4><br>
        @endif
        @csrf
        <div class='row'>
          <div class='col-md-2'>
            <label>Product Name*</label>
          </div>
          <div class="col-md-5">
            <?php if (@$product[0]) { ?>
              <input type="text" value="{{ $product[0]['name'] }}" readonly class="form-control" id="product_name" name="product_name">
              <input type="hidden" name="type" id="type" value="{{ $product[0]['id'] }}" />
            <?php }else{ ?>
              <input type="text" class="form-control" id="product_name" name="product_name">
              <input type="hidden" name="type" id="type" value="-1" />
            <?php } ?>
          </div>
        </div>
        <br>

        <?php if (@$product[0]) {
          if(@$product[0]->thumbnailUrl()) {
         ?>
          <div class='row'>
            <div class="col-md-2">
            </div>
            <div class="col-md-5">
              <img class="u-expanded-width u-image u-image-default u-image-1" data-src="holder.js/100px225?theme=thumb&amp;bg=#eee&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="width: 100%; display: block;" src="{{ asset('uploads/') }}/{{ $product[0]->thumbnailUrl() }}" data-holder-rendered="true">
            </div>
          </div>
          <br>
        <?php } }else{ ?>
        <?php } ?>

        <div class="row">
          <div class='col-md-2'>
            <label>Volume*</label>
          </div>
          <div class='col-md-2' style="display: inline-block;">
            <input type="number" class="form-control" id="volume" name="volume" style="display: inline-block;">
          </div>
          <div class="col-md-3">
            <select class="form-control select2 unit" id="unit" name="unit" style='width:100%; display: inline-block;'>
              <option selected value="">Unit*</option>
              @foreach($units as $unit)
                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <br>
        <div class='row'>
          <div class='col-md-2'>
            <label>Destination*</label>
          </div>
          <div class="col-md-5">
            <textarea class="form-control" id="port_of_destination" name="port_of_destination" rows='4'></textarea>  
          </div>
        </div>
        <br>
        <div class="row">
          <div class='col-md-2'>
            <label>Additional Information*</label>
          </div>
          <div class="col-md-5">
            <textarea class="form-control" id="description" name="description" rows='6'></textarea>  
          </div>
        </div>
        <br>
        <div class="row">
          <div class='col-md-2'>
            <label>Choose file</label>
          </div>
          <div class="col-md-5">
            <input type="file" name="files" id="files" class="form-control files" />  
          </div>
        </div>
        <br>
        <div class="row">
          <div class='col-md-2'>
            <label>Human Check</label>
          </div>
          <div class="col-md-5">
            <input type='number' class='form-control' id='human_check' name='human_check' placeholder='Please solve the following math function 2 + 5' />  
          </div>
        </div>
        <br>      
        @if($user_status == 0)
          <div class="form-group">
            <button class="ps-btn ps-btn--lg rfq_btn_hide" id="js-contact-btn" type="submit" style="display: none;">Request a quote</button> 
          </div>
        @endif        
      </form>
      @if($user_status == 0)
        <button class="ps-btn ps-btn--lg rfq_btn" id="js-contact-btn">Send</button>
      @endif
    </div>
  </div>
</section>
@stop
