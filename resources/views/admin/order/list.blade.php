@extends('layouts.app')

@section('page-css')
    <link href="{{ asset('plugins/daterangepicker-master/daterangepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">@lang('order_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.order.index')}}">@lang('orders')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('list')</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@lang('order-list')</div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('search_by_date')</label>
                                    <div id="filter_range" style="background: #fff; cursor: pointer; padding: 7px 10px; border: 1px solid #ccc; width: 100%; height: 38px">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span>
                                    </div>
                                    <input type="hidden" id="start_date">
                                    <input type="hidden" id="end_date">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('search_by')</label>
                                    <div class="d-flex align-items-center">
                                        <select name="type" id="type" class="form-control mr-3">
                                            <option value="customer_name">@lang('customer_name')</option>
                                            <option value="customer_id">@lang('customer_id')</option>
                                            <option value="customer_contact">@lang('customer_contact')</option>
                                            <option value="customer_email">@lang('customer_email')</option>
                                            <option value="order_number">@lang('order_number')</option>
                                            <option value="order_date">@lang('order_date')</option>
                                            <option value="referral_code">@lang('referral_code')</option>
                                            <option value="product_name">@lang('product_name')</option>
                                        </select>
                                        <input type="text" class="form-control" name="filter" id="filter" placeholder="@lang('input_search_text')">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="button" onclick="getOrders()"><i class="fe fe-search mr-1"></i>@lang('search')</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="dt_orders" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>@lang('order_number')</th>
                                    <th>@lang('order_date')</th>
                                    <th>@lang('product_name')</th>
                                    <th>@lang('customer') ID</th>
                                    <th>@lang('customer_name')</th>
                                    <th>@lang('customer_email')</th>
                                    <th>@lang('status')</th>
                                    <th>@lang('action')</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script src="{{ asset('plugins/momentjs/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker-master/daterangepicker.js') }}"></script>
    <script>
        let list_path = '{{ route('admin.order.getList') }}'
        let _token = '{{csrf_token()}}'
        let locale_dt = '{{ asset('locales/'.App::getLocale().'.json') }}';

        $(function(e) {
            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#start_date').val(start.format('YYYY-MM-DD'));
                $('#end_date').val(end.format('YYYY-MM-DD'));
                $('#filter_range span').html(start.format('YYYY-MM-DD') + ' ~ ' + end.format('YYYY-MM-DD'));
            }

            $('#filter_range').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')]
                }
            }, cb);

            cb(start, end);

            getOrders();
        });

        function getOrders() {
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();
            let filter_type = $('#type').val();
            let filter_text = $('#filter').val();
            try {
                dt.destroy()
            } catch (e) {

            }

            dt = $('#dt_orders').DataTable({
                ajax: {
                    url: list_path,
                    type: "POST",
                    data: {_token: _token, start_date:start_date, end_date:end_date, filter_type:filter_type, filter_text:filter_text},
                    dataSrc: ""
                },
                searching: false,
                bLengthChange: true,
                columns: [
                    {"data":"order_number"},
                    {"data":"order_date"},
                    {"data":"product","render":function(data){
                            return data.name;
                        }},
                    {"data":"user","render":function(data){
                            return data.member_id;
                        }},
                    {"data":"user","render":function(data){
                            return data.name;
                        }},
                    {"data":"user","render":function(data){
                            return data.email;
                        }},
                    {"data":"status","render":function(data){
                            return data.toUpperCase();
                        }},
                    {"data":"id","render":function(data){
                            return `<div class="d-flex justify-content-center">
                                        <a href="javascript:void(0);" class="action-icon delete-icon" data-value="`+ data +`" title="@lang('delete')"><i class="fa fa-trash-o"></i></a>
                                    </div>`;
                        }},
                ],
                language:{"url":locale_dt},
                pageLength:10
            });
        }
    </script>
@endsection
