@extends('layouts.dashboardsecond')

@section('content')

<!-- Map and From Area --> 
<div class="card">
    <div class="card-body" style="padding: 5%;">
        <div class="row">
            <div class="col-md-12">    
                @if($reviews)
                    <div class="col-md-12" style="display: inline-block;">
                        <h4 style="display: inline-block;">{{ $name }} ( {{ $company }} )</h4>
                        @if($company_logo)
                            <div class="pull-right" style="display: inline-block;">
                                <img class="img-fluid" style="display: inline-block; width: 50px; height: 50px; border-radius: 100%;" src="{{ asset('uploads/') }}/{{ $company_logo }}" alt="Logo">       
                            </div>
                        @endif
                    </div>
                    
                    <?php if(count($reviews) > 0) { ?>
                        @foreach($reviews as $review)
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <div class="form-group">
                                        <?php 
                                            if (round($review->mark) == 0) { ?>
                                                <?php echo number_format($review->mark, 1); ?>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span> 
                                        <?php }elseif (round($review->mark) == 1) { ?>
                                                <?php echo number_format($review->mark, 1); ?>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span> 
                                        <?php }elseif (round($review->mark) == 2) { ?>
                                                <?php echo number_format($review->mark, 1); ?>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span> 
                                        <?php }elseif (round($review->mark) == 3) { ?>
                                                <?php echo number_format($review->mark, 1); ?>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span> 
                                        <?php }elseif (round($review->mark) == 4) { ?>
                                                <?php echo number_format($review->mark, 1); ?>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span> 
                                        <?php }elseif (round($review->mark) == 5) { ?>
                                                <?php echo number_format($review->mark, 1); ?>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span> 
                                        <?php } ?>
                                        <span class="pull-right">{{ number_format(round($review->total_price, 3, PHP_ROUND_HALF_UP), 2) }} {{ $localization_setting->currency }}</span>
                                    </div>

                                    <div class="form-group">
                                        <span>{{ $review->description }}</span>
                                        <br><br>

                                        <span>{{ $review->name }} ( {{ $review->sign_date }} )</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    <?php } else { ?>
                        <div class="row" style="text-align: center;">
                            <p>No Review</p>    
                        </div>
                    <?php } ?>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- End Map and From Area --> 
@stop