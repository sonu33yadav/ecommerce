@extends('layouts.template')

@section('content')
    <div class="page login-img">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-6">
                            <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" class="h-6" alt=""></a>
                        </div>
                        <form class="card" method="post" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="card-body p-6">
                                <div class="text-center card-title">@lang('password_reset')</div>
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
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="@lang('confirm_password')" minlength="6" required>
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
    </div>
@endsection
