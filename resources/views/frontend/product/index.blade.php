@extends('layouts.app')

@section('content')

<div class="ps-page--shop" id="shop-sidebar">
  <div class="container">
      <div class="ps-layout--shop">
          <div class="ps-layout__left">
            <product-category-left></product-category-left>
          </div>
          <div class="ps-layout__right">
            <product-right></product-right>
          </div>
      </div>
  </div>
</div>
@stop
