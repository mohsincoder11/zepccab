@extends('website-layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    Services || Zhep Tours & Travels
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

    <main class="page-wrappper">

        <!-- Start Breadcrumb Area -->
        <div class="axil-breadcrumb-area breadcrumb-style-2 pt--170 pb--70 theme-gradient">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 order-2 order-lg-1 mt_md--30 mt_sm--30">
                        <div class="inner">
                            <div class="content">
                                <h1 class="page-title mb--20">Our Services</h1>
                                <!--  <p class="subtitle-2">A quick view of industry specific problems solved with design
                                     by the awesome team at Keystroke.</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 order-1 order-lg-2">
                        <div class="breadcrumb-thumbnail-group with-image-group text-left text-lg-right">
                            <div class="thumbnail">
                                <img class="paralax-image" src="{{asset('public/website/assets/images/slider/offer1.png')}}" alt="Keystoke Images">
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
        <!-- End Breadcrumb Area -->


        <!-- Axil Scroll Navigation Area  -->
        <div class="axil-scroll-navigation-area axil-scroll-navigation position-relative bg-color-white">
            <!-- Start Navigation Nav  -->
            <nav class="axil-scroll-nav navbar navbar-example2">
                <ul class="nav nav-pills justify-content-center sidebar__inner">
                    <li class="nav-item"><a class="nav-link smoth-animation active" href="#section1">Local</a></li>
                    <li class="nav-item"><a class="nav-link smoth-animation" href="#section2">Rental</a></li>
                    <li class="nav-item"><a class="nav-link smoth-animation" href="#section3">Outstation</a>
                    </li>
                    <li class="nav-item"><a class="nav-link smoth-animation" href="#section4">Share Ride</a></li>
                    <li class="nav-item"><a class="nav-link smoth-animation" href="#section5">Corporate</a></li>
                    <!--  <li class="nav-item"><a class="nav-link smoth-animation" href="#section6">Content strategy</a>
                     </li> -->
                </ul>
            </nav>
            <!-- End Navigation Nav  -->

            <!-- Start Navigation Content  -->
            <div id="section1" class="section axil-service-area bg-color-white ax-section-gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-left">
                                <!--  <span class="sub-title extra04-color wow" data-splitting>services</span> -->
                                <h2 class="title wow" data-splitting>Local Ride</h2>
                            </div>
                        </div>
                    </div>
                    <!-- Start Service Wrapper  -->
                    <div class="row">
                        <!-- Start Single Service  -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="axil-service text-left axil-control paralax-image active">
                                <div class="inner">
                                    <div class="icon">
                                        <div class="icon-inner" style="margin-left: 30px;">
                                            <img src="{{asset('public/website/assets/images/icons/layer.svg')}}" alt="Icon Images">
                                            <div  class="image-2">&nbsp;<img src="{{asset('public/website/assets/images/icons/icon-01.svg')}}" alt="Shape Images"></div>
                                        </div>
                                    </div>
                                    <div class="content" style="margin-left: 50px;">
                                        <p>Book Local Rides For Shopping, Wedding, Office, School.</p>
                                        <p>We Offers Local Taxi Booking Facility To Travel Within The City Limits With Most Affordable Rates.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Service Wrapper  -->
                </div>
            </div>
            <!-- End Navigation Content  -->

            <!-- Start Navigation Content  -->
            <div id="section2" class="section axil-service-area bg-color-lightest ax-section-gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-left">

                                <h2 class="title wow" data-splitting>Rental Ride</h2>
                            </div>
                        </div>
                    </div>
                    <!-- Start Service Wrapper  -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="axil-service text-left axil-control paralax-image active">
                                <div class="inner">
                                    <div class="icon">
                                        <div class="icon-inner" style="margin-left: 30px;">
                                            <img src="{{asset('public/website/assets/images/icons/layer.svg')}}" alt="Icon Images">
                                            <div  class="image-2">&nbsp;<img src="{{asset('public/website/assets/images/icons/icon-01.svg')}}" alt="Shape Images"></div>
                                        </div>
                                    </div>
                                    <div class="content" style="margin-left: 50px;">
                                        <p>Book Taxi For Flexible Hours Within City Limits
                                            .</p>
                                        <p>The Travelers Who Wants To Rent A Car for City Usage Like Local Sightseeing, In-City Transfers, Short
                                            Time Booking etc. We Provide Hourly, Half Day & Full Day Car Hiring Facilities to our Customers,
                                            Which They Can Avail as Per Their Convenience & Needs.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Wrapper  -->
                </div>
            </div>
            <!-- End Navigation Content  -->

            <!-- Start Navigation Content  -->
            <div id="section3" class="section axil-service-area bg-color-white ax-section-gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-left">
                                <h2 class="title wow" data-splitting>Outstation</h2>
                            </div>
                        </div>
                    </div>
                    <!-- Start Service Wrapper  -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="axil-service text-left axil-control paralax-image active">
                                <div class="inner">
                                    <div class="icon">
                                        <div class="icon-inner" style="margin-left: 30px;">
                                            <img src="{{asset('public/website/assets/images/icons/layer.svg')}}" alt="Icon Images">
                                            <div  class="image-2">&nbsp;<img src="{{asset('public/website/assets/images/icons/icon-01.svg')}}" alt="Shape Images"></div>
                                        </div>
                                    </div>
                                    <div class="content" style="margin-left: 50px;">
                                        <p>Plan Your Family Weekend Trips & Leisure Trips With Friends Outside The City Limits.</p>
                                        <p>Not All Outstation Journeys Can be Covered by Flight, Train or Bus, Sometimes a Cab is the Fastest
                                            and the Most Efficient Way to Cover the Distance. It is a lot Easier When Travelling From Amravati to
                                            Nagpur to Book Outstation Cab. Zhep Cab Brings to You This New Feature That Let’s You Book an
                                            Outstation Taxi Booking on tens of Hundreds of Routes across the Country. For Instance, You Wish
                                            to Travel to Amravati from Nagpur & Find It More Convenient to Make An Outstation Taxi Booking & zip
                                            Down the National Highway to Get Into Nagpur in a Matter of a Couple of Hours.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Service Wrapper  -->
                </div>
            </div>
            <!-- End Navigation Content  -->

            <!-- Start Navigation Content  -->
            <div id="section4" class="section axil-service-area bg-color-lightest ax-section-gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-left">
                                <h2 class="title wow" data-splitting>Share Ride (CARPOOL)</h2>
                            </div>
                        </div>
                    </div>
                    <!-- Start Service Wrapper  -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="axil-service text-left axil-control paralax-image active">
                                <div class="inner">
                                    <div class="icon">
                                        <div class="icon-inner" style="margin-left: 30px;">
                                            <img src="{{asset('public/website/assets/images/icons/layer.svg')}}" alt="Icon Images">
                                            <div  class="image-2">&nbsp;<img src="{{asset('public/website/assets/images/icons/icon-01.svg')}}" alt="Shape Images"></div>
                                        </div>
                                    </div>
                                    <div class="content" style="margin-left: 50px;">
                                        <p>Traveler Commute Made Easier.</p>
                                        <p>Carpool is Revolutionary & Fun Way to Commute. Whether You are a Car
                                            owner, or a Rider, Just Post Your Ride Details on Share Ride & We will Match
                                            You with Co-Riders on Your Way.</p>

                                        <h3>Why Should Use Carpool ?</h3>
                                        <ul>
                                            <li>Save upto 80% on Commute Cost.</li>
                                            <li>Save Upto Rs 3000 Per Month on Commute Costs Compared to People Who opt
                                                for Cabs/Auto.</li>
                                        </ul>


                                        <h3>Expand Your Professional Network</h3>
                                        <ul>
                                            <li>Carpool with Professionals from Different Domains & Expand Your Professional.</li>
                                            <li>Network while Commuting.</li>
                                            <li>Reduce Pollution & Save Environment.</li>
                                            <li>Carpool and reduce traffic and pollution.</li>
                                        </ul>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Wrapper  -->
                </div>
            </div>
            <!-- End Navigation Content  -->

            <!-- Start Navigation Content  -->
            <div id="section5" class="section axil-service-area bg-color-white ax-section-gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-left">
                                <h2 class="title wow" data-splitting>Corporate Ride</h2>
                            </div>
                        </div>
                    </div>
                    <!-- Start Service Wrapper  -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="axil-service text-left axil-control paralax-image active">
                                <div class="inner">
                                    <div class="icon">
                                        <div class="icon-inner" style="margin-left: 30px;">
                                            <img src="{{asset('public/website/assets/images/icons/layer.svg')}}" alt="Icon Images">
                                            <div  class="image-2">&nbsp;<img src="{{asset('public/website/assets/images/icons/icon-01.svg')}}" alt="Shape Images"></div>
                                        </div>
                                    </div>
                                    <div class="content" style="margin-left: 50px;">
                                        <ul>
                                            <li>Let us take care of your enterprise travel.</li>
                                            <li>Employees book their rides through corporate login on Zhep Cab app.</li>
                                            <li>Track ride expense details and download invoices anytime.</li>
                                            <li>Point to point pick up.</li>
                                            <li>Executive Ride.</li>
                                            <li>Real Time Booking Approval.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Wrapper  -->
                </div>
            </div>
            <!-- End Navigation Content  -->

        </div>

    </main>

@endsection

@section('footer')
    @include('website-layouts.footer')
@endsection

@section('script')
    @include('website-layouts.script')
@endsection


