<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'damraaz.com') }}</title>


    <link rel="icon" href="{{ asset('admin/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Damraaz - Dashboard</title>

    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/linearicon.css') }}">

    <!-- fontawesome css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/font-awesome.css') }}">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/themify.css') }}">

    <!-- ratio css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/ratio.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/remixicon.css') }}">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/animate.css') }}">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/bootstrap.css') }}">

    <!-- vector map css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vector-map.css') }}">

    <!-- Slick Slider Css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/vendors/slick.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css') }}">


</head>

<body>
    {{-- <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div> --}}
    <!-- tap on tap end -->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper m-0">
                <div class="header-logo-wrapper p-0">
                    <div class="logo-wrapper">
                        <a href="{{ route('admin.dashboard') }}">
                            <img class="img-fluid main-logo" src="{{ asset('admin/assets/images/logo/1.png') }}"
                                alt="logo">
                            <img class="img-fluid white-logo" src="{{ asset('admin/assets/images/logo/1-white.png') }}"
                                alt="logo">
                        </a>
                    </div>
                    <div class="toggle-sidebar">
                        <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{ asset('admin/assets/images/logo/1.png') }}" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>

                <form class="form-inline search-full d-none" action="javascript:void(0)" method="get"></form>
                    <div class="form-group w-100">
                        <div class="Typeahead Typeahead--twitterUsers">
                            <div class="d-flex ">

                                <div class="u-posRelative">
                                    <input class="demo-input Typeahead-input form-control-plaintext w-100" id="seach_it" type="search" placeholder="Search User, Product, Branding...">

                                </div>

                            </div>
                            <div id="show_data" style="top: 60px;background-color: grey;position: absolute;z-index: 99;width: 42%;margin: 0rem auto;padding:1rem 2rem;border:1px solid black;overflow-y:scroll;height:500px;left: 0px;">
                            </div>
                            <div class="Typeahead-menu"></div>
                        </div>
                    </div>
                </form>
                <div class="nav-right col-6 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li>
                            <span class="header-search">
                                <i class="ri-search-line"></i>
                            </span>
                        </li>
                        @php
                            $notifications = App\Models\Notification::where('is_admin', true)
                                ->where('is_read', false)
                                ->latest()
                                ->paginate(8);
                        @endphp
                        <li class="onhover-dropdown">
                            <div class="notification-box">
                                <i class="ri-notification-line"></i>
                                <span class="badge rounded-pill badge-theme">{{ $notifications->total() }}</span>
                            </div>
                            <ul class="notification-dropdown onhover-show-div">
                                <li>
                                    <i class="ri-notification-line"></i>
                                    <h6 class="f-18 mb-0">Notitications</h6>
                                </li>
                                @forelse($notifications as $notification)
                                    <li>
                                        <p>
                                            <i class="fa fa-circle me-2 font-primary"></i>{{ $notification->name ?? '' }}
                                            <span class="pull-right">{{ $notification->created_at->diffForHumans() }}</span>
                                        </p>
                                    </li>
                                @empty
                                    <li>
                                        <p>No Notification found</p>
                                    </li>
                                @endforelse
                                <!--<li>-->
                                <!--    <p>-->
                                <!--        <i class="fa fa-circle me-2 font-success"></i>Order Complete<span-->
                                <!--            class="pull-right">1 hr</span>-->
                                <!--    </p>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <p>-->
                                <!--        <i class="fa fa-circle me-2 font-info"></i>Tickets Generated<span-->
                                <!--            class="pull-right">3 hr</span>-->
                                <!--    </p>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <p>-->
                                <!--        <i class="fa fa-circle me-2 font-danger"></i>Delivery Complete<span-->
                                <!--            class="pull-right">6 hr</span>-->
                                <!--    </p>-->
                                <!--</li>-->
                                <li>
                                    <a class="btn btn-primary" href="{{ route('admin.notifications') }}">Check all
                                        notification</a>
                                </li>
                            </ul>
                        </li>

                        <!--<li>-->
                        <!--    <div class="mode">-->
                        <!--        <i class="ri-moon-line"></i>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <li class="profile-nav onhover-dropdown pe-0 me-0">
                            <div class="media profile-media">
                                <img class="user-profile rounded-circle"
                                    src="{{ asset('admin/assets/images/users/4.jpg') }}" alt="">
                                <div class="user-name-hide media-body">
                                    {{-- <span>{{Auth()->guard('admin')->check()}}</span> --}}
                                    <p class="mb-0 font-roboto">Admin<i class="middle ri-arrow-down-s-line"></i></p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <!--<li>-->
                                <!--    <a href="all-users.html">-->
                                <!--        <i data-feather="users"></i>-->
                                <!--        <span>Users</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="order-list.html">-->
                                <!--        <i data-feather="archive"></i>-->
                                <!--        <span>Orders</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="support-ticket.html">-->
                                <!--        <i data-feather="phone"></i>-->
                                <!--        <span>Spports Tickets</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="profile-setting.html">-->
                                <!--        <i data-feather="settings"></i>-->
                                <!--        <span>Settings</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                <li>
                                    <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                        href="javascript:void(0)">
                                        <i data-feather="log-out"></i>
                                        <span>Log out</span>
                                    </a>

                                </li>
                                <li>
                                    <a  href="{{route('admin.profile')}}"><i data-feather="user"></i><span>Profile</span></a>

                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                <div id="sidebarEffect"></div>
                <div>
                    <div class="logo-wrapper logo-wrapper-center">
                        <a href="{{ route('admin.dashboard') }}" data-bs-original-title="" title="">
                            <img class="img-fluid for-white" src="{{ asset('images/logo.png') }}" alt="logo">
                        </a>
                        <div class="back-btn">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="toggle-sidebar">
                            <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
                        </div>
                    </div>
                    <div class="logo-icon-wrapper">
                        <a href="{{ route('admin.dashboard') }}">
                            <img class="img-fluid main-logo main-white"
                                src="{{ asset('admin/assets/images/logo/logo.png') }}" alt="logo">
                            <img class="img-fluid main-logo main-dark"
                                src="{{ asset('admin/assets/images/logo/logo-white.png') }}" alt="logo">
                        </a>
                    </div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow">
                            <i data-feather="arrow-left"></i>
                        </div>

                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"></li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('admin.dashboard') }}">
                                        <i class="ri-home-line"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="ri-store-3-line"></i>
                                        <span>Shops</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.newShop') }}">New Shop Request</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('admin.allShops',['shop'=>'approved']) }}">All Approved</a>
                                            <a href="{{ route('admin.allShops',['shop'=>'inActive']) }}">All In-Active</a>
                                            <a href="{{ route('admin.allShops',['shop'=>'blocked']) }}">All Blocked</a>

                                        </li>
                                    </ul>
                                </li>
                                {{-- <li class="sidebar-list">
                                    <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="ri-store-3-line"></i>
                                        <span>Product</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.product.index') }}">Prodcts</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('admin.product.create') }}">Add New Products</a>
                                        </li>
                                    </ul>
                                </li> --}}

                                <li class="sidebar-list">
                                    <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="ri-store-3-line"></i>
                                        <span>Products</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ route('admin.megaSales') }}">Mega Sales</a>
                                        <li><a href="{{ route('admin.userProduct.index', 'pending') }}">Pending</a>
                                        </li>
                                        <li><a href="{{ route('admin.userProduct.index', 'accepted') }}">Accepted</a>
                                        </li>
                                        <li><a href="{{ route('admin.userProduct.index', 'rejected') }}">Rejected</a>
                                        </li>
                                        <li><a href="{{ route('admin.products.inActive') }}">In-Active</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="ri-store-3-line"></i>
                                        <span>Bundles</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ route('admin.allProductBundle') }}">All Bundle</a>
                                        <li><a href="{{ route('admin.createBundle') }}">Add New Bundle</a>
                                        <li><a href="{{ route('admin.bundleOrder', 'pending') }}">New Bundle Payments</a>
                                        <li><a href="{{ route('admin.bundleOrder', 'cancelled') }}">Cancelled Bundle Payments</a>
                                        <li><a href="{{ route('admin.bundleOrder', 'approved') }}">Accepted Bundle Payments</a>
                                        <li><a href="{{ route('admin.getBundleOrder', 'pending') }}">New Orders Payments</a>
                                        <li><a href="{{ route('admin.getBundleOrder' ,'delivered') }}">Delivered Orders</a>
                                        <li><a href="{{ route('admin.getBundleOrder' ,'cancelled') }}">Cancelled Orders</a>
                                        <li><a href="{{ route('admin.getBundleOrder' ,'onDelivery') }}">On-Delivery Orders</a>
                                        <li><a href="{{ route('admin.getBundleOrder' ,'return') }}">Return Orders</a>
                                        <li><a href="{{ route('admin.getBundleOrder' ,'refund') }}">Refund Orders</a>
                                        {{-- <li><a href="{{ route('admin.levelCommissionBundle') }}">Level Commissions</a> --}}

                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="ri-store-3-line"></i>
                                        <span>Notification</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.notification.forUser.view') }}">Notifications</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('admin.notification.create') }}">Add New Notification</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="sidebar-list">
                                    <a class="linear-icon-link sidebar-link sidebar-title {{ Request::routeIs(['admin.category.create', 'admin.category.index', 'admin.category.edit', 'admin.category.show']) ? 'active' : '' }}"
                                        href="javascript:void(0)">
                                        <i class="ri-list-check-2"></i>
                                        <span>Category</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.category.index') }}">Category List</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('admin.category.create') }}">Add New Category</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="linear-icon-link sidebar-link sidebar-title "
                                        href="javascript:void(0)">
                                        <i class="ri-list-check-2"></i>
                                        <span>Branding</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.index.branding') }}">Branding List</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.create.branding') }}">Add New Branding</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.branding.createNewProduct') }}">Add New Product In Branding</a>
                                        </li>
                                    </ul>
                                </li>

                                <!--<li class="sidebar-list">-->
                                <!--    <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">-->
                                <!--        <i class="ri-list-settings-line"></i>-->
                                <!--        <span>Attributes</span>-->
                                <!--    </a>-->
                                <!--    <ul class="sidebar-submenu">-->
                                <!--        <li>-->
                                <!--            <a href="attributes.html">Attributes</a>-->
                                <!--        </li>-->

                                <!--        <li>-->
                                <!--            <a href="add-new-attributes.html">Add Attributes</a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="ri-user-3-line"></i>
                                        <span>Users</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.user.index') }}">All users</a>
                                        </li>
                                        <!--<li>-->
                                        <!--    <a href="add-new-user.html">Add new user</a>-->
                                        <!--</li>-->
                                    </ul>
                                </li>

                                <!--<li class="sidebar-list">-->
                                <!--    <a class="sidebar-link sidebar-title" href="javascript:void(0)">-->
                                <!--        <i class="ri-user-3-line"></i>-->
                                <!--        <span>Roles</span>-->
                                <!--    </a>-->
                                <!--    <ul class="sidebar-submenu">-->
                                <!--        <li>-->
                                <!--            <a href="role.html">All roles</a>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <a href="create-role.html">Create Role</a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->

                                <!--<li class="sidebar-list">-->
                                <!--    <a class="sidebar-link sidebar-title link-nav" href="media.html">-->
                                <!--        <i class="ri-price-tag-3-line"></i>-->
                                <!--        <span>Media</span>-->
                                <!--    </a>-->
                                <!--</li>-->

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="ri-archive-line"></i>
                                        <span>Orders</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.orders.index', ['orders' => 'pending']) }}">New
                                                Order</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.orders.index', ['orders' => 'processing']) }}">Processing
                                                Order</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.orders.index', ['orders' => 'onDelivery']) }}">On-Delivery
                                                Order</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.orders.index', ['orders' => 'delivered']) }}">Delivered
                                                Order </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.orders.index', ['orders' => 'cancelled']) }}">Cancelled
                                                Order</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.orders.index', ['orders' => 'return']) }}">Return
                                                Order</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.orders.index', ['orders' => 'refund']) }}">Refund
                                                Order</a>
                                        </li>
                                        {{-- <li>
                                            <a href="{{ route('admin.orders.index', ['orders' => 'confirm']) }}">Confirm   Order</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.orders.index', ['orders' => 'on-the-way    ']) }}">On the Way
                                                Order</a>
                                        </li> --}}


                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="ri-archive-line"></i>
                                        <span>Return Orders</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a
                                                href="{{ route('admin.orders.returnOrder', ['order' => 'pending']) }}">Pending
                                                Order</a>
                                        </li>
                                        <li>
                                            <a
                                                href="{{ route('admin.orders.returnOrder', ['order' => 'returned']) }}">Returned
                                                Order </a>
                                        </li>
                                        <li>
                                            <a
                                                href="{{ route('admin.orders.returnOrder', ['order' => 'cancelled']) }}">Cancelled
                                                Order </a>
                                        </li>


                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('admin.users.bonus') }}">
                                        <i class="fa-solid fa-money-bill-trend-up"></i>
                                        <span>Bonus</span>
                                    </a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="ri-archive-line"></i>
                                        <span>Withdraw</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a
                                                href="{{ route('admin.withdraws.index', ['withdraws' => 'pending']) }}">New
                                                Withdraw</a>
                                        </li>
                                        <li>
                                            <a
                                                href="{{ route('admin.withdraws.index', ['withdraws' => 'completed']) }}">Completed
                                                Withdraw </a>
                                        </li>
                                        <li>
                                            <a
                                                href="{{ route('admin.withdraws.index', ['withdraws' => 'approved']) }}">Approved
                                                Withdraw</a>
                                        </li>
                                        <li>
                                            <a
                                                href="{{ route('admin.withdraws.index', ['withdraws' => 'cancelled']) }}">Cancelled
                                                Withdraw</a>
                                        </li>



                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="fa fa-phone"></i>
                                        <span>Contact Us</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.contact') }}">New Contact Us</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.contacted') }}">Contacted </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="fa fa-phone"></i>
                                        <span>WhatsApp</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.viewStoreWhatsapp') }}">View</a>
                                        </li>


                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="fa fa-phone"></i>
                                        <span>Slider</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.slider.create') }}">New Slider</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.slider.index') }}">View Sliders </a>
                                        </li>



                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="fa fa-currency"></i>
                                        <span>Shop Accounts</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.view_accounts') }}">View</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="fa fa-currency"></i>
                                        <span>Bundle Accounts</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.view_accounts_bundle') }}">View</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="fa fa-currency"></i>
                                        <span>Payment Methods</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.paymentGateway') }}">View</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <i class="fa fa-currency"></i>
                                        <span>Store Setting</span>
                                    </a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="{{ route('admin.viewStoreInformation') }}">Setting</a>
                                        </li>




                                    </ul>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('admin.marquee.index') }}">
                                        <i class="fa-regular fa-newspaper"></i>
                                        <span>News</span>
                                    </a>
                                </li>


                            </ul>
                        </div>

                        <div class="right-arrow" id="right-arrow">
                            <i data-feather="arrow-right"></i>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->

            <!-- index body start -->
            <div class="page-body">

                @yield('content')

                <!-- footer start-->
                <div class="container-fluid">
                    <footer class="footer">
                        <div class="row">
                            <div class="col-md-12 footer-copyright text-center">
                                <p class="mb-0">Copyright {{ date('Y') }} &copy; Damraaz</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <!-- footer End-->
            </div>
            <!-- index body end -->

        </div>
        <!-- Page Body End -->
    </div>
    {{-- modals --}}

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                    <p>Are you sure you want to log out?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="button-box">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                        <a href="{{ route('logout') }}" class="btn  btn--yes btn-primary"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Yes</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- /modals --}}

    <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap js -->
    <script src="{{ asset('admin/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js -->
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather-icon.js') }}"></script>

    <!-- scrollbar simplebar js -->
    <script src="{{ asset('admin/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scrollbar/custom.js') }}"></script>

    <!-- Sidebar jquery -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>

    <!-- tooltip init js -->
    <script src="{{ asset('admin/assets/js/tooltip-init.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('admin/assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('admin/assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/notify/index.js') }}"></script>

    <!-- Apexchar js -->
    {{-- <script src="{{ asset('admin/assets/js/chart/apex-chart/apex-chart1.js') }}"></script>
    <script src="{{ asset('admin/assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('admin/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('admin/assets/js/chart/apex-chart/chart-custom1.js') }}"></script> --}}


    <!-- slick slider js -->
    <script src="{{ asset('admin/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom-slick.js') }}"></script>

    <!-- customizer js -->
    <!--<script src="{{ asset('admin/assets/js/customizer.js') }}"></script>-->

    <!-- ratio js -->
    <script src="{{ asset('admin/assets/js/ratio.js') }}"></script>

    <!-- sidebar effect -->
    <script src="{{ asset('admin/assets/js/sidebareffect.js') }}"></script>

    <!-- Theme js -->
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

    @yield('scripts')

<style>
    a#searc_user_id {
    color: white !important;
}
input#seach_it {
    padding-left: 2rem;
}
input#seach_it {
    border: 1px solid black;
}
</style>

<script>

    $( document ).ready(function() {

   $('#show_data').hide();

   $( "#seach_it" ).on('keyup',function() {

        var search =  $('#seach_it').val();

  console.log(search);

  if(search !== ""){

    $.ajax({

    type : 'get',

    url : '{{route('admin.search_data')}}',

    data:{'search':search},

    success:function(data){

    $('#show_data').show();



    $('#show_data').empty();

    $('#show_data').append(data);



    }



    });

}



     $('#show_data').empty();

$('#show_data').hide();

});

$('#show_data').hide();





  $('#from_to_date_check').change(function(){

      $( "#from_to_date" ).submit();



   });

  $('#single_date_check').change(function(){

      $( "#single_date" ).submit();



   });



});

</script>
@stack('scripts')
</body>

</html>
