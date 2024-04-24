@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    OUT STATION PAGE
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
    <div class="container-fluid">
        @include('delete')

        <section class="mb-5">
            <!--Card-->
            <div class="card card-cascade narrower">

                <div class="card-body card-body-cascade">

                    <div class="table-responsive">
                        <div class="row">
                               
                            <div class="col-md-3">
                                <select name="type" id="type" class="select-wrapper mdb-select colorful-select dropdown-primary">
                                    <option value="All">All Ride</option>
                                    <option value="1">Zep Cab Ride</option>
                                    <option value="2">Company Ride</option>
                                    <option value="3">Vendor Ride</option>
                                </select>
                                </div>
                                <div class="col-md-3">
                                <div class="md-form mt-3">
                                    <label for="date-picker-example" style="margin-top: -30px;">From Date</label>
                                    <input placeholder="From date" type="date" name="from_date" id="from_date_filter" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="md-form mt-3">
                                    <label for="date-picker-example" style="margin-top: -30px;">To Date</label>
                                    <input placeholder="To date" type="date" name="to_date" id="to_date_filter" class="form-control">
                                </div>
                            </div>

                               

                    </div>
                        <table id="list" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="th-sm">Ref No
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>

                                    <th class="th-sm">Travel Date
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Enq Date & Time
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

                                    <th class="th-sm">From
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Stops
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>

                                    <th class="th-sm">To
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Distance
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Company
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Vendor
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>

                                    <th class="th-sm">Car Type
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>

                                    <th class="th-sm">Days
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>

                                    <th class="th-sm">Trip Type
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>


                                    <th class="th-sm">Time From / Time To
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>

                                    <th class="th-sm">Driver Link
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Amount
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Otp
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Status
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Per Km Amount
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Per Day Amount
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Per Day Desc
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Per Km Desc
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Waiting Charge
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Toll & Parking Desc
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Night Hault Desc
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Fixed Rate
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Coupon Details
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Billing Print
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
            @if (Auth::guard('admin')->user()->role == '1')
                <a title="Add Rental" href="" ONCLICK="getCustomer();"
                    class="btn-floating gray fixed-bottom-right open_modal2" data-toggle="modal"
                    data-target="#createModal"><i class="fa fa-plus mt-0"></i></a>
            @endif
        </section>
        <!--Section: Table-->

    </div>
@endsection

@section('create')
    @include('rental.create')
@endsection

@section('edit')
    @include('rental.edit')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('rental.ajax')
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key=AIzaSyC1Cz13aBYAbBYJL0oABZ8KZnd7imiWwA4&libraries=places&components=country:in">
    </script>

    <script type="text/javascript">
        function codeAddress() {
            getCustomer();
        }
        window.onload = codeAddress;
        $(window).on('load', function() {
            $(document).on('click', '.open_modal2', function() {
                setTimeout(() => {
                    $('#from_origin').focus();
                    $('#to_destination').focus();
                    $('#from_origin').focus();

                }, 500);
            })

            $('.custom-select2').select2({
                dropdownParent: $('#createModal .modal-content'),
                theme: "classic", // You can change the theme as needed
                placeholder: "Search for a customer...",

            });

            $('#driver_id').select2({
                dropdownParent: $('#createModal .modal-content'),
                theme: "classic", // You can change the theme as needed
                placeholder: "Search for a driver...",
            });
            $('#driver_id_edit').select2({
                dropdownParent: $('#editModal .modal-content'),
                theme: "classic", // You can change the theme as needed
                placeholder: "Search for a driver...",
            });
        })
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var options = {
                componentRestrictions: {
                    country: "in"
                }
            };
            var input = document.getElementById('from_origin');
            var autocomplete = new google.maps.places.Autocomplete(input, options);
            var input2 = document.getElementById('to_destination');
            var autocomplete2 = new google.maps.places.Autocomplete(input2, options);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $('#from_lat').val(place.geometry['location'].lat());
                $('#from_lng').val(place.geometry['location'].lng());
                setTimeout(() => {
                    $('#from_lat').focus();
                    $('#from_lng').focus();
                    $('#to_destination').focus();
                }, 1000);

            });
        }
    </script>
@endsection
