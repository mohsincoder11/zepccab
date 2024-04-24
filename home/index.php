

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="Themescare">
    <!-- Title -->
    <title>Zhep Cab</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <!--Font Awesome css-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!--Magnific css-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!--Owl-Carousel css-->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <!--Animate css-->
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <!--Datepicker css-->
    <link rel="stylesheet" href="assets/css/jquery.datepicker.css">
    <!--Nice Select css-->
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <!-- Lightgallery css -->
    <link rel="stylesheet" href="assets/css/lightgallery.min.css">
    <!--ClockPicker css-->
    <link rel="stylesheet" href="assets/css/jquery-clockpicker.min.css">
    <!--Slicknav css-->
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!--Site Main Style css-->
    <link rel="stylesheet" href="assets/css/style.css">
    <!--Responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/js/jquery.min.js "></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<?php
session_start(); // Start the session

if (isset($_SESSION["alertMessage"])) {
    $alertMessage = $_SESSION["alertMessage"];
    $icon = $_SESSION["icon"];
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: '$icon',
            title: '$icon',
            text: '$alertMessage',
            showConfirmButton: false,
            timer: 3000 // 3 seconds
          });
    })
    </script>";
    unset($_SESSION["alertMessage"]); 
    unset($_SESSION["icon"]); // Remove the alert message from the session
}
?>
<style>
    .closebtn {
        position: absolute;
        top: 0;
        right: 10px;
        font-size: 36px;
        /* margin-left: 10px; */
        color: #000000;
    }
    
    body {
        font-family: Arial;
    }
    /* Style the tab */
    
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }
    /* Style the buttons inside the tab */
    
    .tab button {
        /* background-color: inherit; */
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }
    /* Change background color of buttons on hover */
    /* .tab button:hover {
        background-color: #ddd;
    } */
    /* Create an active/current tablink class */
    /* .tab button.active {
        background-color: #ccc;
    } */
    /* Style the tab content */
    
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ff0000;
        border-top: none;
    }
    
    .cool-link {
        display: inline-block;
        /* color: #fb0606; */
        color: #fff;
        text-decoration: none;
    }
    
    .cool-link::after {
        content: '';
        display: block;
        width: 0;
        height: 2px;
        /* background: #fb0606; */
        background: #fff;
        transition: width .3s;
    }
    
    .cool-link:hover::after {
        width: 100%;
        transition: width .3s;
    }
    
    .cool-link1 {
        display: inline-block;
        /* color: #fb0606; */
        color: #030303;
        text-decoration: none;
    }
    
    .cool-link1.active {
        border-bottom: 2px solid;
        border-color: #000000
    }
    
    .cool-link1::after {
        content: '';
        display: block;
        width: 0;
        height: 2px;
        /* background: #fb0606; */
        background: #000000;
        transition: width .3s;
    }
    
    .cool-link1:hover::after {
        width: 100%;
        transition: width .3s;
    }
</style>

