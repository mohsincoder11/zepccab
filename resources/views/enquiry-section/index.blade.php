@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    Enquiry Section
@endsection

@section('head')
    @include('layouts.head')
    <style>
        .hidespan{
            visibility: hidden;
            display: none;
        }
    </style>
   
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
                {{-- <div class="card-body card-body-cascade">
             
                    <div class="table-responsive text-nowrap">

                        <table id="list" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="th-sm">Ref No
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Customer Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Mobile
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                               
                                <th class="th-sm">Ride Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Car Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Date & Time
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">No of Days
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Rate
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Destination Details
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                               
								<th class="th-sm">Added By
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Status
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

                </div> --}}

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
                                <th class="th-sm">Status
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
            <!--/.Card-->
        @if(Auth::guard('admin')->user()->role=='1')
            <a title="Add Customer" ONCLICK="getCustomer();" href="" class="btn-floating gray fixed-bottom-right open_modal2" data-toggle="modal" data-target="#modalVM"><i class="fa fa-plus mt-0"></i></a>
            @endif

        </section>

    </div>
@endsection

@section('delete')
    @include('delete')
@endsection

@section('search')
    @include('enquiry-section.search')
@endsection

@section('edit')
    @include('enquiry-section.edit')
@endsection

@section('create')
    @include('enquiry-section.create')
@endsection

@section('show')
    @include('enquiry-section.show')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')

    <script>
        function disableTab(element,condition) {
            if(condition){
                $(element).addClass('disabled')
            }
            else{
                $(element).removeClass('disabled');
                $(element).find('.nav-link').click();
            }
        }
		
		
		
		
		 function showDiv(divId, element,ride_type)
        {
            if(ride_type=='local'){
                if (element.value == "ride_later")
                {
                    document.getElementById('local_purpose').style.display = 'block';
                }
                else
                {
                    document.getElementById('local_purpose').style.display = 'none';
                }
            }
            else if(ride_type=='rental'){
                if (element.value == "ride_later")
                {
                    document.getElementById('rental_purpose').style.display = 'block';
                }
                else
                {
                    document.getElementById('rental_purpose').style.display = 'none';
                }
            }
            else if(ride_type=='local2'){
                if (element.value == "ride_later")
                {
                    document.getElementById('local2_purpose').style.display = 'block';
                }
                else
                {
                    document.getElementById('local2_purpose').style.display = 'none';
                }
            }
            else if(ride_type=='edit_local2'){
                if (element.value == "ride_later")
                {
                    document.getElementById('edit_local2_purpose').style.display = 'block';
                }
                else
                {
                    document.getElementById('edit_local2_purpose').style.display = 'none';
                }
            }
            else if(ride_type=='rental2'){
                if (element.value == "ride_later")
                {
                    document.getElementById('rental2_purpose').style.display = 'block';
                }
                else
                {
                    document.getElementById('rental2_purpose').style.display = 'none';
                }
            }
            else if(ride_type=='edit_rental2'){
                if (element.value == "ride_later")
                {
                    document.getElementById('edit_rental2_purpose').style.display = 'block';
                }
                else
                {
                    document.getElementById('edit_rental2_purpose').style.display = 'none';
                }
            }
        }
        
    </script>
    @include('enquiry-section.ajax')

 <script type="text/javascript">
        function codeAddress() {
            getCustomer();
        }
        window.onload = codeAddress;
    $(window).on('load', function(){
        $('.custom-select2').select2({
        dropdownParent: $('#modalVM .modal-content')
    });
    $('.custom-select22').select2({
        dropdownParent: $('#editModal .modal-content')
    });

    $('.custom-select2local').select2({
        dropdownParent: $('#localModal .modal-content')
    });
    $('.custom-select2rental').select2({
        dropdownParent: $('#rentalModal .modal-content')
    });
    $('.custom-select2outstation').select2({
        dropdownParent: $('#outstationModal .modal-content')
    });

    $('#customer_list').select2({
            placeholder: "Search for a customer...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#modalVM .modal-content')

        });

        $('#local2_customer_list').select2({
            placeholder: "Search for a customer...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#localModal .modal-content')

        });
        $('#edit_local2_customer_list').select2({
            placeholder: "Search for a customer...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#edit_localModal .modal-content')

        });
        
        $('#local2_driver_id').select2({
            placeholder: "Search for a driver...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#localModal .modal-content')

        });

        $('#outstation2_customer_list').select2({
            placeholder: "Search for a customer...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#outstationModal .modal-content')

        });

        $('#edit_outstation2_customer_list').select2({
            placeholder: "Search for a customer...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#edit_outstationModal .modal-content')

        });

        $('#outstation2_driver_id').select2({
            placeholder: "Search for a customer...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#outstationModal .modal-content')

        });

        $('#rental2_customer_list').select2({
            placeholder: "Search for a customer...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#rentalModal .modal-content')

        });

        $('#edit_rental2_customer_list').select2({
            placeholder: "Search for a customer...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#edit_rentalModal .modal-content')

        });

        $('#rental2_driver_id').select2({
            placeholder: "Search for a driver...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#rentalModal .modal-content')

        });

        
        
        

    
    

    $(document).on('click','.open_modal2', function(){
            setTimeout(() => {
            $('#from_location').focus();
            $('#to_location').focus();
            $('#from_location').focus();
            $('#rental_pick_location').focus();
            
        }, 700); 
    });
    });
	
    </script>


