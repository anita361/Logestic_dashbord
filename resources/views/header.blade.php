@php
date_default_timezone_set('Asia/Kolkata');
$hour = date('H');
if ($hour >= 5 && $hour < 12) {
     $greeting='Good Morning' ;
     } elseif ($hour>= 12 && $hour < 17) {
          $greeting='Good Afternoon' ;
          } elseif ($hour>= 17 && $hour < 21) {
               $greeting='Good Evening' ;
               } else {
               $greeting='Good Night' ;
               }
               @endphp

               <!DOCTYPE html>
               <html lang="en">

               <head>
                    <!-- Title Meta -->
                    <meta charset="utf-8" />
                    <title>Dashboard Template</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta name="description" content="A fully responsive premium admin dashboard template" />
                    <meta name="author" content="Techzaa" />
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

                    <!-- App favicon -->
                    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

                    <!-- Vendor css (Require in all Page) -->
                    <link href="{{ asset('css/vendor.min.css')}}" rel="stylesheet" type="text/css" />

                    <!-- Icons css (Require in all Page) -->
                    <link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
                    <link href="{{ asset('css/all.min.css')}}" rel="stylesheet" type="text/css" />

                    <!-- App css (Require in all Page) -->
                    <link href="{{ asset('css/app.min.css')}}" rel="stylesheet" type="text/css" />


                    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css')}}">

                    <!-- DataTables CSS -->
                    <link href="{{ asset('css/dataTables.bootstrap5.min.css')}}" rel="stylesheet">



                    <!-- Theme Config js (Require in all Page) -->
                    <script src="{{ asset('js/config.js')}}"></script>
               </head>

               <body>

                    <!-- START Wrapper -->
                    <div class="wrapper">

                         <!-- ========== Topbar Start ========== -->
                         <header class="topbar">
                              <div class="container-fluid">
                                   <div class="navbar-header">
                                        <div class="d-flex align-items-center">
                                             <!-- Menu Toggle Button -->
                                             <div class="topbar-item">
                                                  <button type="button" class="button-toggle-menu me-2">
                                                       <iconify-icon icon="solar:hamburger-menu-broken" class="fs-24 align-middle"></iconify-icon>
                                                  </button>
                                             </div>

                                             <!-- Menu Toggle Button -->
                                             <div class="topbar-item">
                                                  <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0"> Hi {{ $greeting }}, {{ Auth::user()->name ?? 'User' }}!</h4>
                                             </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-1">
                                             <div class="dropdown topbar-item">
                                                  <a class="topbar-button d-flex align-items-center" href="#" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                       <img class="rounded-circle me-2" width="32"
                                                            src="{{ asset('uploads/' . (Auth::user()->file ?? 'default-avatar.jpg')) }}"
                                                            alt="user-avatar">
                                                       <span class="greeting">Hello, {{ Auth::user()->name ?? 'User' }}</span>
                                                  </a>

                                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="page-header-user-dropdown">
                                                       <h6 class="dropdown-header">Welcome!</h6>

                                                       <div class="dropdown-divider my-1"></div>

                                                       <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                                                            <i class="bx bx-log-out fs-18 align-middle me-1"></i>
                                                            <span class="align-middle">Logout</span>
                                                       </a>
                                                  </div>
                                             </div> 
                                        </div>

                                   </div>
                              </div>
                         </header>
                         <!-- ========== Topbar End ========== -->

                         <!-- ========== App Menu Start ========== -->
                         <div class="main-nav">
                              <!-- Sidebar Logo -->
                              <div class="logo-box">
                                   <a href="index.php" class="logo-dark">
                                        <img src="{{ asset('images/logo-sm.png')}}" class="logo-sm" alt="logo sm">
                                        <img src="{{ asset('images/logo-dark.png')}}" class="logo-lg" alt="logo dark">

                                   </a>

                                   <a href="index.php" class="logo-light">
                                        <img src="{{ asset('images/logo-sm.png')}}" class="logo-sm" alt="logo sm">
                                        <img src="{{ asset('images/logo-light.png')}}" class="logo-lg" alt="logo light">
                                   </a>
                              </div>

                              <!-- Menu Toggle Button (sm-hover) -->
                              <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
                                   <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
                              </button>

                              <div class="scrollbar" data-simplebar>
                                   <ul class="navbar-nav" id="navbar-nav">

                                        <li class="menu-title">General</li>

                                        <li class="nav-item">
                                             <a class="nav-link" href="{{ route('dashbord')}}">
                                                  <span class="nav-icon">
                                                       <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                                                  </span>
                                                  <span class="nav-text"> Dashboard </span>
                                             </a>
                                        </li>


                                        <li class="nav-item">
                                             <a class="nav-link menu-arrow" href="#sidebarDispatch" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDispatch">
                                                  <span class="nav-icon">
                                                       <iconify-icon icon="mdi:truck-delivery-outline"></iconify-icon>
                                                  </span>
                                                  <span class="nav-text"> Dispatch </span>
                                             </a>
                                             <div class="collapse" id="sidebarDispatch">
                                                  <ul class="nav sub-navbar-nav">
                                                       <li class="sub-nav-item">
                                                            <a class="sub-nav-link" href="{{ route('customer-list')}}">Customer</a>
                                                       </li>
                                                       <li class="sub-nav-item">
                                                            <a class="sub-nav-link" href="{{ route('shipper-list')}}">Shipper</a>
                                                       </li>
                                                       <li class="sub-nav-item">
                                                            <a class="sub-nav-link" href="{{ route('consignee-list')}}">Consignee</a>
                                                       </li>
                                                       <li class="sub-nav-item">
                                                            <a class="sub-nav-link" href="{{ route('external_carrier')}}">External Carrier</a>
                                                       </li>
                                                       <li class="sub-nav-item">
                                                            <a class="sub-nav-link" href="{{ route('load-creation')}}">Load Creation</a>
                                                       </li>
                                                       <li class="sub-nav-item">
                                                            <a class="sub-nav-link" href="{{ route('mc-check-list')}}">MC Check</a>
                                                       </li>

                                                  </ul>
                                             </div>
                                        </li>

                                   </ul>
                              </div>
                         </div>
                         <!-- ========== App Menu End ========== -->