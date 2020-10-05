@extends('layouts.product')

@section('section')

      @if ($errors->any())
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="card rounded-0">
        <div class="card-body" style="padding: 5%;">

          <h3>{{ __('Edit Product') }}</h3>
          <br>

          <form method="post" action="{{ route('product.update', $product->slug) }}" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="_method" value="put">

            <!-- Name -->
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" placeholder="Name">
              </div>
            </div>
            <!-- / Name -->

            <!-- Category -->
            <div class="form-group row">
              <label for="price" class="col-sm-2 col-form-label">{{ __('Category') }}</label>
              <div class="col-sm-8">
                <select name="category_id" id="category" class="form-control" placeholder="Category">
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ ($category->id == $product->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <!-- / Category -->

            <!-- MOQ -->
            <div class="form-group row">
              <label for="MOQ" class="col-sm-2 col-form-label">{{ __('MOQ') }}</label>
              <div class="col-sm-8">
                <input required type="text" class="form-control" id="MOQ" name="MOQ" placeholder="MOQ" value="{{ $product->MOQ }}">
              </div>
            </div>
            <!-- / MOQ -->

            <!-- Description -->
            <div class="form-group row">
              <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }}</label>
              <div class="col-sm-8">
                <input type="hidden" name="description" class="description" value="{{ $product->description }}" />
                <div id="quillExample1" class="quill-container" style="height: 20rem;">
                </div>
              </div>
            </div>
            <br><br>
            <!-- / Description -->

            <!-- Price -->
            <div class="form-group row">
              <label for="price" class="col-sm-2 col-form-label">{{ __('Price ( From, To )') }}</label>
              <div class="col-sm-3">
                <input type="number" class="form-control" id="price_from" name="price_from" placeholder="Price From" required value="{{ $product->price_from }}">
              </div>
              <div class="col-sm-2"></div>
              <div class="col-sm-3">
                <input type="number" class="form-control" id="price_to" name="price_to" placeholder="Price To" required value="{{ $product->price_to }}">
              </div>
            </div>
            <!-- /Price -->

            <!-- Image -->
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">{{ __('Product Images') }}</label>
              <div class="col-md-10">
                <?php 
                  $path = asset('uploads/') . "/";
                ?>
                <file-upload-multiple urls="{{ $path }}" images="{{ $product->images }}"></file-upload-multiple>
              </div>
            </div>
            <!-- /Image -->

            <!-- Save Button -->
            <div class="form-group row">
              <div class="col-sm-8">
                <button style="display: none;" type="submit" class="btn btn-primary float-right btn-flat correct_btn">{{ __('Update Product') }}</button>
              </div>
            </div>
            <!-- /Save Button -->

          </form>

          <div class="col-sm-7">
            <button type="submit" class="ps-btn float-right btn-flat hidden_btn">{{ __('Save Product') }}</button>
          </div>
        </div>
      </div> <!-- [End] .card -->
@endsection

<style>
  .inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
  }

  .inputfile + label {
    font-size: 1.25em;
    font-weight: 700;
    color: white;
    background-color: #E9ECEF;
    padding: 50px;
    display: inline-block;
    cursor: pointer;
    background-size: cover;
  }

  .inputfile:focus + label,
  .inputfile + label:hover {
    background-color: #38C172ed;
  }

  .hidden {
    display: none !important;
  }
</style>

@section('script')
<script>
  function loadPreview(input, id) {
    id = "#" + id;
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        var path = "background-image: " + "url('" + e.target.result + "')";
        $(id).attr('style', path);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $('.hidden_btn').click(function() {
    var description = $('#quillExample1 .ql-editor');
    // console.log('-------', description[0].innerHTML);
    var value = description[0].innerHTML;
    if ($('#quillExample1 .ql-editor').children().text() == '') {
      alert('Description is required.');
      return;
    }
    $('.description').val('');
    $('.description').val(value);
    $('.correct_btn').click();
  });

  $(document).ready(function() {
    var element = $('#quillExample1 .ql-editor');
    var value = $('.description').val();
    element.append(value);
  });
</script>
@endsection