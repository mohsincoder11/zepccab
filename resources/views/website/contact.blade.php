@extends('website-layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    Contact Us || Zhep Tours & Travels
@endsection

@section('head')
    @include('website-layouts.head')



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('public/website/assets/css/demo.css')}}" >
    <link rel="stylesheet" href="{{asset('public/website/assets/css/client.css')}}" >
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
			$('.customer-logos').slick({
				slidesToShow: 6,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 1500,
				arrows: false,
				dots: false,
				pauseOnHover: false,
				responsive: [{
					breakpoint: 768,
					settings: {
						slidesToShow: 4
					}
				}, {
					breakpoint: 520,
					settings: {
						slidesToShow: 3
					}
				}]
			});
		});
    </script>
@endsection

@section('theme')
    @include('website-layouts.theme')
@endsection

@section('header')
    @include('website-layouts.header')
@endsection


@section('content')

    <div class="axil-breadcrumb-area breadcrumb-style-2 pt--170 pb--70 theme-gradient">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 order-2 order-lg-1 mt_md--30 mt_sm--30">
                     <div class="inner">
                        <h1 class="title">Contact Us</h1>
                    </div>
                    </div>
                    <div class="col-lg-7 order-1 order-lg-2">
                        <div class="breadcrumb-thumbnail-group with-image-group text-left text-lg-right">
                            <div class="thumbnail">
                                <img class="paralax-image" src="{{asset('public/website/assets/images/slider/banner-about.png')}}" alt="Keystoke Images">
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

<main class="main-wrapper">

    <!-- Start Contact Area  -->
    <div class="axil-contact-area axil-shape-position ax-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-xl-5 col-12">
                    <div class="contact-form-wrapper">
                        <!-- Start Contact Form -->
                        <div class="axil-contact-form contact-form-style-1">
                            <h3 class="title">Get a Zhep Cab Now</h3>
<form enctype="multipart/form-data" action="{{route('addTour')}}" method="POST" id="TourSubmitFormContact">
                            {{ csrf_field() }}
	<input type="hidden" name="contact_form" value="1">
                                <div class="form-group">
                                    <input name="name" type="text">
                                    <label>Name</label>
                                    <span class="focus-border"></span>
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email">
                                    <label>Email</label>
                                    <span class="focus-border"></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone">
                                    <label>Phone</label>
                                    <span class="focus-border"></span>
                                </div>
                                <div class="form-group">
                                    <textarea name="message"></textarea>
                                    <label>Your message</label>
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group">
			<button class="axil-button btn-transparent" name="submitBtnContact" id="submitBtnContact" type="submit">Send message</button>
									<p class="form-messege"></p>
                                </div>
                            </form>

                        </div>
                        <!-- End Contact Form -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xl-6 offset-xl-1 col-12 mt_md--40 mt_sm--40">
                    <div class="axil-address-wrapper">
                        <!-- Start Single Address  -->
                        <div class="axil-address wow move-up">
                            <div class="inner">
                                <div class="icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">Phone</h4>
                                    <p>Our Office is open 24 Hours</p>
                                    <p><a class="axil-link" href="tel:97666 58802">(+91) 97666 58802</a></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Address  -->
                        <!-- Start Single Address  -->
                        <div class="axil-address wow move-up mt--60 mt_sm--30 mt_md--30">
                            <div class="inner">
                                <div class="icon">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">Email</h4>
                                    <p>Our support team will get back to you soon.
                                    </p>
                                    <p><a style="font-size:14px" class="axil-link" href="mailto:zheptoursandtravels@gmail.com ">zheptoursandtravels@gmail.com </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Address  -->
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-group">
            <div class="shape shape-01">
                <i class="icon icon-contact-01"></i>
            </div>
            <div class="shape shape-02">
                <i class="icon icon-contact-02"></i>
            </div>
            <div class="shape shape-03">
                <i class="icon icon-contact-03"></i>
            </div>
        </div>
    </div>
    <!-- End Contact Area  -->
	
	
	
	<div class="axil-client-area bg-shape-image-position bg-color-white axil-bg-oval">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title mb--60 text-center">
                            <h3 class="title">Our Services In Cities</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
						
					  <section class="customer-logos slider">
                  <div class="slide"><img height="35px" width="60px" src="{{asset('public/website/assets/images/brand/1.png')}}"></div>
                  <div class="slide"><img height="35px" width="60px" src="{{asset('public/website/assets/images/brand/2.png')}}"></div>
                  <div class="slide"><img height="35px" width="60px" src="{{asset('public/website/assets/images/brand/3.png')}}"></div>
                  <div class="slide"><img height="35px" width="60px" src="{{asset('public/website/assets/images/brand/4.png')}}"></div>
                  <div class="slide"><img height="35px" width="60px" src="{{asset('public/website/assets/images/brand/5.png')}}"></div>
                  <div class="slide"><img height="35px" width="60px" src="{{asset('public/website/assets/images/brand/6.png')}}"></div>
                  <div class="slide"><img height="35px" width="60px" src="{{asset('public/website/assets/images/brand/7.png')}}"></div>
                  <div class="slide"><img height="35px" width="60px" src="{{asset('public/website/assets/images/brand/8.png')}}"></div>
				  <div class="slide"><img height="35px" width="60px" src="{{asset('public/website/assets/images/brand/9.png')}}"></div>
                  <div class="slide"><img height="35px" width="60px" src="{{asset('public/website/assets/images/brand/10.png')}}"></div>
           
						 </section>
						
                    </div>
                </div>
            </div>
            <div class="bg-shape-image">
                <img src="{{asset('public/website/assets/images/others/background-shape.svg')}}" alt="Bg images">
            </div>
        </div>
	

        <!-- End Client Logo Area  -->
		<br>
	
</main>

@endsection

@section('footer')
    @include('website-layouts.footer')
@endsection

@section('script')
    @include('website-layouts.script')
	<script>
   $("#submitBtnContact").on('click', function() {

    $(".form-group").removeClass('has-error').removeClass('has-success');
    $(".text-danger").remove();
    $(".messages").html("");
    $("#TourSubmitFormContact").unbind('submit').bind('submit', function() {

        $(".text-danger").remove();

        var form = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var postData = new FormData($("#TourSubmitFormContact")[0]);
        $.ajax({
            cache:false,
            contentType: false,
            processData: false,
            url : form.attr('action'),
            type : form.attr('method'),
            dataType : 'json',
            data : postData,
            // data : form.serialize(),
            success:function(response) {

// remove the error
                $(".form-group").removeClass('has-error').removeClass('has-success');
                if(response.success == true) {
					toastr.success('Added Successfully.', 'Enquiry', {timeOut: 5000});
                    location.reload(true);
                }
                else
                {
				toastr.error(response.messages, '', {timeOut: 5000});
                }  // /else
            } // success
        }); // ajax subit

        return false;
    }); // /submit form for create member
}); // /add modal
	
	
	</script>
@endsection


