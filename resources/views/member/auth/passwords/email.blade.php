@extends('member.layout.auth')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    SEND RESET PASSWORD LINK: MATHARON
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
    @include('layouts.sidebar')
@endsection

@section('content')
    <!--Section: -->
    <section id="resetLoginforms">
        <!--Description-->
        <p class="description"></p>
        <!--Section: Live preview-->
        <section>
            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-12 col-lg-6 col-xl-5 mx-auto">
                    <section class="form-gradient">
                        <div class="card">
                            <!--Header-->
                            <div class="header pt-3 bg-gray">
                                <div class="row d-flex justify-content-center">
                                    <h3 class="white-text mb-3 pt-3 font-weight-light">RESET PASSWORD</h3>
                                </div>
                            </div>
                            <!--Header-->
                            <div class="card-body mx-4 mt-4">
                                <!--Body-->
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <br>
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/member/password/email') }}">
                                    {{ csrf_field() }}
                                    <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off" autofocus>
                                        <label for="email" >Email</label>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="md-form">
                                        <div class="row d-flex mb-4">
                                            <!--Grid column-->
                                            <div class="col-md-1 col-md-12 d-flex  ml-auto">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-grey btn-rounded z-depth-1a">Send Password Reset Link</button>
                                                </div>
                                            </div>
                                            <!--Grid column-->
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </section>
    </section>
    <!--/Section: -->
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
@endsection


