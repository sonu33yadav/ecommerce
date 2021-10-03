@extends('base.static')

@section('content')
<div class="container" style="margin-top: 5rem">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="padding: 1.5rem 2.5rem">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('verification_link_sent') }}
                        </div>
                    @endif
                    <div class="text-center w-100 mb-2">
                        <img src="{{asset('images/icons/mail.png')}}" style="width: 80px">
                    </div>
                    <h2 class="text-center">@lang('verification_email_sent')</h2>
                    <p class="text-center" style="font-size: 0.9rem; margin-bottom: 2rem">{{ __('thanks_your_signing_up') }}</p>
                    <form class="d-inline text-center" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <p class="mb-2">{{ __('I_did_not_receive_email') }}</p>
                        <div class="text-center w-100">
                            <button type="submit" class="btn btn-resend text-uppercase">{{ __('resend_verify_email') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
