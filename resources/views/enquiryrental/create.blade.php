<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Rental</h5>
                
            </div>
            <form action="{{route('addRentalEnquiry')}}" method="POST" id="AddRental">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-row">
                    <div class="col">
                        <select name="city_id" id="city_id" onchange="getPackagesList(this.value);" class="mdb-select colorful-select dropdown-primary">
                            <option value="">Select City</option>
								 @php
                                    use Illuminate\Support\Facades\DB;
                                    $cities =DB::table('city')->select('id','name')->get();
                                @endphp
                                @foreach( $cities as $city )
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                        </select>
                    </div>
						
						<div class="col">
                        <select name="package_id" id="package_list" class="mdb-select colorful-select dropdown-primary">
                            <option value="">Select Package</option>
								
                        </select>
                    </div>
                       
                    </div>

                    <div class="form-row">
						 <div class="col">
                            <select name="cartype_id" id="cartype_id" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Car Type</option>
                                @php
                                    $cartypes =DB::table('car_types')->select('id','name')->groupBy('name')->get();
                                @endphp
                                @foreach( $cartypes as $cartype )
                                    <option value="{{$cartype->id}}">{{$cartype->name}}</option>
                                @endforeach
                            </select>
                        </div>
						
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="amount" name="amount" class="form-control" autocomplete="off">
                                <label for="amount">Amount</label>
                            </div></div>
                    </div>
					
					<div class="form-row">
					<div class="col">
						<select name="travel_type" id="travel_type" onchange="showDiv('hidden_div', this);" class="mdb-select colorful-select dropdown-primary">
							<option value="">Select Travel Type</option>
							<option value="ride_now">Ride Now</option>
							<option value="ride_later">Ride Later</option>
						</select>
					</div>
						</div>
                       
					
					  <div class="form-row" id="purpose" style="display:none">
                                
						  <div class="col">
							  <div class="md-form mt-3">
								  <input type="date" id="ride_later_date" name="ride_later_date" class="form-control" autocomplete="off">
								  <label for="ride_later_date" class="input-active">Date</label>
							  </div></div>

						  <div class="col">
							  <div class="md-form mt-3">
								  <input type="time" id="ride_later_time" name="ride_later_time" class="form-control" autocomplete="off">
								  <label for="ride_later_time" class="input-active">Time</label>
							  </div></div>
                         </div>
					
					
					<div class="form-row">
                    <div class="col">
                        <select name="customer_id" id="customer_list" class="custom-select2" style="width:100%">
                            <option value="">Select Customer</option>

                        </select>
                    </div>
                        <a style="background-color: #f77014; margin-top: 18px;" class="btn-floating btn-sm" data-toggle="modal" data-target="#modalAddCustomer">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                    

                    <div class="form-row">
						
                        <div class="col">
                            <label>Start Time</label>
                            <div class="md-form mt-3">
                                <input type="time" id="start_time" name="start_time" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="col">
                            <label>End Time</label>
                            <div class="md-form mt-3">
                                <input type="time" id="end_time" name="end_time" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
					
					  <div class="form-row">
						  
						  <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="pick_location" name="pick_location" class="form-control" autocomplete="off">
                                <label for="pick_location">Pick Location</label>
                            </div></div>
                      </div>
                      <div class="form-row">
                        <div class="col">
                            <select name="driver_id" id="driver_id12"
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
                                <input type="text" id="from_lat" name="latitude" class="form-control" autocomplete="off">
                                <label for="from_lat">From Lat</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="from_lng" name="longitude" class="form-control" autocomplete="off">
                                <label for="from_lng">From Long</label>
                            </div></div>
                    </div>
					
					
					 <div class="form-row">
						 
						<div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="distance_driver_user_km" name="distance_driver_user_km" class="form-control" autocomplete="off">
                                <label for="distance_driver_user_km">Distance Driver User Km</label>
                            </div></div>
						 
						 <div class="col">
                            <div class="md-form mt-3">
               <input type="text" id="distance_user_destination_km" name="distance_user_destination_km" class="form-control" autocomplete="off">
                                <label for="distance_user_destination_km">Distance User Destination Km</label>
                            </div></div>
						 
						 <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="custoemr_amount" name="custoemr_amount" class="form-control" autocomplete="off">
                                <label for="custoemr_amount">Customer Amount</label>
                            </div></div>
						
                    </div>
					
			
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="submitadd" id="submitadd" type="submit">Add</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="reset">Reset</button>
                        </div>
                         <div class="col">
                            <button class="btn btn-info btn-block" type="button" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>






<div class="modal fade" id="modalAddCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('addCustomerRental')}}" method="POST" id="AddRentalCustomer">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="first_name" name="first_name" class="form-control" autocomplete="off">
                                <label for="first_name">First Name</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="last_name" name="last_name" class="form-control" autocomplete="off">
                                <label for="last_name">Last Name</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="mobile_no" name="mobile_no" class="form-control" autocomplete="off">
                                <label for="mobile_no">Mobile No.</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="email_id" name="email_id" class="form-control" autocomplete="off">
                                <label for="email_id">Email</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="id_proof" name="id_proof" class="form-control" autocomplete="off">
                                <label for="id_proof">ID Proof</label>
                            </div></div>
                    </div>

                    <br>
                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="submitadd1" id="submitadd1" type="submit">Add</button>
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
