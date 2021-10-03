@extends('base.static')
@section('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link href="{{asset('plugins/slick/slick.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/slick/slick-theme.css')}}" rel="stylesheet" />
    <style>
        .single-slide{
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
        .single-slide img{
            height: 550px;
            width: auto;
        }
    </style>
@endsection

@section('content')
    <section id="products" class="mb-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="products-slide">
                        @foreach($product->images as $one)
                            <div class="single-slide">
                                <img src="{{$one->url}}" alt="no_img">
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center" style="margin-top: 3rem">
                        <a href="{{ route('customer.product.addToCart', $product->id) }}" class="btn btn-primary btn-buy">@lang('buy_now')</a>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="special-bundle w-100">
                        <h2 class="text-center">{{$product->name}}</h2>
                        <div class="d-flex justify-content-center">
                            <div class="divider" style="width: 170px"></div>
                        </div>
                    </div>
                    <div class="product-description text-center w-100 mt-5" id="product-description">
                        {!! $product->description !!}
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="special-bundle w-100" style="margin-top: 3.5rem">
                        <h2 class="text-center text-uppercase">@lang('satisfied_customers_say')</h2>
                        <div class="d-flex justify-content-center">
                            <div class="divider" style="width: 170px"></div>
                        </div>
                        <div class="reviews mt-6">
                            @if(count($product->reviews) > 0)
                                @foreach($product->reviews as $review)
                                <div class="row" style="margin-bottom: 3rem">
                                    <div class="col-md-2">
                                        <p class="mb-1">{{date('Y-m-d', strtotime($review->created_at))}}</p>
                                        <p class="mb-0">{{$review->customer->name." · ".$review->customer->country->name}}</p>
                                    </div>
                                    <div class="col-md-9 offset-md-1">
                                        <div class="review-header d-flex align-items-center">
                                            <div class="rating"></div>
                                            <p class="mb-0 ml-5 font-weight-bold">{{$review->title}}</p>
                                        </div>
                                        <div class="review-body mt-4">
                                            <p class="mb-0">{{$review->desc}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                                <h4 class="mb-0 text-center text-primary">@lang('no_review')</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script src="{{ asset('plugins/slick/slick.min.js') }}"></script>

    <script>
        $(function () {
            $(".rating").rateYo({
                starWidth: "25px",
                readOnly: true,
                rating: 4.7
            });
        });
        $('.products-slide').slick({
            dots: false,
            infinite: true,
            speed: 700,
            fade: true,
            cssEase: 'linear',
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            adaptiveHeight: true
        });
    </script>
@endsection
