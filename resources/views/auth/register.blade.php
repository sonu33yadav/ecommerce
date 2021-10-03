@extends('layouts.template')

@section('page-css')

@endsection

@section('content')
    <div class="page login-img">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-6">
                            <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" class="h-6" alt=""></a>
                        </div>
                        <form class="card" method="post" action="{{url('/register')}}">
                            @csrf
                            <div class="card-body p-6">
                                <div class="card-title text-center">@lang('create_new_account')</div>
                                <div class="form-group">
                                    <label class="form-label">@lang('name')</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="@lang('enter_name')" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>@lang('name_incorrect')</strong>
                                    </span>
                                    @enderror
                                </div>
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
                                    <label class="form-label">@lang('password')</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="@lang('enter_password')" minlength="6" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                         <strong>@lang('password_incorrect')</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('confirm_password')</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="@lang('confirm_password')" minlength="6" required>
                                </div>
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" name="agree" id="agree" class="custom-control-input" onchange="changeStatus()"/>
                                        <span class="custom-control-label">@lang('agree_the') <a href="#">@lang('terms_and_policy')</a></span>
                                    </label>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" id="btn_register" class="btn btn-primary btn-block">@lang('REGISTER')</button>
                                </div>
                                <div class="text-center text-muted mt-4">
                                    @lang('already_have_account') <a href="{{route('login')}}">@lang('SIGNIN')</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        $(document).ready(function () {
            changeStatus();
        })
        function changeStatus() {
            let checked = $("#agree").is(':checked');
            if(checked){
                $('#btn_register').prop('disabled',false);
            }else{
                $('#btn_register').prop('disabled',true);
            }
        }
    </script>
@endsection
