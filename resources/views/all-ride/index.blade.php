@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
   All Rides Page
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
        
        <section class="mb-5">
            <!--Card-->
            <div class="card card-cascade narrower">
               
                <div class="card-body card-body-cascade">

                    <div class="table-responsive">
                        <div class="row">
                               
                                <div class="col-md-4">
                                <select name="type" id="type" class="select-wrapper mdb-select colorful-select dropdown-primary">
                                    <option value="All">All Ride</option>
                                    <option value="Local">Local Ride</option>
                                    <option value="Rental">Rental Ride</option>
                                    <option value="Outstation">Outstation Ride</option>
                                </select>
                                </div>
                        </div>
                        <table id="list" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                              
                                <th class="th-sm">Ref No
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th> 
                                <th class="th-sm">Ride Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Travel Date
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Customer Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								
								{{-- <th class="th-sm">Driver Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th> --}}
								
								 <th class="th-sm">Mobile Number
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                               
                                <th class="th-sm">Destination Details
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

        </section>
        <!--Section: Table-->

    </div>
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('all-ride.ajax')
   
   
    
@endsection

