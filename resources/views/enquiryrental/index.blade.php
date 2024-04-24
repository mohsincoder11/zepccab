@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    ENQUIRY PAGE
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
								 <th class="th-sm">Ref No
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Customer Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Mobile Number
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                
                                 <th class="th-sm">Package Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                
                                 <th class="th-sm">Car Type Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								
								 <th class="th-sm">Driver Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								
                                <th class="th-sm">Travel Date & Time
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Enq Date & Time
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								
								<th class="th-sm">Amount
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Destination Details
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Coupon Details
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Ride Details
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Otp
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Status
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
                    <!--Bottom Table UI-->
                </div>
                <!--/.Card content-->
            </div>
@if(Auth::guard('admin')->user()->role=='1')
			
			 <a title="Add Rental" ONCLICK="getCustomer();" href="" class="btn-floating gray fixed-bottom-right open_modal2" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus mt-0"></i></a>
             @endif

        </section>
        <!--Section: Table-->

    </div>
@endsection


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Link To Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('updateLinkDriverRental')}}" method="POST" id="editForm">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col" style="margin-bottom:20px;">
                            <select name="driver_id" id="driver_id" class="custom-select2" style="width:100%;">
                                <option value="">Select Driver</option>
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    $drivers =DB::table('driver')->select('id','first_name','last_name')->orderBy('first_name','ASC')->get();
                                @endphp
                                @foreach( $drivers as $driver )
                                    <option value="{{$driver->id}}">{{$driver->first_name}} {{$driver->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="editBtn" id="editBtn" type="submit">Link</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

@section('create')
    @include('enquiryrental.create')
@endsection

@section('edit')
    @include('enquiryrental.edit')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('enquiryrental.ajax')

<script>
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
        $(window).on('load', function(){
            
            $('#customer_list').select2({
            placeholder: "Search for a customer...",
            theme: "classic", // You can change the theme as neede
        dropdownParent: $('#createModal .modal-content')
    });
    $('#driver_id12').select2({
            placeholder: "Search for a driver...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#createModal .modal-content')

        });

        $('#driver_id').select2({
            placeholder: "Search for a driver...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#editModal .modal-content')

        });
        $('#driver_list').select2({
            placeholder: "Search for a driver...",
            theme: "classic", // You can change the theme as needed
            dropdownParent: $('#editModalRental .modal-content')

        });
        
        $(document).on('click','.open_modal2', function(){
            setTimeout(() => {
            $('#pick_location').focus();
        }, 700); 
                
            })
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
    var input = document.getElementById('pick_location');
    var autocomplete = new google.maps.places.Autocomplete(input,options);

    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        $('#from_lat').val(place.geometry['location'].lat());
        $('#from_lng').val(place.geometry['location'].lng());
        setTimeout(() => {
        $('#from_lat').focus();
        $('#from_lng').focus();
        $('#distance_driver_user_km').focus();
        

        }, 500); 
       

       
    });
}
</script>

@endsection

