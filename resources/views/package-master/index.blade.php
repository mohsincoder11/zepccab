@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    Package Master
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
                                <select name="type" id="type"
                                    class="select-wrapper mdb-select colorful-select dropdown-primary">
                                    <option value="All">All Package</option>
                                    <option value="Company">Company Package</option>
                                    <option value="Vendor">Vendor Package</option>
                                </select>
                            </div>
                        </div>
                        <table id="list" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>

                                    <th class="th-sm">Package Title
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Package Type
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Per KM Amount
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Per Day Amount
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Per Day Description
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Per KM Description
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Waiting Charge
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Toll & Parking Description
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Night Hault Description
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Fixed Rate
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
            <a title="Add City" href="" class="btn-floating gray fixed-bottom-right open_modal2" data-toggle="modal"
                data-target="#createModal"><i class="fa fa-plus mt-0"></i></a>
        </section>
        <!--Section: Table-->

    </div>
@endsection

@section('edit')
    @include('package-master.edit')
@endsection

@section('create')
    @include('package-master.create')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('package-master.ajax')

    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key=AIzaSyC1Cz13aBYAbBYJL0oABZ8KZnd7imiWwA4&libraries=places&components=country:in">
    </script>
    <script>
        $(document).on('click', '.open_modal2', function() {
            setTimeout(() => {
                $('#city_name').focus();
                $("#edit_city_name").focus();
                $("#edit_latitude").focus();
                $("#edit_longitude").focus();
                $("#edit_radius_km").focus();
                $("#edit_mobile_no").focus();

            }, 700);
        });
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {

            var options = {
                componentRestrictions: {
                    country: "in"
                },
                types: ['(cities)'],

            };
            var input = document.getElementById('city_name');
            var autocomplete = new google.maps.places.Autocomplete(input, options);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $("#city_name").val(place.name);

                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
                setTimeout(() => {
                    $('#latitude').focus();
                    $('#longitude').focus();
                    $('#radius_km').focus();
                }, 500);
            });

            var input = document.getElementById('edit_city_name');
            var autocomplete = new google.maps.places.Autocomplete(input, options);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $("#edit_city_name").val(place.name);

                $('#edit_latitude').val(place.geometry['location'].lat());
                $('#edit_longitude').val(place.geometry['location'].lng());
                setTimeout(() => {
                    $('#edit_latitude').focus();
                    $('#edit_longitude').focus();
                    $('#edit_radius_km').focus();
                }, 500);
            });


        }
    </script>
@endsection
