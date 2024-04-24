@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    SOS PAGE
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
    <div class="container-fluid" >
        @include('delete')

        <section class="mb-5">
            <!--Card-->
            <div class="card card-cascade narrower">

                <div class="card-body card-body-cascade">

                    <div class="table-responsive">
                        <table id="list" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="th-sm">City Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Police Station Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Phone Number
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Address
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
                    <!--Bottom Table UI-->
                </div>
                <!--/.Card content-->
            </div>
            <a title="Add SOS" href="" class="btn-floating gray fixed-bottom-right" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus mt-0"></i></a>
        </section>
        <!--Section: Table-->

    </div>
@endsection

@section('create')
    @include('sos.create')
@endsection

@section('edit')
    @include('sos.edit')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('sos.ajax')
@endsection

