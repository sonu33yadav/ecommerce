@extends('layouts.app')

@section('page-css')
    <link href="{{asset('plugins/date-picker/spectrum.css')}}" rel="stylesheet" />
    <!-- select2 Plugin -->
    <link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('productbundel_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.productbundel.list')}}">@lang('product_bundle')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{isset($productbundel)?__('update'):__('create')}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form method="post" class="card" id="submitForm" action="{{route('admin.productbundel.update')}}" enctype="multipart/form-data" onsubmit="return validateForm()">
                    @csrf
                    <input type="hidden" name="id" value="{{isset($productbundel)?$productbundel->id:0}}">
                    <div class="card-header">
                        <h3 class="card-title">{{isset($productbundel)?__('edit_product_bundle'):__('create_product_bundle')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if (session('product_bundel_edit_error'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger mb-4 text-center" role="alert">
                                        @lang('server_error')
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('name')</label>
                                    <input type="text" class="form-control" name="name" placeholder="@lang('name')" value="{{isset($productbundel)?$productbundel->name:''}}"  required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('short_description')</label>
                                    <input type="text" class="form-control" name="short_description" placeholder="@lang('short_description')" value="{{isset($productbundel)?$productbundel->short_description:''}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('selling_price')</label>
                                    <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" placeholder="@lang('selling_price')" value="{{isset($productbundel)?$productbundel->selling_price:0}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('discount_price')</label>
                                    <input type="number" step="0.01" class="form-control" id="discount_price" name="discount_price" placeholder="@lang('discount_price')" value="{{isset($productbundel)?$productbundel->discount_price:0}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('discount_start_date')</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" type="text" id="discount_start_date" name="discount_start_date" value="{{isset($productbundel)?$productbundel->discount_start_date:''}}" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('discount_end_date')</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" type="text" id="discount_end_date" name="discount_end_date" value="{{isset($productbundel)?$productbundel->discount_end_date:''}}" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('category')</label>
                                    <select name="category_id" id="category_id" class="form-control"  onchange="category()">
                                        <option value="0" selected>@lang('select_category')</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{(isset($productbundel)&&$productbundel->category_id==$category->id)?'selected':''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('items')</label>
                                    <select name="item_ids[]" id="item_ids" class="form-control select2" multiple>
                                        @foreach($items as $item)
                                            @php
                                                $selected = '';
                                                if(isset($productbundel)){
                                                    $item_ids = explode(",", $productbundel->item_ids);
                                                    if(in_array($item->id, $item_ids))
                                                    {
                                                        $selected = 'selected';
                                                    }
                                                }
                                            @endphp
                                            <option value="{{$item->id}}" {{$selected}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('status')</label>
                                    <select name="status" id="status" class="form-control ">
                                        <option value="1" {{(isset($productbundel)&&$productbundel->status=="1")?'selected':''}}>@lang('active')</option>
                                        <option value="0" {{(!isset($productbundel)||$productbundel->status=="0")?'selected':''}}>@lang('inactive')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">@lang('description')</label>
                                    <textarea class="form-control" id="summernote" name="description">{{isset($productbundel)?$productbundel->description:''}}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label add-image cursor-pointer mb-3"><i class="fa fa-plus-circle mr-2"></i>@lang('add_image')</label>
                                    <div class="image-box">
                                        @if(isset($productbundel))
                                            @foreach($productbundel->images as $one)
                                                <div class="single-image-box" id="single-image-{{$one->id}}">
                                                    <img class="img-upload-preview img-circle" id="product-img" width="150" height="150" src="{{$one['url']}}" alt="preview" onerror="src='{{asset('images/empty.jpg')}}'">
                                                    <i class="fa fa-times delete-image" data-value="{{$one->id}}"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if(isset($productbundel)&&count($productbundel->images)>0)
                                            <input type="file" id="productbundel{{intval($productbundel->images[count($productbundel->images)-1]->id)+1}}" class="input-product-image d-none" name="product{{intval($productbundel->images[count($productbundel->images)-1]->id)+1}}" accept="image/*">
                                        @else
                                            <input type="file" id="productbundel0" class="input-product-image d-none" name="productbundel0" accept="image/*">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{route('admin.productbundel.list')}}" class="btn btn-link">@lang('back_to_list')</a>
                            <button type="submit" class="btn btn-primary ml-auto">{{isset($productbundel)?__('update'):__('create')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <!-- Datepicker js -->
    <script src="{{ asset('plugins/date-picker/spectrum.js') }}"></script>
    <script src="{{ asset('plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.maskedinput.js') }}"></script>
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
            $('.select2').select2({
                minimumResultsForSearch: Infinity
            });
        });

        $( ".fc-datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });

        function validateForm() {
            let status = false;
            let discount_price = $('#discount_price').val();
            if(discount_price == "" || discount_price==0)
                status = true;
            else{
                let d_start_date = $('#discount_start_date').val();
                let d_end_date = $('#discount_end_date').val();
                if(d_start_date == "" || d_end_date == "")
                {
                    $.growl.warning({
                        title: "{{__('warning')}}",
                        message: "{{__('enter_discount_date')}}",
                        duration: 3000
                    });
                    return false;
                }
            }

            if(image_ids.length == 0){
                swal({
                    title: "@lang('notice')",
                    text: "@lang('choose_at_least_one_image')",
                    type: 'warning',
                    icon: 'warning',
                    buttons:{
                        confirm: {
                            text : '@lang('ok')',
                            className : 'btn btn-primary btn-min'
                        }
                    }
                });
                return false;
            }
            let ids = image_ids.join(',')
            let append_id = '<input type="hidden" name="image_ids" value="'+ ids +'">';
            $('#submitForm').append(append_id);

            return true;
        }
    </script>

    <!-- Productbundel images -->
    <script>
        let image_id = 0;
        let image_ids = [];
        let images = <?php echo isset($productbundel)?json_encode($productbundel->images):json_encode(array())?>;
        for(let i=0; i<images.length; i++){
            image_ids.push(images[i]['id']);
        }
        if(image_ids.length >0){
            image_id = image_ids.reduce(function(a, b) {
                return Math.max(a, b);
            });
            image_id++;
        }
        $(document).on('click','.add-image', function () {
            $("#productbundel" + image_id).trigger('click');
        })
        function createImageBox(id, image_src){
            let item = '<div class="single-image-box" id="single-image-' + id + '">\n' +
                '                                                    <img class="img-upload-preview img-circle" id="productbundel-img" width="150" height="150" src="' + image_src +'" alt="productbundel">\n' +
                '                                                    <i class="fa fa-times delete-image" data-value="' + id + '"></i>\n' +
                '                                                </div>'

            return item;
        }

        $(document).on('change','.input-product-image',function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    let image_src = e.target.result;
                    $('.image-box').append(createImageBox(image_id, image_src))
                    image_ids.push(image_id);
                    image_id++;
                    let input_item = '<input type="file" name="productbundel'+ image_id +'" id="productbundel'+ image_id +'" class="input-product-image d-none">';
                    $('.image-box').append(input_item)
                }

                reader.readAsDataURL(this.files[0]);
            }
        })

        $(document).on('click','.delete-image',function () {
            let id = $(this).data('value');
            $('#single-image-' + id).remove();
            $('#productbundel' + id).val('');
            image_ids = removeItemFromArray(image_ids, id);
        });

        function removeItemFromArray(arr,val){
            const index = arr.indexOf(val);
            if (index > -1) {
                arr.splice(index, 1);
            }

            return arr;
        }


        function category() {
            var category_id   = $('#category_id').val();
            var data = {
                _token:     $(this).data('token'),
                category_id: category_id
            }

            $.ajax({
                type:       'get',
                url:        "{{route('admin.productbundel.change')}}",
                data:       data,
                success:    function (data) {
                                    var jsonData1   = JSON.parse(data);
                                    var appenddata1 = '';
                                    $("#item_ids").empty();
                                    for (var i = 0; i < jsonData1.length; i++) {
                                        appenddata1 += "<option value = '" + jsonData1[i].pId + "'>" + jsonData1[i].pName + " </option>";
                                    }
                                    $("#item_ids").append(appenddata1);
                            },
                error:      function (jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
            });
        };
    </script>
    <!-- End Product images -->

@endsection


