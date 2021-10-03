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
            <h4 class="page-title">@lang('profile')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{env('APP_NAME')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('edit_profile')</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form method="post" class="card" action="{{route('admin.profile.update')}}" enctype="multipart/form-data" onsubmit="return checkPass()">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">@lang('edit_profile')</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if (session('update_success'))
                                <div class="col-md-12">
                                    <div class="alert alert-success mb-4 text-center" role="alert">
                                        @lang('updated_successfully')
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
                            @if (session('user_edit_error'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger mb-4 text-center" role="alert">
                                        @lang('server_error')
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('name')</label>
                                    <input type="text" class="form-control" name="name" placeholder="@lang('name')" value="{{isset($user)?$user->name:''}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('email')</label>
                                    <input type="email" class="form-control" name="email" placeholder="@lang('email')" value="{{isset($user)?$user->email:''}}" required {{isset($user)?'disabled':''}}>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('department')</label>
                                    <input type="text" class="form-control" name="department" placeholder="@lang('department')" value="{{isset($user)?$user->department:''}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('designation')</label>
                                    <input type="text" class="form-control" name="designation" placeholder="@lang('designation')" value="{{isset($user)?$user->designation:''}}">
                                </div>
                            </div>
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
@endsection

@section('page-js')
    <script>
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
@endsection


