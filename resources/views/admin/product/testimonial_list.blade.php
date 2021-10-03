@extends('layouts.app')

@section('page-css')
    <style>
        .testimonial-attach{
            min-height: 180px;
            border-right: 1px solid #d7e7ff;
        }
    </style>
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('product_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.product.list')}}">@lang('product')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('testimonials')</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    @csrf
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title">@lang('testimonials')</h3>
                        <a href="{{ route('admin.testimonial.create', $product->id) }}" class="btn btn-primary"><i class="fa fa-pencil mr-3"></i>@lang('new')</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($testimonials as $one)
                                <div class="col-md-6">
                                    <div class="card item-card bg-azure-lightest">
                                        <div class="card-body">
                                            <div class="border p-0">
                                                <div class="row">
                                                    <div class="col-md-6 pr-0">
                                                        <div class="text-center d-flex align-items-center justify-content-center testimonial-attach">
                                                            @if($one->type == 'picture')
                                                                <img src="{{$one->attach->url}}" alt="img" class="img-fluid">
                                                            @else
                                                                <video src="{{$one->attach->url}}" class="img-fluid" controls>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pl-0">
                                                        <div class="card-body cardbody">
                                                            <div class="cardtitle d-flex align-items-center justify-content-between">
                                                                <h2 class="card-title mb-0" style="font-size: 1.5rem">{{$one->user->name}}</h2>
                                                                <a href="{{ route('admin.testimonial.edit', $one->id) }}" class="btn btn-primary text-white"><i class="fa fa-edit mr-0"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-4 text-center">
                                                            {{$one->desc}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')

@endsection


