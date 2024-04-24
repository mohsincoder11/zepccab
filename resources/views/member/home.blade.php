@extends('member.layout.auth')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
  HOME
@endsection

@section('head')
    @include('layouts.head')
@endsection

@section('theme')
    @include('layouts.theme')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('sidebar')
    @include('layouts.member-sidebar')
@endsection



@section('content')

    <div class="container-fluid">
        <!--Section: Intro-->
        <section class="mt-lg-5">
            <div class="row">

                <div class="card weather-card mr-3 mb-3">
                    <div class="card-body pb-3 ">
                        <h4 class="card-title font-weight-bold">Warsaw</h4>
                        <p class="card-text">Mon, 12:30 PM, Mostly Sunny</p>
                        <div class="d-flex justify-content-between">
                            <p class="display-1 mr-10  degree">23</p>
                            <i class="fa fa-sun-o fa-5x pt-3 amber-text"></i>
                        </div>
                    </div>
                </div>
                <div class="card weather-card  mr-3 mb-3">
                    <div class="card-body pb-3">
                        <h4 class="card-title font-weight-bold">Warsaw</h4>
                        <p class="card-text">Mon, 12:30 PM, Mostly Sunny</p>
                        <div class="d-flex justify-content-between">
                            <p class="display-1 mr-10  degree">23</p>
                            <i class="fa fa-sun-o fa-5x pt-3 amber-text"></i>
                        </div>
                    </div>
                </div>
                <div class="card weather-card mr-3 mb-3">
                    <div class="card-body pb-3">
                        <h4 class="card-title font-weight-bold">Warsaw</h4>
                        <p class="card-text">Mon, 12:30 PM, Mostly Sunny</p>
                        <div class="d-flex justify-content-between">
                            <p class="display-1 mr-10  degree">23</p>
                            <i class="fa fa-sun-o fa-5x pt-3 amber-text"></i>
                        </div>
                    </div>
                </div>
                <div class="card weather-card mr-3 mb-3">
                    <div class="card-body pb-3">
                        <h4 class="card-title font-weight-bold">Warsaw</h4>
                        <p class="card-text">Mon, 12:30 PM, Mostly Sunny</p>
                        <div class="d-flex justify-content-between">
                            <p class="display-1 mr-10  degree">23</p>
                            <i class="fa fa-sun-o fa-5x pt-3 amber-text"></i>
                        </div>
                    </div>
                </div>
                <div class="card weather-card mr-3 mb-3">
                    <div class="card-body pb-3">
                        <h4 class="card-title font-weight-bold">Warsaw</h4>
                        <p class="card-text">Mon, 12:30 PM, Mostly Sunny</p>
                        <div class="d-flex justify-content-between">
                            <p class="display-1 mr-10  degree">23</p>
                            <i class="fa fa-sun-o fa-5x pt-3 amber-text"></i>
                        </div>
                    </div>
                </div>
                <div class="card weather-card mr-3 mb-3">
                    <div class="card-body pb-3">
                        <h4 class="card-title font-weight-bold">Warsaw</h4>
                        <p class="card-text">Mon, 12:30 PM, Mostly Sunny</p>
                        <div class="d-flex justify-content-between">
                            <p class="display-1 mr-10  degree">23</p>
                            <i class="fa fa-sun-o fa-5x pt-3 amber-text"></i>
                        </div>
                    </div>
                </div>

                    </div>

        </section>
    </div>

@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')

@endsection

