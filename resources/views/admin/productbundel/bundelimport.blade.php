@extends('layouts.app')

@section('page-css')
    <link href="{{asset('plugins/date-picker/spectrum.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/fileuploads/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('productbundel_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.productbundel.list')}}">@lang('product_bundle')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('import')</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form method="post" class="card" action="{{route('admin.productbundel.importExcel')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">@lang('import_productbundel')</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if (session('file_format_error'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger mb-4 text-center" role="alert">
                                        @lang('file_content_error')
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-4 col-sm-12 offset-md-4">
                                <input type="file" class="dropify" name="upload" data-height="180" accept=".csv" required/>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{route('admin.product.list')}}" class="btn btn-link">@lang('back_to_list')</a>
                            <button type="submit" class="btn btn-primary ml-auto">@lang('import')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<!-- new commit  -->
<!-- new commit -->
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