<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyC1Cz13aBYAbBYJL0oABZ8KZnd7imiWwA4&libraries=places&components=country:in" >
</script>
<script>
google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
    var options = {
componentRestrictions: {country: "in"}
};
    //localride
    var input = document.getElementById('from_location');
    var autocomplete = new google.maps.places.Autocomplete(input,options);
    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        $('#from_latitude').val(place.geometry['location'].lat());
        $('#from_longitude').val(place.geometry['location'].lng());
        setTimeout(() => {
        $('#from_latitude').focus();
        $('#from_longitude').focus();
        $('#to_location').focus();
        }, 500); 
    });
    var input2 = document.getElementById('to_location');
    var autocomplete2 = new google.maps.places.Autocomplete(input2,options);
    autocomplete2.addListener('place_changed', function () {
        var place2 = autocomplete2.getPlace();
        $('#to_latitude').val(place2.geometry['location'].lat());
        $('#to_longitude').val(place2.geometry['location'].lng());
        setTimeout(() => {
        $('#to_latitude').focus();
        $('#to_longitude').focus();
        }, 500); 
    });

    //localride edit
    var input21 = document.getElementById('edit_local2_from_location');
    var autocomplete21 = new google.maps.places.Autocomplete(input21,options);
    autocomplete21.addListener('place_changed', function () {
        var place21 = autocomplete21.getPlace();
        $('#edit_local2_from_latitude').val(place21.geometry['location'].lat());
        $('#edit_local2_from_longitude').val(place21.geometry['location'].lng());
        setTimeout(() => {
        $('#edit_local2_from_latitude').focus();
        $('#edit_local2_from_longitude').focus();
        $('#edit_local2_to_location').focus();
        }, 500); 
    });
    var input22 = document.getElementById('edit_local2_to_location');
    var autocomplete22 = new google.maps.places.Autocomplete(input22,options);
    autocomplete22.addListener('place_changed', function () {
        var place22 = autocomplete22.getPlace();
        $('#edit_local2_to_latitude').val(place22.geometry['location'].lat());
        $('#edit_local2_to_longitude').val(place22.geometry['location'].lng());
        setTimeout(() => {
        $('#edit_local2_to_latitude').focus();
        $('#edit_local2_to_longitude').focus();
        }, 500); 
    });


    //rental ride
    var rental_input = document.getElementById('rental_pick_location');
    var rental_autocomplete = new google.maps.places.Autocomplete(rental_input,options);
    rental_autocomplete.addListener('place_changed', function () {
        var rental_place = rental_autocomplete.getPlace();
        $('#rental_from_lat').val(rental_place.geometry['location'].lat());
        $('#rental_from_lng').val(rental_place.geometry['location'].lng());
        setTimeout(() => {
        $('#rental_from_lat').focus();
        $('#rental_from_lng').focus();
        }, 500); 
    });

    //edit rental ride
    var rental_input2 = document.getElementById('edit_rental2_pick_location');
    var rental_autocomplete2 = new google.maps.places.Autocomplete(rental_input2,options);
    rental_autocomplete2.addListener('place_changed', function () {
        var rental_place2 = rental_autocomplete2.getPlace();
        $('#edit_rental2_from_lat').val(rental_place2.geometry['location'].lat());
        $('#edit_rental2_from_lng').val(rental_place2.geometry['location'].lng());
        setTimeout(() => {
        $('#edit_rental2_from_lat').focus();
        $('#edit_rental2_from_lng').focus();
        }, 500); 
    });


    //outstation
    var outstation_input = document.getElementById('outstation_from_origin');
    var outstation_autocomplete = new google.maps.places.Autocomplete(outstation_input,options);
    outstation_autocomplete.addListener('place_changed', function () {
        var outstation_place = outstation_autocomplete.getPlace();
        $('#outstation_from_lat').val(outstation_place.geometry['location'].lat());
        $('#outstation_from_lng').val(outstation_place.geometry['location'].lng());
        setTimeout(() => {
        $('#outstation_from_lat').focus();
        $('#outstation_from_lng').focus();
        $('#outstation_to_destination').focus();
        }, 500); 
    });

    var outstation_to_destination_input = document.getElementById('outstation_to_destination');
    var outstation_to_destination_autocomplete = new google.maps.places.Autocomplete(outstation_to_destination_input,options);
    outstation_to_destination_autocomplete.addListener('place_changed', function () {
       
        setTimeout(() => {
      
        $('#outstation_to_destination').focus();
        }, 500); 
    });

     //outstation edit
     var outstation_input2 = document.getElementById('edit_outstation_from_origin');
    var outstation_autocomplete2 = new google.maps.places.Autocomplete(outstation_input2,options);
    outstation_autocomplete2.addListener('place_changed', function () {
        var outstation_place2 = outstation_autocomplete2.getPlace();
        $('#edit_outstation_from_lat').val(outstation_place2.geometry['location'].lat());
        $('#edit_outstation_from_lng').val(outstation_place2.geometry['location'].lng());
        setTimeout(() => {
        $('#edit_outstation_from_lat').focus();
        $('#edit_outstation_from_lng').focus();
        $('#edit_outstation_to_destination').focus();
        }, 500); 
    });

    var outstation_to_destination_input2 = document.getElementById('edit_outstation_to_destination');
    var outstation_to_destination_autocomplete2 = new google.maps.places.Autocomplete(outstation_to_destination_input2,options);
    outstation_to_destination_autocomplete2.addListener('place_changed', function () {
       
        setTimeout(() => {
      
        $('#edit_outstation_to_destination').focus();
        }, 500); 
    });
   
}
</script>

@endsection


