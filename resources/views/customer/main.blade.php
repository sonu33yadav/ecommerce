@extends('base.static')

@section('page-css')
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <style>
        .tab-menu-heading{
            padding: 0;
        }
        .panel-tabs li{
            font-size: 1.1rem;
        }
        .panel-tabs li i{
            font-size: 2rem;
        }
    </style>
@endsection
@php
    $main_seg = Request::segment(1);
    $sub_seg = Request::segment(2);
@endphp
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 col-md-4 d-flex main-info justify-content-sm-center justify-content-md-start">
                <div class="avatar-image">
                    <img class="img-circle br-1" width="80" height="80" src="{{isset($user->avatar)?$user->avatar:''}}" alt="preview" onerror="src='{{asset('images/empty.jpg')}}'">
                </div>
                <div class="mt-2 ml-3">
                    <h4 class="mb-2">@lang('hi'), <span class="font-weight-bold">{{$user->name}}</span></h4>
                    <p class="mb-0">@lang('member') #ID: <span class="font-weight-bold">{{$user->member_id}}</span></p>
                    <p class="mb-0">@lang('member_since'): <span class="font-weight-bold">{{date('Y-m-d',strtotime($user->created_at))}}</span></p>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 pl-5">
                <div class="d-flex justify-content-sm-center justify-content-md-start mt-sm-3 mt-md-0">
                    <div class="box mr-5">
                        <p class="font-weight-bold mb-1">TOTAL SPENDING: </p>
                        <p class="text-sm-center text-md-left" style="font-size: 1.5rem">RM 2,388</p>
                    </div>
                    <div class="box">
                        <p class="font-weight-bold mb-1">TOTAL CREDIT POINTS: </p>
                        <p class="text-sm-center text-md-left" style="font-size: 1.5rem">100</p>
                    </div>
                </div>
                <div class="tab-menu-heading" style="border: none">
                    <div class="tabs-menu1">
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#orders" class="{{$sub_seg=="orders"?'active':''}} d-flex align-items-center" data-toggle="tab"><i class="fa fa-shopping-cart mr-3"></i> @lang('orders')</a></li>
                            <li><a href="#wishes" class="{{$sub_seg=="wishes"?'active':''}} d-flex align-items-center" data-toggle="tab"><i class="fa fa-heart-o mr-3"></i> @lang('wish_list')</a></li>
                            <li><a href="#rewards" class="{{$sub_seg=="rewards"?'active':''}} d-flex align-items-center" data-toggle="tab"><i class="fa fa-gift mr-3"></i> @lang('rewards')</a></li>
                            <li><a href="#account_info" class="{{($sub_seg=="account"||$sub_seg=="edit_account")?'active':''}} d-flex align-items-center" data-toggle="tab"><i class="fa fa-user-o mr-3"></i> @lang('account_info')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="tab-content mt-5">
                    <div class="tab-pane {{$sub_seg=="orders"?'active':''}} " id="orders">
                        <p>This will be replaced with the order list. You can see your order history this page.</p>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et</p>
                    </div>
                    <div class="tab-pane {{$sub_seg=="wishes"?'active':''}} " id="wishes">
                        <p>default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like</p>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et</p>
                    </div>
                    <div class="tab-pane {{$sub_seg=="rewards"?'active':''}} " id="rewards">
                        <p>over the years, sometimes by accident, sometimes on purpose (injected humour and the like</p>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et</p>
                    </div>
                    <div class="tab-pane {{$sub_seg=="account"?'active':''}} " id="account_info">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-profile bg-gray-dark-lightest">
                                    <div class="card-body text-center">
                                        <img class="img-upload-preview img-circle" width="100" height="100" src="{{isset($user->avatar)?$user->avatar:''}}" alt="preview" onerror="src='{{asset('images/empty.jpg')}}'">
                                        <h3 class="my-3">{{$user->name}}</h3>
                                        <p class="mb-4">{{env('APP_NAME')}} @lang('customer')</p>
                                        <a href="{{ url('/main/edit_account') }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> @lang('edit_profile')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card p-5 ">
                                    <div class="card-title">
                                        @lang('contact_and_personal_info')
                                    </div>
                                    <div class="media-list">
                                        <div class="media mt-1 pb-2">
                                            <div class="mediaicon">
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="card-body p-1 ml-3">
                                                <h6 class="mediafont text-dark">@lang('email')</h6><span class="d-block">{{$user->email}}</span>
                                            </div>
                                        </div>
                                        <div class="media mt-1 pb-2">
                                            <div class="mediaicon">
                                                <i class="fa fa-link" aria-hidden="true"></i>
                                            </div>
                                            <div class="card-body ml-3 p-1">
                                                <h6 class="mediafont text-dark">@lang('contact')</h6><span class="d-block">{{$user->contact_number}}</span>
                                            </div>
                                        </div>
                                        <div class="media mt-1 pb-2">
                                            <div class="mediaicon">
                                                <i class="fa fa-code-fork" aria-hidden="true"></i>
                                            </div>
                                            <div class="card-body p-1 ml-3">
                                                <h6 class="mediafont text-dark">@lang('referral_code')</h6><span class="d-block">{{$user->referral_code}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class=" " id="profile-log-switch">
                                            <div class="fade show active">
                                                <div class="table-responsive border ">
                                                    <table class="table row table-borderless w-100 m-0 ">
                                                        <tbody class="col-lg-6 p-0">
                                                        <tr>
                                                            <td><strong>@lang('name') :</strong> {{$user->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('gender') :</strong> {{$user->gender=="M"?__('male'):__('female')}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('contact') :</strong> {{$user->contact_number}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('address') 2 :</strong> {{$user->address2}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('postcode') :</strong> {{$user->postcode}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('race') :</strong> {{$user->race?$user->race->name:''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('language') :</strong> {{__($user->language)}}</td>
                                                        </tr>
                                                        </tbody>
                                                        <tbody class="col-lg-6 p-0">
                                                        <tr>
                                                            <td><strong>@lang('email') :</strong> {{$user->email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('birthday') :</strong> {{$user->birthday}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('address') 1 :</strong> {{$user->address}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('address') 3 :</strong> {{$user->address3}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('state') :</strong> {{$user->state}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('country') :</strong> {{$user->country?$user->country->name:''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>@lang('referral_code') :</strong> {{$user->referral_code}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane {{$sub_seg=="edit_account"?'active':''}} " id="account_edit">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <form method="post" class="card bg-gray-dark-lightest" action="{{route('customer.profile.update')}}" enctype="multipart/form-data" onsubmit="return checkPass()">
                                    @csrf
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('edit_account_info')</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @if (session('user_edit_error'))
                                                <div class="col-md-12">
                                                    <div class="alert alert-danger mb-4 text-center" role="alert">
                                                        @lang('server_error')
                                                    </div>
                                                </div>
                                            @endif
                                            @if (session('old_pass_incorrect'))
                                                <div class="col-md-12">
                                                    <div class="alert alert-danger mb-4 text-center" role="alert">
                                                        @lang('old_password_incorrect')
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('name')</label>
                                                    <input type="text" class="form-control" name="name" placeholder="@lang('enter_name')" value="{{$user->name}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('email')</label>
                                                    <input type="email" class="form-control" name="email" placeholder="@lang('enter_email')" value="{{$user->email}}" required disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('birthday')</label>
                                                    <input type="text" class="form-control fc-datepicker" name="birthday" placeholder="@lang('enter_birthday')" value="{{$user->birthday}}" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('gender')</label>
                                                    <select name="gender" id="gender" class="form-control" required>
                                                        <option value="en" {{$user->gender=="M"?'selected':''}}>@lang('male')</option>
                                                        <option value="ma" {{$user->gender=="F"?'selected':''}}>@lang('female')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('contact')</label>
                                                    <input type="text" class="form-control" name="contact_number" placeholder="@lang('enter_contact_number')" value="{{$user->contact_number}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('address') 1</label>
                                                    <input type="text" class="form-control" name="address" placeholder="@lang('address') 1" value="{{$user->address}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('address') 2</label>
                                                    <input type="text" class="form-control" name="address2" placeholder="@lang('address') 2" value="{{$user->address2}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('address') 3</label>
                                                    <input type="text" class="form-control" name="address3" placeholder="@lang('address') 3" value="{{$user->address3}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('postcode')</label>
                                                    <input type="text" class="form-control" name="postcode" placeholder="@lang('enter_postcode')" value="{{$user->postcode}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('state')</label>
                                                    <input type="text" class="form-control" name="state" placeholder="@lang('enter_state')" value="{{$user->state}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('race')</label>
                                                    <select name="race_id" class="form-control" required>
                                                        <option value="" selected disabled>@lang('select_race')</option>
                                                        @foreach($races as $race)
                                                            <option value="{{$race->id}}" {{$race->id==$user->race_id?'selected':''}}>{{$race->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('country')</label>
                                                    <select class="form-control" name="country_id" required>
                                                        <option value="" selected disabled>@lang('select_country')</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->id}}" {{$country->id==$user->country_id?'selected':''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('language')</label>
                                                    <select name="language" id="language" class="form-control ">
                                                        <option value="en" {{(isset($user)&&$user->language=="en")?'selected':''}}>@lang('en')</option>
                                                        <option value="ma" {{(!isset($user)||$user->language=="ma")?'selected':''}}>@lang('ma')</option>
                                                        <option value="cn" {{(!isset($user)||$user->language=="cn")?'selected':''}}>@lang('cn')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('referral_code')</label>
                                                    <input type="text" class="form-control" name="referral_code" value="{{isset($user)?$user->referral_code:''}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('profile')</label>
                                                    <div class="input-file input-file-image">
                                                        <img class="img-upload-preview img-circle" id="avatar-img" width="100" height="100" src="{{$user->avatar?$user->avatar:''}}" alt="preview" onerror="src='{{asset('images/empty.jpg')}}'">
                                                        <input type="file" class="form-control form-control-file d-none" id="avatar" name="avatar" accept="image/*">
                                                        <button type="button" class="btn btn-primary ml-2" onclick="uploadImage()"><i class="fa fa-image"></i> @lang('upload')</button>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($user->login_type != "facebook")
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="custom-control custom-checkbox w-fit-content">
                                                            <input type="checkbox" name="reset" id="reset" class="custom-control-input" onchange="resetPass()"/>
                                                            <span class="custom-control-label">@lang('password_reset')</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 password-form">
                                                    <div class="form-group">
                                                        <label class="form-label">@lang('old_password')</label>
                                                        <input type="password" class="form-control" name="old_password" id="old_password" placeholder="@lang('old_password')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 password-form">
                                                    <div class="form-group">
                                                        <label class="form-label">@lang('new_password')</label>
                                                        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="@lang('new_password')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 password-form">
                                                    <div class="form-group">
                                                        <label class="form-label">@lang('confirm_password')</label>
                                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="@lang('confirm_password')">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary ml-auto">@lang('update')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane {{$sub_seg=="cart"?'active':''}} " id="cart">
                        @include('cart')
                        @include('payment_form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script>
        localStorage.removeItem('status');
        $( ".fc-datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });

        function uploadImage(){
            document.getElementById('avatar').click();
        }

        $("#avatar").on("change", function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatar-img').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        })

        function resetPass() {
            let reset = $("#reset").is(':checked');
            if(reset){
                $('.password-form').show();
            }else{
                $('.password-form').hide();
            }
        }

        function checkPass(){
            let reset = $("#reset").is(':checked');
            if(reset){
                let old_pass = $('#old_password').val();
                let new_pass = $('#new_password').val();
                let confirm_pass = $('#confirm_password').val();
                if(old_pass == "" || new_pass == "" || confirm_pass == ""){
                    $.growl.warning({
                        title: "{{__('warning')}}",
                        message: "{{__('input_password_correctly')}}",
                        duration: 3000
                    });
                    return false;
                }
                if(new_pass != confirm_pass){
                    $.growl.warning({
                        title: "{{__('warning')}}",
                        message: "{{__('password_not_equal')}}",
                        duration: 3000
                    });
                    return false;
                }
                else
                    return true;
            }else{
                return true;
            }
        }

        $(document).ready(function () {
            $('.password-form').hide();
        })
    </script>

    <!---cart block-->
    <script>
        let quantity_units = [];
        let cartIds;

        $(document).ready(function () {
            const swiper = new Swiper('.swiper', {
                // Optional parameters
                direction: 'horizontal',
                loop: false,

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },

                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                }
            });

            //format cart quantity
            cartIds= JSON.parse('{{isset($myCarts)?json_encode($myCarts):json_encode(array())}}');
            for(let i=0; i<cartIds.length; i++){
                quantity_units[cartIds[i]] = 1;
            }

            calcSubSum();

            $('.full-total').hide();
        })

        $(document).on('click','.count-plus', function () {
            let targetId = $(this).data('value');
            let q_unit = quantity_units[targetId];
            let current_quantity = $('#quantity_' + targetId).val();
            let new_quantity = parseInt(current_quantity) + parseInt(q_unit)
            let limit = $(this).data('limit');
            if(new_quantity <= limit)
                $('#quantity_' + targetId).val(new_quantity);

            calcSubSum();

            calcEachSum(targetId)
        })

        $(document).on('click','.count-minus', function () {
            let targetId = $(this).data('value');
            let q_unit = quantity_units[targetId];
            let current_quantity = $('#quantity_' + targetId).val();
            let new_quantity = parseInt(current_quantity) - parseInt(q_unit)
            if(new_quantity > 0){
                $('#quantity_' + targetId).val(new_quantity);
            }

            calcSubSum();

            calcEachSum(targetId)
        })

        $(document).on('change','.package', function () {
            let targetId = $(this).data('value');
            $('#quantity_' + targetId).val(quantity_units[targetId]);
        })

        function changePackage(p_id, pa_id) {
            quantity_units[p_id] = pa_id
            $('#quantity_' + p_id).val(quantity_units[p_id]);

            calcSubSum()

            calcEachSum(p_id)
        }

        function calcEachSum(p_id){
            let product_count = $('#quantity_' + p_id).val();
            let index_name = 'package_' + p_id;
            let product_price = $('input[name="'+ index_name +'"]:checked').attr("data-price");
            let package_unit = $('input[name="'+ index_name +'"]:checked').attr("data-unit");
            let product_origin_price = $('input[name="'+ index_name +'"]:checked').attr("data-origin");
            let sum = product_count/package_unit * product_price;
            let origin_sum = product_origin_price * product_count;

            $('#each-total-' + p_id).html(origin_sum.toFixed(2));
            $('#each-total-discount-' + p_id).html(sum.toFixed(2));
            if(package_unit == 1){
                $('#each-total-full-' + p_id).hide();
                $('#each-total-' + p_id).removeClass('text-line')
            }else{
                $('#each-total-full-' + p_id).show();
                $('#each-total-' + p_id).addClass('text-line')
            }
        }

        $(document).on('click', '.btn-remove-cart', function () {
            swal({
                title: "@lang('are_you_sure')",
                text: "@lang('product_will_remove_from_cart')",
                type: 'question',
                icon: 'warning',
                buttons:{
                    confirm: {
                        text : '@lang('yes')',
                        className : 'btn btn-primary btn-min'
                    },
                    cancel: {
                        visible: true,
                        text : '@lang('cancel')',
                        className: 'btn btn-warning'
                    }
                }
            }).then((confirmed) => {
                if (confirmed) {
                    let id = $(this).data('value');
                    let _token = '{{csrf_token()}}';
                    let path_delete = '{{route('customer.cart.remove')}}';
                    $.post(
                        path_delete,
                        {_token:_token,id:id},
                        function(resp){
                            if(resp.result){
                                $.growl.notice({
                                    title: "{{__('success')}}",
                                    message: "{{__('cart_removed')}}",
                                    duration: 3000
                                });
                                location.reload();
                            }else{
                                $.growl.warning({
                                    title: "{{__('error')}}",
                                    message: "{{__('try_again')}}",
                                    duration: 3000
                                });
                            }
                        }
                    )
                }
            });
        })

        function calcSubSum() {
            let sum = 0;
            let save_sum = 0;
            for (let i=0; i<cartIds.length; i++){
                let p_id = cartIds[i];
                let product_count = $('#quantity_' + p_id).val();
                let index_name = 'package_' + p_id;
                let product_price = $('input[name="'+ index_name +'"]:checked').attr("data-price");
                let package_unit = $('input[name="'+ index_name +'"]:checked').attr("data-unit");
                sum += product_count/package_unit * product_price;
                if(package_unit != 1){
                    let product_origin_price = $('input[name="'+ index_name +'"]:checked').attr("data-origin");
                    let each_sum = product_origin_price * product_count - product_count/package_unit * product_price;
                    save_sum += each_sum;
                }
            }
            $('#subTotal').html(sum.toFixed(2));
            $('#total').html(sum.toFixed(2));
            $('#saving').html(save_sum.toFixed(2))
        }
    </script>
@endsection
