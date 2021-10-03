@extends('layouts.app')

@section('page-css')

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('product_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.product.list')}}">@lang('products')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('list')</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@lang('product_list')</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt_products" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>@lang('name')</th>
                                        <th>@lang('thumbnails')</th>
                                        <th>@lang('selling_price')</th>
                                        <th>@lang('stock_quantity')</th>
                                        <th>@lang('create_date')</th>
                                        <th>@lang('status')</th>
                                        <th>@lang('action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>
                                            <a class="text-primary" href="{{route('product',$product->id)}}">{{$product->name}}</a>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                @if(count($product->images)>0)
                                                    <a href="{{route('product',$product->id)}}">
                                                        <img src="{{$product->images[0]->url}}" width="50" height="50">
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{$product->selling_price}}</td>
                                        <td>{{$product->stock_quantity}}</td>
                                        <td>{{$product->created_at}}</td>
                                        <td>{{$product->status==1?__('active'):__('inactive')}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{route('admin.product.edit',$product->id)}}" class="action-icon mr-3" title="@lang('edit')"><i class="fa fa-pencil"></i></a>
                                                <a href="{{route('admin.product.testimonial.view',$product->id)}}" class="action-icon mr-3" title="@lang('testimonials')"><i class="fa fa-star"></i></a>
                                                <a href="javascript:void(0);" class="action-icon delete-icon" data-value="{{$product->id}}" title="@lang('delete')"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>
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
                        title: 'ProductListing',
                        text:'Excel',
                        //Columns to export
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'ProductListing',
                        text: 'PDF',
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6]
                        }
                    }
                ],
                "order": [[ 3, "desc" ]]
            });
        });
        $(document).on('click','.delete-icon',function () {
            swal({
                title: "@lang('are_you_sure')",
                text: "@lang('product_will_delete_permanently')",
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
                    let path_delete = '{{route('admin.product.delete')}}';
                    $.post(
                        path_delete,
                        {_token:_token,id:id},
                        function(resp){
                            if(resp.result){
                                $.growl.notice({
                                    title: "{{__('success')}}",
                                    message: "{{__('product_deleted')}}",
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
