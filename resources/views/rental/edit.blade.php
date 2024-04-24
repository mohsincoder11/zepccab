<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Link To Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('updateLinkDriver')}}" method="POST" id="editForm">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col mb-4">
                            <select name="driver_id" id="driver_id_edit" class="custom-select2" style="width:100%">
                                <option value="">Select Driver</option>
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    $drivers =DB::table('driver')
											->select('id','first_name','last_name')
											->orderby('first_name','ASC')
											->get();
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

<div class="modal fade" id="editModalDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Outstation Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('updateOutstationDetails')}}" method="POST" id="editFormDetails">
                {{ csrf_field() }}
                <div class="modal-body">
					
						{{-- <div class="form-row">
						<div class="col">
							<div class="md-form mt-3">
								<input type="date" id="edit_date" name="date" class="form-control" autocomplete="off">
								<label for="edit_date" class="input-active">Date</label>
							</div></div>
					</div> --}}
                    <div class="form-row">
                        <div class="col">
                            <select name="car_type_id" id="edit_car_type_id" class="mdb-select colorful-select dropdown-primary">
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
                            <select name="type" id="edit_type" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Type</option>
                                <option value="one_way">One Way</option>
                                <option value="round_trip">Round Trip</option>
                            </select>
                        </div>

                       

                    </div>
					
					<div class="form-row">
						<div class="col">
							<div class="md-form mt-3">
								<input type="date" id="edit_date" name="date" class="form-control" autocomplete="off">
								<label for="date" class="input-active">Date</label>
							</div></div>
					</div>

                    <div class="form-row">
                        <div class="col">
                            <label>From Time</label>
                            <div class="md-form mt-3">
                                <input type="time" id="edit_from_time" name="from_time" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="col">
                            <label>To Time</label>
                            <div class="md-form mt-3">
                                <input type="time" id="edit_to_time" name="to_time" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
					
					<div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_from_lat" name="from_lat" class="form-control" autocomplete="off">
                                <label for="edit_from_lat" class="input-active">From Lat</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_from_lng" name="from_lng" class="form-control" autocomplete="off">
                                <label for="edit_from_lng" class="input-active">From Long</label>
                            </div></div>
                    </div>
					
					
					<div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_amount" name="amount" class="form-control" autocomplete="off">
                                <label for="edit_amount" class="input-active">Amount</label>
                            </div></div>
						
						
						<div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_days" name="days" class="form-control" autocomplete="off">
                                <label for="edit_days" class="input-active">Days</label>
                            </div></div>
					
                    </div>
					
					
					<div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_extra_per_km_rate" name="extra_per_km_rate" class="form-control" autocomplete="off">
                                <label for="edit_extra_per_km_rate" class="input-active">Extra Per Km Rate</label>
                            </div></div>
						
						
						<div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_customer_extra_kms" name="customer_extra_kms" class="form-control" autocomplete="off">
                                <label for="edit_customer_extra_kms" class="input-active">Customer Extra Kms</label>
                            </div></div>
					
                    </div>
					
					
					<div class="form-row">
					<div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_extra_per_min_rate" name="extra_per_min_rate" class="form-control" autocomplete="off">
                                <label for="edit_extra_per_min_rate" class="input-active">Extra Per Min Rate</label>
                            </div></div>
						
						<div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_customer_extra_time" name="customer_extra_time" class="form-control" autocomplete="off">
                                <label for="edit_customer_extra_time" class="input-active">Customer Extra Time (Minutes)</label>
                            </div></div>
				</div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_perkm_amount" name="perkm_amount" class="form-control" autocomplete="off">
                                <label for="edit_perkm_amount" class="input-active">Per Km Amount</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_per_day_amount" name="per_day_amount" class="form-control" autocomplete="off">
                                <label for="edit_per_day_amount" class="input-active">Per Day Amount</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_per_day_desc" name="per_day_desc" class="form-control" autocomplete="off">
                                <label for="edit_per_day_desc" class="input-active">Per Day Desc</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_per_km_desc" name="per_km_desc" class="form-control" autocomplete="off">
                                <label for="edit_per_km_desc" class="input-active">Per Km Desc</label>
                            </div></div>
                    </div>

                    <div class="form-row">
						
						
						
                    <!--    <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_waiting_charge" name="waiting_charge" class="form-control" autocomplete="off">
                                <label for="edit_waiting_charge" class="input-active">Extra Time</label>
                            </div></div> -->

						
						<div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_fixed_rate" name="fixed_rate" class="form-control" autocomplete="off">
                                <label for="edit_fixed_rate" class="input-active">Fixed Rate</label>
                            </div></div>
						
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_toll_n_parking_desc" name="toll_n_parking_desc" class="form-control" autocomplete="off">
                                <label for="edit_toll_n_parking_desc" class="input-active">Toll & Park Desc</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_night_hault_desc" name="night_hault_desc" class="form-control" autocomplete="off">
                                <label for="edit_night_hault_desc" class="input-active">Driver Allowance</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="notification" name="notification" class="form-control" autocomplete="off">
                                <label for="notification" class="input-active">Notification</label>
                            </div>
                        </div>
                    </div>
					
					
					<div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                       <input type="text" id="edit_distance" name="distance" class="form-control" autocomplete="off">
                                                    <label for="edit_distance" class="input-active">Total Km</label>
                                                </div></div>
						
						<div class="col">
                                                <div class="md-form mt-3">
                                       <input type="text" id="edit_total_average_amount" name="total_average_amount" class="form-control" autocomplete="off">
                                                    <label for="edit_total_average_amount" class="input-active">Total Aaverage Amount</label>
                                                </div></div>
											
                                            <div class="col">
                                                <select name="status" id="status_list" class="mdb-select colorful-select dropdown-primary">
                                                    <option value="">Select Status</option>

                                                </select>
                                            </div>
                                        </div>

                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="editBtnDetails" id="editBtnDetails" type="submit">Update</button>
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
