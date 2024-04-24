
@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    PATIENTS PAGE
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

                            <a href="" class="white-text mx-3">Patient</a>

                            <div class="px-5">
                            </div>

                        </div>
                        <!--/Card header-->

                        <!--Card content-->
                        <div class="card-body card-body-cascade">
                            <form class="text-center" style="color: #757575;" action="{{route('searchPatient')}}" method="POST" id="searchPatientForm">
                            {{csrf_field()}}
                            <!-- Name -->
                                <div class="form-row">
                                    <div class="col">
                                        <div class="md-form mt-3">
                                            <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                                            <label for="name">Patient Name</label>
                                        </div></div>

                                    <div class="col">
                                        <div class="md-form mt-3">
                                            <input type="text" name="mobile_no" id="mobile_no" class="form-control" autocomplete="off">
                                            <label for="mobile_no">Mobile No.</label>
                                        </div></div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="md-form mt-3">
                                            <input type="text" name="address" id="address" class="form-control" autocomplete="off">
                                            <label for="address">Address</label>
                                        </div></div>
                                </div>

                                <!-- Send button -->
                                <div class="row">
                                    <div class="col">

                                    </div>
                                    <div class="col">
                                        <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" id="searchStudentBtn" type="submit">Search</button>
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

                        <a href="" class="white-text mx-3">Patients List</a>

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
                                    <th class="th-sm">Patient Name
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Age
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Gender
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Mobile
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
    @include('free.edit')
@endsection

@section('create')
    @include('free.create')
@endsection

@section('show')
    @include('free.show')
@endsection

@section('report')
    @include('free.report')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('free.ajax')
@endsection


