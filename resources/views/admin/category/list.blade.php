@extends('layouts.app')

@section('page-css')

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('category_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.category.list')}}">@lang('categories')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('list')</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@lang('category_list')</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt_categories" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>@lang('name')</th>
                                    <th>@lang('status')</th>
                                    <th>@lang('create_date')</th>
                                    <th>@lang('action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->status==1?__('active'):__('inactive')}}</td>
                                        <td>{{$category->created_at}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{route('admin.category.edit',$category->id)}}" class="action-icon mr-3" title="@lang('edit')"><i class="fa fa-pencil"></i></a>
                                                <a href="javascript:void(0);" class="action-icon delete-icon" data-value="{{$category->id}}" title="@lang('delete')"><i class="fa fa-trash-o"></i></a>
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
    <script>
        $(function(e) {
            $('#dt_categories').DataTable();
        });
        $(document).on('click','.delete-icon',function () {
            swal({
                title: "@lang('are_you_sure')",
                text: "@lang('user_will_delete_permanently')",
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
                    let path_delete = '{{route('admin.category.delete')}}';
                    $.post(
                        path_delete,
                        {_token:_token,id:id},
                        function(resp){
                            if(resp.result){
                                $.growl.notice({
                                    title: "{{__('success')}}",
                                    message: "{{__('category_deleted')}}",
                                    duration: 3000
                                });
                                location.reload();
                            }else{
                                $.growl.warning({
                                    title: "{{__('error')}}",
                                    message: "{{__('cannot_delete_category')}}",
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
