<!-- Register Popup -->
@php
    $races = \App\Models\Race::all();
    $countries = \App\Models\Country::orderBy('name','ASC')->get();
@endphp
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 60rem">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 ml-5 text-center" id="registerModalLabel">@lang('create_new_account')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('/register')}}" onsubmit="return registerCheck()">
                    @csrf
                    <div class="p-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('name')</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="@lang('enter_name')" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>@lang('name_incorrect')</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('email_address')</label>
                                    <input type="email" id="register_email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="@lang('enter_email')" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>@lang('email_incorrect')</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('password')</label>
                                    <input type="password" id="register_password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="@lang('enter_password')" minlength="6" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>@lang('password_incorrect')</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('confirm_password')</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="@lang('confirm_password')" minlength="6" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('birthday')</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" type="text" name="birthday" value="{{ old('birthday') }}" placeholder="YYYY-MM-DD" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('gender')</label>
                                    <select class="form-control" name="gender" required>
                                        <option value="" disabled selected>@lang('select_gender')</option>
                                        <option value="M">@lang('male')</option>
                                        <option value="F">@lang('Female')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('preferred_lang')</label>
                                    <select class="form-control" name="language" required>
                                        <option value="" selected disabled>@lang('select_language')</option>
                                        <option value="en">@lang('ENGLISH')</option>
                                        <option value="ma">@lang('MALAY')</option>
                                        <option value="cn">@lang('CHINESE')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('race')</label>
                                    <select class="form-control" name="race_id">
                                        <option value="" selected disabled>@lang('select_race')</option>
                                        @foreach($races as $race)
                                            <option value="{{$race->id}}">{{$race->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('contact')</label>
                                    <input type="text" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ old('contact_number') }}" placeholder="@lang('enter_contact_number')" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('address') 1</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="@lang('enter_address')1" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('address') 2</label>
                                    <input type="text" class="form-control" name="address2" value="{{ old('address2') }}" placeholder="@lang('enter_address')2" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('address') 3</label>
                                    <input type="text" class="form-control" name="address3" value="{{ old('address3') }}" placeholder="@lang('enter_address')3">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('postcode')</label>
                                    <input type="text" class="form-control" name="postcode" value="{{ old('postcode') }}" placeholder="@lang('enter_postcode')" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('state')</label>
                                    <input type="text" class="form-control" name="state" value="{{ old('state') }}" placeholder="@lang('enter_state')" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('country')</label>
                                    <select class="form-control" name="country_id" required>
                                        <option value="" selected disabled>@lang('select_country')</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox w-fit-content">
                                        <input type="checkbox" name="agree" id="agree" class="custom-control-input" onchange="changeStatus()"/>
                                        <span class="custom-control-label">@lang('agree_the') <a href="#" style="color: #0b7ec4">@lang('terms_and_policy')</a></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-footer">
                                    <button type="submit" id="btn_register" class="btn btn-primary btn-block">@lang('REGISTER')</button>
{{--                                    <a href="{{ route('facebook', 'register') }}" id="btn_register_facebook" class="btn btn-primary btn-block"><i class="fa fa-facebook-square mr-3"></i>@lang('FACEBOOK')</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Register End -->
<!-- Login Popup -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog h-90 d-flex align-items-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 ml-5 text-center" id="loginModalLabel">@lang('login_account')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('/login')}}" onsubmit="return logCheck()">
                    @csrf
                    <div class="p-3">
                        @if($errors->has('email'))
                        <div class="alert alert-danger" id="login_email_error" role="alert">
                            {{ __('email_or_password_incorrect') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">@lang('email_address')</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="login_email" name="email"  placeholder="@lang('enter_email')" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">@lang('password')
                                <a href="{{route('password.request')}}" class="float-right small forgot_password">@lang('i_forgot_password')</a>
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="login_password" name="password" placeholder="@lang('enter_password')" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                <span class="custom-control-label">@lang('remember_me')</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">@lang('SIGNIN')</button>
{{--                            <a href="{{ route('facebook', 'login') }}"  id="btn_facebook" class="btn btn-primary btn-block"><i class="fa fa-facebook-square mr-3"></i>@lang('FACEBOOK')</a>--}}
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->
<!-- Password Reset Email -->
<div class="modal fade" id="pEmailModal" tabindex="-1" role="dialog" aria-labelledby="pEmailLabel" aria-hidden="true">
    <div class="modal-dialog h-90 d-flex align-items-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 ml-5 text-center" id="pEmailLabel">@lang('forgot_password')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('password.email') }}">
                    @csrf
                    <div class="p-3">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                @lang('reset_email_sent')
                            </div>
                        @endif
                        @if (session('email_not_exist'))
                            <div class="alert alert-danger mb-4 mt-3" role="alert">
                                @lang('unregistered_email')
                            </div>
                        @endif
                        <div class="form-group mb-3">
                            <label class="form-label" for="email">@lang('email_address')</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="@lang('enter_email')">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>@lang('email_incorrect')</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">@lang('send')</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Password Reset Email End -->
<!-- Password Reset -->
<div class="modal fade" id="pResetModal" tabindex="-1" role="dialog" aria-labelledby="pResetLabel" aria-hidden="true">
    <div class="modal-dialog h-90 d-flex align-items-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 ml-5 text-center" id="pResetLabel">@lang('password_reset')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('password.update') }}" onsubmit="return resetCheck()">
                    @csrf
                    <input type="hidden" name="token" value="{{ isset($token)?$token:'' }}">
                    <div class="p-3">
                        <div class="form-group">
                            <label class="form-label">@lang('email_address')</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="@lang('enter_email')" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>@lang('email_incorrect')</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">@lang('new_password')</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="@lang('enter_new_password')" minlength="6" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                         <strong>@lang('password_incorrect')</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">@lang('confirm_password')</label>
                            <input id="reset_password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="@lang('confirm_password')" minlength="6" required>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">@lang('reset')</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Password Reset End -->
