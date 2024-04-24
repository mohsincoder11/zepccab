@extends('member.layout.auth')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    REGISTER : MATHARON
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

@section('content')

    <!--Section: -->
    <section id="contactforms">
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
                                    <h3 class="white-text mb-3 pt-3 font-weight-light">REGISTER</h3>
                                </div>
                                <div class="row mt-2 mb-3 d-flex justify-content-center">
                                <!--Facebook-->
                                <a class="icons-sm fb-ic mx-2"><i class="fa fa-facebook white-text fa-lg"> </i></a>
                                <!--Twitter-->
                                <a class="icons-sm tw-ic mx-2"><i class="fa fa-twitter white-text fa-lg"> </i></a>
                                <!--Google +-->
                                <a class="icons-sm gplus-ic mx-2"><i class="fa fa-google-plus white-text fa-lg"> </i></a>
                                </div>
                            </div>
                            <!--Header-->
                            <div class="card-body mx-4 mt-4">
                                <!--Body-->
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/member/register') }}">
                                    {{ csrf_field() }}
                                    <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus autocomplete="off">
                                        <label for="name">Name</label>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off">
                                        <label for="email" >Email</label>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input id="password" type="password" class="form-control" name="password" autocomplete="off">
                                        <label for="password">Password</label>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="md-form{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off">
                                        <label for="password-confirm">Confirm Password</label>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="md-form">
                                        <div class="row d-flex mb-4">
                                            <!--Grid column-->
                                            <div class="col-md-1 col-md-12 d-flex  ml-auto">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-grey btn-rounded z-depth-1a">REGISTER</button>
                                                </div>
                                                <div class="text-center" style="margin-top: 20px; margin-left: 20px">
                                                    <a class="gray-text font-weight-normal" href="{{ url('/member/login') }}">
                                                        Already have account.
                                                    </a>
                                                </div>
                                            </div>
                                            <!--Grid column-->
                                        </div>
                                    </div>
                                </form>
                                <!--Grid row-->
                                <!--Grid row-->
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
