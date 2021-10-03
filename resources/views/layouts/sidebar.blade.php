<!-- Sidebar menu-->
@php
    $basic = Request::segment(1);
    $tab = Request::segment(2);
    $sub_tab =  Request::segment(3);
@endphp

<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar ">
    <div class="app-sidebar__user">
        <div class="dropdown">
            <a class="nav-link p-0 leading-none d-flex" data-toggle="dropdown" href="javascript:void(0)">
                <span class="avatar avatar-md brround" style="background-image: url({{\Illuminate\Support\Facades\Auth::user()->avatar}})"></span>
                <span class="ml-2">
                    <span class="text-dark app-sidebar__user-name font-weight-semibold">{{\Illuminate\Support\Facades\Auth::user()->name}}</span><br>
                    <span class="text-muted app-sidebar__user-name text-sm">{{__(\Illuminate\Support\Facades\Auth::user()->role)}}</span>
                </span>
            </a>
        </div>
    </div>
    <ul class="side-menu">
        <li>
            <a class="side-menu__item {{($tab =='dashboard'||$basic == 'main') ? 'active' : ''}}" href="{{route('dashboard')}}"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">@lang('dashboard')</span></a>
        </li>
        @if(\Illuminate\Support\Facades\Auth::user()->role == 'super_admin')
            <li class="slide">
                <a class="side-menu__item {{$tab == 'user' ? 'active' : ''}}" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-user-o"></i><span class="side-menu__label">@lang('users')</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{route('manager.user.list')}}" class="slide-item {{($tab == 'user' && $sub_tab =='list') ? 'active' : ''}}">@lang('list')</a>
                    </li>
                    <li>
                        <a href="{{route('manager.user.create')}}" class="slide-item {{($tab == 'user' && $sub_tab =='create') ? 'active' : ''}}">@lang('create')</a>
                    </li>
                </ul>
            </li>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->role != 'customer')
            <li>
                <a class="side-menu__item {{$tab == 'customer' ? 'active' : ''}}" href="{{route('admin.customer.list')}}"><i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">@lang('customers')</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item {{$tab == 'category' ? 'active' : ''}}" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-align-justify"></i><span class="side-menu__label">@lang('categories')</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{route('admin.category.list')}}" class="slide-item {{($tab == 'category' && $sub_tab =='list') ? 'active' : ''}}">@lang('list')</a>
                    </li>
                    <li>
                        <a href="{{route('admin.category.create')}}" class="slide-item {{($tab == 'category' && $sub_tab =='create') ? 'active' : ''}}">@lang('create')</a>
                    </li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item {{$tab == 'product' ? 'active' : ''}}" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-cart-arrow-down"></i><span class="side-menu__label">@lang('products')</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{route('admin.product.list')}}" class="slide-item {{($tab == 'product' && $sub_tab =='list') ? 'active' : ''}}">@lang('list')</a>
                    </li>
                    <li>
                        <a href="{{route('admin.product.create')}}" class="slide-item {{($tab == 'product' && $sub_tab =='create') ? 'active' : ''}}">@lang('create')</a>
                    </li>
                    <li>
                        <a href="{{route('admin.product.import')}}" class="slide-item {{($tab == 'product' && $sub_tab =='import') ? 'active' : ''}}">@lang('import')</a>
                    </li>
                    <li>
                        <a href="{{route('admin.product.recommend')}}" class="slide-item {{($tab == 'product' && $sub_tab =='recommend') ? 'active' : ''}}">@lang('recommendation')</a>
                    </li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item {{$tab == 'productbundel' ? 'active' : ''}}" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-archive"></i><span class="side-menu__label">@lang('product bundle')</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{route('admin.productbundel.list')}}" class="slide-item {{($tab == 'productbundel' && $sub_tab =='list') ? 'active' : ''}}">@lang('list')</a>
                    </li>
                    <li>
                        <a href="{{route('admin.productbundel.create')}}" class="slide-item {{($tab == 'productbundel' && $sub_tab =='create') ? 'active' : ''}}">@lang('create')</a>
                    </li>
                    <li>
                        <a href="{{route('admin.productbundel.import')}}" class="slide-item {{($tab == 'productbundel' && $sub_tab =='import') ? 'active' : ''}}">@lang('import')</a>
                    </li>


                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item {{$tab == 'creditpoint' ? 'active' : ''}}" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-credit-card"></i><span class="side-menu__label">@lang('Credit point')</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{route('admin.creditpoint.list')}}" class="slide-item {{($tab == 'creditpoint' && $sub_tab =='list') ? 'active' : ''}}">@lang('list')</a>
                    </li>
                    <li>
                        <a href="{{route('admin.creditpoint.create')}}" class="slide-item {{($tab == 'creditpoint' && $sub_tab =='create') ? 'active' : ''}}">@lang('create')</a>
                    </li>
                    <li>
                        <a href="{{route('admin.creditpoint.import')}}" class="slide-item {{($tab == 'creditpoint' && $sub_tab =='import') ? 'active' : ''}}">@lang('import')</a>
                    </li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item {{$tab == 'promocode' ? 'active' : ''}}" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-diamond"></i><span class="side-menu__label">@lang('promo_code')</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{route('admin.promoCode.list')}}" class="slide-item {{($tab == 'promocode' && $sub_tab =='list') ? 'active' : ''}}">@lang('list')</a>
                    </li>
                    <li>
                        <a href="{{route('admin.promoCode.create')}}" class="slide-item {{($tab == 'promocode' && $sub_tab =='create') ? 'active' : ''}}">@lang('create')</a>
                    </li>
                    <li>
                        <a href="{{route('admin.promoCode.import')}}" class="slide-item {{($tab == 'promocode' && $sub_tab =='import') ? 'active' : ''}}">@lang('import')</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="side-menu__item {{$tab == 'orders' ? 'active' : ''}}" href="{{route('admin.order.index')}}"><i class="side-menu__icon fa fa-wpforms"></i><span class="side-menu__label">@lang('orders')</span></a>
            </li>
        @endif
    </ul>
</aside>
