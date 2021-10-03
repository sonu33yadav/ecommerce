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
            <h4 class="page-title">@lang('user_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('manager.user.list')}}">@lang('users')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{isset($user)?__('update'):__('create')}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form method="post" class="card" action="{{route('admin.user.update')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{isset($user)?$user->id:0}}">
                    <div class="card-header">
                        <h3 class="card-title">{{isset($user)?__('edit_user'):__('create_user')}}</h3>
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
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('name')</label>
                                    <input type="text" class="form-control" name="name" placeholder="@lang('name')" value="{{isset($user)?$user->name:''}}" required>
                                </div>
                                @if(!isset($user))
                                <div class="form-group">
                                    <label class="form-label">@lang('password')</label>
                                    <input type="password" class="form-control" name="password" placeholder="@lang('password')" required>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="form-label">@lang('contact')</label>
                                    <input type="text" class="form-control" name="contact_number" placeholder="@lang('contact')" value="{{isset($user)?$user->contact_number:''}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('role')</label>
                                    <select name="role" id="role" name="role" class="form-control ">
                                        <option value="admin" {{(isset($user)&&$user->role=="admin")?'selected':''}}>@lang('admin')</option>
                                        <option value="super_admin" {{(isset($user)&&$user->role=="super_admin")?'selected':''}}>@lang('super_admin')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('profile')</label>
                                    <div class="input-file input-file-image">
                                        <img class="img-upload-preview img-circle" id="avatar-img" width="100" height="100" src="{{isset($user->avatar)?$user->avatar:''}}" alt="preview" onerror="src='{{asset('images/empty.jpg')}}'">
                                        <input type="file" class="form-control form-control-file d-none" id="avatar" name="avatar" accept="image/*">
                                        <button type="button" class="btn btn-primary ml-2" onclick="uploadImage()"><i class="fa fa-image"></i> @lang('upload')</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('email')</label>
                                    <input type="email" class="form-control" name="email" placeholder="@lang('email')" value="{{isset($user)?$user->email:''}}" required {{isset($user)?'disabled':''}}>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('department')</label>
                                    <input type="text" class="form-control" name="department" placeholder="@lang('department')" value="{{isset($user)?$user->department:''}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('designation')</label>
                                    <input type="text" class="form-control" name="designation" placeholder="@lang('designation')" value="{{isset($user)?$user->designation:''}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('status')</label>
                                    <select name="manage_status" id="status" class="form-control ">
                                        <option value="1" {{(isset($user)&&$user->manage_status=="1")?'selected':''}}>@lang('active')</option>
                                        <option value="0" {{(!isset($user)||$user->manage_status=="0")?'selected':''}}>@lang('inactive')</option>
                                    </select>
                                </div>
                            </div>
                            @if(isset($user))
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
                                        <input type="password" class="form-control" name="password" placeholder="@lang('new_password')" autocomplete="off">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{route('manager.user.list')}}" class="btn btn-link">@lang('back_to_list')</a>
                            <button type="submit" class="btn btn-primary ml-auto">{{isset($user)?__('update'):__('create')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
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


