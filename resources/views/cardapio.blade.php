<!DOCTYPE html>
<html lang="en">

<head>
    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    <meta name="keywords" content="bootstrap admin, card, clean, credit card, dashboard template, elegant, invoice, modern, money, transaction, Transfer money, user interface, wallet">
    <meta name="description" content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
    <meta property="og:title" content="Dompet - Payment Admin Dashboard Bootstrap Template">
    <meta property="og:description" content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
    <meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Page Title Here -->
    <title>Cardápio</title>



    <link href="{{ asset('assets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy fs-4">
            <span style="--i:1">C</span>
            <span style="--i:2">a</span>
            <span style="--i:3">r</span>
            <span style="--i:4">d</span>
            <span style="--i:5">a</span>
            <span style="--i:6">p</span>
            <span style="--i:7">.</span>
            <span style="--i:8">.</span>
            <span style="--i:9">.</span>
            <span style="--i:10">.</span>
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
            <a href="index.html" >
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="img-fluid">
               
            </a>
            
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
                                    <div class="fs-2">
                                        Cardapio
                                    </div>
                                </div>
                                <ul class="navbar-nav header-right">
                                  
                                  

                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="btn btn-primary ">Menu<i class="las la-signal ms-3 scale5"></i></a>
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
                <div class="dlabnav">
                    <div class="dlabnav-scroll">
                        <ul class="metismenu" id="menu">
                            <li class="dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <img src="images/profile/pic1.jpg" width="20" alt="">
                                    <div class="header-info ms-3">
                                        <span class="font-w600 ">Hi,<b>William</b></span>
                                        <small class="text-end font-w400">william@gmail.com</small>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="app-profile.html" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ms-2">Profile </span>
                                    </a>
                                    <a href="email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span class="ms-2">Inbox </span>
                                    </a>
                                    <a href="page-login.html" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="flaticon-025-dashboard"></i>
                                    <span class="nav-text">Dashboard</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="index.html">Dashboard Light</a></li>
                                    <li><a href="index-2.html">Dashboard Dark</a></li>
                                    <li><a href="index-3.html">Dashboard 3<span class="badge badge-xs badge-danger ms-3">New</span></a></li>
                                    <li><a href="index-4.html">Dashboard 4<span class="badge badge-xs badge-danger ms-3">New</span></a></li>
                                    <li><a href="index-5.html">Dashboard 5<span class="badge badge-xs badge-danger ms-3">New</span></a></li>
                                    <li><a href="index-6.html">Dashboard 6<span class="badge badge-xs badge-danger ms-3">New</span></a></li>
                                    <li><a href="index-7.html">Dashboard 7<span class="badge badge-xs badge-danger ms-3">New</span></a></li>
                                    <li><a href="index-8.html">Dashboard 8<span class="badge badge-xs badge-danger ms-3">New</span></a></li>
                                    <li><a href="my-wallet.html">My Wallet</a></li>
                                    <li><a href="page-invoices.html">Invoices</a></li>
                                    <li><a href="cards-center.html">Cards Center</a></li>
                                    <li><a href="page-transaction.html">Transaction</a></li>
                                    <li><a href="transaction-details.html">Transaction Details</a></li>
                                </ul>

                            </li>
                            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="fa-solid fa-gear fw-bold"></i>
                                    <span class="nav-text">CMS</span>
                                    <span class="badge badge-xs badge-danger ms-3">New</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="content.html">Content</a></li>
                                    <li><a href="menu.html">Menu</a></li>
                                    <li><a href="email-template.html">Email Template</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                </ul>

                            </li>
                            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="flaticon-050-info"></i>
                                    <span class="nav-text">Apps</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="app-profile.html">Profile</a></li>
                                    <li><a href="post-details.html">Post Details</a></li>
                                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                                        <ul aria-expanded="false">
                                            <li><a href="email-compose.html">Compose</a></li>
                                            <li><a href="email-inbox.html">Inbox</a></li>
                                            <li><a href="email-read.html">Read</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="./app-calender.html">Calendar</a></li>
                                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Shop</a>
                                        <ul aria-expanded="false">
                                            <li><a href="ecom-product-grid.html">Product Grid</a></li>
                                            <li><a href="ecom-product-list.html">Product List</a></li>
                                            <li><a href="ecom-product-detail.html">Product Details</a></li>
                                            <li><a href="ecom-product-order.html">Order</a></li>
                                            <li><a href="ecom-checkout.html">Checkout</a></li>
                                            <li><a href="ecom-invoice.html">Invoice</a></li>
                                            <li><a href="ecom-customers.html">Customers</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="flaticon-041-graph"></i>
                                    <span class="nav-text">Charts</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="chart-flot.html">Flot</a></li>
                                    <li><a href="chart-morris.html">Morris</a></li>
                                    <li><a href="chart-chartjs.html">Chartjs</a></li>
                                    <li><a href="chart-chartist.html">Chartist</a></li>
                                    <li><a href="chart-sparkline.html">Sparkline</a></li>
                                    <li><a href="chart-peity.html">Peity</a></li>
                                </ul>
                            </li>
                            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="flaticon-086-star"></i>
                                    <span class="nav-text">Bootstrap</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="ui-accordion.html">Accordion</a></li>
                                    <li><a href="ui-alert.html">Alert</a></li>
                                    <li><a href="ui-badge.html">Badge</a></li>
                                    <li><a href="ui-button.html">Button</a></li>
                                    <li><a href="ui-modal.html">Modal</a></li>
                                    <li><a href="ui-button-group.html">Button Group</a></li>
                                    <li><a href="ui-list-group.html">List Group</a></li>
                                    <li><a href="ui-card.html">Cards</a></li>
                                    <li><a href="ui-carousel.html">Carousel</a></li>
                                    <li><a href="ui-dropdown.html">Dropdown</a></li>
                                    <li><a href="ui-popover.html">Popover</a></li>
                                    <li><a href="ui-progressbar.html">Progressbar</a></li>
                                    <li><a href="ui-tab.html">Tab</a></li>
                                    <li><a href="ui-typography.html">Typography</a></li>
                                    <li><a href="ui-pagination.html">Pagination</a></li>
                                    <li><a href="ui-grid.html">Grid</a></li>

                                </ul>
                            </li>
                            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="flaticon-045-heart"></i>
                                    <span class="nav-text">Plugins</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="uc-select2.html">Select 2</a></li>
                                    <li><a href="uc-nestable.html">Nestedable</a></li>
                                    <li><a href="uc-noui-slider.html">Noui Slider</a></li>
                                    <li><a href="uc-sweetalert.html">Sweet Alert</a></li>
                                    <li><a href="uc-toastr.html">Toastr</a></li>
                                    <li><a href="map-jqvmap.html">Jqv Map</a></li>
                                    <li><a href="uc-lightgallery.html">Light Gallery</a></li>
                                </ul>
                            </li>
                            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="flaticon-045-heart"></i>
                                    <span class="nav-text">Widget</span>
                                </a>
                                <ul aria-expanded="false" class="mm-collapse" style="">
                                    <li><a href="widget-card.html">Widget Card</a></li>
                                    <li><a href="widget-chart.html">widget Chart</a></li>
                                    <li><a href="widget-list.html">Widget List</a></li>

                                </ul>
                            </li>

                            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="flaticon-072-printer"></i>
                                    <span class="nav-text">Forms</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="form-element.html">Form Elements</a></li>
                                    <li><a href="form-wizard.html">Wizard</a></li>
                                    <li><a href="form-ckeditor.html">CkEditor</a></li>
                                    <li><a href="form-pickers.html">Pickers</a></li>
                                    <li><a href="form-validation.html">Form Validate</a></li>
                                </ul>
                            </li>
                            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="flaticon-043-menu"></i>
                                    <span class="nav-text">Table</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                                    <li><a href="table-datatable-basic.html">Datatable</a></li>
                                </ul>
                            </li>
                            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="flaticon-022-copy"></i>
                                    <span class="nav-text">Pages</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="page-login.html">Login<span class="badge badge-xs badge-success ms-3">Update</span></a></li>
                                    <li><a href="page-register.html">Register<span class="badge badge-xs badge-success ms-3">Update</span></a></li>
                                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error<span class="badge badge-xs badge-success ms-3">Upadte</span></a>
                                        <ul aria-expanded="false">
                                            <li><a href="page-error-400.html">Error 400</a></li>
                                            <li><a href="page-error-403.html">Error 403</a></li>
                                            <li><a href="page-error-404.html">Error 404</a></li>
                                            <li><a href="page-error-500.html">Error 500</a></li>
                                            <li><a href="page-error-503.html">Error 503</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="page-lock-screen.html">Lock Screen<span class="badge badge-xs badge-success ms-3">Update</span></a></li>
                                    <li><a href="empty-page.html">Empty Page</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="copyright">
                            <p><strong>Dompet Payment Admin Dashboard</strong> © 2023 All Rights Reserved</p>
                            <p class="fs-12">Made with <span class="heart"></span> by DexignLab</p>
                        </div>
                    </div>
                </div>
                <!--**********************************
            Sidebar end
        ***********************************-->

                <!--**********************************
            Content body start
        ***********************************-->
                <div class="content-body">
                    <div class="container-fluid">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control  form-control-sm border-0 z-10" placeholder="Search here...">
                            <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/1.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">Bonorum et Malorum</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                                    <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                                </ul>
                                                <del class="discount">$159</del>
                                                <span class="price">$761.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/2.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">Striped Dress</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <del class="discount">$129</del>
                                                <span class="price">$159.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/3.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">BBow polka-dot</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <del class="discount">$150</del>
                                                <span class="price">$357.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/4.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">Z Product 360</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-half-stroke"></i></li>
                                                    <li><i class="fa fa-star-half-stroke"></i></li>
                                                </ul>
                                                <del class="discount">$359</del>
                                                <span class="price">$654.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/5.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">Chair Grey</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <del class="discount">$159</del>
                                                <span class="price">$369.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/6.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">fox sake withe</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <del class="discount">$359</del>
                                                <span class="price">$245.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/7.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">Back Bag</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <del class="discount">$9</del>
                                                <span class="price">$364.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/1.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">FLARE DRESS</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-half-stroke"></i></li>
                                                    <li><i class="fa fa-star-half-stroke"></i></li>
                                                </ul>
                                                <del class="discount">$159</del>
                                                <span class="price">$548.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/5.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">Chair Grey</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <del class="discount">$359</del>
                                                <span class="price">$369.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/6.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">fox sake withe</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <del class="discount">$159</del>
                                                <span class="price">$245.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/7.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">Back Bag</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <del class="discount">$259</del>
                                                <span class="price">$364.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src="images/product/1.jpg" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="ecom-product-detail.html">FLARE DRESS</a></h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-half-stroke"></i></li>
                                                    <li><i class="fa fa-star-half-stroke"></i></li>
                                                </ul>
                                                <del class="discount">$159</del>
                                                <span class="price">$548.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--**********************************
            Content body end
        ***********************************-->


                <!--**********************************
            Footer start
        ***********************************-->
                <div class="footer">
                    <div class="copyright">
                        <p>Copyright © Desenvolvido pela <a href="https://softetech.com" target="_blank">Softetech</a> {{date('Y')}}</p>
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
        <!-- Required vendors -->
        <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('assets/js/custom.min.js') }}"></script>
        <script src="{{ asset('assets/js/dlabnav-init.js') }}"></script>


</body>

</html>