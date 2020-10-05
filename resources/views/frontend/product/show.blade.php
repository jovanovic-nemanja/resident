@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                @include('component.productcarousel', ['images' => $product->images])
            </div>    
        </div>

        <div class="col-md-4">
            <h2 class='pro_name'>{{ $product->name }}</h2>
            <p>
                <div class="font-weight-bold">{{ __('Seller') }} : <a class="" href="{{ url('/purchaseorders/userreview', $product->user_id) }}"> {{ $product->getUsername($product->user_id) }}</a></div> 

                <div class="font-weight-bold">
                    {{ __('Company') }} : {{ $product->getcompanyName($product->user_id) }}
                    @if($product->getcompanyLogo($product->user_id))
                        <img class="img-fluid" style="width: 50px; height: 50px; border-radius: 100%;" src="{{ asset('uploads/') }}/{{ $product->getcompanyLogo($product->user_id) }}" alt="Logo">
                    @endif
                </div> 

                <div class="font-weight-bold">{{ __('MOQ') }} : {{ $product->MOQ }}</div>

                <div class="font-weight-bold mt-4">{{ __('Price') }} :</div>
                <h3 class="mt-2">{{ number_format(round($product->price_from, 3, PHP_ROUND_HALF_UP), 2) }} ~ {{ number_format(round($product->price_to, 3, PHP_ROUND_HALF_UP), 2) }} {{ $localization_setting->currency }}</h3>
            </p>
            
            @guest
                <a class="ps-btn rfq_detail_page" href="{{ route('request.sendrequest', $product->id) }}">Request for Quotation</a>
            @else
                @if(auth()->user()->hasRole('buyer'))
                    <a class="ps-btn rfq_detail_page" href="{{ route('request.sendrequest', $product->id) }}">Request for Quotation</a>
                @endif
            @endguest
            
            <!-- <a href="{{ route('cart.create', $product->slug) }}" class="btn btn-lg btn-success btn-block btn-flat mt-5">{{ __('Buy Now') }}</a>
            <a href="{{ route('cart.create', $product->slug) }}" class="btn btn-lg btn-primary btn-flat btn-block">{{ __('Add to Cart') }}</a> -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">{{ __('Description') }}</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">{{ __('Review') }}</a>
                </li> -->
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <br>
                    <p class="text-muted"><?= nl2br($product->description); ?></p>
                </div>
                <br>
                <br>
                <!-- <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">...</div> -->
            </div>
        </div>
    </div>
</div>
@endsection