@extends('layouts.dashboards')

@section('content')

<!-- Map and From Area --> 
<div class="card">
  <div class="card-body" style="padding: 1%;">
    <div class="row">
      <div class="col-12"> 
        @if(auth()->user()->hasRole('admin'))
          <h3>View Quotes</h3> <br/><br/>
        @else
          <h3>Edit Quotes</h3> <br/><br/>
        @endif

        @if(auth()->user()->hasRole('buyer'))
          <h5>Seller Name: {{ $seller->name }}</h5> <br/>
          <h5>Company Name: {{ $seller->company_name }}</h5> <br/>
        @endif
        
        <form action="{{ route('quote.update') }}" method="POST" id="new_quote">
          <div style="width: 100%; display: inline-flex;">
            <div class="form-group col-md-2">
              <label>Product Name</label>
              <input readonly class="form-control product_name" type="text" name="product_name" id="product_name" value="{{ $result['product_name'] }}" />
              <input type="hidden" name="id" value="{{ $result['id'] }}">
              <input type="hidden" class="form-control" name="request_id" id="request_id" value="{{ $result['request_id'] }}" />
              @csrf
            </div>

            <div class="form-group col-md-2">
              <label>Unit</label>
              <select class="form-control select2 unit" readonly disabled id="unit" name="unit" style='width:100%;'>
                @foreach($units as $unit)
                  <option <?php if($unit['id'] == $result['unit']){echo 'selected';} ?> value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-2">
              <label>Volume</label>
              <input readonly class="form-control volume" type="text" name="volume" id="volume" value="{{ $result['volume'] }}" />
            </div>

            <div class="col-md-2">
              <label>Unit Price</label>
              <input class="form-control product_price" value="{{ number_format(round($result['product_price'], 3, PHP_ROUND_HALF_UP), 2) }}" type="text" name="product_price" id="product_price" onchange="myFuntion(this.value)" placeholder="Unit Product Price" <?= $result['readonly'] ?> />
            </div>
            
            <div class="form-group col-md-2" style="text-align: right;">
              <label>Available</label>
              @if($result['readonly'] == 'readonly')
                @if($result['available'] == 1) 
                  <input class="form-control available" disabled type="checkbox" name="available" id="available" style="appearance: auto; margin-left: 90%; width: 10%; height: 55%;" />
                @endif
                @if($result['available'] == 0)
                  <input class="form-control available" disabled type="checkbox" checked name="available" id="available" style="appearance: auto; margin-left: 90%; width: 10%; height: 55%;" />
                @endif
              @endif
              @if($result['readonly'] == '')
                @if($result['available'] == 1) 
                  <input class="form-control available" type="checkbox" name="available" id="available" style="appearance: auto; margin-left: 90%; width: 10%; height: 55%;" />
                @endif
                @if($result['available'] == 0)
                  <input class="form-control available" type="checkbox" checked name="available" id="available" style="appearance: auto; margin-left: 90%; width: 10%; height: 55%;" />
                @endif
              @endif
            </div>

            <div class="form-group col-md-2">
              <label>Price</label>
              <input class="form-control" type="text" id="product_total_price" readonly disabled value="{{ number_format(round($result['product_price'] * $result['volume'], 3, PHP_ROUND_HALF_UP), 2) }}" />
            </div>
          </div>  

          <div style="width: 100%; display: inline-flex; padding-top: 1%;" class="alternative">
            <div class="form-group col-md-2">
              <label>Alternative Product</label>
              <?php 
                if (@$result['readonly']) {
                  if ($result['readonly'] == 'readonly') { ?>
                    <select class="form-control alternative_product" id="alternative_product" name="alternative_product" style='width:100%;' disabled>
                      @foreach($m_products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                      @endforeach
                    </select>
                  <?php }else{ ?>
                    <select class="form-control alternative_product" id="alternative_product" name="alternative_product" style='width:100%;'>
                      @foreach($m_products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                      @endforeach
                    </select>
              <?php } } ?>
            </div>

            <div class="form-group col-md-2">
              <label>Unit</label>
              <select class="form-control" readonly disabled style='width:100%;'>
                @foreach($units as $unit)
                  <option <?php if($unit['id'] == $result['unit']){echo 'selected';} ?> value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-2">
              <label>Volume</label>
              <input readonly class="form-control" type="text" value="{{ $result['volume'] }}" />
            </div>

            <div class="col-md-2">
              <label>Unit Alternative Product Price</label>
              <input class="form-control alternative_product_price" type="text" name="alternative_product_price" id="alternative_product_price" onchange="myFuntion3(this.value)" placeholder="Unit Alternative Product Price" value="{{ number_format(round($result['alternative_product_price'], 3, PHP_ROUND_HALF_UP), 2) }}" <?= $result['readonly'] ?> />
            </div>
            <div class="col-md-2"></div>

            <div class="form-group col-md-2">
              <label>Alternative Product Price</label>
              <input type="text" readonly disabled id="alternative_product_total_price" class="form-control" value="{{ number_format(round($result['alternative_product_price'] * $result['volume'], 3, PHP_ROUND_HALF_UP), 2) }}" />
            </div>
          </div>

          <div style="width: 100%; display: inline-flex; padding-top: 1%;">
            <div class="form-group col-md-2">
              <label>Shipping</label>
              <input type='text' <?= $result['readonly'] ?> name="shipping_desc" id="shipping_desc" placeholder="Shipping Description" class="form-control shipping_desc" value="{{ $result['shipping_desc'] }}" />
            </div>

            <div class="form-group col-md-2">
              <label>Weight</label>
              <input type="number" name="shipping_weight" id="shipping_weight" onchange="myFuntion4(this.value)" placeholder="Weight" class="form-control shipping_weight" <?= $result['readonly'] ?> value='{{ $result["shipping_weight"] }}'>
            </div>

            <div class="form-group col-md-2">
              <label>Unit</label>
              <select class="form-control shipping_unit" id="shipping_unit" name="shipping_unit" style='width:100%;' <?= $result['readonly'] ?> disabled>
                @if($result['shipping_unit'] == 1)
                  <option value="1" selected>g</option>
                  <option value="2">kg</option>
                  <option value="3">t</option>
                @elseif($result['shipping_unit'] == 2)
                  <option value="1">g</option>
                  <option value="2" selected>kg</option>
                  <option value="3">t</option>
                @elseif($result['shipping_unit'] == 3)
                  <option value="1">g</option>
                  <option value="2" selected>kg</option>
                  <option value="3">t</option>
                @endif
              </select>
            </div>

            <div class="form-group col-md-2">
              <label>Shipping Unit Price</label>
              <input type="text" name="shipping_price" onchange="myFuntion1(this.value)" id="shipping_price" placeholder="Shipping Price" class="form-control shipping_price" value="{{ number_format(round($result['shipping_price'], 3, PHP_ROUND_HALF_UP), 2) }}" <?= $result['readonly'] ?> />
            </div>

            <div class="col-md-2"></div>

            <div class="form-group col-md-2">
              <label>Shipping Price</label>
              <input type="text" id="shipping_total_price" class="form-control shipping_total_price" <?= $result['readonly'] ?> value="{{ number_format(round($result['shipping_price']*$result['shipping_weight'], 3, PHP_ROUND_HALF_UP), 2) }}" />
            </div>
          </div>

          <div style="width: 100%; display: inline-flex; padding-top: 1%;">
            <div class="form-group col-md-4">
              <label>Other Charge</label>
              <input type='text' name="other_price_desc" id="other_price_desc" <?= $result['readonly'] ?> class="form-control other_price_desc" value="{{ $result['other_price_desc'] }}" />
            </div>

            <div class="col-md-6"></div>

            <div class="form-group col-md-2">
              <label>Other Charge Price</label>
              <input type="text" name="other_price" onchange="myFuntion2(this.value)" id="other_price" class="form-control other_price" value="{{ number_format(round($result['other_price'], 3, PHP_ROUND_HALF_UP), 2) }}" <?= $result['readonly'] ?> />
            </div>
          </div>

          <div style="width: 100%; display: inline-flex; padding-top: 1%;">
            <div class="form-group col-md-3">
              <label>Total Price</label>
              <input type="text" name="total_price" id="total_price" class="form-control total_price" readonly="readonly" value="{{ number_format(round($result['total_price'], 3, PHP_ROUND_HALF_UP), 2) }}" />
            </div>
          </div>

          <button style="display: none;" type="submit" class="btn btn-success rfq_send_btn_hide" id="main_send">Submit</button>
        </form>

        <div style="padding-left: 1%;">
          <br>
          @if($result['readonly'] == "")
            <button class="btn btn-success rfq_send_btn" id="send">Submit</button>  
          @endif
          @if($result['readonly'] == "readonly")
            @if(auth()->user()->hasRole('admin'))
              <a class="btn btn-success" href="{{ url('admin/quotes') }}" style="color: #fff;">Back</a>
            @else
              <a class="btn btn-success" href="{{ route('quote.index') }}" style="color: #fff;">Back</a>
            @endif
            
            @if($result['purchase'] == '')
              @if(auth()->user()->hasRole('buyer'))
                <a class="btn btn-primary" href="{{ route('quote.accepted', $result['id']) }}" style="color: #fff;">Accept</a>
                <a class="btn btn-danger" href="{{ route('quote.reject', $result['id']) }}" style="color: #fff;">Reject</a>
              @endif
            @endif
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Map and From Area --> 
@stop