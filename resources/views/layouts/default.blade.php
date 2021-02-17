<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tracking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slicknav.min.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css"> 

    <!-- others css -->
    <link rel="stylesheet" href="{{asset('assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

    <!-- modernizr css -->
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
</head>

<body>
   
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="{{ url('assets/images/celectric-logo.png') }}" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <!-- <li class="{{Request::is('/') ? 'active' : ''}}"><a href="{{url('/')}}"><i class="ti-receipt"></i> <span>Dashboards</span></a></li> -->
                           
                            <li><a href="{{url('form')}}"><i class="ti-receipt"></i> <span>Purchase Request</span></a></li>
                            <li><a href="{{url('customer')}}"><i class="ti-receipt"></i> <span>Customer</span></a></li>    
                             <li><a href="{{url('order')}}"><i class="ti-receipt"></i> <span>View Order</span></a></li>
                             <li><a href="{{route('currency.index')}}"><i class="ti-receipt"></i> <span>Currencies</span></a></li>

                           

                           
                           

                        
                           
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                       
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">@yield('title')</h4>
                        <ul class="breadcrumbs pull-left">
                            {{-- <li><a href="index.html">Home</a></li>
                            <li><span>Datatable</span></li> --}}
                        </ul>
                        </div>
                    </div>
                    @if(Session::has('name'))
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="{{asset('assets/images/author/avatar.png')}}" alt="avatar">
                            
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{Session::get('name')}}<i class="fa fa-angle-down"></i></h4>
                            
                            <div class="dropdown-menu">
                               
                                <a class="dropdown-item" href="{{url('/logout')}}">Log Out</a>
                            </div>
                        </div>
                    </div>@endif
                </div>
            </div>
            <!-- page title area end -->

            
            <div class="main-content-inner">
                @include('partials.alert', ['class' => 'mt-3'])

                @yield('content')
            </div>

              <!-- jquery latest version -->
    <script src="{{asset('assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>

  
    <!-- others plugins -->
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
 
  

<script>
    $(document).ready(function(){
      //$('.page-container').toggleClass('sbar_collapsed');
       // $('.form-container').toggleClass('sbar_collapsed');
      //  $('.container').toggleClass('sbar_collapsed');

    })

    $(window).on('load',function(){
        activeOnMenu();
    })
        function activeOnMenu(){
            const currentLocation = location.href;
            const menuItem = document.querySelectorAll('a');
            const menuLi = document.querySelectorAll('li');
            const menuLength = menuItem.length;
            for(let i=0;i<menuLength;i++){
                if(menuItem[i].href===currentLocation){
                    menuLi[i-1].className = "active";
                }
            }
        }

       

    </script>
</body>