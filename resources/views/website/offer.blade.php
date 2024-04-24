@extends('website-layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    Offers || Zhep Tours & Travels
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
                            <div class="content">
                                <h1 class="page-title mb--20">Offers</h1>
                                <!--  <p class="subtitle-2">A quick view of industry specific problems solved with design
                                     by the awesome team at Keystroke.</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 order-1 order-lg-2">
                        <div class="breadcrumb-thumbnail-group with-image-group text-left text-lg-right">
                            <div class="thumbnail">
                                <img class="paralax-image" src="{{asset('public/website/assets/images/slider/finaloffer.png')}}" alt="Keystoke Images">
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
		
		
        <div class="axil-team-area ax-section-gap bg-color-lightest">
            <div class="container">
                <div class="tab-content" id="myTabContent">
                    <div class="row">
						 		@php
									$now = date('Y-m-d');
                                    use Illuminate\Support\Facades\DB;
                                    $coupons = DB::table('coupon')
                                    ->select('coupon.*')
									->where('website_status',1)
									->where('to_date', '>', $now)
									->limit(20)
									->orderby('id','DESC')
                                    ->get();
                                @endphp
						@foreach($coupons as $coupon)
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mt--60 mt_sm--30 mt_md--30">
                            <div class="axil-team">
                                <div class="inner">
                                    <div class="thumbnail paralax-image">
                                        <a href="">
                     <img class="w-100" src="https://cab.orangebytetech.com/public/img/{{$coupon->coupon_image}}" alt="Coupon Images">
                                        </a>
                                    </div>
                                    <div class="content">
										<p style="color: #ee2326;" class="subtitle">{{$coupon->description}}</p>
                                        <p class="subtitle">{{$coupon->from_date}} to {{$coupon->to_date}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
						@endforeach

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


