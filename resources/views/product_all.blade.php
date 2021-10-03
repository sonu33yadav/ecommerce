@extends('base.static')
@section('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@endsection

@section('content')
    <section id="products" class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="special-bundle w-100">
                        <h2 class="text-center">{{isset($recommend)?__('recommend_products'):__('all_products')}}</h2>
                        <div class="d-flex justify-content-center">
                            <div class="divider" style="width: 170px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 4rem">
                @if(count($data)>0)
                    @foreach($data as $product)
                        <div class="col-sm-12 col-md-6 mb-5 product-info">
                            <div class="w-100 text-center" style="overflow: auto;  max-width: 100%;">
                                <a href="{{ route('product', $product->id) }}">
                                <div class="product-image" style="background-image: url({{count($product->images)>0?$product->images[0]->url:'../images/product/new-product.jpg'}})"></div>
                                </a>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-between mt-5">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box mr-5"><a href="{{ route('product', $product->id) }}"><i class="fa fa-search-plus"></i></a></div>
                                    <div class="icon-box mr-5"><i class="fa fa-heart"></i></div>
                                    <div class="icon-box"><i class="fa fa-shopping-cart"></i></div>
                                </div>
                                <div class="info-group d-flex">
                                    <div class="product-mark new-mark mr-3">@lang('NEW')</div>
                                    <div class="product-mark hot-mark mr-3">@lang('HOT')</div>
                                    <div class="product-mark sales-mark">@lang('SALES')</div>
                                </div>
                            </div>
                            <div class="product-name text-center mt-5 px-4">
                                <a href="{{ route('product', $product->id) }}"><h3 class="font-weight-bold">{{$product->name}}</h3></a>
                                <p class="product-desc">{{$product->short_description}}</p>
                                <h3>
                                    <span class="{{$product->discount_price?'text-line':''}}">RM {{number_format($product->selling_price,2)}}</span>
                                    @if($product->discount_price)
                                        <span class="text-danger ml-3">{{'RM '.number_format($product->discount_price,2)}}</span>
                                    @endif
                                </h3>
                                <div class="d-flex justify-content-center" style="margin-top: 1.8rem">
                                    <div class="rating" id="rate-{{$product->id}}"></div>
                                </div>
                                <p class="my-3" style="font-size: 1.2rem">{{isset($product->review_count)?$product->review_count:0}}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12 d-flex justify-content-end navigation-part">
                        {!! $data->appends($pagination_params)->render() !!}
                    </div>
                @else
                    <div class="col-sm-12">
                        <h3 class="mb-0 text-center text-primary">@lang('no_product')</h3>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        $(function () {
            $(".rating").rateYo({
                starWidth: "25px",
                readOnly: true,
                rating: 4.7
            });

        });
    </script>
@endsection
