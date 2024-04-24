@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    DONORS PAGE
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
    <!--Main layout-->
    <main>
        <div class="container-fluid" style="margin-top: -100px;">
            @include('delete')

            <div class="collapse" id="collapseExample">
                <section class="mb-5">

                    <!--Card-->
                    <div class="card card-cascade narrower offset-1 col-md-10">
                        <!--Card header-->
                        <div class="view view-cascade py-3 gradient-card-header info-color-dark mx-4 d-flex justify-content-between align-items-center">
                            <div class="px-5">
                            </div>

                            <a href="" class="white-text mx-3">Donors</a>

                            <div class="px-5">
                            </div>

                        </div>
                        <!--/Card header-->

    <!--Card content-->
    <div class="card-body card-body-cascade">
        <form class="text-center" style="color: #757575;" action="{{route('searchDonor')}}" method="POST" id="searchDonorForm">
        {{csrf_field()}}
        <!-- Name -->
            <div class="form-row">
                <div class="col">
                    <div class="md-form mt-3">
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                        <label for="name">Donor Name</label>
                    </div></div>

                <div class="col">
                    <div class="md-form mt-3">
                        <input type="text" name="mobile_number" id="mobile_number" class="form-control" autocomplete="off">
                        <label for="mobile_number">Mobile No.</label>
                    </div></div>

                <div class="col">
                    <div class="md-form mt-3">
                        <input type="text" name="address" id="address" class="form-control" autocomplete="off">
                        <label for="address">Address</label>
                    </div></div>

            </div>

            {{--<div class="form-row">--}}
                {{--<div class="col">--}}
                    {{--<div class="md-form mt-3">--}}
                        {{--<input type="date" name="from_date" id="from_date" class="form-control">--}}
                        {{--<label for="from_date" class="input-active">From Date</label>--}}
                    {{--</div></div>--}}

                {{--<div class="col">--}}
                    {{--<div class="md-form mt-3">--}}
                        {{--<input type="date" name="to_date" id="to_date" class="form-control">--}}
                        {{--<label for="to_date" class="input-active">To Date</label>--}}
                    {{--</div></div>--}}

                {{--<div class="col">--}}
                    {{--<select name="dialysis_type" id="dialysis_type" class="mdb-select colorful-select dropdown-primary">--}}
                        {{--<option>Select Type</option>--}}
                        {{--<option value="free">Free</option>--}}
                        {{--<option value="special">Special</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
            {{--</div>--}}

            <!-- Send button -->
            <div class="row">
                <div class="col">

                </div>
                <div class="col">
                    <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" id="searchDonorBtn" type="submit">Search</button>
                </div>
                <div class="col">
                    <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" onclick="resetSearchForm()" type="reset">Reset</button>
                </div>
                <div class="col">

                </div>
            </div>

        </form>

    </div>
    <!--/.Card content-->

                    </div>
                    <!--/.Card-->

                </section>
            </div>
            <br>
            <section class="mb-5">

                <!--Card-->
                <div class="card card-cascade narrower">

                    <!--Card header-->
                    <div class="view view-cascade py-3 gradient-card-header info-color-dark mx-4 d-flex justify-content-between align-items-center">

                        <div>
                            <a class="btn btn-default btn-rounded mb-4" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-filter mt-0"></i>
                            </a>

                        </div>

                        <a href="" class="white-text mx-3">Donors List</a>

                        <div class="text-center">
                            <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalVM"><i class="fa fa-plus mt-0"></i></a></div>
                    </div>
                    <!--/Card header-->

                    <!--Card content-->
                    <div class="card-body card-body-cascade">

                        <div class="table-responsive text-nowrap">

                            <table id="list" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="th-sm">Donors Name
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Mobile
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Gender
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Quantity
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Dialysis Type
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Action
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>

                        </div>

                    </div>
                    <!--/.Card content-->

                </div>
                <!--/.Card-->

            </section>
            <!--Section: Table-->



        </div>
    </main>
@endsection

@section('edit')
    @include('donor.edit')
@endsection

@section('create')
    @include('donor.create')
@endsection

@section('show')
    @include('donor.show')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('donor.ajax')
@endsection


