<div class="row" style="margin-top:3rem">
    <div class="col-sm-12 col-md-6 main-info" style="padding-right: 3rem">
        <h3 class="mb-1 text-uppercase">@lang('your_contact_information') :</h3>
        <label>@lang('already_have_member_account')<a class="ml-2 text-info" href="#">@lang('sign_here')</a></label>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="@lang('email')" name="check_email">
        </div>
        <h3 class="mt-6 mb-1">@lang('your_shipping_detail') : </h3>
        <label>@lang('kindly_note_postal_address')</label>
        <div class="row mt-5">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <div class="input-icon custom-input-icon mb-3">
                        <input type="text" class="form-control" name="check_first_name" placeholder="@lang('first_name')">
                        <span class="input-icon-addon">
                            <i class="fa fa-question-circle-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <div class="input-icon custom-input-icon mb-3">
                        <input type="text" class="form-control" name="check_last_name" placeholder="@lang('last_name')">
                        <span class="input-icon-addon">
                            <i class="fa fa-question-circle-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="input-icon custom-input-both-icon mb-3">
                        <span class="input-icon-addon pl-3">
                            <span class="prefix"> +60 | </span>
                        </span>
                        <input type="text" class="form-control" name="check_mobile" placeholder="@lang('mobile_no')">
                        <span class="input-icon-addon">
                            <i class="fa fa-question-circle-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="input-icon custom-input-icon mb-3">
                        <select class="form-control" name="check_country">
                            <option value="" disabled selected>@lang('country')</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        <span class="input-icon-addon custom-addon">
                            <i class="fa fa-question-circle-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="input-icon custom-input-icon mb-3">
                        <input type="text" class="form-control" name="check_address" placeholder="@lang('full_address')">
                        <span class="input-icon-addon">
                            <i class="fa fa-question-circle-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <div class="input-icon custom-input-icon mb-3">
                        <input type="text" class="form-control" name="check_postcode" placeholder="@lang('postcode')">
                        <span class="input-icon-addon">
                            <i class="fa fa-question-circle-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <div class="input-icon custom-input-icon mb-3">
                        <input type="text" class="form-control" name="check_state" placeholder="@lang('state')">
                        <span class="input-icon-addon">
                            <i class="fa fa-question-circle-o"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6" style="padding-left: 3rem;">
        <h3 class="mb-2 text-uppercase">@lang('payment_method') :</h3>
        <div class="w-100 method-box d-flex justify-content-between align-items-center mb-1">
            <div>
                <label class="custom-control custom-radio mb-0">
                    <input type="radio" class="custom-control-input" name="payment_method" value="banking">
                    <span class="custom-control-label">@lang('online_banking')</span>
                </label>
            </div>
            <div>
                <img src="{{asset('images/home/fpx.png')}}" style="height: 50px">
            </div>
        </div>
        <div class="w-100 method-box d-flex justify-content-between align-items-center mb-1">
            <div>
                <label class="custom-control custom-radio mb-0">
                    <input type="radio" class="custom-control-input" name="payment_method" value="card">
                    <span class="custom-control-label">@lang('credit_card_debit')</span>
                </label>
            </div>
            <div>
                <img src="{{asset('images/home/card.png')}}" style="height: 40px">
            </div>
        </div>
        <div class="w-100 method-box d-flex justify-content-between align-items-center mb-1">
            <div>
                <label class="custom-control custom-radio mb-0">
                    <input type="radio" class="custom-control-input" name="payment_method" value="wallet">
                    <span class="custom-control-label">@lang('e_wallet')</span>
                </label>
            </div>
            <div style="height: 50px">
            </div>
        </div>
        <div class="confirm-check mt-6">
            <div class="form-group">
                <label class="custom-control custom-checkbox w-fit-content">
                    <input type="checkbox" name="check_agree" id="check_agree" class="custom-control-input"/>
                    <span class="custom-control-label">@lang('confirm_checkout')</span>
                </label>
            </div>
            <div class="text-center mt-6">
                <button type="submit" class="btn btn-primary btn-round btn-checkout text-uppercase">@lang('checkout')</button>
            </div>
        </div>
    </div>
</div>
