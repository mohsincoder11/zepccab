<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid cascading-modal modal-full-height" role="document">
        <div class="modal-content">
            <div class="edge-header white">
                <ul class="nav nav-tabs md-tabs nav-justified gray mt-3" role="tablist">
                    <li class="nav-item" id="tab1">
                        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
                            <i class="fa fa-user pr-2"></i>Update Customer Details</a>
                    </li>
                </ul>
            </div>

            <div class=" free-bird modal-body mx-3">
                <div class="row">
                    <div class="col-md-8 col-lg-7 mx-auto float-none white z-depth-1 py-2 px-2">

                        <!--Naked Form-->
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{route('updateCustomer')}}" method="POST" id="editForm" >
                            {{ csrf_field() }}

                            <!-- Tab panels -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_first_name" name="first_name" class="form-control" autocomplete="off">
                                                    <label for="edit_first_name" class="input-active">First Name</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_last_name" name="last_name" class="form-control" autocomplete="off">
                                                    <label for="edit_last_name" class="input-active">Last Name</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_mobile_no" name="mobile_no" class="form-control" autocomplete="off">
                                                    <label for="edit_mobile_no" class="input-active">Mobile No.</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_email_id" name="email_id" class="form-control" autocomplete="off">
                                                    <label for="edit_email_id" class="input-active">Email</label>
                                                </div></div>
                                        </div>


                                        <div class="form-row">
                                            <div class="col">
                                                <select name="travel_type_id" id="edit_travel_type_id" class="mdb-select colorful-select dropdown-primary">

                                                </select>
                                            </div>

                                            <div class="col">
                                                <select name="car_type_id" id="edit_car_type_id" class="mdb-select colorful-select dropdown-primary">

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_from_latitude" name="from_latitude" class="form-control" autocomplete="off">
                                                    <label for="edit_from_latitude" class="input-active">From Latitude</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_from_longitude" name="from_longitude" class="form-control" autocomplete="off">
                                                    <label for="edit_from_longitude" class="input-active">From Longitude</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_to_latitude" name="to_latitude" class="form-control" autocomplete="off">
                                                    <label for="edit_to_latitude" class="input-active">From Latitude</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_to_longitude" name="to_longitude" class="form-control" autocomplete="off">
                                                    <label for="edit_to_longitude" class="input-active">From Longitude</label>
                                                </div></div>
                                        </div>
										
										
										<div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_from_location" name="from_location" class="form-control" autocomplete="off">
                                                    <label for="edit_from_location" class="input-active">From Location</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_to_location" name="to_location" class="form-control" autocomplete="off">
                                                    <label for="edit_to_location" class="input-active">To Location</label>
                                                </div></div>
                                        </div>
										
										
										<div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                         <input type="date" id="edit_ride_later_date" name="ride_later_date" class="form-control" autocomplete="off">
                                                    <label for="edit_ride_later_date" class="input-active">Date</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                       <input type="text" id="edit_ride_later_time" name="ride_later_time" class="form-control" autocomplete="off">
                                                    <label for="edit_ride_later_time" class="input-active">Time</label>
                                                </div></div>
                                        </div>
										
										
										  <div class="form-row mb-4">
                                        <div class="col">
                                            <select name="driver_id" id="driver_list" class="mdb-select colorful-select dropdown-primary" style="width:100%">
                                                <option value="">Select Driver</option>
                                             
                                            </select>
                                        </div>
                                        </div>
										
										<div class="form-row">
                                           

                                            <div class="col">
                                                <div class="md-form mt-3">
                                       <input type="text" id="edit_distance_user_destination_km" name="distance_user_destination_km" class="form-control" autocomplete="off">
                                                    <label for="edit_distance_user_destination_km" class="input-active">Total Km</label>
                                                </div></div>
											
											 <div class="col">
                                                <div class="md-form mt-3">
                                       <input type="text" id="edit_custoemr_amount" name="custoemr_amount" class="form-control" autocomplete="off">
                                                    <label for="edit_custoemr_amount" class="input-active">Customer Amount</label>
                                                </div></div>

                                            <div class="col">
                                                <select name="status" id="status_list" class="mdb-select colorful-select dropdown-primary">
                                                    <option value="">Select Status</option>

                                                </select>
                                            </div>

                                        </div>

										
										
										
										<!--
										<div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                     <input type="text" id="edit_average_per_litre" name="average_per_litre" class="form-control" autocomplete="off">
                                                    <label for="edit_average_per_litre" class="input-active">Average / Litre</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                       <input type="text" id="edit_driver_allowance" name="driver_allowance" class="form-control" autocomplete="off">
                                                    <label for="edit_driver_allowance" class="input-active">Driver Allowance</label>
                                                </div></div>
											
											<div class="col">
                                                <div class="md-form mt-3">
                                       <input type="text" id="edit_route_direction" name="route_direction" class="form-control" autocomplete="off">
                                                    <label for="edit_route_direction" class="input-active">Route Direction</label>
                                                </div></div>
                                        	</div>   -->
										
									
										<div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                     <input type="text" id="edit_parking_and_tolltax" name="parking_and_tolltax" class="form-control" autocomplete="off">
                                                    <label for="edit_parking_and_tolltax" class="input-active">Parking and Tolltax</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                       <input type="text" id="edit_driver_allowance" name="driver_allowance" class="form-control" autocomplete="off">
                                                    <label for="edit_driver_allowance" class="input-active">Driver Allowance</label>
                                                </div></div>
											
                                        	</div>   
								


                                        <div class="modal-footer d-flex justify-content-center">
                                            <div class="form-row">
                                                <div class="col">
                                                    <button class="btn btn-info btn-block" name="editBtn" id="editBtn" type="submit">Update</button>
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-info btn-block" type="reset">Reset</button>
                                                </div>
                                                 <div class="col">
                                                <button class="btn btn-info btn-block" type="button" data-dismiss="modal" aria-label="Close">Close</button>
                                            </div>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- Panel 1 -->
                                </div>
                            </form>
                        </div>
                        <!--Naked Form-->

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


