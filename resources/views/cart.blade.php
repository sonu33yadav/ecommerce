@php
    $r_products = array();
    $customerId = \Illuminate\Support\Facades\Auth::id();
    $customerAnswer = \App\Models\CustomerAnswer::where('customer_id', $customerId)->first();
    if($customerAnswer){
        $pair = \App\Models\RecommendPair::find($customerAnswer->recommmend_answer_id);
        if($pair){
            $p_ids = explode(",",$pair->product_ids);
            $r_products = \App\Models\Product::whereIn('id', $p_ids)->get();
        }
    }
@endphp
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h3 class="mb-3">@lang('your_cart')</h3>
        <div class="free-gift">
            <h4>@lang('redeem_this_product_with_credits')</h4>
            <h2 class="text-center">This is the Free Gift part. Coming soon</h2>
        </div>
    </div>
    @if(count($r_products)>0)
        <div class="col-sm-12 col-md-12">
            <div class="recommend-products">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach($r_products as $product)
                            <div class="swiper-slide">
                                <div class="d-flex w-100">
                                    <div class="left-img">
                                        <img src="{{count($product->images)>0?$product->images[0]->url:asset('images/product/new-product.jpg')}}">
                                    </div>
                                    <div class="right-side d-flex flex-column justify-content-center align-items-center mt-3" style="flex-grow: 1">
                                        <h3 class="font-weight-bold text-center">{{$product->name}}</h3>
                                        <h2 class="font-weight-bold text-center">
                                            <span class="{{$product->discount_price?'text-line':''}}">MYR {{number_format($product->selling_price,2)}}</span></br>
                                            @if($product->discount_price)
                                                <span class="text-danger">{{'RM '.number_format($product->discount_price,2)}}</span>
                                            @endif
                                        </h2>
                                        
                                        <div class="text-center">
                                            <a href="{{ route('customer.product.addToCart', $product->id) }}" class="btn btn-primary btn-round">@lang('add_to_cart')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    @endif
