<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Quản Lý Chi Tiêu Cá Nhân </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('FE/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('FE/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('FE/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('FE/css/style.css') }}" rel="stylesheet">



</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('FE/images/logo.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('FE/images/logo-text.png') }}" alt="">
                <img class="brand-title" src="{{ asset('FE/images/logo-text.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            {{-- <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li> --}}
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    {{-- <i class="mdi mdi-account"></i> --}}
                                    <span class="ml-2">
                                        <!-- Check if the 'username' key exists in the session -->
                                        @if(session()->has('username'))
                                        <p>Chào Mừng, {{ session('username') }}!</p>
                                        @endif
                                    </span> <!-- Display the username -->
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ URL::to('/profile') }}" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Thông Tin Cá Nhân </span>
                                    </a>
                                    <a href="{{ route('change-password.form') }}" class="dropdown-item">
                                        <i class="fa fa-key"></i>
                                        <span class="ml-2">Đổi Mật Khẩu </span>
                                    </a>
                                    <a href="{{ URL::to('/login') }}" class="dropdown-item">
                                        <i class="fa fa-sign-out"></i>
                                        <span class="ml-2">Đăng Xuất </span>
                                    </a>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a class="has-arrow"  aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ URL::to('/home') }}">Trang Chủ</a></li>
                            
                        </ul>
                    </li>
                    
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Quản Lý Ví</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ URL::to('/wallet') }}">Ví</a></li>
                            
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-chart-bar-33"></i><span class="nav-text">Quản Lý Giao Dịch</span></a>
                        	<ul aria-expanded="false">
                            <li><a href="{{ URL::to('/transaction') }}">Lịch Sử Giao Dịch</a></li>
				</ul>
                    </li>
                   
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-world-2"></i><span class="nav-text">Quản Lý Danh Mục</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ URL::to('/category') }}">Danh Mục</a></li>
                            

                        </ul>
                    </li>

                   
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            @yield('home')
            @yield('wallet')
            @yield('category')
            @yield('transaction')
            @yield('profile')
            @yield('add_category')
            @yield('edit_category')
            @yield('edit_wallet')
            @yield('edit_transaction')
            @yield('search')
            @yield('add_balance')
            @yield('change_password')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Nguyễn Ngọc Thái- Nhóm 17</a> 2019</p>
                <p>Distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a></p> 
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> --}}

    <!-- Required vendors -->
    <script src="{{ asset('FE/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('FE/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('FE/js/custom.min.js') }}"></script>


    <!-- Vectormap -->
    <script src="{{ asset('FE/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('FE/vendor/morris/morris.min.js') }}"></script>


    <script src="{{ asset('FE/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('FE/vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('FE/vendor/gaugeJS/dist/gauge.min.js') }}"></script>

    <!--  flot-chart js -->
    <script src="{{ asset('FE/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('FE/vendor/flot/jquery.flot.resize.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('FE/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    <!-- Counter Up -->
    <script src="{{ asset('FE/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('FE/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('FE/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>


    <script src="{{ asset('FE/js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('FE/js/thainn/wallet.js') }}"></script>
    <script src="{{ asset('FE/js/thainn/category.js') }}"></script>
    <script src="{{ asset('FE/js/thainn/home.js') }}"></script>
    <script src="{{ asset('FE/js/thainn/authentication.js') }}"></script>
    <script src="{{ asset('FE/js/thainn/profile.js') }}"></script>
    <script src="{{ asset('FE/js/thainn/transaction.js') }}"></script>
    

</body>

</html>