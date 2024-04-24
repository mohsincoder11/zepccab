<!--Modal: modalVM-->
<div class="modal fade" id="modalVM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Enquiry</h5>

            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="" method="POST" id="EnquiryForm">
                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="col-md-10">
                            <select name="customer_id" id="customer_list" class="custom-select2 customer_list"
                                style="width:100%">
                                <option value="">Select Customer</option>

                            </select>
                        </div>
                        <a style="background-color: #f77014; margin-top: 18px;" class="btn-floating btn-sm "
                            data-toggle="modal" data-target="#modalAddCustomer">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="ride_type" id="ride_type" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Ride Type</option>
                                <option value="ctl">Local</option>
                                <option value="cpl">Rental</option>
                                <option value="outstation">OutStation</option>

                            </select>
                        </div>
                    </div>

                    <span class="ride_span" id="local_ride">
                        
                        <div class="form-row">
                            <div class="col">
                                <select name="local_travel_type" id="travel_type" onchange="showDiv('hidden_div', this,'local');"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Travel Type</option>
                                    <option value="ride_now">Ride Now</option>
                                    <option value="ride_later">Ride Later</option>
                                </select>
                            </div>
                            <div class="col">
                                <select name="local_car_type_id" id="car_type_id"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Car Type</option>
                                    @php
                                        $cars_type = DB::table('car_types')
                                            ->select('id', 'name')
                                            ->groupby('name')
                                            ->get();
                                    @endphp
                                    @foreach ($cars_type as $carstype)
                                        <option value="{{ $carstype->id }}">{{ $carstype->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="from_location" name="local_from_location" class="form-control"
                                        autocomplete="off">
                                    <label for="from_location">From Location</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="to_location" name="local_to_location" class="form-control"
                                        autocomplete="off">
                                    <label for="to_location">To Location</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="from_latitude" name="local_from_latitude" class="form-control"
                                        autocomplete="off">
                                    <label for="from_latitude">From Latitude</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="from_longitude" name="local_from_longitude" class="form-control"
                                        autocomplete="off">
                                    <label for="from_longitude">From Longitude</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="to_latitude" name="local_to_latitude" class="form-control"
                                        autocomplete="off">
                                    <label for="to_latitude">To Latitude</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="to_longitude" name="local_to_longitude" class="form-control"
                                        autocomplete="off">
                                    <label for="to_longitude">To Longitude</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row" id="local_purpose" style="display:none">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="date" id="ride_later_date" name="local_ride_later_date"
                                        class="form-control" autocomplete="off">
                                    <label for="ride_later_date" class="input-active">Date</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="time" id="ride_later_time" name="local_ride_later_time"
                                        class="form-control" autocomplete="off">
                                    <label for="ride_later_time" class="input-active">Time</label>
                                </div>
                            </div>
                        </div>

                    </span>

                    <span class="ride_span" id="rental_ride">

                        <div class="form-row">
                            <div class="col">
                                <select name="rental_city_id" id="rental_city_id" onchange="getPackagesList(this.value);"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select City</option>
                                    @php
                                        use Illuminate\Support\Facades\DB;
                                        $cities = DB::table('city')
                                            ->select('id', 'name')
                                            ->get();
                                    @endphp
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select name="rental_package_id" id="rental_package_list"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Package</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <select name="rental_cartype_id" id="rental_cartype_id"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Car Type</option>
                                    @php
                                        $cartypes = DB::table('car_types')
                                            ->select('id', 'name')
                                            ->groupBy('name')
                                            ->get();
                                    @endphp
                                    @foreach ($cartypes as $cartype)
                                        <option value="{{ $cartype->id }}">{{ $cartype->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental_amount" name="rental_amount" class="form-control"
                                        autocomplete="off">
                                    <label for="amount">Amount</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <select name="rental_travel_type" id="rental_travel_type"
                                    onchange="showDiv('hidden_div', this,'rental');"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Travel Type</option>
                                    <option value="ride_now">Ride Now</option>
                                    <option value="ride_later">Ride Later</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row" id="rental_purpose" style="display:none">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="date" id="rental_ride_later_date" name="rental_ride_later_date"
                                        class="form-control" autocomplete="off">
                                    <label for="ride_later_date" class="input-active">Date</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="time" id="rental_ride_later_time" name="rental_ride_later_time"
                                        class="form-control" autocomplete="off">
                                    <label for="ride_later_time" class="input-active">Time</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label>Start Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="rental_start_time" name="rental_start_time"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="col">
                                <label>End Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="rental_end_time" name="rental_end_time" class="form-control"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental_pick_location" name="rental_pick_location"
                                        class="form-control" autocomplete="off">
                                    <label for="pick_location">Pick Location</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental_from_lat" name="rental_latitude" class="form-control"
                                        autocomplete="off">
                                    <label for="from_lat">From Lat</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental_from_lng" name="rental_longitude" class="form-control"
                                        autocomplete="off">
                                    <label for="from_lng">From Long</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental_distance_driver_user_km"
                                        name="rental_distance_driver_user_km" class="form-control" autocomplete="off">
                                    <label for="distance_driver_user_km">Distance Driver User Km</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental_distance_user_destination_km"
                                        name="rental_distance_user_destination_km" class="form-control" autocomplete="off">
                                    <label for="distance_user_destination_km">Distance User Destination Km</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental_custoemr_amount" name="rental_custoemr_amount"
                                        class="form-control" autocomplete="off">
                                    <label for="custoemr_amount">Customer Amount</label>
                                </div>
                            </div>
                        </div>
                    </span>

                    <span class="ride_span" id="outstation_ride">

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_from_origin" name="outstation_from_origin"
                                        class="form-control">
                                    <label for="from_origin">From Origin</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_to_destination" name="outstation_to_destination"
                                        class="form-control">
                                    <label for="to_destination">To Destination</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <select name="outstation_car_type_id" id="outstation_car_type_id"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Car Type</option>
                                    @php
                                        $cartypes = DB::table('car_types')
                                            ->select('id', 'name')
                                            ->groupBy('name')
                                            ->get();
                                    @endphp
                                    @foreach ($cartypes as $cartype)
                                        <option value="{{ $cartype->id }}">{{ $cartype->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select name="outstation_type" id="outstation_type"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Type</option>
                                    <option value="one_way">One Way</option>
                                    <option value="round_trip">Round Trip</option>
                                </select>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_days" name="outstation_days" class="form-control"
                                        autocomplete="off">
                                    <label for="days">Days</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="date" id="outstation_date" name="outstation_date" class="form-control"
                                        autocomplete="off">
                                    <label for="date" class="input-active">Date</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label>From Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="outstation_from_time" name="outstation_from_time"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <label>To Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="outstation_to_time" name="outstation_to_time"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_from_lat" name="outstation_from_lat"
                                        class="form-control" autocomplete="off">
                                    <label for="from_lat">From Lat</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_from_lng" name="outstation_from_lng"
                                        class="form-control" autocomplete="off">
                                    <label for="from_lng">From Long</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_perkm_amount" name="outstation_perkm_amount"
                                        class="form-control" autocomplete="off">
                                    <label for="perkm_amount">Per Km Amount</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_per_day_amount" name="outstation_per_day_amount"
                                        class="form-control" autocomplete="off">
                                    <label for="per_day_amount">Per Day Amount</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_per_day_desc" name="outstation_per_day_desc"
                                        class="form-control" autocomplete="off">
                                    <label for="per_day_desc">Per Day Desc</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_per_km_desc" name="outstation_per_km_desc"
                                        class="form-control" autocomplete="off">
                                    <label for="per_km_desc">Per Km Desc</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_waiting_charge" name="outstation_waiting_charge"
                                        class="form-control" autocomplete="off">
                                    <label for="waiting_charge">Waiting Charge</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_toll_n_parking_desc"
                                        name="outstation_toll_n_parking_desc" class="form-control" autocomplete="off">
                                    <label for="toll_n_parking_desc">Toll & Park Desc</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_night_hault_desc" name="outstation_night_hault_desc"
                                        class="form-control" autocomplete="off">
                                    <label for="night_hault_desc">Night Hault Desc</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation_fixed_rate" name="outstation_fixed_rate"
                                        class="form-control" autocomplete="off">
                                    <label for="fixed_rate">Fixed Rate</label>
                                </div>
                            </div>
                          
                        </div>
                    </span>


                    <div class="modal-footer d-flex justify-content-center">
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-info btn-block" name="submitBtn" id="submitBtn"
                                    type="submit">Add</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-info btn-block" type="reset">Reset</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-info btn-block" type="button" data-dismiss="modal"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!--Naked Form-->

        </div>
    </div>
</div>


<!--Modal: modalVM-->
<div class="modal fade" id="localModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="localModalHeader">Add Local Ride</h5>

        </div>
        <div class="modal-body">
           
                <div class="form-row">
                    <div class="col-md-10">
                        <select name="customer_id" id="local2_customer_list" class="custom-select2"
                            style="width:100%">
                            <option value="">Select Customer</option>

                        </select>
                    </div>
                    <a style="background-color: #f77014; margin-top: 18px;" class="btn-floating btn-sm view_hide_fields"
                        data-toggle="modal" data-target="#modalAddCustomer">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="form-row">
                    <div class="col">
                        <select name="travel_type" id="local2_travel_type" onchange="showDiv('hidden_div', this,'local2');"
                            class="mdb-select colorful-select dropdown-primary">
                            <option value="">Select Travel Type</option>
                            <option value="ride_now">Ride Now</option>
                            <option value="ride_later">Ride Later</option>
                        </select>
                    </div>


                    <div class="col">
                        <select name="car_type_id" id="local2_cartype_id"
                            class="mdb-select colorful-select dropdown-primary">
                            <option value="">Select Car Type</option>
                            @php
                                $cartypes = DB::table('car_types')
                                    ->select('id', 'name')
                                    ->groupBy('name')
                                    ->get();
                            @endphp
                            @foreach ($cartypes as $cartype)
                                <option value="{{ $cartype->id }}">{{ $cartype->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>


                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="local2_from_location" name="from_location"
                                class="form-control" autocomplete="off">
                            <label for="from_location">From Location</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="local2_to_location" name="to_location" class="form-control"
                                autocomplete="off">
                            <label for="to_location">To Location</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="local2_from_latitude" name="from_latitude"
                                class="form-control" autocomplete="off">
                            <label for="from_latitude">From Latitude</label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="local2_from_longitude" name="from_longitude"
                                class="form-control" autocomplete="off">
                            <label for="from_longitude">From Longitude</label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="local2_to_latitude" name="to_latitude" class="form-control"
                                autocomplete="off">
                            <label for="to_latitude">To Latitude</label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="local2_to_longitude" name="to_longitude"
                                class="form-control" autocomplete="off">
                            <label for="to_longitude">To Longitude</label>
                        </div>
                    </div>
                </div>
                <div class="form-row" id="local2_purpose" style="display:none">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="date" id="local2_ride_later_date" name="local_ride_later_date"
                                class="form-control" autocomplete="off">
                            <label for="ride_later_date" class="input-active">Date</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="time" id="local2_ride_later_time" name="local_ride_later_time"
                                class="form-control" autocomplete="off">
                            <label for="ride_later_time" class="input-active">Time</label>
                        </div>
                    </div>
                </div>
                <div class="form-row view_hide_fields">
                    <div class="col mb-4">
                        <select name="driver_id" id="local2_driver_id"
                            class="custom-select2" style="width:100%">
                            <option value="">Select Driver</option>
                            @php
                                $drivers = DB::table('driver')
                                    ->select('id', 'first_name', 'last_name', 'city')
                                    ->orderby('first_name', 'ASC')
                                    ->get();
                            @endphp
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->first_name }}
                                    {{ $driver->last_name }}, {{ $driver->city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>




                <div class="form-row view_hide_fields">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="submitBtn" id="local_submitBtn"
                                type="submit">Add</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="reset">Reset</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="button" data-dismiss="modal"
                                aria-label="Close">Close</button>
                    </div>
                </div>

        </div>
        <!--Naked Form-->

    </div>
</div>
</div>

<div class="modal fade" id="edit_localModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" >Edit Local Ride</h5>

        </div>
        <div class="modal-body">
            <form enctype="multipart/form-data" action="{{ route('update_tempaddCustomer') }}" method="POST"
                id="edit_CustomerForm">
                <input type="hidden" name="enquiry_id" id="edit_local2_enquiry_id">
                <div class="form-row">
                    <div class="col-md-10">
                        <select name="customer_id" id="edit_local2_customer_list" class="custom-select2"
                            style="width:100%">
                            <option value="">Select Customer</option>

                        </select>
                    </div>
                    <a style="background-color: #f77014; margin-top: 18px;" class="btn-floating btn-sm"
                        data-toggle="modal" data-target="#modalAddCustomer">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="form-row">
                    <div class="col">
                        <select name="travel_type" id="edit_local2_travel_type" onchange="showDiv('hidden_div', this,'edit_local2');"
                            class="mdb-select colorful-select dropdown-primary">
                            <option value="">Select Travel Type</option>
                            <option value="ride_now">Ride Now</option>
                            <option value="ride_later">Ride Later</option>
                        </select>
                    </div>


                    <div class="col">
                        <select name="car_type_id" id="edit_local2_cartype_id"
                            class="mdb-select colorful-select dropdown-primary">
                            <option value="">Select Car Type</option>
                            @php
                                $cartypes = DB::table('car_types')
                                    ->select('id', 'name')
                                    ->groupBy('name')
                                    ->get();
                            @endphp
                            @foreach ($cartypes as $cartype)
                                <option value="{{ $cartype->id }}">{{ $cartype->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>


                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="edit_local2_from_location" name="from_location"
                                class="form-control" autocomplete="off">
                            <label for="from_location">From Location</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="edit_local2_to_location" name="to_location" class="form-control"
                                autocomplete="off">
                            <label for="to_location">To Location</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="edit_local2_from_latitude" name="from_latitude"
                                class="form-control" autocomplete="off">
                            <label for="from_latitude">From Latitude</label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="edit_local2_from_longitude" name="from_longitude"
                                class="form-control" autocomplete="off">
                            <label for="from_longitude">From Longitude</label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="edit_local2_to_latitude" name="to_latitude" class="form-control"
                                autocomplete="off">
                            <label for="to_latitude">To Latitude</label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="edit_local2_to_longitude" name="to_longitude"
                                class="form-control" autocomplete="off">
                            <label for="to_longitude">To Longitude</label>
                        </div>
                    </div>
                </div>
                <div class="form-row" id="edit_local2_purpose">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="date" id="edit_local2_ride_later_date" name="ride_later_date"
                                class="form-control" autocomplete="off">
                            <label for="ride_later_date" class="input-active">Date</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="time" id="edit_local2_ride_later_time" name="ride_later_time"
                                class="form-control" autocomplete="off">
                            <label for="ride_later_time" class="input-active">Time</label>
                        </div>
                    </div>
                </div>


                <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="submitBtn" id="edit_local_submitBtn"
                                type="submit">Update</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="reset">Reset</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="button" data-dismiss="modal"
                                aria-label="Close">Close</button>
                    </div>
                </div>

            </form>
        </div>
        <!--Naked Form-->

    </div>
</div>
</div>

<div class="modal fade" id="rentalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rentalModalHeader">Add Rental Ride</h5>

            </div>
            <div class="modal-body">
                <form action="{{ route('addRentalEnquiry') }}" method="POST" id="AddRental">
                    {{ csrf_field() }}
                    <input type="hidden" name="enquiry_id" id="rental2_enquiry_id">

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col">
                                <select name="city_id" id="rental2_city_id" onchange="getPackagesList(this.value);"
                                class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select City</option>
                                    @php
                                        $cities = DB::table('city')
                                            ->select('id', 'name')
                                            ->get();
                                    @endphp
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <select name="package_id" id="rental2_package_list"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Package</option>

                                </select>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col">
                                <select name="cartype_id" id="rental2_cartype_id"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Car Type</option>
                                    @php
                                        $cartypes = DB::table('car_types')
                                            ->select('id', 'name')
                                            ->groupBy('name')
                                            ->get();
                                    @endphp
                                    @foreach ($cartypes as $cartype)
                                        <option value="{{ $cartype->id }}">{{ $cartype->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental2_amount" name="amount" class="form-control"
                                        autocomplete="off">
                                    <label for="amount">Amount</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <select name="travel_type" id="rental2_travel_type"
                                    onchange="showDiv('hidden_div', this,'rental2');"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Travel Type</option>
                                    <option value="ride_now">Ride Now</option>
                                    <option value="ride_later">Ride Later</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-row" id="rental2_purpose" style="display:none">

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="date" id="rental2_ride_later_date" name="ride_later_date"
                                        class="form-control" autocomplete="off">
                                    <label for="ride_later_date" class="input-active">Date</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="time" id="rental2_ride_later_time" name="ride_later_time"
                                        class="form-control" autocomplete="off" >
                                    <label for="ride_later_time" class="input-active">Time</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col">
                                <select name="customer_id" id="rental2_customer_list" class="custom-select2"
                                    style="width:100%">
                                    <option value="">Select Customer</option>

                                </select>
                            </div>
                            <a style="background-color: #f77014; margin-top: 18px;" class="btn-floating btn-sm view_hide_fields"
                                data-toggle="modal" data-target="#modalAddCustomer">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>



                        <div class="form-row">

                            <div class="col">
                                <label>Start Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="rental2_start_time" name="start_time"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="col">
                                <label>End Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="rental2_end_time" name="end_time" class="form-control"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental2_pick_location" name="pick_location"
                                        class="form-control" autocomplete="off">
                                    <label for="pick_location">Pick Location</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row view_hide_fields">


                            <div class="col mb-4">
                                <select name="driver_id" id="rental2_driver_id"
                                class="custom-select2" style="width:100%">
                                    <option value="">Select Driver</option>
                                    @php
                                        $drivers = DB::table('driver')
                                            ->select('id', 'first_name', 'last_name', 'city')
                                            ->orderby('first_name', 'ASC')
                                            ->get();
                                    @endphp
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->first_name }}
                                            {{ $driver->last_name }}, {{ $driver->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental2_from_lat" name="latitude" class="form-control"
                                        autocomplete="off">
                                    <label for="from_lat">From Lat</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental2_from_lng" name="longitude" class="form-control"
                                        autocomplete="off">
                                    <label for="from_lng">From Long</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental2_distance_driver_user_km"
                                        name="distance_driver_user_km" class="form-control" autocomplete="off">
                                    <label for="distance_driver_user_km">Distance Driver User Km</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental2_distance_user_destination_km"
                                        name="distance_user_destination_km" class="form-control" autocomplete="off">
                                    <label for="distance_user_destination_km">Distance User Destination Km</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="rental2_custoemr_amount" name="custoemr_amount"
                                        class="form-control" autocomplete="off">
                                    <label for="custoemr_amount">Customer Amount</label>
                                </div>
                            </div>

                        </div>


                        <br>
                        <div class="form-row view_hide_fields">
                            <div class="col">
                                <button class="btn btn-info btn-block" name="submitadd" id="rental_submitadd"
                                    type="submit">Add</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-info btn-block" type="reset">Reset</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-info btn-block" type="button" data-dismiss="modal"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--Naked Form-->

        </div>
    </div>
</div>

<div class="modal fade" id="edit_rentalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Update Rental Ride</h5>

            </div>
            <div class="modal-body">
                <form action="{{ route('tempupdateRentalEnquiry') }}" method="POST" id="UpdateRental">
                    {{ csrf_field() }}
                    <input type="hidden" name="enquiry_id" id="edit_rental2_enquiry_id">

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col">
                                <select name="city_id" id="edit_rental2_city_id" onchange="getPackagesList(this.value);"
                                class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select City</option>
                                    @php
                                        $cities = DB::table('city')
                                            ->select('id', 'name')
                                            ->get();
                                    @endphp
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <select name="package_id" id="edit_rental2_package_list"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Package</option>

                                </select>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col">
                                <select name="cartype_id" id="edit_rental2_cartype_id"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Car Type</option>
                                    @php
                                        $cartypes = DB::table('car_types')
                                            ->select('id', 'name')
                                            ->groupBy('name')
                                            ->get();
                                    @endphp
                                    @foreach ($cartypes as $cartype)
                                        <option value="{{ $cartype->id }}">{{ $cartype->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_rental2_amount" name="amount" class="form-control"
                                        autocomplete="off">
                                    <label for="amount">Amount</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <select name="travel_type" id="edit_rental2_travel_type"
                                    onchange="showDiv('hidden_div', this,'edit_rental2');"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Travel Type</option>
                                    <option value="ride_now">Ride Now</option>
                                    <option value="ride_later">Ride Later</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-row" id="edit_rental2_purpose">

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="date" id="edit_rental2_ride_later_date" name="ride_later_date"
                                        class="form-control" autocomplete="off">
                                    <label for="ride_later_date" class="input-active">Date</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="time" id="edit_rental2_ride_later_time" name="ride_later_time"
                                        class="form-control" autocomplete="off" >
                                    <label for="ride_later_time" class="input-active">Time</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col">
                                <select name="customer_id" id="edit_rental2_customer_list" class="custom-select2"
                                    style="width:100%">
                                    <option value="">Select Customer</option>

                                </select>
                            </div>
                            <a style="background-color: #f77014; margin-top: 18px;" class="btn-floating btn-sm view_hide_fields"
                                data-toggle="modal" data-target="#modalAddCustomer">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>



                        <div class="form-row">

                            <div class="col">
                                <label>Start Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="edit_rental2_start_time" name="start_time"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="col">
                                <label>End Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="edit_rental2_end_time" name="end_time" class="form-control"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_rental2_pick_location" name="pick_location"
                                        class="form-control" autocomplete="off">
                                    <label for="pick_location">Pick Location</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row view_hide_fields">


                            <div class="col mb-4">
                                <select name="driver_id" id="edit_rental2_driver_id"
                                class="custom-select2" style="width:100%">
                                    <option value="">Select Driver</option>
                                    @php
                                        $drivers = DB::table('driver')
                                            ->select('id', 'first_name', 'last_name', 'city')
                                            ->orderby('first_name', 'ASC')
                                            ->get();
                                    @endphp
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->first_name }}
                                            {{ $driver->last_name }}, {{ $driver->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_rental2_from_lat" name="latitude" class="form-control"
                                        autocomplete="off">
                                    <label for="from_lat">From Lat</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_rental2_from_lng" name="longitude" class="form-control"
                                        autocomplete="off">
                                    <label for="from_lng">From Long</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_rental2_distance_driver_user_km"
                                        name="distance_driver_user_km" class="form-control" autocomplete="off">
                                    <label for="distance_driver_user_km">Distance Driver User Km</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_rental2_distance_user_destination_km"
                                        name="distance_user_destination_km" class="form-control" autocomplete="off">
                                    <label for="distance_user_destination_km">Distance User Destination Km</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_rental2_custoemr_amount" name="custoemr_amount"
                                        class="form-control" autocomplete="off">
                                    <label for="custoemr_amount">Customer Amount</label>
                                </div>
                            </div>

                        </div>


                        <br>
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-info btn-block" name="submitadd" id="edit_rental_submitBtn"
                                    type="submit">Update</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-info btn-block" type="reset">Reset</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-info btn-block" type="button" data-dismiss="modal"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--Naked Form-->

        </div>
    </div>
</div>

<div class="modal fade" id="outstationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="outstatinoModalHeader">Add OutStation Ride</h5>

            </div>
            <div class="modal-body">
                <form action="{{ route('addRental') }}" method="POST" id="AddOutstation">
                    {{ csrf_field() }}
                    <input type="hidden" name="enquiry_id" id="outstation2_enquiry_id">

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col">
                                <select name="customer_id" id="outstation2_customer_list"
                                    class="custom-select2" style="width:100%">
                                    <option value="">Select Customer</option>

                                </select>
                            </div>
                            <a style="background-color: #f77014; margin-top: 18px;" class="btn-floating btn-sm view_hide_fields"
                                data-toggle="modal" data-target="#modalAddCustomer">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_from_origin" name="from_origin"
                                        class="form-control">
                                    <label for="from_origin">From Origin</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_to_destination" name="to_destination"
                                        class="form-control">
                                    <label for="to_destination">To Destination</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <select name="car_type_id" id="outstation2_car_type_id"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Car Type</option>
                                    @php
                                        $cartypes = DB::table('car_types')
                                            ->select('id', 'name')
                                            ->groupBy('name')
                                            ->get();
                                    @endphp
                                    @foreach ($cartypes as $cartype)
                                        <option value="{{ $cartype->id }}">{{ $cartype->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <select name="type" id="outstation2_type"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Type</option>
                                    <option value="one_way">One Way</option>
                                    <option value="round_trip">Round Trip</option>
                                </select>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_days" name="days" class="form-control"
                                        autocomplete="off">
                                    <label for="days">Days</label>
                                </div>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="date" id="outstation2_date" name="date" class="form-control"
                                        autocomplete="off">
                                    <label for="date" class="input-active">Date</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label>From Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="outstation2_from_time" name="from_time"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="col">
                                <label>To Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="outstation2_to_time" name="to_time"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_from_lat" name="from_lat"
                                        class="form-control" autocomplete="off">
                                    <label for="from_lat">From Lat</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_from_lng" name="from_lng"
                                        class="form-control" autocomplete="off">
                                    <label for="from_lng">From Long</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_perkm_amount" name="perkm_amount"
                                        class="form-control" autocomplete="off">
                                    <label for="perkm_amount">Per Km Amount</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_per_day_amount" name="per_day_amount"
                                        class="form-control" autocomplete="off">
                                    <label for="per_day_amount">Per Day Amount</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_per_day_desc" name="per_day_desc"
                                        class="form-control" autocomplete="off">
                                    <label for="per_day_desc">Per Day Desc</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_per_km_desc" name="per_km_desc"
                                        class="form-control" autocomplete="off">
                                    <label for="per_km_desc">Per Km Desc</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_waiting_charge" name="waiting_charge"
                                        class="form-control" autocomplete="off">
                                    <label for="waiting_charge">Waiting Charge</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_toll_n_parking_desc"
                                        name="toll_n_parking_desc" class="form-control" autocomplete="off">
                                    <label for="toll_n_parking_desc">Toll & Park Desc</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_night_hault_desc" name="night_hault_desc"
                                        class="form-control" autocomplete="off">
                                    <label for="night_hault_desc">Night Hault Desc</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="outstation2_fixed_rate" name="fixed_rate"
                                        class="form-control" autocomplete="off">
                                    <label for="fixed_rate">Fixed Rate</label>
                                </div>
                            </div>

                            <div class="col view_hide_fields" >
                                <select name="driver_id" id="outstation2_driver_id"
                                    class="custom-select2" style="width:100%;">
                                    <option value="">Select Driver</option>
                                    @php
                                        $drivers = DB::table('driver')
                                            ->select('id', 'first_name', 'last_name', 'city')
                                            ->orderby('first_name', 'ASC')
                                            ->get();
                                    @endphp
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->first_name }}
                                            {{ $driver->last_name }}, {{ $driver->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-row view_hide_fields">
                            <div class="col">
                                <button class="btn btn-info btn-block" name="submitadd" id="outstation_submitadd"
                                    type="submit">Add</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-info btn-block" type="reset">Reset</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-info btn-block" type="button" data-dismiss="modal"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--Naked Form-->

        </div>
    </div>
</div> 

<div class="modal fade" id="edit_outstationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Update OutStation Ride</h5>

            </div>
            <div class="modal-body">
                <form action="{{ route('tempupdateRental') }}" method="POST" id="editOutstation">
                    {{ csrf_field() }}
                    <input type="hidden" name="enquiry_id" id="edit_outstation2_enquiry_id">

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col">
                                <select name="customer_id" id="edit_outstation2_customer_list"
                                    class="custom-select2" style="width:100%">
                                    <option value="">Select Customer</option>

                                </select>
                            </div>
                            <a style="background-color: #f77014; margin-top: 18px;" class="btn-floating btn-sm view_hide_fields"
                                data-toggle="modal" data-target="#modalAddCustomer">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_from_origin" name="from_origin"
                                        class="form-control">
                                    <label for="from_origin">From Origin</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_to_destination" name="to_destination"
                                        class="form-control">
                                    <label for="to_destination">To Destination</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <select name="car_type_id" id="edit_outstation2_car_type_id"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Car Type</option>
                                    @php
                                        $cartypes = DB::table('car_types')
                                            ->select('id', 'name')
                                            ->groupBy('name')
                                            ->get();
                                    @endphp
                                    @foreach ($cartypes as $cartype)
                                        <option value="{{ $cartype->id }}">{{ $cartype->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <select name="type" id="edit_outstation2_type"
                                    class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Type</option>
                                    <option value="one_way">One Way</option>
                                    <option value="round_trip">Round Trip</option>
                                </select>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_days" name="days" class="form-control"
                                        autocomplete="off">
                                    <label for="days">Days</label>
                                </div>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="date" id="edit_outstation2_date" name="date" class="form-control"
                                        autocomplete="off">
                                    <label for="date" class="input-active">Date</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label>From Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="edit_outstation2_from_time" name="from_time"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="col">
                                <label>To Time</label>
                                <div class="md-form mt-3">
                                    <input type="time" id="edit_outstation2_to_time" name="to_time"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_from_lat" name="from_lat"
                                        class="form-control" autocomplete="off">
                                    <label for="from_lat">From Lat</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_from_lng" name="from_lng"
                                        class="form-control" autocomplete="off">
                                    <label for="from_lng">From Long</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_perkm_amount" name="perkm_amount"
                                        class="form-control" autocomplete="off">
                                    <label for="perkm_amount">Per Km Amount</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_per_day_amount" name="per_day_amount"
                                        class="form-control" autocomplete="off">
                                    <label for="per_day_amount">Per Day Amount</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_per_day_desc" name="per_day_desc"
                                        class="form-control" autocomplete="off">
                                    <label for="per_day_desc">Per Day Desc</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_per_km_desc" name="per_km_desc"
                                        class="form-control" autocomplete="off">
                                    <label for="per_km_desc">Per Km Desc</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_waiting_charge" name="waiting_charge"
                                        class="form-control" autocomplete="off">
                                    <label for="waiting_charge">Waiting Charge</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_toll_n_parking_desc"
                                        name="toll_n_parking_desc" class="form-control" autocomplete="off">
                                    <label for="toll_n_parking_desc">Toll & Park Desc</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_night_hault_desc" name="night_hault_desc"
                                        class="form-control" autocomplete="off">
                                    <label for="night_hault_desc">Night Hault Desc</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="edit_outstation2_fixed_rate" name="fixed_rate"
                                        class="form-control" autocomplete="off">
                                    <label for="fixed_rate">Fixed Rate</label>
                                </div>
                            </div>

                            <div class="col view_hide_fields" >
                                <select name="driver_id" id="edit_outstation2_driver_id"
                                    class="custom-select2" style="width:100%;">
                                    <option value="">Select Driver</option>
                                    @php
                                        $drivers = DB::table('driver')
                                            ->select('id', 'first_name', 'last_name', 'city')
                                            ->orderby('first_name', 'ASC')
                                            ->get();
                                    @endphp
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->first_name }}
                                            {{ $driver->last_name }}, {{ $driver->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-info btn-block" name="submitadd" id="edit_outstation_submitbtn"
                                    type="submit">Update</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-info btn-block" type="reset">Reset</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-info btn-block" type="button" data-dismiss="modal"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--Naked Form-->

        </div>
    </div>
</div> 



<div class="modal fade" id="modalAddCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('addCustomerRental') }}" method="POST" id="AddRentalCustomer">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="first_name" name="first_name" class="form-control"
                                    autocomplete="off">
                                <label for="first_name">First Name</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="last_name" name="last_name" class="form-control"
                                    autocomplete="off">
                                <label for="last_name">Last Name</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="mobile_no" name="mobile_no" class="form-control"
                                    autocomplete="off">
                                <label for="mobile_no">Mobile No.</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="email_id" name="email_id" class="form-control"
                                    autocomplete="off">
                                <label for="email_id">Email</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="id_proof" name="id_proof" class="form-control"
                                    autocomplete="off">
                                <label for="id_proof">ID Proof</label>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="submitadd1" id="submitadd1"
                                type="submit">Add</button>
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
