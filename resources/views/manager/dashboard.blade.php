@extends('layouts.app')

@section('page-css')

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('dashboard')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">@lang('dashboard')</a></li>
            </ol>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        localStorage.removeItem('status');
    </script>
@endsection
