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
                        <form class="card" method="post" action="{{url('/login')}}">
                            @csrf
                            <div class="card-body p-6">
                                <div class="card-title text-center">@lang('login_account')</div>
                                @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ __('email_or_password_incorrect') }}
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label class="form-label">@lang('email_address')</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  placeholder="@lang('enter_email')" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('password')
                                        <a href="{{ route('password.request') }}" class="float-right small">@lang('i_forgot_password')</a>
                                    </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="@lang('enter_password')" required>
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
                                </div>
                                <div class="text-center text-muted mt-3">
                                    @lang('not_have_account') <a href="{{ route('register') }}">@lang('REGISTER')</a>
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
        function validCheck() {
            showLoading();
            return true;
        }
    </script>
@endsection
