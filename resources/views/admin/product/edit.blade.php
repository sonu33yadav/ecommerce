@extends('layouts.app')

@section('page-css')
    <link href="{{asset('plugins/date-picker/spectrum.css')}}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('product_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.product.list')}}">@lang('products')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{isset($product)?__('update'):__('create')}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form method="post" class="card" id="submitForm" action="{{route('admin.product.update')}}" enctype="multipart/form-data" onsubmit="return validateForm()">
                    @csrf
                    <input type="hidden" name="id" value="{{isset($product)?$product->id:0}}">
                    <div class="card-header">
                        <h3 class="card-title">{{isset($product)?__('edit_product'):__('create_product')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if (session('product_edit_error'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger mb-4 text-center" role="alert">
                                        @lang('server_error')
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('name')</label>
                                    <input type="text" class="form-control" name="name" placeholder="@lang('name')" value="{{isset($product)?$product->name:''}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('short_description')</label>
                                    <input type="text" class="form-control" name="short_description" placeholder="@lang('short_description')" value="{{isset($product)?$product->short_description:''}}">
                                </div>
                            </div>
{{--                            <div class="col-md-6 col-lg-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">@lang('cost_price')</label>--}}
{{--                                    <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price" placeholder="@lang('cost_price')" value="{{isset($product)?$product->cost_price:0}}" onchange="calcMargin()">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('selling_price')</label>
                                    <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" placeholder="@lang('selling_price')" value="{{isset($product)?$product->selling_price:0}}" required>
                                </div>
                            </div>
{{--                            <div class="col-md-6 col-lg-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">@lang('percentage_margin')</label>--}}
{{--                                    <input type="number" step="0.01" class="form-control" id="percentage_margin" placeholder="%" value="{{isset($product)?$product->percentage_margin:''}}" required disabled>--}}
{{--                                    <input type="hidden" name="percentage_margin" id="p_margin" value="{{isset($product)?$product->percentage_margin:''}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('discount_price')</label>
                                    <input type="number" step="0.01" class="form-control" id="discount_price" name="discount_price" placeholder="@lang('discount_price')" value="{{isset($product)?$product->discount_price:0}}">
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
                                        <input class="form-control fc-datepicker" type="text" id="discount_start_date" name="discount_start_date" value="{{isset($product)?$product->discount_start_date:''}}" placeholder="YYYY-MM-DD">
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
                                        <input class="form-control fc-datepicker" type="text" id="discount_end_date" name="discount_end_date" value="{{isset($product)?$product->discount_end_date:''}}" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('stock_quantity')</label>
                                    <input type="number" class="form-control" name="stock_quantity" placeholder="@lang('stock_quantity')" value="{{isset($product)?$product->stock_quantity:1}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('category')</label>
                                    <select name="category_id" id="category_id" class="form-control ">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{(isset($product)&&$product->category_id==$category->id)?'selected':''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('status')</label>
                                    <select name="status" id="status" class="form-control ">
                                        <option value="1" {{(isset($product)&&$product->status=="1")?'selected':''}}>@lang('active')</option>
                                        <option value="0" {{(!isset($product)||$product->status=="0")?'selected':''}}>@lang('inactive')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">@lang('description')</label>
                                    <textarea class="form-control" id="summernote" name="description">{{isset($product)?$product->description:''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label add-package cursor-pointer mb-0"><i class="fa fa-plus-circle mr-2"></i>@lang('add_package')</label>
                                </div>
                                <div class="packages">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label add-image cursor-pointer mb-3"><i class="fa fa-plus-circle mr-2"></i>@lang('add_image')</label>
                                    <div class="image-box">
                                        @if(isset($product))
                                            @foreach($product->images as $one)
                                                <div class="single-image-box" id="single-image-{{$one->id}}">
                                                    <img class="img-upload-preview img-circle" id="product-img" width="150" height="150" src="{{$one['url']}}" alt="preview" onerror="src='{{asset('images/empty.jpg')}}'">
                                                    <i class="fa fa-times delete-image" data-value="{{$one->id}}"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if(isset($product)&&count($product->images)>0)
                                            <input type="file" id="product{{intval($product->images[count($product->images)-1]->id)+1}}" class="input-product-image d-none" name="product{{intval($product->images[count($product->images)-1]->id)+1}}" accept="image/*">
                                        @else
                                            <input type="file" id="product0" class="input-product-image d-none" name="product0" accept="image/*">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{route('admin.product.list')}}" class="btn btn-link">@lang('back_to_list')</a>
                            <button type="submit" class="btn btn-primary ml-auto">{{isset($product)?__('update'):__('create')}}</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });

        $( ".fc-datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });

        function calcMargin() {
            return;
            let cost_price = $('#cost_price').val();
            let selling_price = $('#selling_price').val();
            let discount_price = $('#discount_price').val();
            let calc_price = (discount_price!=""&&discount_price>0)?discount_price:selling_price;
            let val = 0;
            if(calc_price == "" ||  calc_price==0 || cost_price=="" || cost_price==0)
                val = 0;
            else{
                let earning = calc_price - cost_price;
                val = (earning*100/cost_price).toFixed(2);
            }
            $('#percentage_margin').val(val);
            $('#p_margin').val(val);
        }

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
    <!-- Packages -->
    <script>
        let package_id = 0;
        let packages;
        function generatePackageForm(id) {
            let code = '';
            code = '<div class="row" id="package_' + id + '">\n' +
                '                                        <div class="col-sm-12 col-md-4">\n' +
                '                                            <div class="form-group">\n' +
                '                                                <label class="form-label">Name</label>\n' +
                '                                                <input type="text" class="form-control" id="package_name_' + id + '" name="package_name[]" required>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-sm-12 col-md-4">\n' +
                '                                            <div class="form-group">\n' +
                '                                                <label class="form-label">Quantity</label>\n' +
                '                                                <input type="number" class="form-control" id="package_quantity_' + id + '" name="package_quantity[]" required>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-sm-11 col-md-3">\n' +
                '                                            <div class="form-group">\n' +
                '                                                <label class="form-label">Price</label>\n' +
                '                                                <input type="number" step="0.01" class="form-control" id="package_price_' + id + '" name="package_price[]" required>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-sm-1">\n' +
                '                                            <div class="form-group">\n' +
                '                                                <label class="form-label cursor-pointer delete-package" data-value="' + id + '"><i class="fa fa-times"></i></label>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                    </div>'

            return code;
        }

        $(document).on('click','.add-package', function () {
            $('.packages').append(generatePackageForm(package_id));
            package_id++;
        })

        $(document).on('click','.delete-package', function () {
            let id = $(this).data('value')
            $('#package_' + id).remove();
        })

        $(document).ready(function () {
            packages = JSON.parse('<?php echo isset($packages)?json_encode($packages):json_encode(array())?>');
            for (let i=0; i<packages.length; i++){
                $('.packages').append(generatePackageForm(i));
                $('#package_name_' + i).val(packages[i].name)
                $('#package_quantity_' + i).val(packages[i].quantity)
                $('#package_price_' + i).val(packages[i].price)
            }
            package_id = packages.length;
        })
    </script>
    <!-- End Packages -->
    <!-- Product images -->
    <script>
        let image_id = 0;
        let image_ids = [];
        let images = <?php echo isset($product)?json_encode($product->images):json_encode(array())?>;
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
            $("#product" + image_id).trigger('click');
        })
        function createImageBox(id, image_src){
            let item = '<div class="single-image-box" id="single-image-' + id + '">\n' +
                '                                                    <img class="img-upload-preview img-circle" id="product-img" width="150" height="150" src="' + image_src +'" alt="product">\n' +
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
                    let input_item = '<input type="file" name="product'+ image_id +'" id="product'+ image_id +'" class="input-product-image d-none">';
                    $('.image-box').append(input_item)
                }

                reader.readAsDataURL(this.files[0]);
            }
        })

        $(document).on('click','.delete-image',function () {
            let id = $(this).data('value');
            $('#single-image-' + id).remove();
            $('#product' + id).val('');
            image_ids = removeItemFromArray(image_ids, id);
        });

        function removeItemFromArray(arr,val){
            const index = arr.indexOf(val);
            if (index > -1) {
                arr.splice(index, 1);
            }

            return arr;
        }
    </script>
    <!-- End Product images -->
@endsection


