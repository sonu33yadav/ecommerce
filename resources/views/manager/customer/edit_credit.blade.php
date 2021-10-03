@extends('layouts.app')

@section('page-css')

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('user_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.customer.list')}}">@lang('users')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('credit_point')</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('credit_point')</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{route('admin.customer.list')}}" class="btn btn-link">@lang('back_to_list')</a>
                            <button type="button" class="btn btn-primary ml-auto">@lang('update')</button>
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


