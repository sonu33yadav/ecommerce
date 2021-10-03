@extends('layouts.app')

@section('page-css')
    <link href="{{asset('plugins/fileuploads/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('product_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.product.list')}}">@lang('products')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{isset($testimonial)?__('edit_testimonial'):__('create_testimonial')}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form method="post" class="card" action="{{route('admin.testimonial.update')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{isset($testimonial)?$testimonial->id:0}}">
                    <div class="card-header">
                        <h3 class="card-title">{{isset($testimonial)?__('edit_testimonial'):__('create_testimonial')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if (session('testimonial_edit_error'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger mb-4 text-center" role="alert">
                                        @lang('server_error')
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('product')</label>
                                    <select name="product_id" class="form-control " required>
                                        <option value="" disabled selected>@lang('select_product')</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}" {{(isset($testimonial)&&$testimonial->product_id==$product->id)?'selected':''}}>{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('user')</label>
                                    <select name="user_id" class="form-control " required>
                                        <option value="" disabled selected>@lang('select_user')</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{(isset($testimonial)&&$testimonial->user_id==$user->id)?'selected':''}}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('type')</label>
                                    <select name="type" class="form-control " required>
                                        <option value="" disabled selected>@lang('select_type')</option>
                                        <option value="picture" {{(isset($testimonial)&&$testimonial->type=="picture")?'selected':''}}>@lang('picture')</option>
                                        <option value="video" {{(isset($testimonial)&&$testimonial->type=="video")?'selected':''}}>@lang('video')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('text')</label>
                                    <textarea class="form-control" name="desc" required>{{isset($testimonial)?$testimonial->desc:''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 offset-md-3">
                                <input type="file" class="dropify" name="media" data-default-file="{{isset($testimonial)?$testimonial->attach->url:''}}" data-height="180" required/>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{route('admin.product.testimonial.view', isset($testimonial)?$testimonial->product_id:$product_id)}}" class="btn btn-link">@lang('back')</a>
                            <button type="submit" class="btn btn-primary ml-auto">{{isset($testimonial)?__('update'):__('create')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <!-- file uploads js -->
    <script src="{{asset('plugins/fileuploads/js/dropify.min.js')}}"></script>
    <script>
        var drEvent = $('.dropify').dropify({
            messages: {
                'default': '@lang("drag_and_drop_or_click")',
                'replace': '@lang("drag_and_drop_or_click_to_replace")',
                'remove':  '@lang('remove')',
                'error':   '@lang('ops_error')'
            }
        });
    </script>
@endsection


