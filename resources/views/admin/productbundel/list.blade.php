@extends('layouts.app')

@section('page-css')

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('productbundel_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.productbundel.list')}}">@lang('product_bundle')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('list')</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@lang('productbundellist')</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt_products" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>@lang('name')</th>
                                        <th>@lang('thumbnails')</th>
                                        <th>@lang('selling_price')</th>
                                        <th>@lang('create_date')</th>
                                        <th>@lang('status')</th>
                                        <th>@lang('action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $productbundel)
                                    <tr>
                                        <td>
                                            <a class="text-primary" href="{{route('admin.productbundel.edit',$productbundel->id)}}">{{$productbundel->name}}</a>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                @if(count($productbundel->images)>0)
                                                    <img src="{{$productbundel->images[0]->url}}" width="50" height="50">
                                                @endif
                                            </div>
                                        </td>

                                        <td>{{$productbundel->selling_price}}</td>
                                        <td>{{$productbundel->created_at}}</td>
                                        <td>{{$productbundel->status==1?__('active'):__('inactive')}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{route('admin.productbundel.edit',$productbundel->id)}}" class="action-icon mr-3" title="@lang('edit')"><i class="fa fa-pencil"></i></a>
                                                <a href="{{route('admin.productbundel.track',$productbundel->id)}}" class="action-icon mr-3" title="@lang('tracking')"><i class="fa fa-link"></i></a>
                                                <a href="javascript:void(0);" class="action-icon delete-icon" data-value="{{$productbundel->id}}" title="@lang('delete')"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </td>
                                    </tr
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script>
        $(function(e) {
            $('#dt_products').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'ProductBundleListing',
                        text:'Excel',
                        //Columns to export
                        exportOptions: {
                            columns: [0, 2, 3]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'ProductBundleListing',
                        text: 'PDF',
                        exportOptions: {
                            columns: [0, 2, 3]
                        }
                    }
                ],
                "order": [[ 4, "desc" ]]
            });
        });
        $(document).on('click','.delete-icon',function () {
            swal({
                title: "@lang('are_you_sure')",
                text: "@lang('product_bundle_will_delete_permanently')",
                type: 'question',
                icon: 'warning',
                buttons:{
                    confirm: {
                        text : '@lang('yes')',
                        className : 'btn btn-primary btn-min'
                    },
                    cancel: {
                        visible: true,
                        text : '@lang('cancel')',
                        className: 'btn btn-warning'
                    }
                }
            }).then((confirmed) => {
                if (confirmed) {
                    let id = $(this).data('value');
                    let _token = '{{csrf_token()}}';
                    let path_delete = '{{route('admin.productbundel.delete')}}';
                    $.post(
                        path_delete,
                        {_token:_token,id:id},
                        function(resp){
                            if(resp.result){
                                $.growl.notice({
                                    title: "{{__('success')}}",
                                    message: "{{__('product_bundle_deleted')}}",
                                    duration: 3000
                                });
                                location.reload();
                            }else{
                                $.growl.warning({
                                    title: "{{__('error')}}",
                                    message: "{{__('cannot_delete_product')}}",
                                    duration: 3000
                                });
                            }
                        }
                    )
                }
            });
        })
    </script>
@endsection
