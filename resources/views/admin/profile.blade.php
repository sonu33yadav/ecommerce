@extends('layouts.app')

@section('page-css')
    <style>
        .img-circle{
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('user_info')</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-profile "  style="background-image: url(assets/images/photos/12.jpg);    background-position: center; background-size:cover;">
                    <div class="card-body text-center">
                        <img class="img-upload-preview img-circle" id="avatar-img" width="100" height="100" src="{{isset($user->avatar)?$user->avatar:''}}" alt="preview" onerror="src='{{asset('images/empty.jpg')}}'">
                        <h3 class="my-3">{{$user->name}}</h3>
                        <p class="mb-4">{{env('APP_NAME')}} @lang('customer')</p>
                        <a href="{{route('customer.profile.edit')}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> @lang('edit_profile')</a>
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
                                <i class="fa fa-address-book" aria-hidden="true"></i>
                            </div>
                            <div class="card-body p-1 ml-3">
                                <h6 class="mediafont text-dark">@lang('address')</h6><span class="d-block">{{$user->address}}</span>
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
                                            <td><strong>@lang('contact') :</strong> {{$user->contact_number}}</td>
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
                                            <td><strong>@lang('address') :</strong> {{$user->address}}</td>
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
@endsection
@section('page-js')

@endsection
