@extends('base.static')
@section('page-css')
    <style>
        .relative{
            line-height: 2.5rem;
        }
        .navigation-part>.justify-between>.justify-between{
            display: none !important;
        }

        .navigation-part p{
            margin-bottom: 0.5rem;
        }
        .navigation-part svg{
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    <section id="testimonial" class="mb-5">
        <div class="container">
            <div class="w-100" style="height: 500px">
                <img src="{{asset('images/testimonial/tetimonial-main.png')}}" class="w-100" style="max-height: 550px">
            </div>
            <div class="special-bundle w-100">
                <h2 class="text-center">@lang('VIDEO')</h2>
                <div class="d-flex justify-content-center">
                    <div class="divider" style="width: 170px"></div>
                </div>
                <p class="text-center mt-5" style="font-size: 1.5rem; color: #636363">@lang('satisfied_customers_say')</p>
                <div class="bundle-box row">
                    @foreach($data as $video)
                        <div class="col-sm-6 col-md-4 mb-2">
                            <div class="w-100" style="height: 160px">
                                <video src="{{$video->attach->url}}" class="img-fluid w-100" controls style="max-height: 160px"></video>
                            </div>
                            <pre class="mt-1 testimonial-text">{{$video->desc}}</pre>
                        </div>
                    @endforeach
                    <div class="col-12 d-flex justify-content-end navigation-part">
                        {!! $data->appends($pagination_params)->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-js')

@endsection
