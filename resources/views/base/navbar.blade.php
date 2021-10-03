@php
    $main = Request::segment(1);
    $sub = Request::segment(2);
    $products = \App\Models\Product::where('status',1)->orderBy('created_at','DESC')->get();
@endphp
<header id="header-wrap">
    <!-- Navbar Start -->
    <div class="mobile-menu-icon">
        <div class="menu-box w-100 d-flex align-content-center justify-content-center">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="javascript:void(0)"></a>
            <a href="{{ route('home') }}"><img src="{{asset('images/logo-white.png')}}" style="width: 100px"></a>
        </div>
    </div>
    <nav class="navbar navbar-expand-md flex-column front-navbar">
        <div class="notification w-100">
            <p class="mb-0">@lang('use_code') <span>NCSBEST</span> @lang('to_get') <span>30 @lang('points')</span> @lang('your_purchage_when') <span>{{env('APP_NAME')}}</span> @lang('products.') <span>@lang('shop_now') ></span></p>
        </div>
        <div class="main-nav w-100 py-5">
            <div class="logo w-100 text-center">
                <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" style="width: 200px"></a>
            </div>
            <div class="container-fluid align-items-center justify-content-center px-custom">
                <div class="row">
                    <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center mb-sm-2 mb-md-0 mobile-hide">
                        <div class="custom-search w-100">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-search"></i></div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-sm-center justify-content-md-end mb-sm-2 mb-md-0">
                        @if(\Illuminate\Support\Facades\Auth::guard()->check())
                            <div class="dropdown">
                                <div class="nav-link pr-0 leading-none d-flex flex-column align-items-baseline" data-toggle="dropdown">
                                    <div class="icon-box mr-5"><a href="javascript:void(0)" class="d-flex align-items-center"><i class="fa fa-user-o mr-2"></i>{{\Illuminate\Support\Facades\Auth::user()->name}}<i class="fa fa-chevron-down ml-2" style="font-size: 1rem"></i></a></div>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="min-width: 10rem">
                                    @if((\Illuminate\Support\Facades\Auth::user()->role == "admin" || \Illuminate\Support\Facades\Auth::user()->role == "super_admin") && \Illuminate\Support\Facades\Auth::user()->manage_status == 1)
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">@lang('Dashboard')</a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                    <a class="dropdown-item" href="{{ url('/main/orders') }}">@lang('orders')</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/main/account') }}">@lang('account_setting')</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('logout')</a>
                                </div>
                            </div>
                        @else
                            <div class="icon-box pr-5 mr-5" style="border-right: 1px solid #cdcdcd"><a href="javascript:void(0)" data-toggle="modal" data-target="#registerModal"><i class="fa fa-pencil mr-2"></i>@lang('REGISTER')</a></div>
                            <div class="icon-box mr-sm-0 mr-md-5"><a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal"><i class="fa fa-user mr-2"></i>@lang('SIGNIN')</a></div>
                        @endif
                        <div class="icon-box mr-5 mobile-hide"><a href="#"><i class="fa fa-heart"></i></a></div>
                        <div class="icon-box mr-5 mobile-hide"><a href="{{ url('main/cart') }}"><i class="fa fa-shopping-cart"></i></a></div>
                    </div>
                    <div class="col-sm-12 col-md-3 d-flex justify-content-center">
                        <div class="dropdown">
                            <div class="nav-link pr-0 leading-none d-flex flex-column align-items-baseline" data-toggle="dropdown">
                                <p class="mb-1" style="font-size: 0.5rem">@lang('CURRENCY')</p>
                                <p>MYR <img class="cu-flag ml-2" src="{{asset('images/flags/my.svg')}}"><i class="fa fa-chevron-down ml-1"></i></p>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">MYR<img class="cu-flag ml-2" src="{{asset('images/flags/my.svg')}}"></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">SGD<img class="cu-flag ml-2" src="{{asset('images/flags/sg.svg')}}"></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">THB<img class="cu-flag ml-2" src="{{asset('images/flags/th.svg')}}"></a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <div class="nav-link pr-0 leading-none d-flex flex-column align-items-baseline" data-toggle="dropdown">
                                <p style="font-size: 0.5rem">@lang('LANGUAGE')</p>
                                <p>{{App::getLocale()=="en"?__('ENGLISH'):(App::getLocale()=="my"?__('Malay'):__('Chinese'))}}<i class="fa fa-chevron-down ml-1"></i></p>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="{{url('lang/en')}}">@lang('ENGLISH')</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('lang/my')}}">@lang('MALAY')</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('lang/cn')}}">@lang('CHINESE')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-nav w-100 mobile-hide">
            <div class="container d-flex justify-content-between">
                <div class="dropdown">
                    <a class="nav-link pr-0 leading-none d-flex" data-toggle="dropdown" href="#">
                        <span class="text-white text-uppercase">@lang('products')</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="width: 200px">
                        <a class="dropdown-item" href="{{ route('product',0) }}">@lang('all')</a>
                        @foreach($products as $one)
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('product', $one->id) }}">{{$one->name}}</a>
                        @endforeach
                    </div>
                </div>
                <div>
                    <a class="nav-link pr-0 leading-none d-flex" href="{{route('testimonial')}}">
                        <span class="text-white text-uppercase">@lang('testimonial')</span>
                    </a>
                </div>
                <div>
                    <a class="nav-link pr-0 leading-none d-flex" href="#">
                        <span class="text-white text-uppercase">@lang('blog')</span>
                    </a>
                </div>
                <div>
                    <a class="nav-link pr-0 leading-none d-flex" href="#">
                        <span class="text-white text-uppercase">@lang('faqs')</span>
                    </a>
                </div>
                <div>
                    <a class="nav-link pr-0 leading-none d-flex" href="#">
                        <span class="text-white text-uppercase">@lang('membership')</span>
                    </a>
                </div>
                <div>
                    <a class="nav-link pr-0 leading-none d-flex" href="#">
                        <span class="text-white text-uppercase">@lang('free_shipping')</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
    <!-- mobile side bar -->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar front-sidebar">
        <div class="app-sidebar__user">
            <div class="dropdown">
                <a class="nav-link p-0 leading-none d-flex" href="{{route('home')}}">
                    <img src="{{asset('images/logo.png')}}" style="width: 150px">
                </a>
            </div>
        </div>
        <ul class="side-menu">
            <li>
                <a class="side-menu__item {{$main == 'product' ? 'active' : ''}}" href="{{route('product',0)}}"><span class="side-menu__label">@lang('products')</span></a>
            </li>
            <li>
                <a class="side-menu__item {{$main == 'testimonial' ? 'active' : ''}}" href="{{route('testimonial')}}"><span class="side-menu__label">@lang('testimonial')</span></a>
            </li>
            <li>
                <a class="side-menu__item {{$main == 'blog' ? 'active' : ''}}" href="#"><span class="side-menu__label">@lang('blog')</span></a>
            </li>
            <li>
                <a class="side-menu__item {{$main == 'faqs' ? 'active' : ''}}" href="#"><span class="side-menu__label">@lang('faqs')</span></a>
            </li>
            <li>
                <a class="side-menu__item {{$main == 'membership' ? 'active' : ''}}" href="#"><span class="side-menu__label">@lang('membership')</span></a>
            </li>
            <li>
                <a class="side-menu__item {{$main == 'free_shipping' ? 'active' : ''}}" href="#"><span class="side-menu__label">@lang('free_shipping')</span></a>
            </li>
        </ul>
    </aside>
    <!-- mobile side bar end-->
</header>