<body>


    <section class="gauto-mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3" align="left">
                    <div class="site-logo" style="padding-top: 10px;">
                        <a href="index.php">
                            <img src="assets/img/logo1.png" alt="zheplogo" width="40%" ; height="20%">
                            <img src="assets/img/logo2.png" alt="zheplogo" width="50%" ; height="30%">
                        </a>
                        <a href="index.php">
                        </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mainmenu">
                        <nav>
                            <ul id="gauto_navigation">
                                <li class="cool-link"><a href="#services">Services</a></li>
                                <li class="cool-link"><a href="#about">About</a></li>
                                <li class="cool-link"><a href="#about">Contact</a></li>
                                <li class="cool-link"><a href="zhep-advertisement/advertisement.html">Advertisements</a></li>

                                <!-- <li>
                                <a href="#">pages</a>
                                <ul>
                                    <li><a href="blog.html">blog</a></li>
                                    <li><a href="single-blog.html">single blog</a></li>
                                    <li><a href="404.html">404 not found</a></li>
                                    <li><a href="login.html">login</a></li>
                                    <li><a href="register.html">register</a></li>
                                </ul>
                            </li> -->

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12" align="right">
                    <div class="main-search-right">
                        <!-- Responsive Menu Start -->
                        <div class="gauto-responsive-menu"></div>
                        <!-- Responsive Menu Start -->

                        <div class="search-box" align="right" style="padding-right: 10px;">
                            <a href="https://play.google.com/store/apps/details?id=com.orangebytetech.cab.customer"><img src="assets/img/google.png" width="30%" ; height="15s%"></a> &nbsp;
                            <a href="https://zhepcab.com/pwa/#/new-login"><img src="assets/img/pwa.png" width="30%" ; height="15%"></a>&nbsp;
                        </div>


                        <!-- <div class="header-cart-box">
                    <div class="login dropdown">
                        <img src="assets/img/location.png" style="height:25px; width:25px;" class="dropdown-toggle login dropdown" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                       <button class="dropdown-toggle cart-icon" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <span>2</span>
                       </button>
                       <div class="dropdown-menu cart-dropdown" aria-labelledby="dropdownMenu1">
                          <ul class="product_list">
                             <li>
                                <div class="cart-btn-product">
                                   <a class="product-remove" href="#">
                                   <i class="fa fa-times"></i>
                                   </a>
                                   <div class="cart-btn-pro-img">
                                      <a href="#">
                                      <img src="assets/img/cart-1.png" alt="product" />
                                      </a>
                                   </div>
                                   <div class="cart-btn-pro-cont">
                                      <h4><a href="#">CAR SPOILERS</a></h4>
                                      <p>Quantity 2</p>
                                      <span class="price">
                                      $29.99
                                      </span>
                                   </div>
                                </div>
                             </li>
                             <li>
                                <div class="cart-btn-product">
                                   <a class="product-remove" href="#">
                                   <i class="fa fa-times"></i>
                                   </a>
                                   <div class="cart-btn-pro-img">
                                      <a href="#">
                                      <img src="assets/img/cart-2.jpg" alt="product" />
                                      </a>
                                   </div>
                                   <div class="cart-btn-pro-cont">
                                      <h4><a href="#">CAR SPOILERS</a></h4>
                                      <p>Quantity 2</p>
                                      <span class="price">
                                      $29.99
                                      </span>
                                   </div>
                                </div>
                             </li>
                          </ul>
                          <div class="cart-subtotal">
                             <p>
                                Subtotal :
                                <span class="drop-total">$59.98</span>
                             </p>
                          </div>
                          <div class="cart-btn">
                             <a href="#" class="cart-btn-1">View Cart</a>
                             <a href="#" class="cart-btn-2">Checkout</a>
                          </div>
                       </div>
                    </div>
                 </div> -->


                        <!-- Cart Box Start -->
                        <div class="header-cart-box">
                            <div class="login dropdown">
                                <img src="assets/img/location.png" style="height:25px; width:25px; padding-top: 5px; padding-right: 5px;" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span style="font-size: x-small; color: #fff;">In&nbsp;Cities</span>
                                <div class="dropdown-menu cart-dropdown" aria-labelledby="dropdownMenu1" id="mySidepanel">
                                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                                    <ul class="product_list">
                                        <li>Amravati</li>
                                        <li>Aurangabad</li>
                                        <li>Buldhana</li>
                                        <li>Chandrapur</li>
                                        <li>Khamgaon</li>
                                        <li>Mumbai</li>
                                        <li>Nagpur</li>
                                        <li>Pune</li>
                                        <li>Shegaon</li>
                                        <li>Yawatmal</li>
                                    </ul>

                                </div>

                                <!-- <div id="mySidepanel" class="sidepanel">
                                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                    <a href="#">About</a>
                                    <a href="#">Services</a>
                                    <a href="#">Clients</a>
                                    <a href="#">Contact</a>
                                </div> -->

                                <!-- <div class="dropdown-menu cart-dropdown" aria-labelledby="dropdownMenu1">
                                <ul class="product_list">
                                    <li> Mumbai </li>
                                    <li> Amravati </li>
                                </ul>

                            </div> -->
                            </div>
                        </div>
                        <!-- Cart Box End -->


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Mainmenu Area End -->




    <!-- Slider Area Start -->
    <!-- Breadcromb Area Start -->
    <!-- <section class="gauto-breadcromb-area section_70">
        <div class="container">

        </div>
    </section> -->
    <!-- Breadcromb Area End -->
    <!-- Slider Area End -->


    <!-- Slider Area Start -->
    <section class="gauto-slider-area fix">
        <div class="gauto-slide owl-carousel">
            <div class="gauto-main-slide slide-item-1">
                <div class="gauto-main-caption">
                    <div class="gauto-caption-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <div class="slider-text">
                                        <p>for rent $65 per day</p>
                                        <h2>Reserved Now & Get <span>50% Off</span></h2>
                                        <a href="#" class="gauto-btn">Reserve Now!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Slider Area End -->



    <!-- Find Area Start -->
    <section class="gauto-find-area">

        <div class="container">

            <div class="row">

                <div class="col-md-12">
                    <div class="find-box1">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="find-form">

                                    <div class="b-find">
                                        <ul class="b-find-nav nav nav-tabs" id="findTab" role="tablist" style="background-color: red; border-top-left-radius:10px; border-top-right-radius:10px; width:25%; border: 1px solid; border-color:#fff;
                                        border-color: red;">
                                            <li class="b-find-nav__item nav-item cool-link" style="background-color: red; border-top-left-radius:10px;"><a class="b-find-nav__link nav-link active" id="tab-allCar" data-toggle="tab" href="#content-allCar" role="tab" aria-controls="content-allCar" aria-selected="true">LOCAL</a></li>
                                            <li class="b-find-nav__item nav-item cool-link" style="background-color: red;"><a class="b-find-nav__link nav-link" id="tab-newCars" data-toggle="tab" href="#content-newCars" role="tab" aria-controls="content-newCars" aria-selected="false">RENTAL</a></li>
                                            <li class="b-find-nav__item nav-item cool-link" style="background-color: red; border-top-right-radius:10px;"><a class="b-find-nav__link nav-link" id="tab-usedCars" data-toggle="tab" href="#content-usedCars" role="tab" aria-controls="content-usedCars" aria-selected="false">OUTSTATION</a></li>
                                        </ul>
                                        <div class="b-find-content tab-content" id="findTabContent">
                                            <div class="tab-pane fade show active find-box" id="content-allCar">
                                            <form action="submit.php" method="post">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p>
                                                                <input required name="pick_up_location" type="text" placeholder="PICK-UP LOCATION" />
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p>
                                                                <input required name="drop_location" type="text" placeholder="DROP LOCATION" />
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p>
                                                                <input required name="phone" type="number" placeholder="MOBILE NUMBER" />
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p>
                                                                <button name="local_submit" value="local_submit" type="submit"  class="gauto-theme-btn">Send Enquiry</button>
                                                            </p>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="tab-pane fade find-box" id="content-newCars">
                                            <form action="submit.php" method="post">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p>
                                                                <input required name="pick_up_location" type="text" placeholder="PICK-UP LOCATION" />
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p>
                                                                <input required name="drop_location" type="text" placeholder="DROP LOCATION" />
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p>
                                                                <select name="package" required>
                                                                  <option data-display="Select">Select Package</option>
                                                                  <option>2Hrs- 20Km</option>
                                                                  <option>4Hrs- 40Km</option>
                                                                  <option>6Hrs- 60Km</option>
                                                                  <option>8Hrs- 80Km</option>
                                                               </select>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p>
                                                                <input required name="phone" type="number" placeholder="MOBILE NUMBER" />
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p>
                                                                <button name="rental_submit" value="rental_submit" type="submit" class="gauto-theme-btn">Send Enquiry</button>
                                                            </p>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="tab-pane fade find-box" id="content-usedCars">
                                                <form action="submit.php" method="post">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p>
                                                                <input required name="pick_up_location" type="text" placeholder="PICK-UP LOCATION" />
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p>
                                                                <input required name="drop_location" type="text" placeholder="DROP LOCATION" />
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p>
                                                                <input required name="phone" type="number" placeholder="MOBILE NUMBER" />
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p>
                                                                <button name="outstation_submit" value="outstation_submit" type="submit" class="gauto-theme-btn">Send Enquiry</button>
                                                            </p>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Find Area End -->


    <!-- About Area Start -->
    <section class="gauto-about-area section_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6" style="padding-top: 35px;">
                    <div class="about-left">
                        <h2>Download & ride soon with zhep cab </h2>
                        <!-- <h2>Welcome to Zhep Cab</h2> -->
                        <p>Zhep Cab is the Taxi Service that runs into multiple cities and various destinations than any other taxi operator in the City. Zhep Cab has a fleet of over 300 Cars moving to over 1000+ destinations</p>
                        <br>
                        <h5 style="color: #ff0000;">Let's Drive&nbsp;
                            <a href="https://zhepcab.com/pwa/#/new-login"><img src="assets/img/right-arrow.png">
                            </a>
                        </h5>

                        <div class="row" style="padding-top:20px;">
                            <div class="col-lg-4" align="left">
                                <a href="https://play.google.com/store/apps/details?id=com.orangebytetech.cab.customer"> <img src="assets/img/google-black.png" /></a>
                            </div>

                            <div class="col-lg-4" align="left">
                                <a href="https://zhepcab.com/pwa/#/new-login"> <img src="assets/img/pwa-black.png" /></a>
                            </div>
                        </div>
                        <!-- <div class="about-list">
                            <ul>
                                <li><i class="fa fa-check"></i>We are a trusted name</li>
                                <li><i class="fa fa-check"></i>we deal in have all brands</li>
                                <li><i class="fa fa-check"></i>have a larger stock of vehicles</li>
                                <li><i class="fa fa-check"></i>we are at worldwide locations</li>
                            </ul>
                        </div>
                        <div class="about-signature">
                            <div class="signature-left">
                                <img src="assets/img/signature.png" alt="signature" />
                            </div>
                            <div class="signature-right">
                                <h3>Robertho Garcia</h3>
                                <p>President</p>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6" align="center">
                    <div class="about-right">
                        <img src="assets/img/mob-app.png" alt="car" height="80%" width="60%" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->


    <!-- Service Area Start -->
    <section class="gauto-service-area service-page-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-heading">
                        <!-- <h4>see our</h4> -->
                        <h2 class="cool-link">Make Your Smartest Move</h2><br>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top:25px;">
                <div class="col-md-4" align="center">
                    <div>
                        <img src="assets/img/city-transport.png" alt="city trasport" width="30%" height="30%" />
                    </div>
                    <div class="service-text">

                        <h3>Set your destination</h3><br>
                    </div>

                </div>
                <div class="col-md-4" align="center">
                    <div>
                        <img src="assets/img/request-ride.png" alt="city trasport" width="30%" height="30%" />
                    </div>
                    <div class="service-text">

                        <h3>Request a ride</h3><br>
                    </div>

                </div>
                <div class="col-md-4" align="center">
                    <div>
                        <img src="assets/img/driver-ride.png" alt="city trasport" width="40%" height="40%" />
                    </div>
                    <div class="service-text">

                        <h3>Driver arrive in minutes</h3><br>
                    </div>

                </div>
            </div>



        </div>
    </section>
    <!-- Service Area End -->



    <!-- Offers Area Start -->
    <section class="gauto-offers-area section_70">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-heading">
                        <!-- <h4>Come with</h4> -->
                        <h2>ZHEP CAB RENTAL </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="offer-tabs">
                        <ul class="nav nav-tabs" id="offerTab" role="tablist">
                            <!-- <li class="nav-item">
                                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All Brands</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="cool-link1 active" id="nissan-tab" data-toggle="tab" href="#nissan" role="tab" data-tab="#tab-one" aria-controls="nissan" aria-selected="false"> <b>SEDAN</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="cool-link1" id="Toyota-tab" data-toggle="tab" href="#Toyota" role="tab" data-tab="#tab-two" aria-controls="Toyota" aria-selected="false"><b>SUV</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="cool-link1" id="Audi-tab" data-toggle="tab" href="#Audi" role="tab" data-tab="#tab-three" aria-controls="Audi" aria-selected="false"><b>BUS</b></a>
                            </li>
                        </ul>

                        <div class="tab-content" id="offerTabContent">

                            <!-- Nissan Tab Start -->
                            <div class="tab-pane fade show active" id="nissan" role="tabpanel" aria-labelledby="nissan-tab">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10" align="center" style="padding-left: 0px; padding-right: 0px;">
                                        <img src="assets/img/pxfuel.jpg" alt="airport trasport" />
                                    </div>
                                    <div class="col-md-1"></div>

                                    <div class="col-md-1"></div>
                                    <div class="col-md-10" align="center" style="background-color: #000000;">
                                        <div class="row" style="background-color: #000000;">
                                            <div class="col-md-6" align="left">
                                                <p style="color: #fff; padding-top:10px;">Recognised for its excellent products and services around the Region, Zhep Cab Service bridges cultures and continents from its hub with Indian hospitality at its heart.</p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="single-service" style="background-color:#000000; padding-left:18px;" align="left">
                                                    <h6 style="color:#ffffff;"><b>Local Ride</b></h6>
                                                    <h5 style="padding-top:10px;">₹80</h5>
                                                    <!-- <span class="service-number">01 </span> -->
                                                    <div class="service-text">
                                                        <a href="#">

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="single-service" style="background-color:#000000; padding-left:18px;" align="left">
                                                    <h6 style="color:#ffffff;"><b>Rental Ride</b></h6>
                                                    <h5 style="padding-top:10px;">₹500</h5>
                                                    <!-- <span class="service-number">01 </span> -->
                                                    <div class="service-text">
                                                        <a href="#">

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="single-service" style="background-color:#000000; padding-left:18px;" align="left">
                                                    <h6 style="color:#ffffff;"><b>Intercity</b></h6>
                                                    <h5 style="padding-top:10px;">₹1200</h5>
                                                    <!-- <span class="service-number">01 </span> -->
                                                    <div class="service-text">
                                                        <a href="#">

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>

                                </div>



                            </div>
                            <!-- Nissan Tab End -->

                            <!-- Toyota Tab Start -->
                            <div class="tab-pane fade" id="Toyota" role="tabpanel" aria-labelledby="Toyota-tab">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10" align="center" style="padding-left: 0px; padding-right: 0px;">
                                        <img src="assets/img/suv.jpg" alt="airport trasport" />
                                    </div>
                                    <div class="col-md-1"></div>

                                    <div class="col-md-1"></div>
                                    <div class="col-md-10" align="center" style="background-color: #000000;">
                                        <div class="row" style="background-color: #000000;">
                                            <div class="col-md-6" align="left">
                                                <p style="color: #fff; padding-top:10px;">Recognised for its excellent products and services around the Region, Zhep Cab Service bridges cultures and continents from its hub with Indian hospitality at its heart.</p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="single-service" style="background-color:#000000; padding-left:18px;" align="left">
                                                    <h6 style="color:#ffffff;"><b>Local Ride</b></h6>
                                                    <h5 style="padding-top:10px;">₹160</h5>
                                                    <!-- <span class="service-number">01 </span> -->
                                                    <div class="service-text">
                                                        <a href="#">

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="single-service" style="background-color:#000000; padding-left:18px;" align="left">
                                                    <h6 style="color:#ffffff;"><b>Rental Ride</b></h6>
                                                    <h5 style="padding-top:10px;">₹1000</h5>
                                                    <!-- <span class="service-number">01 </span> -->
                                                    <div class="service-text">
                                                        <a href="#">

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="single-service" style="background-color:#000000; padding-left:18px;" align="left">
                                                    <h6 style="color:#ffffff;"><b>Intercity</b></h6>
                                                    <h5 style="padding-top:10px;">₹1500</h5>
                                                    <!-- <span class="service-number">01 </span> -->
                                                    <div class="service-text">
                                                        <a href="#">

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>

                                </div>

                            </div>
                            <!-- Toyota Tab Start -->

                            <!-- Audi Tab Start -->
                            <div class="tab-pane fade" id="Audi" role="tabpanel" aria-labelledby="Audi-tab">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10" align="center" style="padding-left: 0px; padding-right: 0px;">
                                        <img src="assets/img/bus.jpg" alt="airport trasport" />
                                    </div>
                                    <div class="col-md-1"></div>

                                    <div class="col-md-1"></div>
                                    <div class="col-md-10" align="center" style="background-color: #000000;">
                                        <div class="row" style="background-color: #000000;">
                                            <div class="col-md-2">
                                                <!-- <p style="color: #fff; padding-top:10px;">Recognised for its excellent products and services around the Region, Zhep Cab Service bridges cultures and continents from its hub with Indian hospitality at its heart.</p> -->
                                            </div>
                                            <div class="col-md-2">
                                                <div class="single-service" style="background-color:#000000; padding-left:18px;" align="left">
                                                    <h6 style="color:#ffffff;"><b>Capacity</b></h6>
                                                    <h5 style="padding-top:10px;">17 Seater</h5>
                                                    <!-- <span class="service-number">01 </span> -->
                                                    <div class="service-text">
                                                        <a href="#">

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="single-service" style="background-color:#000000; padding-left:18px;" align="left">
                                                    <h6 style="color:#ffffff;"><b>Capacity</b></h6>
                                                    <h5 style="padding-top:10px;">20 Seater</h5>
                                                    <!-- <span class="service-number">01 </span> -->
                                                    <div class="service-text">
                                                        <a href="#">

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="single-service" style="background-color:#000000; padding-left:18px;" align="left">
                                                    <h6 style="color:#ffffff;"><b>Capacity</b></h6>
                                                    <h5 style="padding-top:10px;">26 Seater</h5>
                                                    <!-- <span class="service-number">01 </span> -->
                                                    <div class="service-text">
                                                        <a href="#">

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="single-service" style="background-color:#000000; padding-left:18px;" align="left">
                                                    <h6 style="color:#ffffff;"><b>Capacity</b></h6>
                                                    <h5 style="padding-top:10px;">30 Seater</h5>
                                                    <!-- <span class="service-number">01 </span> -->
                                                    <div class="service-text">
                                                        <a href="#">

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="single-service" style="background-color:#000000; padding-left:18px;" align="left">
                                                    <h6 style="color:#ffffff;"><b>Capacity</b></h6>
                                                    <h5 style="padding-top:10px;">50 Seater</h5>
                                                    <!-- <span class="service-number">01 </span> -->
                                                    <div class="service-text">
                                                        <a href="#">

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>

                                </div>

                            </div>
                            <!-- Audi Tab End -->



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Offers Area End -->

    <!-- Car Booking Area Start -->
    <section class="gauto-car-booking section_70">
        <div class="container" style="box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;  ">
            <div class="row">
                <div class="col-lg-6" style="padding-left: 0px;  padding-right: 0px; border-top-left-radius: 20px; border-bottom-left-radius: 20px;">

                    <img src="assets/img/local1.webp" alt="car" />

                </div>
                <div class="col-lg-6" style="background-color: #fcf2f2; border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                    <div class="car-booking-right" style="padding-left: 20px; padding-right: 20px; padding-bottom: 100px; padding-top: 100px; ">
                        <!-- <p class="rental-tag">Local</p> -->
                        <h3 class="cool-link1">Local Ride
                            <a href="https://zhepcab.com/pwa/#/new-login"><img src="assets/img/right-arrow.png">
                            </a>
                        </h3>

                        <p align="justify" style="color: #000000;"> Book Local Rides For Shopping, Wedding, Office, School. <br><br>We Offers Local Taxi Booking Facility To Travel Within The City Limits With Most Affordable Rates.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Car Booking Area End -->


    <!-- Car Booking Area Start -->
    <section class="gauto-car-booking section_70">
        <div class="container" style="box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px; ">
            <div class="row ">
                <div class="col-lg-6 " style="background-color: #fcf2f2; border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                    <div class="car-booking-right " style="padding-left: 20px; padding-right: 20px; padding-bottom: 100px; padding-top: 100px; ">
                        <!-- <p class="rental-tag ">Local</p> -->
                        <h3 class="cool-link1 ">Rental Ride
                            <a href="https://zhepcab.com/pwa/#/new-login"><img src="assets/img/right-arrow.png">
                            </a>
                        </h3>

                        <p align="justify " style="color: #000000; "> Book Taxi For Flexible Hours Within City Limits . <br><br>The Travelers Who Wants To Rent A Car for City Usage Like Local Sightseeing, In-City Transfers, Short Time Booking etc. We Provide Hourly, Half Day & Full Day Car Hiring
                            Facilities to our Customers, Which They Can Avail as Per Their Convenience & Needs.</p>

                    </div>
                </div>

                <div class="col-lg-6 " style="padding-left: 0px; padding-right: 0px; ">

                    <img src="assets/img/rental.webp " alt="car " />

                </div>
            </div>
        </div>
    </section>
    <!-- Car Booking Area End -->

    <!-- Car Booking Area Start -->
    <section class="gauto-car-booking section_70 ">
        <div class="container " style="box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px; ">
            <div class="row ">
                <div class="col-lg-6 " style="padding-left: 0px; padding-right: 0px; ">

                    <img src="assets/img/outstation.webp " alt="car " />

                </div>
                <div class="col-lg-6 " style="background-color: #fcf2f2; border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                    <div class="car-booking-right " style="padding-left: 20px; padding-right: 20px; padding-bottom: 100px; padding-top: 100px; ">
                        <!-- <p class="rental-tag ">Local</p> -->
                        <h3 class="cool-link1 ">Outstation
                            <a href="https://zhepcab.com/pwa/#/new-login"><img src="assets/img/right-arrow.png">
                            </a>
                        </h3>

                        <p align="justify " style="color: #000000; "> Plan Your Family Weekend Trips & Leisure Trips With Friends Outside The City Limits. <br><br> Not All Outstation Journeys Can be Covered by Flight, Train or Bus, Sometimes a Cab is the Fastest and the Most Efficient Way to Cover
                            the Distance. It is a lot Easier When Travelling From Amravati to Nagpur to Book Outstation Cab. Zhep Cab Brings to You This New Feature That Let’s You Book an Outstation Taxi Booking on tens of Hundreds of Routes across the
                            Country. For Instance, You Wish to Travel to Amravati from Nagpur & Find It More Convenient to Make An Outstation Taxi Booking & zip Down the National Highway to Get Into Nagpur in a Matter of a Couple of Hours.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Car Booking Area End -->


    <!-- Car Booking Area Start -->
    <section class="gauto-car-booking section_70 ">
        <div class="container " style="box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px; ">
            <div class="row ">
                <div class="col-lg-6 " style="background-color: #fcf2f2; border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                    <div class="car-booking-right " style="padding-left: 20px; padding-right: 20px; padding-bottom: 100px; padding-top: 100px; ">
                        <!-- <p class="rental-tag ">Local</p> -->
                        <h3 class="cool-link1 ">Share Ride
                            <a href="https://zhepcab.com/pwa/#/new-login"><img src="assets/img/right-arrow.png">
                            </a>
                        </h3>

                        <p align="justify " style="color: #000000; "> Traveler Commute Made Easier. <br> Carpool is Revolutionary & Fun Way to Commute. Whether You are a Car owner, or a Rider, Just Post Your Ride Details on Share Ride & We will Match You with Co-Riders on Your Way.</p>
                        <h5 style="color:#ff0000; padding-top:10px;">Why Should Use Carpool ?</h5>
                        <div class="">
                            <ul style="color:#000000;">
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Save upto 80% on Commute Cost.</li>
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Save Upto Rs 3000 Per Month on Commute Costs Compared to People Who opt for Cabs/Auto.</li>
                            </ul>
                        </div>

                        <h5 style="color:#ff0000; padding-top:10px;">Expand Your Professional Network</h5>
                        <div class="">
                            <ul style="color:#000000;">
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Carpool with Professionals from Different Domains & Expand Your Professional.</li>
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Network while Commuting.</li>
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Reduce Pollution & Save Environment.</li>
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Carpool and reduce traffic and pollution.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 " style="padding-left: 0px; padding-right: 0px; ">

                    <img src="assets/img/shareride.jpg " alt="car " />

                </div>
            </div>
        </div>
    </section>
    <!-- Car Booking Area End -->

    <!-- Car Booking Area Start -->
    <section class="gauto-car-booking section_70 ">
        <div class="container " style="box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px; ">
            <div class="row ">
                <div class="col-lg-6 " style="padding-left: 0px; padding-right: 0px; ">

                    <img src="assets/img/corporate.webp " alt="car " />

                </div>
                <div class="col-lg-6 " style="background-color: #fcf2f2; border-top-right-radius: 20px; border-bottom-right-radius: 20px; ">
                    <div class="car-booking-right " style="padding-left: 20px; padding-right: 20px; padding-bottom: 100px; padding-top: 100px; ">
                        <!-- <p class="rental-tag ">Local</p> -->
                        <h3 class="cool-link1 ">Corporate
                            <a href="https://zhepcab.com/pwa/#/new-login"><img src="assets/img/right-arrow.png">
                            </a>
                        </h3>

                        <!-- <p align="justify " style="color: #000000; "> Book Local Rides For Shopping, Wedding, Office, School. We Offers Local Taxi Booking Facility To Travel Within The City Limits With Most Affordable Rates.</p> -->
                        <div class="">
                            <ul>
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Let us take care of your enterprise travel.</li>
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Employees book their rides through corporate login on Zhep Cab app.</li>
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Track ride expense details and download invoices anytime.</li>
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Point to point pick up.</li>
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Executive Ride.</li>
                                <li><i class="fa fa-car" style="color:red;"></i>&nbsp;Real Time Booking Approval.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Car Booking Area End -->




    <!-- About Area Start -->
    <section class="gauto-about-area section_70 ">
        <div class="container ">
            <div class="row ">
                <div class="col-lg-6 " style="padding-top: 35px; ">
                    <div class="about-left ">
                        <h4>about us</h4>
                        <!-- <h2>Welcome to Zhep Cab</h2> -->
                        <p>Zhep Cab is a Part of Zhep Tours and Travels, operating since 2010 All Over Maharashtra We believe that best service makes Customer, not a Sale.</p>
                        <br>

                        <p>Zhep Cab is Top Rated Taxi Service Operating in Multiple Cities to Fulfill Traveler's Need.Our mission is to be recognised as the global leader in Cab Rental for companies and the public and private sector by partnering with our
                            clients to provide the best and most efficient Cab Rental solutions and to achieve service excellence.</p>

                        <!-- <h6>A BETTER WAY TO RENT A CAR</h3> -->
                        <h6 style="color:#ff0000; padding-top:10px;"><b>A BETTER WAY TO RENT A CAR</b></h6>
                        <p align="justify ">We Believe that Best Service Makes Customer, Not a Sale. Let's Join Hand Together for Corporate Booking. We Discover & Explore New Technologies For Taxi Booking Download Zhep Cab.</p>

                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="about-right ">
                        <img src="assets/img/about.gif" alt="car " />
                    </div>
                </div>
            </div>

            <div class="row" style="padding-top:25px;">
                <div class="col-md-12" align="left">
                    <div class="site-heading">
                        <!-- <h4>see our</h4> -->
                        <h4 class="cool-link" style="font-size: 25px; color:#000000 ">Something to make you love us more</h4><br>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4" align="center">
                    <div>
                        <img src="assets/img/car.png" alt="city trasport" height="20%" width="20%" />
                    </div>
                    <div class="service-text">

                        <h3>Quality Cars and Drivers</h3><br>
                        <p>We work with Pre-Checked and Certified Cars and Drivers.</p>
                    </div>

                </div>
                <div class="col-md-4" align="center">
                    <div>
                        <img src="assets/img/billing.png" alt="city trasport" height="20%" width="20%" />
                    </div>
                    <div class="service-text">

                        <h3>Transparent Billing</h3>
                        <p>We provide every detail of your usage clearly with no hidden costs.</p>
                    </div>

                </div>
                <div class="col-md-4" align="center">
                    <div>
                        <img src="assets/img/regulation.png" alt="city trasport" height="20%" width="20%" />
                    </div>
                    <div class="service-text">

                        <h3>Maintain Regulations</h3>
                        <p>Our vehicles and drivers have valid licences, permits and approvals.</p>
                    </div>

                </div>
            </div>

            <div class="row" style="padding-top:15px;">
                <div class="col-md-4" align="center">
                    <div>
                        <img src="assets/img/technology.png" alt="city trasport" height="20%" width="20%" />
                    </div>
                    <div class="service-text">

                        <h3>Technology with Human Touch</h3><br>
                        <p>A dedicated manager is assigned to take care of all the queries and needs of our clients.</p>
                    </div>

                </div>
                <div class="col-md-4" align="center">
                    <div>
                        <img src="assets/img/tracking.png" alt="city trasport" height="20%" width="20%" />
                    </div>
                    <div class="service-text">

                        <h3>Booking Validation & Tracking</h3>
                        <p>Real time booking approval as per company approval matrix.</p>
                    </div>

                </div>
                <div class="col-md-4" align="center">
                    <div>
                        <img src="assets/img/platform.png" alt="city trasport" height="20%" width="20%" />
                    </div>
                    <div class="service-text">

                        <h3>Multiple Booking Platform</h3>
                        <p>Booking through web, mobile app and call Center.</p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->



    <!-- Testimonial Area Start -->
    <section class="gauto-testimonial-area section_70 ">
        <div class="container ">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="site-heading ">
                        <!-- <h4>Partners</h4> -->
                        <h2>Our Partners</h2>
                    </div>
                </div>
            </div>
            <div class="row " style="padding-top:15px;">
                <div class="col-md-12 ">
                    <div class="testimonial-slider owl-carousel ">
                        <img src="assets/img/clt1.png " style="width: 250px; height: 100px; ">
                        <img src="assets/img/clt2.png " style="width: 250px; height: 100px; ">
                        <!-- <img src="assets/img/clt3.png " style="width: 250px; height: 100px; "> -->
                        <img src="assets/img/clt4.png " style="width: 250px; height: 100px; ">
                        <img src="assets/img/clt5.png " style="width: 250px; height: 100px; ">
                        <img src="assets/img/clt6.png " style="width: 250px; height: 100px; ">
                        <img src="assets/img/clt7.png " style="width: 250px; height: 100px; ">
                        <img src="assets/img/clt8.png " style="width: 250px; height: 100px; ">
                        <img src="assets/img/clt9.png " style="width: 250px; height: 100px; ">
                        <img src="assets/img/clt10.png " style="width: 250px; height: 100px; ">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Area End -->


    <!-- Blog Area Start -->
    <!-- <section class="gauto-blog-area section_70 ">
        <div class="container ">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="site-heading ">
                        <h4>latest</h4>
                        <h2>our blog</h2>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-4 ">
                    <div class="single-blog ">
                        <div class="blog-image ">
                            <a href="# ">
                                <img src="assets/img/blog-1.jpg " alt="blog 1 " />
                            </a>
                        </div>
                        <div class="blog-text ">
                            <h3><a href="# ">if Your Car's bettery down.</a></h3>
                            <div class="blog-meta-home ">
                                <div class="blog-meta-left ">
                                    <p>July 13, 09:43 am</p>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <div class="single-blog ">
                        <div class="blog-image ">
                            <a href="# ">
                                <img src="assets/img/blog-2.jpg " alt="blog 1 " />
                            </a>
                        </div>
                        <div class="blog-text ">
                            <h3><a href="# ">How often is a taxi used?</a></h3>
                            <div class="blog-meta-home ">
                                <div class="blog-meta-left ">
                                    <p>July 13, 09:43 am</p>
                                </div>
                          
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <div class="single-blog ">
                        <div class="blog-image ">
                            <a href="# ">
                                <img src="assets/img/blog-3.jpg " alt="blog 1 " />
                            </a>
                        </div>
                        <div class="blog-text ">
                            <h3><a href="# ">The best ways to pay Drivers</a></h3>
                            <div class="blog-meta-home ">
                                <div class="blog-meta-left ">
                                    <p>July 13, 09:43 am</p>
                                </div>
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Blog Area End -->

    <!-- Contact Area Start -->
    <section class="gauto-contact-area section_70 ">
        <div class="container ">
            <div class="row ">
                <div class="col-lg-7 ">
                    <div class="contact-left ">
                        <h3>Fill the form Now</h3>
                        <form action="submit.php" method="post" >
    <div class="row">
        <div class="col-md-12">
            <div class="single-contact-field">
                <input type="text" name="name" placeholder="Your Name" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="single-contact-field">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="single-contact-field">
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="single-contact-field">
                <textarea name="message" placeholder="Write here your message" required></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="single-contact-field">
                <button name="contact_submit" value="contact_submit" type="submit" class="gauto-theme-btn"><i class="fa fa-paper-plane"></i> Send Message</button>
            </div>
        </div>
    </div>
