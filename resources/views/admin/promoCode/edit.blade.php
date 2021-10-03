@extends('layouts.app')

@section('page-css')
    <link href="{{asset('plugins/date-picker/spectrum.css')}}" rel="stylesheet" />
    <!-- select2 Plugin -->
    <link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('promo_code_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.promoCode.list')}}">@lang('promo_code')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{isset($promoCode)?__('update'):__('create')}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form method="post" class="card" action="{{route('admin.promoCode.update')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{isset($promoCode)?$promoCode->id:0}}">
                    <div class="card-header">
                        <h3 class="card-title">{{isset($promoCode)?__('edit_promoCode'):__('create_promoCode')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if (session('promoCode_edit_error'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger mb-4 text-center" role="alert">
                                        @lang('server_error')
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('code')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="code" name="code" placeholder="@lang('code')" value="{{isset($promoCode)?$promoCode->code:''}}" required>
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="generate(10)">@lang('generate')</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" id="limit_label">@lang('total_limit')</label>
                                    <input type="number" min="1" class="form-control" name="limit" value="{{isset($promoCode)?$promoCode->limit:'1'}}" required>
                                    <div class="custom-controls-stacked mt-1">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="members_limit" name="enable_member_limit" value="1" {{isset($promoCode)&&$promoCode->enable_member_limit==1?'checked':''}} onchange="checkLimitLabel()">
                                            <span class="custom-control-label">@lang('members_limit')</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('primary_type')</label>
                                    <select name="primary_type" id="primary_type" class="form-control " onchange="primaryChange()" required>
                                        <option value="" disabled selected>@lang('select_primary_type')</option>
                                        @foreach($pTypes as $one)
                                            <option value="{{$one->id}}" {{(isset($promoCode)&&$promoCode->primary_type==$one->id)?'selected':''}}>{{__($one->type_name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6" id="amount-box">
                                <div class="form-group">
                                    <label class="form-label">@lang('primary_type_value')</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="amount" name="amount" placeholder="@lang('amount')" value="{{isset($promoCode)?$promoCode->amount:''}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('secondary_type')</label>
                                    <select name="secondary_type" id="secondary_type" class="form-control " onchange="secondaryChange()">
                                        <option value="" selected>@lang('select_secondary_type')</option>
                                        @foreach($sTypes as $one)
                                            <option value="{{$one->id}}" data-value="{{$one->type_name}}" {{(isset($promoCode)&&$promoCode->secondary_type==$one->id)?'selected':''}}>{{__($one->type_name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="col-md-6 col-lg-6 secondary-option" id="detail-box">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Minimum Spend')</label>
                                        <input type="text" class="form-control" name="secondary_info" id="secondary_info" value="{{isset($promoCode)?$promoCode->secondary_usage:''}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 secondary-option" id="secondary_product_box">
                                    <div class="form-group">
                                        <label class="form-label">@lang('select_products')</label>
                                        <select name="secondary_product[]" id="secondary_product" class="form-control select2" multiple>
                                            @foreach($products as $one)
                                                <option value="{{$one->id}}">{{$one->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 secondary-option" id="secondary_category_box">
                                    <div class="form-group">
                                        <label class="form-label">@lang('select_categories')</label>
                                        <select name="secondary_category[]" id="secondary_category" class="form-control select2" multiple>
                                            @foreach($categories as $one)
                                                <option value="{{$one->id}}">{{$one->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 secondary-option" id="secondary_race_box">
                                    <div class="form-group">
                                        <label class="form-label">@lang('select_races')</label>
                                        <select name="secondary_race[]" id="secondary_race" class="form-control select2" multiple>
                                            @foreach($races as $one)
                                                <option value="{{$one->id}}">{{$one->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 secondary-option" id="secondary_gender_box">
                                    <div class="form-group">
                                        <label class="form-label">@lang('select_genders')</label>
                                        <select name="secondary_gender[]" id="secondary_gender" class="form-control select2" multiple>
                                            <option value="M">@lang('male')</option>
                                            <option value="F">@lang('Female')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 secondary-option" id="secondary_month_box">
                                    <div class="form-group">
                                        <label class="form-label">@lang('select_months')</label>
                                        <select name="secondary_month[]" id="secondary_month" class="form-control select2" multiple>
                                            <option value="1">@lang('January')</option>
                                            <option value="2">@lang('February')</option>
                                            <option value="3">@lang('March')</option>
                                            <option value="4">@lang('April')</option>
                                            <option value="5">@lang('May')</option>
                                            <option value="6">@lang('June')</option>
                                            <option value="7">@lang('July')</option>
                                            <option value="8">@lang('August')</option>
                                            <option value="9">@lang('September')</option>
                                            <option value="10">@lang('October')</option>
                                            <option value="11">@lang('November')</option>
                                            <option value="12">@lang('December')</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('promo_code_start_date')</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" type="text" name="start_date" value="{{isset($promoCode)?$promoCode->start_date:''}}" placeholder="YYYY-MM-DD" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('promo_code_end_date')</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" type="text" name="end_date" value="{{isset($promoCode)?$promoCode->end_date:''}}" placeholder="YYYY-MM-DD" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('description')</label>
                                    <textarea class="form-control" name="desc" required>{{isset($promoCode)?$promoCode->desc:''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('earning_start_date')</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" type="text" id="earning_start_date" name="earning_start_date" value="{{isset($promoCode)?$promoCode->earning_start_date:''}}" placeholder="YYYY-MM-DD" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('earning_end_date')</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" type="text" id="earning_end_date" name="earning_end_date" value="{{isset($promoCode)?$promoCode->earning_start_date:''}}" placeholder="YYYY-MM-DD" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <a href="{{route('admin.promoCode.list')}}" class="btn btn-link">@lang('back_to_list')</a>
                            <button type="submit" class="btn btn-primary ml-auto">{{isset($promoCode)?__('update'):__('create')}}</button>
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
    <!--Select2 js -->
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>

    <script>
        let secondary_info = '{{isset($promoCode)&&$promoCode->secondary_type?$promoCode->secondary_info:''}}'
        $(document).ready(function () {
            $('.select2').select2({
                minimumResultsForSearch: Infinity
            });

            $('.secondary-option').hide();

            let amount = {{isset($promoCode)?1:0}};
            if(amount == 0)
                $('#amount-box').hide();

            checkLimitLabel()
            secondaryChange()
            if(secondary_info){
                setSecondaryInfo()
            }
        })

        function generate(len){
            let code = generateRandom(len);
            $('#code').val(code);
        }
        $( ".fc-datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });

        function primaryChange() {
            $('#amount-box').show();
            let val = $('#primary_type').val();
            if(val == 3)
                $('#amount').prop('disabled',true)
            else
                $('#amount').prop('disabled',false)
        }

        function secondaryChange() {
            let val = $('#secondary_type').find(':selected').data('value');
            $('.secondary-option').hide();
            $('#earning_start_date').attr('disabled', true);
            $('#earning_end_date').attr('disabled', true);
            switch (val) {
                case 'Product':
                    $('#secondary_product_box').show();
                    $('#earning_start_date').attr('disabled', false);
                    $('#earning_end_date').attr('disabled', false);
                    break;
                case 'Product Category':
                    $('#secondary_category_box').show();
                    $('#earning_start_date').attr('disabled', false);
                    $('#earning_end_date').attr('disabled', false);
                    break;
                case 'Customer Race':
                    $('#secondary_race_box').show();
                    break;
                case 'Customer Gender':
                    $('#secondary_gender_box').show();
                    break;
                case 'Customer Registration':
                    $('#secondary_month_box').show();
                    break;
                case 'Customer Birthday':
                    $('#secondary_month_box').show();
                    break;
                case 'Minimum Spend':
                    $('#detail-box').show();
                    $('#earning_start_date').attr('disabled', false);
                    $('#earning_end_date').attr('disabled', false);
                    break;
                default:
                    break;
            }
        }

        function setSecondaryInfo() {
            let val = $('#secondary_type').find(':selected').data('value');
            let info = secondary_info
            if(val != "Minimum Spend"){
                info = secondary_info.split(",")
            }
            switch (val) {
                case 'Minimum Spend':
                    $('#secondary_info').val(info);
                    break;
                case 'Product':
                    $('#secondary_product').select2().val(info).trigger("change");
                    break;
                case 'Product Category':
                    $('#secondary_category').select2().val(info).trigger("change");
                    break;
                case 'Customer Race':
                    $('#secondary_race').select2().val(info).trigger("change");
                    break;
                case 'Customer Gender':
                    $('#secondary_gender').select2().val(info).trigger("change");
                    break;
                case 'Customer Registration':
                    $('#secondary_month').select2().val(info).trigger("change");
                    break;
                case 'Customer Birthday':
                    $('#secondary_month').select2().val(info).trigger("change");
                    break;
                default:
                    break;
            }
        }

        function checkLimitLabel() {
            let checked = $('#members_limit').is(":checked");
            if(checked)
                $('#limit_label').text('{{__('members_limit')}}')
            else
                $('#limit_label').text('{{__('total_limit')}}')
        }
    </script>
@endsection