</div>
@if(count($cartProducts) > 0)
<div class="row mt-6">
    @foreach($cartProducts as $cartProduct)
        <div class="col-sm-12 col-md-12">
            <div class="dashed-line mb-6"></div>
            <div class="main-product-box row mb-6">
                <div class="col-sm-12 col-md-3 text-center">
                    <img style="height: 150px" src="{{count($cartProduct->images)>0?$cartProduct->images[0]->url:asset('images/product/new-product.jpg')}}">
                </div>
                <div class="col-sm-12 col-md-9 text-center">
                    <div class="justify-content-between">
                        <div class="mr-5" style="flex-grow: 1">
                            <h2 class="mb-3">{{$cartProduct->name}}</h2>
                            <p class="mb-1">@lang('choose_your_package') : </p>
                            <div class="package-box d-flex justify-content-between align-items-center mb-1">
                                <div class="mr-5">
                                    <label class="custom-control custom-radio">
                                        <input  type="radio"  class="custom-control-input" name="package_{{$cartProduct->id}}" value="1" data-origin="{{$cartProduct->selling_price}}" data-price="{{$cartProduct->selling_price}}" data-unit="1" onchange="changePackage({{$cartProduct->id}},1)" checked>
                                        <span class="custom-control-label">{{$cartProduct->name}}</span>
                                    </label>
                                </div>
                                <div>
                                    <h4 class="text-right mb-2">MYR <span>{{number_format($cartProduct->selling_price,2)}}</span></h4>
                                </div>
                            </div>
                            @if(count($cartProduct->packages)>0)
                                @foreach($cartProduct->packages as $package)
                                    <div class="package-box d-flex justify-content-between align-items-center mb-1">
                                        <div class="mr-5">
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="package_{{$cartProduct->id}}" value="{{$package->quantity}}" data-origin="{{$cartProduct->selling_price}}" data-price="{{$package->price}}" data-unit="{{$package->quantity}}" onchange="changePackage({{$cartProduct->id}},{{$package->quantity}})">
                                                <span class="custom-control-label">{{$package->name}}</span>
                                            </label>
                                        </div>
                                        <div>
                                            <h4 class="text-right mb-2">MYR {{number_format($package->price,2)}}</h4>
                                            <h5 class="mb-0"><span class="text-line">MYR {{number_format(floatval($cartProduct->selling_price)*floatval($package->quantity),2)}}</span><span class="text-danger ml-4">-MYR {{number_format(floatval($cartProduct->selling_price)*floatval($package->quantity) - floatval($package->price), 2)}}</span></h5>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            <div class="justify-content-between">
                                <div class="counter mr-4" style="height: fit-content">
                                    <i class="fa fa-minus count-minus" data-value="{{$cartProduct->id}}"></i>
                                    <input type="number" name="quantity" id="quantity_{{$cartProduct->id}}" value="1" disabled>
                                    <i class="fa fa-plus count-plus" data-value="{{$cartProduct->id}}" data-limit="{{$cartProduct->stock_quantity}}"></i>
                                </div>
                                <h4 class="mb-0">
                                    RM <span id="each-total-{{$cartProduct->id}}">{{number_format($cartProduct->selling_price,2)}}</span><br>
                                    <span class="text-danger full-total" id="each-total-full-{{$cartProduct->id}}">RM <span id="each-total-discount-{{$cartProduct->id}}">{{number_format($cartProduct->discount_price,2)}}</span></span>
                                </h4>
                            </div>
                            <div class="remove_from_cart mt-5">
                                <button class="btn btn-warning btn-remove-cart" data-value="{{$cartProduct->id}}">@lang('remove')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-sm-12 col-md-12">
        <div class="dashed-line mb-6"></div>
        <div class="row mb-6">
            <div class="col-sm-12 col-md-9 offset-md-3">
                <div class="w-100 d-flex justify-content-between">
                    <div>
                        <h2 class="text-uppercase">@lang('subtotal')</h2>
                        <h4 class="text-uppercase">@lang('use_promo_code')</h4>
                        <h4 class="text-uppercase">@lang('use_voucher')</h4>
                    </div>
                    <div>
                        <h3>MYR <span id="subTotal">0.00</span></h3>
                       
                    </div>
                    <div>
                    <p class="mb-0 text-uppercase"></p>
                    <p class="mb-0 text-uppercase"></p>  
                    </div>
                </div>
                <div class="w-100 d-flex justify-content-between">
                    <p class="mb-0 text-uppercase">@lang('shipping_fee')</p>
                    <p class="mb-0 text-uppercase">MYR 0.00</p>
                </div>
            </div>
        </div>
        <div class="row total-box">
            <div class="col-sm-12 col-md-9 offset-md-3">
                <div class="w-100 d-flex justify-content-between">
                    <h2 class="mb-0 text-uppercase font-weight-bold">@lang('total')</h2>
                    <h2 class="mb-0 text-uppercase font-weight-bold">MYR <span   id="total" name="total">0.00</span></h2>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12 text-right">
                <h5 class="mb-0 text-danger text-uppercase">@lang('total_saving') <span class="mb-0 ml-5">MYR <span id="saving">0.00</span></span></h5>
            </div>
        </div>
        <div class="row mt-6">
            <div class="col-sm-12 text-center">
                <a href="{{ route('product',0) }}" class="btn btn-primary btn-round text-uppercase" style="font-size: 1rem">@lang('continue_shop')</a>
            </div>
        </div>
    </div>
</div>
@endif
<script>
$("#promocode").click(function(){

    if($('#promo_code').val()!=''){         
			$.ajax({
						type: "get",
						url: "{{route('customer.dashboard.cupon')}}",
						data:{
							coupon_code: $('#promo_code').val(),
                            // price: $('#pid').val()
						},
                        
						success: function(data){
							var dataResult = JSON.parse(data);      
							if(dataResult.statusCode==200){
								var after_apply=$('#total').val()-dataResult.value.amount;
                                 alert(after_apply);
								$('#total').val(after_apply);
                                $('#promocode').hide();
								$('#message').html("Promocode applied successfully !");
								
							}
							else if(dataResult.statusCode==201){
								$('#message').html("Invalid promocode !");
							}
						}
			});
		}
		else{
			$('#message').html("Promocode can not be blank .Enter a Valid Promocode !");
		}
	});
</script>

