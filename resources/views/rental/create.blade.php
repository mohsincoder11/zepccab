<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Out Station</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <form action="{{ route('addRental') }}" method="POST" id="AddRental">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <select name="customer_id" id="customer_list" class="custom-select2" style="width:100%">
                                <option value="">Select Customer</option>

                            </select>
                        </div>
                        <a style="background-color: #f77014; margin-top: 18px;" class="btn-floating btn-sm"
                            data-toggle="modal" data-target="#modalAddCustomer">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                    <div class="form-row">
                        <div class="col-9">
                            <div class="md-form mt-3">
                                <input type="text" id="from_origin" name="from_origin" class="form-control">
                                <label for="from_origin">From Origin</label>
                            </div>
                        </div>
                    </div>
                    <div id="stops-container">
                        <!-- Dynamic stops will be added here -->
                    </div>
                    <div class="form-row">
                        <div class="col-9">
                            <div class="md-form mt-3">
                                <input type="text" id="to_destination" name="to_destination" class="form-control">
                                <label for="to_destination">To Destination</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="md-form mt-3">
                                <a style="background-color: #f77014; margin-top: 18px;" class="square_btn btn-sm"
                                    id="add-stop-btn">
                                    <i class="fa fa-plus"></i>
                                    Add Stop
                                </a>
                            </div>
                        </div>
                    </div>





                    <div class="form-row">
                        <div class="col">
                            <select name="car_type_id" id="car_type_id"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Car Type</option>
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    $cartypes = DB::table('car_types')->select('id', 'name')->groupBy('name')->get();
                                @endphp
                                @foreach ($cartypes as $cartype)
                                    <option value="{{ $cartype->id }}">{{ $cartype->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <select name="type" id="type" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Type</option>
                                <option value="one_way">One Way</option>
                                <option value="round_trip">Round Trip</option>
                            </select>
                        </div>
                        
                    </div>
                   

                    <div class="form-row">
                        <div class="col">
                            <select name="outstation_ride_type" id="outstation_ride_type" onchange="ShowHideDiv(this)"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="" disabled>Select Option</option>
                                <option value="1" selected>Zep Cab</option>
                                <option value="2">Company</option>
                                <option value="3">Vendor</option>
                            </select>
                        </div>
                        <div class="col company_div hide">
                            <select name="company_id" id="company_id"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="" disabled selected>Select Company</option>
                                @php
                                    $companys = DB::table('companies')->select('id', 'company_name')->get();
                                @endphp
                                @foreach ($companys as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col vendor_div hide">
                            <select name="vendor_id" id="vendor_id" class="mdb-select colorful-select dropdown-primary">
                                <option value="" disabled selected>Select Vendor</option>
                                @php
                                    $vendors = DB::table('vendors')->select('id', 'vendor_name')->get();
                                @endphp
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col package_div hide">
                            <select name="package_id" id="package_id" class="mdb-select colorful-select dropdown-primary">
                                <option value="" disabled selected>Select Package</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="days" name="days" class="form-control"
                                    autocomplete="off">
                                <label for="days">Days</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="date" id="date" name="date" class="form-control"
                                    autocomplete="off">
                                <label for="date" class="input-active">Date</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label>From Time</label>
                            <div class="md-form mt-3">
                                <input type="time" id="from_time" name="from_time" class="form-control"
                                    autocomplete="off">
                            </div>
                        </div>

                        <div class="col">
                            <label>To Time</label>
                            <div class="md-form mt-3">
                                <input type="time" id="to_time" name="to_time" class="form-control"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="from_lat" name="from_lat" class="form-control"
                                    autocomplete="off">
                                <label for="from_lat">From Lat</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="from_lng" name="from_lng" class="form-control"
                                    autocomplete="off">
                                <label for="from_lng">From Long</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="perkm_amount" name="perkm_amount" class="form-control"
                                    autocomplete="off">
                                <label for="perkm_amount">Per Km Amount</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="per_day_amount" name="per_day_amount" class="form-control"
                                    autocomplete="off">
                                <label for="per_day_amount">Per Day Amount</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="per_day_desc" name="per_day_desc" class="form-control"
                                    autocomplete="off">
                                <label for="per_day_desc">Per Day Desc</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="per_km_desc" name="per_km_desc" class="form-control"
                                    autocomplete="off">
                                <label for="per_km_desc">Per Km Desc</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="waiting_charge" name="waiting_charge" class="form-control"
                                    autocomplete="off">
                                <label for="waiting_charge">Waiting Charge</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="toll_n_parking_desc" name="toll_n_parking_desc"
                                    class="form-control" autocomplete="off">
                                <label for="toll_n_parking_desc">Toll & Park Desc</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="night_hault_desc" name="night_hault_desc"
                                    class="form-control" autocomplete="off">
                                <label for="night_hault_desc">Night Hault Desc</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="fixed_rate" name="fixed_rate" class="form-control"
                                    autocomplete="off">
                                <label for="fixed_rate">Fixed Rate</label>
                            </div>
                        </div>

                        <div class="col" style="margin-top:11px;">
                            <select name="driver_id" id="driver_id" class="custom-select2" style="width:100%;">
                                <option value="">Select Driver</option>
                                @php
                                    $drivers = DB::table('driver')
                                        ->select('id', 'first_name', 'last_name', 'city','vendor_id')
                                        ->orderby('first_name', 'ASC')
                                        ->get();
                                @endphp
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}" data-vendor-id="{{ $driver->vendor_id }}">{{ $driver->first_name }}
                                        {{ $driver->last_name }}, {{ $driver->city }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="submitadd" id="submitadd"
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
