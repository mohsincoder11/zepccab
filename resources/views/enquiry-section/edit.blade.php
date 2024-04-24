<!--Modal: modalVM-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Enquiry</h5>

            </div>

            <div class="modal-body">
                
                <form enctype="multipart/form-data" action="{{ route('updateEnquiry') }}" method="POST" id="editForm">
                    {{ csrf_field() }}

                  

                    
                    <div class="form-row">
                        <div class="col-md-10">
                            <select name="customer_id" id="edit_customer_list" class="custom-select22 customer_list" style="width:100%">
                                <option value="">Select Customer</option>

                            </select>
                        </div>
                        <a style="background-color: #f77014; margin-top: 18px;" class="btn-floating btn-sm " data-toggle="modal" data-target="#modalAddCustomer">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="number" id="edit_number_of_days" name="number_of_days" class="form-control"
                                    autocomplete="off">
                                <label for="number_of_days">Number Of Days</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="number" id="edit_rate" name="rate" class="form-control"
                                    autocomplete="off">
                                <label for="rate">Rate</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <select name="cartype_id" id="edit_cartype_id" class="mdb-select colorful-select dropdown-primary">
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
                            <select name="ride_type" id="edit_ride_type" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Ride Type</option>
                                <option value="ctl">Local</option>
                                <option value="cpl">Rental</option>
                                <option value="outstation">OutStation</option>
                             
                            </select>
                        </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <label for="date-picker-example" style="margin-top: -30px;">Date</label>
                            <input placeholder=" date" type="date" id="edit_date" name="date" class="form-control"
                                >
                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form mt-3">
                            <label for="date-picker-example" style="margin-top: -30px;">Time</label>
                            <input placeholder="time" type="time" id="edit_time" name="time" class="form-control"
                                >
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="edit_from_location" name="from_location" class="form-control"
                                autocomplete="off">
                            <label for="from_location">From Location</label>
                        </div>
                    </div>
                </div>
                    <div class="form-row">

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_to_location" name="to_location" class="form-control"
                                    autocomplete="off">
                                <label for="to_location">To Location</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_from_latitude" name="from_latitude" class="form-control"
                                    autocomplete="off">
                                <label for="from_latitude">From Latitude</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_from_longitude" name="from_longitude" class="form-control"
                                    autocomplete="off">
                                <label for="from_longitude">From Longitude</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_to_latitude" name="to_latitude" class="form-control"
                                    autocomplete="off">
                                <label for="to_latitude">To Latitude</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_to_longitude" name="to_longitude" class="form-control"
                                    autocomplete="off">
                                <label for="to_longitude">To Longitude</label>
                            </div>
                        </div>
                    </div>

                  

                    <div class="modal-footer d-flex justify-content-center">
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-info btn-block" name="submitBtn" id="submitBtn"
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



