<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- meta data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!--font-family-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">

    <!-- title of site -->
    <title>E-Commerce</title>

<!-- For favicon png -->
<link rel="shortcut icon" type="image/icon" href="{{ asset('assets/logo/favicon.png') }}" />

<!-- font-awesome.min.css -->
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

<!-- linear icon css -->
<link rel="stylesheet" href="{{ asset('assets/css/linearicons.css') }}">

<!-- animate.css -->
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

<!-- owl.carousel.css -->
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">

<!-- bootstrap.min.css -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

<!-- bootsnav -->
<link rel="stylesheet" href="{{ asset('assets/css/bootsnav.css') }}">

<!-- style.css -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<!-- responsive.css -->
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->



    <!--welcome-hero start -->
    <header id="home" class="welcome-hero">

        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel"  data-interval="3000">
    <!-- Carousel indicators -->
    <ol class="carousel-indicators">
        @foreach($products->take(3) as $key => $product)
            <li data-target="#header-carousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}">
                <span class="small-circle"></span>
            </li>
        @endforeach
    </ol>

    <!-- Carousel slides -->
<div class="carousel-inner" role="listbox">
    @foreach($products->take(3) as $key => $product)
        <div class="item {{ $key == 0 ? 'active' : '' }}">
            <div class="single-slide-item slide{{ $key + 1 }}">
                <div class="container">
                    <div class="welcome-hero-content">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="single-welcome-hero">
                                    <div class="welcome-hero-txt">
                                        <h4>New Product</h4>
                                        <h2>{{ $product->title }}</h2>
                                        <p>{{ Str::limit($product->description ?? 'No description', 150) }}</p>

                                        <div class="packages-price">
                                            <p>
                                                Rp{{ number_format($product->price, 2) }}
                                                @if($product->original_price)
                                                    <del>Rp{{ number_format($product->original_price, 2) }}</del>
                                                @endif
                                            </p>
                                        </div>

                                        <button class="btn-cart welcome-add-cart" onclick="window.location.href='#'">
                                            <span class="lnr lnr-plus-circle"></span>
                                            add <span>to</span> cart
                                        </button>

                                        <button class="btn-cart welcome-add-cart welcome-more-info"
                                            onclick="window.location.href='{{ route('product.detail', $product->id) }}'">
                                            more info
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="single-welcome-hero">
                                    <div class="welcome-hero-img">
                                        <img src="{{ asset('storage/images/' . $product->image) }}"
                                            alt="{{ $product->title }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

</div>


        <!-- top-area Start -->
        <div class="top-area">
            <div class="header-area">
                <!-- Start Navigation -->
                <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"
                    data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <form action="{{ route('landing') }}" method="GET">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-search"></i>
                </span>

                <input type="text" name="search" class="form-control" placeholder="Search product..."
                    value="{{ request('search') }}">

                <span class="input-group-addon close-search">
                    <i class="fa fa-times"></i>
                </span>
            </div>
        </form>
    </div>
