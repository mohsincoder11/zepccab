@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    Comapny PAGE
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
                                    <th class="th-sm">Company Name
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Mobile Number
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                   
                                    <th class="th-sm">Alternate Contact Number
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Email
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Person Name
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Designation
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Person Number
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th> 
                                    <th class="th-sm">Selected Pacakge
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th-sm">Action
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated dynamically from the server -->
                            </tbody>
                        </table>
                        

                    </div>
                    <!--Bottom Table UI-->
                </div>
                <!--/.Card content-->
            </div>
            <a title="Add City" href="" class="btn-floating gray fixed-bottom-right open_modal2" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus mt-0"></i></a>
        </section>
        <!--Section: Table-->

    </div>
@endsection

@section('edit')
    @include('company.edit')
@endsection

@section('create')
    @include('company.create')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('company.ajax')

    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyC1Cz13aBYAbBYJL0oABZ8KZnd7imiWwA4&libraries=places&components=country:in" >
    </script>
    <script>
         $(document).on('click','.open_modal2', function(){
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
    componentRestrictions: {country: "in"},
    types: ['(cities)'],

    };
    var input = document.getElementById('city_name');
        var autocomplete = new google.maps.places.Autocomplete(input,options);
    
        autocomplete.addListener('place_changed', function () {
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
        var autocomplete = new google.maps.places.Autocomplete(input,options);
    
        autocomplete.addListener('place_changed', function () {
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

