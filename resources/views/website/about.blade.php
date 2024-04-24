@extends('website-layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    About Us || Zhep Tours & Travels
@endsection

@section('head')
    @include('website-layouts.head')
@endsection

@section('theme')
    @include('website-layouts.theme')
@endsection

@section('header')
    @include('website-layouts.header')
@endsection

@section('content')

<main class="page-wrapper">
    <!-- Start Breadcrumb Area -->
	
	<div class="axil-breadcrumb-area breadcrumb-style-2 pt--170 pb--70 theme-gradient">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 order-2 order-lg-1 mt_md--30 mt_sm--30">
                        <div class="inner">
                        <h1 class="title">A Better way to Rent a Car</h1>
                        <p>We Believe that Best Service Makes Customer, Not a Sale.
                            Let's Join Hand Together for Corporate Booking
                            We Discover & Explore New Technologies For Taxi Booking
                            Download Zhep Cab.<li><a target="_blank" href="https://play.google.com/store/apps/details?id=com.orangebytetech.cab.customer">
                                        <img style="height:60px; width:200px;" src="{{asset('public/website/assets/images/brand/play.png')}}" alt="Client Images">
                                    </a></li></p>
                    </div>
                    </div>
                    <div class="col-lg-7 order-1 order-lg-2">
                        <div class="breadcrumb-thumbnail-group with-image-group text-left text-lg-right">
                            <div class="thumbnail">
                                <img class="paralax-image" src="{{asset('public/website/assets/images/slider/finalabout.png')}}" alt="Keystoke Images">
                            </div>
                            <!--  <div class="image-group">
                                 <img class="paralax-image" src="assets/images/others/keystoke-image-2.svg" alt="Keystoke Images">
                             </div> -->

                            <div class="shape-group">
                                <div class="shape shape-1">
                                    <i class="icon icon-breadcrumb-1"></i>
                                </div>
                                <div class="shape shape-2">
                                    <i class="icon icon-breadcrumb-2"></i>
                                </div>
                                <div class="shape shape-3 customOne">
                                    <i class="icon icon-breadcrumb-3"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
	
    <!-- Start Featured Area -->
    <div class="axil-featured-area ax-section-gap bg-color-white">
        <div class="container">
            <!-- Start Single Feature  -->
            <div class="row d-flex flex-wrap axil-featured row--40">
                <div class="col-lg-6 col-xl-6 col-md-12 col-12">
                    <div class="thumb-inner">
                        <div class="thumbnail">
                            <img class="image w-100" src="{{asset('public/website/assets/images/featured/featured-image-02.png')}}" alt="Featured Images">
                        </div>
                        <div class="shape-group">
                            <div class="shape">
                                <i class="icon icon-breadcrumb-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 col-md-12 col-12 mt_md--40 mt_sm--40">
                    <div class="inner">
                        <div class="section-title text-left">
                            <!--    <span class="sub-title extra04-color wow">featured case study</span> -->
                            <h2 class="title wow"><a>About Us</a></h2>
                            <p class="subtitle-2 wow">Zhep Cab is a Part of Zhep Tours and Travels, operating since 2010 All Over Maharashtra
                                We believe that best service makes Customer, not a Sale.</p>

                            <p class="subtitle-2 wow">Zhep Cab is Top Rated Taxi Service Operating in Multiple Cities to Fulfill Traveler's Need.</p>

                            <p class="subtitle-2 wow">Our mission is to be recognised as the global leader in Cab Rental for companies and the public and private
                                sector by partnering with our clients to provide the best and most efficient Cab Rental solutions and to achieve
                                service excellence.</p>
                            <!--    <a class="axil-button btn-large btn-transparent" href="single-case-study.html"><span
                                       class="button-text">Read
                                       Case Study</span><span class="button-icon"></span></a> -->
                        </div>
                        <div class="axil-counterup-area d-flex flex-wrap separator-line-vertical">
                            <!-- Start Counterup -->
                            <div class="single-counterup counterup-style-1">
                                <h3 class="count counter-k">0.5</h3>
                                <p>Monthly Apps Installed</p>
                            </div>
                            <!-- End Counterup -->

                            <!-- Start Counterup -->
                            <div class="single-counterup counterup-style-1">
                                <h3 class="count counter-k">1</h3>
                                <p>Monthly Website Visits</p>
                            </div>
                            <!-- End Counterup -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Feature  -->
        </div>
    </div>
    <!-- End Featured Area -->

    <!-- Start Our Service Area  -->
    <div class="axil-service-area ax-section-gap bg-color-lightest">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <!--   <span class="sub-title extra08-color wow" data-splitting>our valus</span> -->
                        <h2 class="title wow" data-splitting>Something to make you love us more </h2>
                        <!-- <p class="subtitle-2 wow" data-splitting>Nulla facilisi. Nullam in magna id dolor blandit rutrum eget
                            vulputate
                            augue sed eu leo eget risus imperdiet.</p> -->
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- Start Single Service  -->
                <div class="col-lg-4 col-md-6 col-12 mt--90 mt_md--40 mt_sm--30">
                    <div class="axil-service-style--3 move-up wow">
                        <div class="icon">
                            <img src="{{asset('public/website/assets/images/icons/layer.svg')}}" alt="Icon Images">
                            <div class="text"><i class="fa fa-car" aria-hidden="true"></i></div>
                        </div>
                        <div class="content">
                            <h4 class="title">Quality Cars and Drivers</h4>
                            <p>We work with Pre-Checked and Certified Cars and Drivers.</p>
                        </div>
                    </div>
                </div>
                <!-- End Single Service  -->

                <!-- Start Single Service  -->
                <div class="col-lg-4 col-md-6 col-12 mt--90 mt_md--40 mt_sm--30">
                    <div class="axil-service-style--3 color-var--2 move-up wow">
                        <div class="icon">
                            <img src="{{asset('public/website/assets/images/icons/layer.svg')}}" alt="Icon Images">
                            <div class="text"><i class="fa fa-calculator" aria-hidden="true"></i></div>
                        </div>
                        <div class="content">
                            <h4 class="title">Transparent Billing</h4>
                            <p>We provide every detail of your usage clearly with no hidden costs.</p>
                        </div>
                    </div>
                </div>
                <!-- End Single Service  -->

                <!-- Start Single Service  -->
                <div class="col-lg-4 col-md-6 col-12 mt--90 mt_md--40 mt_sm--30">
                    <div class="axil-service-style--3 color-var--3 move-up wow">
                        <div class="icon">
                            <img src="{{asset('public/website/assets/images/icons/layer.svg')}}" alt="Icon Images">
                            <div class="text"><i class="fa fa-magnet" aria-hidden="true"></i></div>
                        </div>
                        <div class="content">
                            <h4 class="title">Maintain Regulations</h4>
                            <p>Our vehicles and drivers have valid licences, permits and approvals</p>
                        </div>
                    </div>
                </div>
                <!-- End Single Service  -->

                <!-- Start Single Service  -->
                <div class="col-lg-4 col-md-6 col-12 mt--90 mt_md--40 mt_sm--30">
                    <div class="axil-service-style--3 color-var--4 move-up wow">
                        <div class="icon">
                            <img src="{{asset('public/website/assets/images/icons/layer.svg')}}" alt="Icon Images">
                            <div class="text"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                        </div>
                        <div class="content">
                            <h4 class="title">Technology with Human Touch</h4>
                            <p>A dedicated manager is assigned to take care of all the queries and needs of our clients</p>
                        </div>
                    </div>
                </div>
                <!-- End Single Service  -->

                <!-- Start Single Service  -->
                <div class="col-lg-4 col-md-6 col-12 mt--90 mt_md--40 mt_sm--30">
                    <div class="axil-service-style--3 color-var--5 move-up wow">
                        <div class="icon">
                            <img src="{{asset('public/website/assets/images/icons/layer.svg')}}" alt="Icon Images">
                            <div class="text"><i class="fa fa-book" aria-hidden="true"></i></div>
                        </div>
                        <div class="content">
                            <h4 class="title">Booking Validation & Tracking</h4>
                            <p>Real time booking approval as per company approval matrix.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Single Service  -->

                <!-- Start Single Service  -->
                <div class="col-lg-4 col-md-6 col-12 mt--90 mt_md--40 mt_sm--30">
                    <div class="axil-service-style--3 color-var--2 move-up wow">
                        <div class="icon">
                            <img src="{{asset('public/website/assets/images/icons/layer.svg')}}" alt="Icon Images">
                            <div class="text"><i class="fa fa-globe" aria-hidden="true"></i></div>
                        </div>
                        <div class="content">
                            <h4 class="title">Multiple Booking Platform</h4>
                            <p>Booking through web, mobile app and call Centre
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Single Service  -->

            </div>
        </div>
    </div>
    <!-- End Our Service Area  -->

    <div class="axil-testimonial-area ax-section-gap bg-color-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                    <div class="section-title text-left">
                        <h2 class="title">Our Testimonial</h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mt_mobile--20">
                    <div class="axil-social-share text-left text-sm-right">
                        <img src="{{asset('public/website/assets/images/logo/logo.png')}}" alt="Social Icons">
                    </div>
                </div>
            </div>
            <div class="testimonial-activation">
                <div class="row axil-testimonial-single">
                    <!-- Start Single Testimonial -->
					
                       <div class="col-lg-6 mt--60 mt_sm--30 mt_md--30">
                        <div class="axil-testimonial testimonial style-var--2 axil-control active">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                    </div>
                                    <div class="client-info">
                                        <h4 class="title">Anant Ingole</h4>
                                        <!-- <span>Executive Chairman @ Google</span> -->
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">Best holiday for kerala... Very good arrangement and service</p>
                                    <!--  <a class="axil-link-button" href="#">Read Project Case Study</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
					
					
					 <div class="col-lg-6 mt--60 mt_sm--30 mt_md--30">
                        <div class="axil-testimonial testimonial style-var--2 axil-control active">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                    </div>
                                    <div class="client-info">
                                        <h4 class="title">BB Ghose</h4>
                                        <!-- <span>Executive Chairman @ Google</span> -->
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">cheapest flight ticket....very good response</p>
                                    <!--  <a class="axil-link-button" href="#">Read Project Case Study</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-6 mt--60 mt_sm--30 mt_md--30">
                        <div class="axil-testimonial testimonial style-var--2 axil-control active">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                    </div>
                                    <div class="client-info">
                                        <h4 class="title">Ajay Ghodeswar</h4>
                                        <!-- <span>Executive Chairman @ Google</span> -->
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">My family had taken trip with ahe tours ... ver good  service and helpful in nature... thank you</p>
                                    <!--  <a class="axil-link-button" href="#">Read Project Case Study</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-6 mt--60 mt_sm--30 mt_md--30">
                        <div class="axil-testimonial testimonial style-var--2 axil-control active">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                    </div>
                                    <div class="client-info">
                                        <h4 class="title">priyanka gawai</h4>
                                        <!-- <span>Executive Chairman @ Google</span> -->
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">Helpful website and best services</p>
                                    <!--  <a class="axil-link-button" href="#">Read Project Case Study</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
					
                </div>
            </div>
        </div>
    </div>

</main>

@endsection

@section('footer')
    @include('website-layouts.footer')
@endsection

@section('script')
    @include('website-layouts.script')
@endsection