</div>
<!-- End Top Search -->


                    <div class="container">
                        <!-- Start Atribute Navigation -->
                        <div class="attr-nav">
                            <ul>
                                <li class="search">
                                    <a href="#"><span class="lnr lnr-magnifier"></span></a>
                                </li><!--/.search-->
                               <!--/.search-->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="lnr lnr-cart"></span>
                                        <span class="badge badge-bg-1">2</span>
                                    </a>
                                    <ul class="dropdown-menu cart-list s-cate">
                                        <li class="single-cart-list">
                                            <a href="#" class="photo"><img src="assets/images/collection/arrivals1.png"
                                                    class="cart-thumb" alt="image" /></a>
                                            <div class="cart-list-txt">
                                                <h6><a href="#">arm <br> chair</a></h6>
                                                <p>1 x - <span class="price">$180.00</span></p>
                                            </div><!--/.cart-list-txt-->
                                            <div class="cart-close">
                                                <span class="lnr lnr-cross"></span>
                                            </div><!--/.cart-close-->
                                        </li><!--/.single-cart-list -->
                                        <li class="single-cart-list">
                                            <a href="#" class="photo"><img src="assets/images/collection/arrivals2.png"
                                                    class="cart-thumb" alt="image" /></a>
                                            <div class="cart-list-txt">
                                                <h6><a href="#">single <br> armchair</a></h6>
                                                <p>1 x - <span class="price">$180.00</span></p>
                                            </div><!--/.cart-list-txt-->
                                            <div class="cart-close">
                                                <span class="lnr lnr-cross"></span>
                                            </div><!--/.cart-close-->
                                        </li><!--/.single-cart-list -->
                                        <li class="single-cart-list">
                                            <a href="#" class="photo"><img src="assets/images/collection/arrivals3.png"
                                                    class="cart-thumb" alt="image" /></a>
                                            <div class="cart-list-txt">
                                                <h6><a href="#">wooden arn <br> chair</a></h6>
                                                <p>1 x - <span class="price">$180.00</span></p>
                                            </div><!--/.cart-list-txt-->
                                            <div class="cart-close">
                                                <span class="lnr lnr-cross"></span>
                                            </div><!--/.cart-close-->
                                        </li><!--/.single-cart-list -->
                                        <li class="total">
                                            <span>Total: $0.00</span>
                                            <button class="btn-cart pull-right" onclick="window.location.href='#'">view
                                                cart</button>
                                        </li>
                                    </ul>
                                </li><!--/.dropdown-->
                                <li class="nav-login">
                                    <a href="/auth"><span class="lnr lnr-enter-down"></span></a>
                                </li>
                                <li class="nav-user">
                                    <a href="#"><span class="lnr lnr-user"></span></a>
                                </li>
                            </ul>
                        </div><!--/.attr-nav-->
                        <!-- End Atribute Navigation -->

                        <!-- Start Header Navigation -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#navbar-menu">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="">E-Commerce.</a>

                        </div><!--/.navbar-header-->
                        <!-- End Header Navigation -->

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                                <li class=" scroll active"><a href="#home">Home</a></li>
                                <li class="scroll"><a href="#new-arrivals">Product</a></li>
                                <li class="scroll"><a href="#feature">features</a></li>
                                <li class="scroll"><a href="#blog">Blog</a></li>
                                <li class="scroll"><a href="#newsletter">contact</a></li>
                                <li class="transaction"><a href="/transaction">Transaction</a>
                                </li>
                            </ul><!--/.nav -->
                        </div><!-- /.navbar-collapse -->
                    </div><!--/.container-->
                </nav><!--/nav-->
                <!-- End Navigation -->
            </div><!--/.header-area-->
            <div class="clearfix"></div>

        </div><!-- /.top-area-->
        <!-- top-area End -->

    </header><!--/.welcome-hero-->
    <!--welcome-hero end -->

    

