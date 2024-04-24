@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    CUSTOMER PAGE
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
{{--                    <a class="btn-floating btn-sm btn-filter"  data-toggle="modal" data-target="#searchModal" title="Filter Student">--}}
{{--                        <i class="fa fa-filter mt-0" aria-hidden="true"></i>--}}
{{--                    </a>--}}
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
                                <th class="th-sm">Travel Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Car Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Travel Date & Time
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Enq Date & Time
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Destination Details
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Ride Details
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								 <th class="th-sm">Coupon Details
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">OTP
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Added By
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
@if(Auth::guard('admin')->user()->role=='1')
            <a title="Add Customer" ONCLICK="getCustomer();" href="" class="btn-floating gray fixed-bottom-right" data-toggle="modal" data-target="#modalVM"><i class="fa fa-plus mt-0"></i></a>
            @endif

        </section>

    </div>
@endsection

@section('delete')
    @include('delete')
@endsection

@section('search')
    @include('customer.search')
@endsection

@section('edit')
    @include('customer.edit')
@endsection

@section('create')
    @include('customer.create')
@endsection

@section('show')
    @include('customer.show')
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
		
		
		
		
		 function showDiv(divId, element)
        {
            if (element.value == "ride_later")
            {
                document.getElementById('purpose').style.display = 'block';
            }
			else
			{
				document.getElementById('purpose').style.display = 'none';
			}
        }
        
    </script>
    @include('customer.ajax')

 <script type="text/javascript">
        function codeAddress() {
            getCustomer();
        }
        window.onload = codeAddress;
    $(window).on('load', function(){
        $('.custom-select2').select2({
            placeholder: "Search for a customer...",
            theme: "classic", // You can change the theme as neede
        dropdownParent: $('#modalVM .modal-content')
    });
    $('#driver_id').select2({
            placeholder: "Search for a driver...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#modalVM .modal-content')

        });
        $('#driver_list').select2({
            placeholder: "Search for a driver...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#editModal .modal-content')

        });
    $(document).on('click','.open_modal2', function(){
            setTimeout(() => {
            $('#from_location').focus();
            $('#to_location').focus();
            $('#from_location').focus();
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
}
</script>

@endsection


