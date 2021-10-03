@extends('layouts.app')

@section('page-css')
    <link href="{{asset('plugins/date-picker/spectrum.css')}}" rel="stylesheet" />
    <!-- select2 Plugin -->
    <link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('credit_point_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.creditpoint.list')}}">@lang('credit_point')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{isset($creditpoint)?__('update'):__('create')}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form method="post" class="card" action="{{route('admin.creditpoint.update')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{isset($creditpoint)?$creditpoint->id:0}}">
                    <div class="card-header">
                        <h3 class="card-title">{{isset($creditpoint)?__('edit_credit_point'):__('create_credit_point')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if (session('credit_edit_error'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger mb-4 text-center" role="alert">
                                        @lang('server_error')
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('expire_duration')</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" type="text" id="point_end_date" name="point_end_date" value="{{isset($creditpoint)?$creditpoint->point_end_date:''}}" placeholder="YYYY-MM-DD" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('point_earn')</label>
                                    <input type="number" class="form-control" id="point_earn" name="point_earn" placeholder="@lang('point_earn')" value="{{isset($creditpoint)?$creditpoint->point_earn:0}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 select_point_type" id="point_type">
                                <div class="form-group">
                                    <label class="form-label">@lang('first_level')</label>
                                    <select name="point_type" id="point_type" class="form-control" required>
                                        <option value="">@lang('select')</option>
                                        <option value="1" {{isset($creditpoint)&&$creditpoint->point_type==1?'selected':''}}>@lang('By Spending')</option>
                                        <option value="2" {{isset($creditpoint)&&$creditpoint->point_type==2?'selected':''}}>@lang('By Product')</option>
                                        <option value="3" {{isset($creditpoint)&&$creditpoint->point_type==3?'selected':''}}>@lang('By Purchase')</option>
                                        <option value="4" {{isset($creditpoint)&&$creditpoint->point_type==4?'selected':''}}>@lang('By Category')</option>
                                        <option value="5" {{isset($creditpoint)&&$creditpoint->point_type==5?'selected':''}}>@lang('By Referral Code')</option>
                                        <option value="6" {{isset($creditpoint)&&$creditpoint->point_type==6?'selected':''}}>@lang('By Registration')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 second_level" id="second_level">
                                <div class="form-group">
                                    <label class="form-label">@lang('second_level')</label>
                                    <select name="second_level" id="second_level" class="form-control second_level">
                                        <option value="">@lang('select')</option>
                                        <option value="1" {{isset($creditpoint)&&$creditpoint->second_level==1?'selected':''}}>@lang('BY Birthdate')</option>
                                        <option value="2" {{isset($creditpoint)&&$creditpoint->second_level==2?'selected':''}}>@lang('BY race')</option>
                                        <option value="3" {{isset($creditpoint)&&$creditpoint->second_level==3?'selected':''}}>@lang('BY location')</option>
                                        <option value="4" {{isset($creditpoint)&&$creditpoint->second_level==4?'selected':''}}>@lang('By gender')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{route('admin.creditpoint.list')}}" class="btn btn-link">@lang('back_to_list')</a>
                            <button type="submit" class="btn btn-primary ml-auto">{{isset($creditpoint)?__('update'):__('create')}}</button>
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
    <!--Select2 js -->
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $( ".fc-datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    </script>
@endsection