<section id="new-arrivals" class="new-arrivals">
    <div class="container">
        <div class="section-header">
            <h2>All Products</h2>
        </div>
        <div class="new-arrivals-content">
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-3 col-sm-4">
                        <div class="single-new-arrival">
                            <div class="single-new-arrival-bg">
                                <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->title }}">
                                <div class="single-new-arrival-bg-overlay"></div>
                                @if($product->sale ?? false)
                                <div class="sale bg-1">
                                    <p>sale</p>
                                </div>
                                @endif
                                <div class="new-arrival-cart">
                                    <p>
                                        <span class="lnr lnr-cart"></span>
                                        <a href="#">add <span>to </span> cart</a>
                                    </p>
                                    <p class="arrival-review pull-right">
                                        <span class="lnr lnr-heart"></span>
                                        <span class="lnr lnr-frame-expand"></span>
                                    </p>
                                </div>
                            </div>
                            <h4><a href="{{ route('product.detail', $product->id) }}">{{ $product->title }}</a></h4>
                            <p class="arrival-product-price">Rp{{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                @empty
                <p>Belum ada produk</p>
                @endforelse
            </div>
        </div>
    </div>
</section>


    <!--sofa-collection start -->
    <section id="sofa-collection">
        <div class="owl-carousel owl-theme" id="collection-carousel">
            <div class="sofa-collection collectionbg1">
                <div class="container">
                    <div class="sofa-collection-txt">
                        <h2>unlimited sofa collection</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <div class="sofa-collection-price">
                            <h4>strting from <span>$ 199</span></h4>
                        </div>
                        <button class="btn-cart welcome-add-cart sofa-collection-btn"
                            onclick="window.location.href='#'">
                            view more
                        </button>
                    </div>
                </div>
            </div><!--/.sofa-collection-->
            <div class="sofa-collection collectionbg2">
                <div class="container">
                    <div class="sofa-collection-txt">
                        <h2>unlimited dainning table collection</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <div class="sofa-collection-price">
                            <h4>strting from <span>$ 299</span></h4>
                        </div>
                        <button class="btn-cart welcome-add-cart sofa-collection-btn"
                            onclick="window.location.href='#'">
                            view more
                        </button>
                    </div>
                </div>
            </div><!--/.sofa-collection-->
        </div><!--/.collection-carousel-->

    </section><!--/.sofa-collection-->
    <!--sofa-collection end -->

    <!--feature start -->
    <section id="feature" class="feature">
        <div class="container">
            <div class="section-header">
                <h2>featured products</h2>
            </div><!--/.section-header-->
            <div class="feature-content">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="single-feature">
                            <img src="assets/images/features/f1.jpg" alt="feature image">
                            <div class="single-feature-txt text-center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="spacial-feature-icon"><i class="fa fa-star"></i></span>
                                    <span class="feature-review">(45 review)</span>
                                </p>
                                <h3><a href="#">designed sofa</a></h3>
                                <h5>$160.00</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-feature">
                            <img src="assets/images/features/f2.jpg" alt="feature image">
                            <div class="single-feature-txt text-center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="spacial-feature-icon"><i class="fa fa-star"></i></span>
                                    <span class="feature-review">(45 review)</span>
                                </p>
                                <h3><a href="#">dinning table </a></h3>
                                <h5>$200.00</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-feature">
                            <img src="assets/images/features/f3.jpg" alt="feature image">
                            <div class="single-feature-txt text-center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="spacial-feature-icon"><i class="fa fa-star"></i></span>
                                    <span class="feature-review">(45 review)</span>
                                </p>
                                <h3><a href="#">chair and table</a></h3>
                                <h5>$100.00</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-feature">
                            <img src="assets/images/features/f4.jpg" alt="feature image">
                            <div class="single-feature-txt text-center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="spacial-feature-icon"><i class="fa fa-star"></i></span>
                                    <span class="feature-review">(45 review)</span>
                                </p>
                                <h3><a href="#">modern arm chair</a></h3>
                                <h5>$299.00</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.container-->

    </section><!--/.feature-->
    <!--feature end -->

    <!--blog start -->
    <section id="blog" class="blog">
        <div class="container">
            <div class="section-header">
                <h2>latest blog</h2>
            </div><!--/.section-header-->
            <div class="blog-content">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="single-blog">
                            <div class="single-blog-img">
                                <img src="assets/images/blog/b1.png" alt="blog image">
                                <div class="single-blog-img-overlay"></div>
                            </div>
                            <div class="single-blog-txt">
                                <h2><a href="#">New Release! IPhone 17 Pro Max</a></h2>
                                <h3>By <a href="#">Robert Norby</a> / 18th March 2018</h3>
                                <p>
                                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt....
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="single-blog">
                            <div class="single-blog-img">
                                <img src="assets/images/blog/b2.png" alt="blog image">
                                <div class="single-blog-img-overlay"></div>
                            </div>
                            <div class="single-blog-txt">
                                <h2><a href="#">New Tech New Year</a></h2>
                                <h3>By <a href="#">Robert Norby</a> / 18th March 2018</h3>
                                <p>
                                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt....
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="single-blog">
                            <div class="single-blog-img">
                                <img src="assets/images/blog/b3.png" alt="blog image">
                                <div class="single-blog-img-overlay"></div>
                            </div>
                            <div class="single-blog-txt">
                                <h2><a href="#">AI on Every Tech</a></h2>
                                <h3>By <a href="#">Robert Norby</a> / 18th March 2018</h3>
                                <p>
                                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt....
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.container-->

    </section><!--/.blog-->
    <!--blog end -->

    <!-- clients strat -->
    <section id="clients" class="clients">
        <div class="container">
            <div class="owl-carousel owl-theme" id="client">
                <div class="item">
                    <a href="#">
                        <img src="assets/images/clients/c1.png" alt="brand-image" />
                    </a>
                </div><!--/.item-->
                <div class="item">
                    <a href="#">
                        <img src="assets/images/clients/c2.png" alt="brand-image" />
                    </a>
                </div><!--/.item-->
                <div class="item">
                    <a href="#">
                        <img src="assets/images/clients/c3.png" alt="brand-image" />
                    </a>
                </div><!--/.item-->
                <div class="item">
                    <a href="#">
                        <img src="assets/images/clients/c4.png" alt="brand-image" />
                    </a>
                </div><!--/.item-->
                <div class="item">
                    <a href="#">
                        <img src="assets/images/clients/c5.png" alt="brand-image" />
                    </a>
                </div><!--/.item-->
            </div><!--/.owl-carousel-->

        </div><!--/.container-->

    </section><!--/.clients-->
    <!-- clients end -->

    <!--newsletter strat -->
    <section id="newsletter" class="newsletter">
        <div class="container">
            <div class="hm-footer-details">
                <div class="row">
                    <div class=" col-md-3 col-sm-6 col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>information</h4>
                            </div><!--/.hm-foot-title-->
                            <div class="hm-foot-menu">
                                <ul>
                                    <li><a href="#">about us</a></li><!--/li-->
                                    <li><a href="#">contact us</a></li><!--/li-->
                                    <li><a href="#">news</a></li><!--/li-->
                                    <li><a href="#">store</a></li><!--/li-->
                                </ul><!--/ul-->
                            </div><!--/.hm-foot-menu-->
                        </div><!--/.hm-footer-widget-->
                    </div><!--/.col-->
                    <div class=" col-md-3 col-sm-6 col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>collections</h4>
                            </div><!--/.hm-foot-title-->
                            <div class="hm-foot-menu">
                                <ul>
                                    <li><a href="#">wooden chair</a></li><!--/li-->
                                    <li><a href="#">royal cloth sofa</a></li><!--/li-->
                                    <li><a href="#">accent chair</a></li><!--/li-->
                                    <li><a href="#">bed</a></li><!--/li-->
                                    <li><a href="#">hanging lamp</a></li><!--/li-->
                                </ul><!--/ul-->
                            </div><!--/.hm-foot-menu-->
                        </div><!--/.hm-footer-widget-->
                    </div><!--/.col-->
                    <div class=" col-md-3 col-sm-6 col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>my accounts</h4>
                            </div><!--/.hm-foot-title-->
                            <div class="hm-foot-menu">
                                <ul>
                                    <li><a href="#">my account</a></li><!--/li-->
                                    <li><a href="#">wishlist</a></li><!--/li-->
                                    <li><a href="#">Community</a></li><!--/li-->
                                    <li><a href="#">order history</a></li><!--/li-->
                                    <li><a href="#">my cart</a></li><!--/li-->
                                </ul><!--/ul-->
                            </div><!--/.hm-foot-menu-->
                        </div><!--/.hm-footer-widget-->
                    </div><!--/.col-->
                    <div class=" col-md-3 col-sm-6  col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>newsletter</h4>
                            </div><!--/.hm-foot-title-->
                            <div class="hm-foot-para">
                                <p>
                                    Subscribe to get latest news,update and information.
                                </p>
                            </div><!--/.hm-foot-para-->
                            <div class="hm-foot-email">
                                <div class="foot-email-box">
                                    <input type="text" class="form-control" placeholder="Enter Email Here....">
                                </div><!--/.foot-email-box-->
                                <div class="foot-email-subscribe">
                                    <span><i class="fa fa-location-arrow"></i></span>
                                </div><!--/.foot-email-icon-->
                            </div><!--/.hm-foot-email-->
                        </div><!--/.hm-footer-widget-->
                    </div><!--/.col-->
                </div><!--/.row-->
            </div><!--/.hm-footer-details-->

        </div><!--/.container-->

    </section><!--/newsletter-->
    <!--newsletter end -->

    <!--footer start-->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="hm-footer-copyright text-center">
                <div class="footer-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
                <p>
                    &copy;copyright. designed and developed by <a href="https://www.themesine.com/">themesine</a>
                </p><!--/p-->
            </div><!--/.text-center-->
        </div><!--/.container-->

        <div id="scroll-Top">
            <div class="return-to-top">
                <i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title=""
                    data-original-title="Back to Top" aria-hidden="true"></i>
            </div>

        </div><!--/.scroll-Top-->

    </footer><!--/.footer-->
    <!--footer end-->

<!-- JQuery -->
<script src="{{ asset('assets/js/jquery.js') }}"></script>

<!-- modernizr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

<!-- bootstrap.min.js -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- bootsnav js -->
<script src="{{ asset('assets/js/bootsnav.js') }}"></script>

<!-- owl.carousel.js -->
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>

<!-- easing -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<!-- custom.js -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>