@extends('base.static')
@section('page-css')

@endsection

@section('content')
    <section id="home">
        <div class="container">
            <div class="w-100 py-3" style="height: 500px">
                <img src="{{asset('images/home/home-main.png')}}" class="w-100" style="height: 550px">
            </div>
            <div class="special-bundle w-100">
                <h2 class="text-center">SPECIAL BUNDLE</h2>
                <div class="d-flex justify-content-center">
                    <div class="divider" style="width: 170px"></div>
                </div>
                <div class="bundle-box row">
                    <div class="bundle col-sm-12 col-md-4 text-center">
                        <img src="{{asset('images/home/bundle1.png')}}">
                        <h3 class="text-center mt-5">Bundle A</h3>
                        <p class="text-center">This is healthy product.This is good product. Buy now.</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="mr-5 bundle-icon"><i class="fa fa-search-plus"></i></span>
                            <span class="mr-5 bundle-icon"><i class="fa fa-heart"></i></span>
                            <span class="mr-5 bundle-icon"><i class="fa fa-shopping-cart"></i></span>
                        </div>
                    </div>
                    <div class="bundle col-sm-12 col-md-4 text-center">
                        <img src="{{asset('images/home/bundle2.png')}}">
                        <h3 class="text-center mt-5">Bundle B</h3>
                        <p class="text-center">This is healthy product.This is good product. Buy now.</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="mr-5 bundle-icon"><i class="fa fa-search-plus"></i></span>
                            <span class="mr-5 bundle-icon"><i class="fa fa-heart"></i></span>
                            <span class="mr-5 bundle-icon"><i class="fa fa-shopping-cart"></i></span>
                        </div>
                    </div>
                    <div class="bundle col-sm-12 col-md-4 text-center">
                        <img src="{{asset('images/home/bundle3.png')}}">
                        <h3 class="text-center mt-5">Bundle C</h3>
                        <p class="text-center">This is healthy product.This is good product. Buy now.</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="mr-5 bundle-icon"><i class="fa fa-search-plus"></i></span>
                            <span class="mr-5 bundle-icon"><i class="fa fa-heart"></i></span>
                            <span class="mr-5 bundle-icon"><i class="fa fa-shopping-cart"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="special-bundle w-100">
                <h2 class="text-center">WHY CHOOSE US ?</h2>
                <div class="d-flex justify-content-center">
                    <div class="divider" style="width: 170px"></div>
                </div>
                <p class="text-center mt-5">We are accredited by global and local accreditation authorities.</p>
                <div class="bundle-box row">
                    <div class="col-sm-6 col-md-3 text-center">
                        <img src="{{asset('images/home/choose1.png')}}" style="height: 100px">
                    </div>
                    <div class="col-sm-6 col-md-3 text-center">
                        <img src="{{asset('images/home/choose2.png')}}" style="height: 100px">
                    </div>
                    <div class="col-sm-6 col-md-3 text-center">
                        <img src="{{asset('images/home/choose3.png')}}" style="height: 100px">
                    </div>
                    <div class="col-sm-6 col-md-3 text-center">
                        <img src="{{asset('images/home/choose4.png')}}" style="height: 100px">
                    </div>
                </div>
            </div>
        </div>

        <div id="recommmendModal" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="background-color: transparent; border: none">
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <div class="close-box d-flex align-items-center justify-content-center"><button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="recommend-box">
                                <h3 class="text-center text-white mb-5">@lang('we_want_know_you_more')</h3>
                                <form method="post" action="{{ route('product.answer') }}">
                                    @csrf
                                    <div class="question-box">
                                        @if(isset($questions))
                                            @foreach($questions as $key => $question)
                                                <div id="question-unit-{{$key}}" class="question-unit">
                                                    <h3 class="text-center">{{$question->question}}</h3>
                                                    <div class="form-group answer-group">
                                                        <div class="custom-controls-stacked row">
                                                            @foreach($answers as $answer)
                                                                @if($answer->question_id == $question->id)
                                                                    <div class="col-sm-6">
                                                                        <label class="custom-control custom-radio">
                                                                            <input type="radio" class="custom-control-input" name="answer_{{$question->id}}" value="{{$answer->id}}">
                                                                            <span class="custom-control-label">{{$answer->answer}}</span>
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div class="change-box d-flex align-items-center prev-box">
                                                <div class="round-arrow mr-sm-1 mr-md-3"><i class="fa fa-arrow-left"></i></div>
                                                <p class="font-1 mb-0">@lang('previous')</p>
                                            </div>
                                            <h3 class="mb-0 mobile-hide">{{env('APP_NAME')}}</h3>
                                            <div class="change-box d-flex align-items-center next-box">
                                                <p class="font-1 mb-0">@lang('next')</p>
                                                <div class="round-arrow ml-sm-1 ml-md-3"><i class="fa fa-arrow-right"></i></div>
                                            </div>
                                        </div>
                                        <div class="submit-answer text-center mt-3">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check mr-2"></i>@lang('complete')</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="w-100 text-center mt-5">
                                    <a href="javascript:void(0)" class="text-white" data-dismiss="modal" aria-label="Close" style="font-size: 1.5rem">@lang('skip_homepage')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-js')
    <script>
        let use_recommend = '{{isset($recommend)?$recommend:0}}';
        let q_count = '{{isset($questions)?count($questions):0}}';
        let current_index = 0;
        $(function(e) {
            if(use_recommend == 1){
                $('#recommmendModal').modal('show');
                $('.question-unit').hide();
                $('#question-unit-0').show();
                checkArrowStatus();
            }
            let facebook_status = '{{session()->get('facebook_auth')}}';
            if(facebook_status == "email_in_use"){
                $.growl.warning({
                    title: "{{__('error')}}",
                    message: "{{__('email_in_use')}}",
                    duration: 3000
                });
            }else if(facebook_status == "register_success"){
                $.growl.notice({
                    title: "{{__('success')}}",
                    message: "{{__('register_successed')}}",
                    duration: 3000
                });
            }else if(facebook_status == "not_registered_user")
                $.growl.warning({
                    title: "{{__('notice')}}",
                    message: "{{__('not_registered_user')}}",
                    duration: 3000
                });
        });
        $(document).on('click','.prev-box',function () {
            if(current_index>0){
                current_index--;
            }
            $('.question-unit').hide();
            $('#question-unit-' + current_index).show();
            checkArrowStatus();
        })
        $(document).on('click','.next-box',function () {
            if(current_index<q_count-1){
                current_index++;
            }
            $('.question-unit').hide();
            $('#question-unit-' + current_index).show();
            checkArrowStatus();
        })

        function checkArrowStatus() {
            if(current_index == 0){
                $('.prev-box').addClass('opacity-5');
            }else{
                $('.prev-box').removeClass('opacity-5');
            }
            if(current_index == q_count - 1){
                $('.submit-answer').show();
                $('.next-box').addClass('opacity-5');
            }else{
                $('.submit-answer').hide();
                $('.next-box').removeClass('opacity-5');
            }
        }
    </script>
@endsection
