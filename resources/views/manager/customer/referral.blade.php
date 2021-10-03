@extends('layouts.app')

@section('page-css')

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('user_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.customer.list')}}">@lang('users')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('edit_referral')</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('referral_track')</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">@lang('referral_code') : </label>
                                    <input type="text" class="form-control" name="code" value="{{$user->referral_code}}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">@lang('referral_track')</label>
                                <div class="table-responsive mt-1">
                                    <table id="dt_track" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>@lang('username')</th>
                                            <th>@lang('followed_date')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->referral_track as $track)
                                            <tr>
                                                <td>{{$track->tracker_id==0?'Unknown':$track->tracker->name}}</td>
                                                <td>{{$track->created_at}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{route('admin.customer.list')}}" class="btn btn-link">@lang('back_to_list')</a>
{{--                            <button type="submit" class="btn btn-primary ml-auto">@lang('edit')</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        $(function(e) {
            $('#dt_track').DataTable({
                searching: false,
                bLengthChange: false,
            });
        });
    </script>
@endsection


