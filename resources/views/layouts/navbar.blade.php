<header class="app-header header">

    <!-- Sidebar toggle button-->
    <!-- Navbar Right Menu-->
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="{{route('home')}}">
                <img alt="logo" class="header-brand-img" src="{{asset('images/logo-white.png')}}" style="height: 30px">
            </a>

            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
            <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown d-none d-md-flex">
                    <a class="nav-link icon" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="nav-unread bg-danger"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item d-flex pb-3" href="#">
                            <div class="notifyimg">
                                <i class="fa fa-thumbs-o-up"></i>
                            </div>
                            <div>
                                <strong>Someone likes our posts.</strong>
                                <div class="small text-muted">
                                    3 hours ago
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex pb-3" href="#">
                            <div class="notifyimg">
                                <i class="fa fa-commenting-o"></i>
                            </div>
                            <div>
                                <strong>3 New Comments</strong>
                                <div class="small text-muted">
                                    5 hour ago
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex pb-3" href="#">
                            <div class="notifyimg">
                                <i class="fa fa-cogs"></i>
                            </div>
                            <div>
                                <strong>Server Rebooted.</strong>
                                <div class="small text-muted">
                                    45 mintues ago
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-center text-muted-dark" href="#">View all Notification</a>
                    </div>
                </div>
                <div class="dropdown d-none d-md-flex">
                    <a class="nav-link icon" data-toggle="dropdown"><i class="fa fa-envelope-o"></i> <span class=" nav-unread badge badge-info badge-pill">2</span></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item text-center text-dark" href="#">2 New Messages</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex pb-3" href="#">
                            <span class="avatar brround mr-3 align-self-center" style="background-image: url(../../images/icons/user.jpg)"></span>
                            <div>
                                <strong>Madeleine</strong> Hey! there I' am available....
                                <div class="small text-muted">
                                    3 hours ago
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex pb-3" href="#"><span class="avatar brround mr-3 align-self-center" style="background-image: url(../../images/icons/user.jpg)"></span>
                            <div>
                                <strong>Anthony</strong> New product Launching...
                                <div class="small text-muted">
                                    5 hour ago
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-center text-muted-dark" href="#">See all Messages</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a class="nav-link pr-0 leading-none d-flex" data-toggle="dropdown" href="#">
                        <span class="avatar avatar-md brround" style="background-image: url({{\Illuminate\Support\Facades\Auth::user()->avatar}})"></span>
                        <span class="ml-2 d-none d-lg-block">
                            <span class="text-white">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        @if(\Illuminate\Support\Facades\Auth::user()->role == 'customer')
                            <a class="dropdown-item" href="{{route('customer.profile')}}"><i class="dropdown-icon mdi mdi-account-outline"></i> Profile</a>
                        @else
                            <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="dropdown-icon mdi mdi-account-outline"></i> Profile</a>
                        @endif
                        <a class="dropdown-item" href="#"><span class="float-right"><span class="badge badge-primary">6</span></span> <i class="dropdown-icon mdi mdi-message-outline"></i> Inbox</a>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="dropdown-icon mdi mdi-logout-variant"></i> Sign out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

