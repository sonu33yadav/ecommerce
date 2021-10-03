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
                        <form class="card"  method="post"  action="{{ route('password.email') }}">
                            @csrf
                            <div class="card-body p-6">
                                <div class="text-center card-title">@lang('forgot_password')</div>
                                @if (session('status'))
                                    <div class="alert alert-success mx-4 mb-4 mt-3" role="alert">
                                        @lang('reset_email_sent')
                                    </div>
                                @endif
                                @if (session('email_not_exist'))
                                    <div class="alert alert-danger mx-4 mb-4 mt-3" role="alert">
                                        @lang('unregistered_email')
                                    </div>
                                @endif
                                <div class="form-group">
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
                                <div class="text-center text-muted mt-3">
                                    @lang('back_to') <a href="{{ route('login') }}">@lang('SIGNIN')</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
