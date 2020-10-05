@extends('layouts.dashboards')

@section('content')

<!-- Map and From Area --> 
<div class="card">
  <div class="card-body" style="padding: 5%;">
    <div class="row">
      <div class="col-12"> 
        <h3>New Quote</h3> <br/><br/>
        <form action="{{ route('quote.store') }}" method="POST" id="new_quote">
          <div style="width: 100%; display: inline-flex;">
            <div class="form-group col-md-2">
              <label>Product Name</label>
              <input <?= $data['readonly'] ?> class="form-control product_name" type="text" name="product_name" id="product_name" value="{{ $data['product_name'] }}" />
              @csrf
            </div>

            <div class="form-group col-md-2">
              <label>Unit</label>
              <input type="hidden" name="unit" value="{{ $data['unit'] }}">
              <select class="form-control" <?= $data['readonly'] ?> disabled style='width:100%;'>
                @foreach($units as $unit)
                  <option <?php if($unit['id'] == $data['unit']){echo 'selected';} ?> value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-2">
              <label>Volume</label>
              <input <?= $data['readonly'] ?> class="form-control volume" type="text" name="volume" id="volume" value="{{ $data['volume'] }}" />
            </div>

            <div class="col-md-2">
              <label>Unit Price</label>
              <input class="form-control product_price" type="text" name="product_price" id="product_price" onchange="myFuntion(this.value)" placeholder="Unit Product Price" />
            </div>
            
            <div class="form-group col-md-2" style="text-align: right;">
              <label>Available</label>
              <input class="form-control available" checked type="checkbox" name="available" id="available" style="appearance: auto; margin-left: 90%; width: 10%; height: 55%;" />
            </div>

            <div class="form-group col-md-2">
              <label>Price</label>
              <input class="form-control" type="text" id="product_total_price" readonly disabled />
            </div>
          </div>  

          <div style="width: 100%; display: inline-flex; padding-top: 1%;" class="alternative">
            <div class="form-group col-md-2">
              <label>Alternative Product</label>
              <select class="form-control alternative_product select2" id="alternative_product" name="alternative_product" style='width:100%;'>
                @foreach($m_products as $product)
                  <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-2">
              <label>Unit</label>
              <select class="form-control" <?= $data['readonly'] ?> disabled style='width:100%;'>
                @foreach($units as $unit)
                  <option <?php if($unit['id'] == $data['unit']){echo 'selected';} ?> value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-2">
              <label>Volume</label>
              <input <?= $data['readonly'] ?> class="form-control" type="text" value="{{ $data['volume'] }}" />
            </div>

            <div class="col-md-2">
              <label>Unit Alternative Product Price</label>
              <input class="form-control alternative_product_price" type="text" name="alternative_product_price" id="alternative_product_price" onchange="myFuntion3(this.value)" placeholder="Unit Alternative Product Price" />
            </div>
            <div class="col-md-2"></div>

            <div class="form-group col-md-2">
              <label>Alternative Product Price</label>
              <input type="text" readonly disabled id="alternative_product_total_price" class="form-control" />
            </div>
          </div>

          <div style="width: 100%; display: inline-flex; padding-top: 1%;">
            <div class="form-group col-md-2">
              <label>Shipping</label>
              <input type='text' name="shipping_desc" id="shipping_desc" placeholder="Shipping Description" class="form-control shipping_desc" />
            </div>

            <div class="form-group col-md-2">
              <label>Weight</label>
              <input type="number" name="shipping_weight" id="shipping_weight" onchange="myFuntion4(this.value)" placeholder="Weight" class="form-control shipping_weight">
            </div>

            <div class="form-group col-md-2">
              <label>Unit</label>
              <select class="form-control shipping_unit" id="shipping_unit" name="shipping_unit" style='width:100%;'>
                <option value="1">g</option>
                <option value="2">kg</option>
                <option value="3">t</option>
              </select>
            </div>

            <div class="form-group col-md-2">
              <label>Shipping Unit Price</label>
              <input type="text" name="shipping_price" onchange="myFuntion1(this.value)" id="shipping_price" placeholder="Shipping Price" class="form-control shipping_price" />
            </div>

            <div class="col-md-2"></div>

            <div class="form-group col-md-2">
              <label>Shipping Price</label>
              <input type="hidden" class="form-control" name="request_id" id="request_id" value="{{ $data['request_id'] }}" />
              <input type="text" id="shipping_total_price" class="form-control shipping_total_price" <?= $data['readonly'] ?> />
            </div>
          </div>

          <div style="width: 100%; display: inline-flex; padding-top: 1%;">
            <div class="form-group col-md-4">
              <label>Other Charge</label>
              <input type="text" name="other_price_desc" id="other_price_desc" placeholder="Other Charge Description" class="form-control other_price_desc" />
            </div>

            <div class="col-md-6"></div>

            <div class="form-group col-md-2">
              <label>Other Charge Price</label>
              <input type="text" name="other_price" onchange="myFuntion2(this.value)" id="other_price" placeholder="Other Charge Price" class="form-control other_price" />
            </div>
          </div>

          <div style="width: 100%; display: inline-flex; padding-top: 1%;">
            <div class="form-group col-md-3">
              <label>Total Price</label>
              <input type="text" id="total_price" class="form-control total_price" readonly="readonly" value="" />
              <input type="text" style="display: none;" id="real_total_price" name="total_price" class="form-control real_total_price" value="" />
            </div>
          </div>

          <button style="display: none;" type="submit" class="btn btn-success rfq_send_btn_hide" id="main_send">Submit</button>
        </form>

        <div style="padding-left: 1%;">
          <br>
          <button class="ps-btn rfq_send_btn" id="send">Submit</button>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Map and From Area --> 
@stop