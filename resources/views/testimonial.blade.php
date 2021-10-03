@extends('base.static')
@section('page-css')

@endsection

@section('content')
    <section id="testimonial" class="mb-5">
        <div class="container">
            <div class="w-100" style="height: 500px">
                <img src="{{asset('images/testimonial/tetimonial-main.png')}}" class="w-100" style="max-height: 550px">
            </div>
            <div class="test">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean accumsan sit amet eros in faucibus. Etiam posuere malesuada lacus quis tempor. Praesent non diam eros. Duis vestibulum, diam sed iaculis consectetur, lorem leo ullamcorper diam, mollis cursus sem metus in lectus. Nam interdum, tellus sed molestie tristique, libero ipsum pretium leo, quis fermentum massa odio vel velit. Proin ut molestie magna, non dapibus nisi. Vestibulum urna purus, aliquam et pulvinar eu, dictum id nulla. Duis venenatis, ex sit amet eleifend tempus, ex sem semper sapien, at sodales dui leo vel nunc. Sed ante nulla, rhoncus at lacus ut, pretium auctor mauris.
                </p>
            </div>
            <div class="special-bundle w-100">
                <h2 class="text-center">@lang('OUR_GLOBAL_COMMUNITY')</h2>
                <div class="d-flex justify-content-center">
                    <div class="divider" style="width: 170px"></div>
                </div>
                <p class="text-center mt-5" style="font-size: 1.5rem; color: #636363">@lang('satisfied_customers_say')</p>
                <div class="bundle-box row">
                    @foreach($pictures as $picture)
                        <div class="col-sm-6 col-md-4 mb-2">
                            <div class="w-100 text-center" style="height: 200px">
                                <img src="{{$picture->attach->url}}" class="h-100">
                            </div>
                            <div class="testimonial-desc">
                                <p>{{$picture->desc}}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-sm-12 text-center">
                        <a class="text-uppercase" href="{{route('pictureTestimonial')}}"><i class="fa fa-plus mr-2"></i>@lang('view_more')</a>
                    </div>
                </div>
            </div>
            <div class="special-bundle w-100" style="margin-top: 3rem">
                <h2 class="text-center">@lang('VIDEO')</h2>
                <div class="d-flex justify-content-center">
                    <div class="divider" style="width: 170px"></div>
                </div>
                <p class="text-center mt-5" style="font-size: 1.5rem; color: #636363">@lang('satisfied_customers_say')</p>
                <div class="bundle-box row">
                    @foreach($videos as $video)
                        <div class="col-sm-6 col-md-4 mb-2">
                            <div class="w-100" style="height: 160px">
                                <video src="{{$video->attach->url}}" class="img-fluid w-100" controls style="max-height: 160px"></video>
                            </div>
                            <div class="testimonial-desc">
                                <p>{{$video->desc}}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-sm-12 text-center">
                        <a class="text-uppercase" href="{{route('videoTestimonial')}}"><i class="fa fa-plus mr-2"></i>@lang('view_more')</a>
                    </div>
                </div>
            </div>
            <div class="special-bundle w-100" style="margin-top: 3rem">
                <h2 class="text-center">@lang('from_our_community')</h2>
                <div class="d-flex justify-content-center">
                    <div class="divider" style="width: 170px"></div>
                </div>
                <p class="text-center mt-5" style="font-size: 1.5rem; color: #636363">@lang('satisfied_customers_say')</p>
                <div class="bundle-box row">
                    <div class="col-sm-12 text-center">
                        <img src="{{asset('images/testimonial/facebook-testimonial.png')}}" style="width: 900px">
                    </div>
                </div>
            </div>
            <div class="special-bundle w-100" style="margin-top: 3rem">
                <h2 class="text-center">@lang('share_your_experience')</h2>
                <div class="d-flex justify-content-center">
                    <div class="divider" style="width: 170px"></div>
                </div>
                <div class="bundle-box row">
                    <div class="col-sm-12 col-md-4 text-center px-4">
                        <img src="{{asset('images/testimonial/testimonial-left.png')}}" class="w-100">
                        <h4 class="text-left mt-3">@lang('review_facebook')</h4>
                        <p class="text-left">@lang('rate_and_write_on_our_facebook')</p>
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="mb-0">20 MYR</h3>
                            <a href="#" class="btn btn-primary">@lang('get_started')</a>
                        </div>
                    </div>
                    <div class="col-sm12 col-md-4 text-center px-4">
                        <img src="{{asset('images/testimonial/testimonial-right.png')}}" class="w-100">
                        <h4 class="text-left mt-3">@lang('post_and_tag_on_instagram')</h4>
                        <p class="text-left">@lang('choose_how_review_story')</p>
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="mb-0">@lang('up_to') 50 MYR</h3>
                            <a href="#" class="btn btn-primary">@lang('get_started')</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 text-center px-4">
                        <img src="{{asset('images/testimonial/testimonial-site.jpg')}}" class="w-100" style="max-height: 207px">
                        <h4 class="text-left mt-3">@lang('review_on_products')</h4>
                        <p class="text-left">@lang('write_on_our_facebook')</p>
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="mb-0">20 MYR</h3>
                            <a href="{{ route('customer.testimonial.upload') }}" class="btn btn-primary">@lang('get_started')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-js')
    <script src="{{ asset('plugins/read-more/js/jquery.readall.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.testimonial-desc').readall({
                // Default values
                showheight: 80,                         // height to show
                showrows: null,                         // rows to show (overrides showheight)
                animationspeed: 200,                    // speed of transition
                btnTextShowmore: '@lang('read_more')',           // text shown on button to show more
                btnTextShowless: '@lang('read_less')',           // text shown on button to show less
                btnClassShowmore: 'btn mt-1',     // class(es) on button to show more
                btnClassShowless: 'btn'      // class(es) on button to show less
            });
        });
    </script>
@endsection
