@extends('layouts.app')

@section('page-css')
    <!-- select2 Plugin -->
    <link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="side-app" id="vue_app">
        <div class="page-header">
            <h4 class="page-title">@lang('product_management')</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.product.list')}}">@lang('products')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('recommendation')</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('product_recommendation')</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center justify-content-between">
                                <div class="form-group mb-0">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" name="use_recommend" id="use_recommend" class="custom-control-input" value="1" v-model="use_recommend" @change="changeSetting"/>
                                        <span class="custom-control-label">@lang('use_product_recommendation')</span>
                                    </label>
                                </div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" v-if="use_recommend==1">@lang('add_question')</button>
                            </div>
                        </div>
                        <div class="row recommend-part" v-show="use_recommend==1">
                            <div class="col-md-12 mt-5">
                                <div class="question-box d-flex align-items-center justify-content-between" v-if="questionList.length>0">
                                    <div class="arrow-box cursor-pointer" @click="changeQuestion('prev')"><i class="fa fa-arrow-left"></i></div>
                                    <div class="questions w-100 text-center px-3">
                                        <div class="unit-question" v-for="question in questionList" :key="question.id" v-if="cu_question==question.id">
                                            <h3>@{{ question.value }}</h3>
                                            <div class="answers d-flex align-items-center justify-content-center">
                                                <p class="mb-0 mr-4" v-for="answer in answerList[question.id]" :key="answer.id">@{{ answer.id + 1 }} : @{{ answer.value }}</p>
                                                <p class="mb-0 cursor-pointer" @click="showAnswerModal"><i class="fa fa-plus mr-1"></i>@lang('add_answer')</p>
                                            </div>
                                            <div class="delete-question" @click="deleteQuestion(question.id)"><i class="fa fa-times"></i></div>
                                        </div>
                                    </div>
                                    <div class="arrow-box cursor-pointer" @click="changeQuestion('next')"><i class="fa fa-arrow-right"></i></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-5" v-if="questionList.length>0">
                                    <div class="col-sm-6 text-center"><h2>@lang('answer_series')</h2></div>
                                    <div class="col-sm-6 text-center"><h2>@lang('product_series')</h2></div>
                                </div>
                                <div class="row" v-for="item in answerSeries" :key="item.id">
                                    <div class="col-sm-6 text-center"><h3>@{{ item.value }}</h3></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="product" class="form-control select2" multiple :id="'product_'+item.id">
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary ml-auto" @click="save">@lang('save')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">@lang('add_question')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">@lang('new_question')</label>
                            <input type="text" class="form-control" v-model="new_question">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="addQuestion">@lang('add')</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addAnswerModal" tabindex="-1" role="dialog" aria-labelledby="addAnswerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAnswerModalLabel">@lang('add_answer')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">@lang('new_answer')</label>
                            <input type="text" class="form-control" v-model="new_answer">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="addAnswer">@lang('add')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <!--Select2 js -->
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
    <script>
        let _token = '{{csrf_token()}}'
    </script>
    <script src="{{ asset('js/recommend.js') }}"></script>
@endsection


