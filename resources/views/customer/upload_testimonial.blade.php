@extends('base.static')
@section('page-css')
    <link href="{{asset('plugins/fileuploads/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container">
    <form action="{{route('customer.testimonial.save')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center" style="margin-top: 4rem">
            <div class="col-md-12">
                <h2 class="text-center">@lang('review_on_products')</h2>
            </div>
        </div>
        @if(session('testimonial_success'))
            <div class="row mt-5">
                <div class="col-sm-12 col-md-7 offset-md-3">
                    <div class="alert alert-success mb-4 text-center" role="alert">
                        @lang('testimonial_success')
                    </div>
                </div>
            </div>
        @endif
        @if(session('testimonial_error'))
            <div class="row">
                <div class="col-sm-12 col-md-7 offset-md-3">
                    <div class="alert alert-danger text-center" role="alert">
                        @lang('testimonial_error')
                    </div>
                </div>
            </div>
        @endif
        <div class="row align-items-center mt-5">
            <div class="col-sm-12 col-md-3 text-sm-left text-md-right">
                <label class="form-label mb-0">@lang('product')</label>
            </div>
            <div class="col-sm-12 col-md-7">
                <select name="product_id" id="product" class="form-control " required>
                    <option value="" disabled selected>@lang('select_product')</option>
                    @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12 col-md-3 text-sm-left text-md-right">
                <label class="form-label mb-0">@lang('text')</label>
            </div>
            <div class="col-sm-12 col-md-7">
                <textarea rows="5" class="form-control" name="desc" required></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12 col-md-3 text-sm-left text-md-right">
                <label class="form-label mb-0">@lang('type')</label>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="custom-controls-stacked d-flex">
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="type" value="picture" checked>
                        <span class="custom-control-label">@lang('picture')</span>
                    </label>
                    <label class="custom-control custom-radio ml-4">
                        <input type="radio" class="custom-control-input" name="type" value="video">
                        <span class="custom-control-label">@lang('video')</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12 offset-md-3 col-md-7">
                <input type="file" class="dropify" name="media" data-height="180" required/>
            </div>
            <div class="col-sm-12 col-md-10 text-right mt-5">
                <button class="btn btn-primary mr-3">@lang('submit')</button>
                <a href="{{ route('testimonial') }}" class="btn btn-warning">@lang('back')</a>
            </div>
        </div>
    </form>
</div>
@endsection
@section('page-js')
    <!-- file uploads js -->
    <script src="{{asset('plugins/fileuploads/js/dropify.min.js')}}"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': '@lang("drag_and_drop_or_click")',
                'replace': '@lang("drag_and_drop_or_click_to_replace")',
                'remove':  '@lang('remove')',
                'error':   '@lang('ops_error')'
            }
        });
    </script>
@endsection
