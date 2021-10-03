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
            <h4 class="page-title">@lang('category_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.category.list')}}">@lang('categories')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{isset($category)?__('update'):__('create')}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form method="post" class="card" action="{{route('admin.category.update')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{isset($category)?$category->id:0}}">
                    <div class="card-header">
                        <h3 class="card-title">{{isset($category)?__('edit_category'):__('create_category')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if (session('category_edit_error'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger mb-4 text-center" role="alert">
                                        @lang('server_error')
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('name')</label>
                                    <input type="text" class="form-control" name="name" placeholder="@lang('name')" value="{{isset($category)?$category->name:''}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('status')</label>
                                    <select name="status" id="status" class="form-control ">
                                        <option value="1" {{(isset($category)&&$category->status=="1")?'selected':''}}>@lang('active')</option>
                                        <option value="0" {{(!isset($category)||$category->status=="0")?'selected':''}}>@lang('inactive')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{route('admin.category.list')}}" class="btn btn-link">@lang('back_to_list')</a>
                            <button type="submit" class="btn btn-primary ml-auto">{{isset($category)?__('update'):__('create')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')

@endsection


