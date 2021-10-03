@extends('layouts.app')

@section('page-css')

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('promo_code_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.promoCode.list')}}">@lang('promo_code')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('tracking')</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('promo_code_track')</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive mt-1">
                                    <table id="dt_track" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>@lang('customer_name')</th>
                                            <th>@lang('followed_date')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promoCode->track as $track)
                                            <tr>
                                                <td>{{isset($track->customer)?$track->customer->name:'Unknown'}}</td>
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
                            <a href="{{route('admin.promoCode.list')}}" class="btn btn-link">@lang('back_to_list')</a>
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