</form>

                    </div>
                </div>
                <div class="col-lg-5 " align="left ">
                    <div class="contact-right ">
                        <h3>Get in touch with Us</h3>
                        <div class="contact-details ">
                            <div class="single-contact-btn order-summury-box " style="display:inherit; margin-top:0px; ">
                                <h3>Phone</h3>
                                <h6 style="padding-bottom:7px; color: #000000;">We are always there for you.</h6>
                                <a href="tel:+919766658802 "><b><i
                                    class="fa fa-phone-square " aria-hidden="true "></i> +91 97666
                                58802</b></a>
                                <a href="tel:+919730158802 "><b><i
                                    class="fa fa-phone-square " aria-hidden="true "></i> +91 97301 58802</b></a>
                            </div><br>


                            <div class="single-contact-btn order-summury-box " style="display:inherit; margin-top:0px; ">
                                <h3>Email</h3>
                                <h6 style="padding-bottom:7px; color: #000000;">Our support team will get back to you soon.</h6>
                                <a href="mailto:zheptoursandtravels@gmail.com "><b><i class="fa fa-envelope-o " aria-hidden="true "></i>
                                    zheptoursandtravels@gmail.com
                                </b></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Area End -->



    <!-- Footer Area Start -->
    <footer class="gauto-footer-area ">
        <div class="footer-top-area ">
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-4 ">
                        <div class="single-footer ">
                            <div class="footer-logo ">
                                <a href="# ">
                                    <img src="assets/img/logo1.png" alt="zheplogo" width="40%" ; height="20%">
                                    <img src="assets/img/logo2.png" alt="zheplogo" width="50%" ; height="30%">
                                </a>
                            </div>
                            <div class="footer-social " align="left">
                                <ul>
                                    <li><a href="https://www.facebook.com/zhepcab/ "><i class="fa fa-facebook " ></i></a></li>
                                    <li><a href="https://twitter.com/zhep13 "><i class="fa fa-twitter "></i></a></li>
                                    <li><a href="https://www.instagram.com/tv/CHNeGzKJXvb/?igshid=1c37767zt5rw2 "><i class="fa fa-instagram "></i></a></li>
                                    <li><a href="https://youtu.be/3UB6pP2knl0 "><i class="fa fa-youtube "></i></a></li>
                                    <li><a href="https://g.page/ZhepCab?av "><i class="fa fa-google "></i></a></li>
                                </ul>
                            </div>
                            <!-- <h3>A BETTER WAY TO RENT A CAR</h3> -->
                        </div>
                    </div>
                    <div class="col-lg-2 ">
                        <div class="single-footer quick_links ">
                            <h3>Services</h3>
                            <ul class="quick-links ">
                                <li><a href="# ">Local</a></li>
                                <li><a href="# ">Rental</a></li>
                                <li><a href="# ">Outstation</a></li>
                                <li><a href="# ">Shareride</a></li>
                                <li><a href="# ">Corporate</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 ">
                        <div class="single-footer quick_links ">
                            <h3>Services</h3>
                            <ul class="quick-links ">
                                <li><a href="# ">Contact Us</a></li>
                                <li><a href="# ">About Us</a></li>
                                <li><a href="# ">Our Services</a></li>
                                <li><a href="# ">Offers</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div class="single-footer ">
                            <h3>Get In Touch</h3>
                            <ul>
                                <li>
                                    <div class="single-footer-post ">
                                        <div class="footer-post-text ">
                                            <ul>
                                                <li>
                                                    <a href="mailto:zheptoursandtravels@gmail.com " style="color: white; "><i class="fa fa-envelope-o " aria-hidden="true "></i>
                                                    zheptoursandtravels@gmail.com
                                                </a></li>
                                                <li>
                                                    <a href="tel:+919766658802 " style="color: white; "><i class="fa fa-phone-square "
                                                aria-hidden="true "></i> +91 97666
                                            58802</a></li>
                                                <li>
                                                    <a href="tel:+919730158802 " style="color: white; "><i class="fa fa-phone-square "
                                                aria-hidden="true "></i> +91 97301 58802</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area ">
            <div class="container ">
                <div class="row ">
                    <div class="col-md-6 ">
                        <div class="copyright ">
                            <div class="copyright ">&copy; 2023 <span style="color:#fb0606 ">ZhepCab.</span> All Rights Reserved.</div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 ">
                        <div class="footer-social ">
                            <ul>
                                <li><a href="https://www.facebook.com/zhepcab/ "><i class="fa fa-facebook "></i></a></li>
                                <li><a href="https://twitter.com/zhep13 "><i class="fa fa-twitter "></i></a></li>
                                <li><a href="https://www.instagram.com/tv/CHNeGzKJXvb/?igshid=1c37767zt5rw2 "><i class="fa fa-instagram "></i></a></li>
                                <li><a href="https://youtu.be/3UB6pP2knl0 "><i class="fa fa-youtube "></i></a></li>
                                <li><a href="https://g.page/ZhepCab?av "><i class="fa fa-google "></i></a></li>
                            </ul>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->


    <!--Jquery js-->
    <!-- Popper JS -->
    <script src="assets/js/popper.min.js "></script>
    <!--Bootstrap js-->
    <script src="assets/js/bootstrap.min.js "></script>
    <!--Owl-Carousel js-->
    <script src="assets/js/owl.carousel.min.js "></script>
    <!--Lightgallery js-->
    <script src="assets/js/lightgallery-all.js "></script>
    <script src="assets/js/custom_lightgallery.js "></script>
    <!--Slicknav js-->
    <script src="assets/js/jquery.slicknav.min.js "></script>
    <!--Magnific js-->
    <script src="assets/js/jquery.magnific-popup.min.js "></script>
    <!--Nice Select js-->
    <script src="assets/js/jquery.nice-select.min.js "></script>
    <!-- Datepicker JS -->
    <script src="assets/js/jquery.datepicker.min.js "></script>
    <!--ClockPicker JS-->
    <script src="assets/js/jquery-clockpicker.min.js "></script>
    <!--Main js-->
    <script src="assets/js/main.js "></script>

    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent ");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none ";
            }
            tablinks = document.getElementsByClassName("tablinks ");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active ", " ");
            }
            document.getElementById(cityName).style.display = "block ";
            evt.currentTarget.className += " active ";
        }
    </script>

    <script>
        /* Set the width of the sidebar to 250px (show it) */
        function openNav() {
            document.getElementById("mySidepanel").style.width = "250px";
        }

        /* Set the width of the sidebar to 0 (hide it) */
        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
</body>

</html>