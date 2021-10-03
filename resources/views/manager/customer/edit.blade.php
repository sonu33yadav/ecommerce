@extends('layouts.app')

@section('page-css')
    <link href="{{asset('plugins/date-picker/spectrum.css')}}" rel="stylesheet" />
    <style>
        .img-circle{
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('customer_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.customer.list')}}">@lang('customers')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{isset($user)?__('update'):__('create')}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form method="post" class="card" action="{{route('admin.user.update')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{isset($user)?$user->id:0}}">
                    <input type="hidden" name="edit_customer" value="1">
                    <div class="card-header">
                        <h3 class="card-title">{{isset($user)?__('edit_customer'):__('create_customer')}}</h3>
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
                            @if (session('no_permission'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger mb-4 text-center" role="alert">
                                        @lang('no_permission_edit')
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
                                    <label class="form-label">@lang('birthday')</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" type="text" name="birthday" value="{{isset($user)?$user->birthday:''}}" placeholder="YYYY-MM-DD" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('gender')</label>
                                    <select class="form-control" name="gender" required>
                                        <option value="" disabled selected>@lang('select_gender')</option>
                                        <option value="M" {{isset($user)&&$user->gender=="M"?'selected':''}}>@lang('male')</option>
                                        <option value="F" {{isset($user)&&$user->gender=="F"?'selected':''}}>@lang('Female')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('race')</label>
                                    <select class="form-control" name="race_id" required>
                                        <option value="" selected disabled>@lang('select_race')</option>
                                        @foreach($races as $race)
                                            <option value="{{$race->id}}" {{(isset($user)&&$user->race_id==$race->id)?'selected':''}}>{{$race->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('contact')</label>
                                    <input type="text" class="form-control" name="contact_number" placeholder="@lang('contact')" value="{{isset($user)?$user->contact_number:''}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('address') 1</label>
                                    <input type="text" class="form-control" name="address" placeholder="@lang('address') 1" value="{{isset($user)?$user->address:''}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('address') 2</label>
                                    <input type="text" class="form-control" name="address2" placeholder="@lang('address') 2" value="{{isset($user)?$user->address2:''}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('address') 3</label>
                                    <input type="text" class="form-control" name="address3" placeholder="@lang('address') 3" value="{{isset($user)?$user->address3:''}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('postcode')</label>
                                    <input type="text" class="form-control" name="postcode" placeholder="@lang('postcode')" value="{{isset($user)?$user->postcode:''}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('state')</label>
                                    <input type="text" class="form-control" name="state" placeholder="@lang('state')" value="{{isset($user)?$user->state:''}}" required>
                                </div>
                            </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">@lang('country')</label>
                                        <select name="country_id" id="country" class="form-control ">
                                            <option value="" selected disabled>@lang('select_country')</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" {{(isset($user)&&$user->country_id==$country->id)?'selected':''}}>{{$country->name}}</option>
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
                                    <label class="form-label">@lang('status')</label>
                                    <select name="status" id="status" class="form-control ">
                                        <option value="1" {{(isset($user)&&$user->status=="1")?'selected':''}}>@lang('active')</option>
                                        <option value="0" {{(!isset($user)||$user->status=="0")?'selected':''}}>@lang('inactive')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox w-fit-content">
                                        <input type="checkbox" name="reset" id="reset" class="custom-control-input" onchange="resetPass()"/>
                                        <span class="custom-control-label">@lang('password_reset')</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6" id="reset-password">
                                <div class="form-group">
                                    <label class="form-label">@lang('new_password')</label>
                                    <input type="password" class="form-control" name="password" placeholder="@lang('new_password')">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">@lang('profile')</label>
                                    <div class="input-file input-file-image">
                                        <img class="img-upload-preview img-circle" id="avatar-img" width="100" height="100" src="{{isset($user->avatar)?$user->avatar:''}}" alt="preview" onerror="src='{{asset('images/empty.jpg')}}'">
                                        <input type="file" class="form-control form-control-file d-none" id="avatar" name="avatar" accept="image/*">
                                        <button type="button" class="btn btn-primary ml-2" onclick="uploadImage()"><i class="fa fa-image"></i> @lang('upload')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{route('admin.customer.list')}}" class="btn btn-link">@lang('back_to_list')</a>
                            <button type="submit" class="btn btn-primary ml-auto">{{isset($user)?__('update'):__('create')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <!-- Datepicker js -->
    <script src="{{ asset('plugins/date-picker/spectrum.js') }}"></script>
    <script src="{{ asset('plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.maskedinput.js') }}"></script>
    <script>
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

        $( ".fc-datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });

        function resetPass() {
            let reset = $("#reset").is(':checked');
            if(reset){
                $('#reset-password').show();
            }else{
                $('#reset-password').hide();
            }
        }

        $(document).ready(function () {
            $('#reset-password').hide();
        })
    </script>
@endsection


