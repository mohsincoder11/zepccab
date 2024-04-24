<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid cascading-modal modal-full-height" role="document">
        <div class="modal-content">
            <div class="edge-header white">
                <ul class="nav nav-tabs md-tabs nav-justified gray mt-3" role="tablist">
                    <li class="nav-item" id="tab1">
                        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
                            <i class="fa fa-user pr-2"></i>Update Driver Details</a>
                            
                    </li>
                   
                </ul>
            </div>

            <div class=" free-bird modal-body mx-3">
                <div class="row">
                    <div class="col-md-8 col-lg-7 mx-auto float-none white z-depth-1 py-2 px-2">

                        <!--Naked Form-->
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{route('updateDriver')}}" method="POST" id="editForm" >
                            {{ csrf_field() }}

                            <!-- Tab panels -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">

                                  <div class="form-row">
                            <div class="col">
                                <select name="city_id" id="edit_cities" class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select City</option>
                                </select>
                            </div>
                            </div>

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
                                                    <input type="text" id="edit_secondary_mobile_no" name="secondary_mobile_no" class="form-control" autocomplete="off">
                                                    <label for="edit_secondary_mobile_no" class="input-active">Secondary Mobile No.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_email_id" name="email_id" class="form-control" autocomplete="off">
                                                    <label for="edit_email_id" class="input-active">Email</label>
                                                </div></div>
                                       
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_address" name="address" class="form-control" autocomplete="off">
                                                    <label for="edit_address" class="input-active">Address</label>
                                                </div></div>
                                        </div>
                                                <div class="form-row">

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_city" name="city" class="form-control" autocomplete="off">
                                                    <label for="edit_city" class="input-active">City</label>
                                                </div></div>

                                       
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_bank_details" name="bank_details" class="form-control" autocomplete="off">
                                                    <label for="edit_bank_details" class="input-active">Bank Details</label>
                                                </div></div>
                                            </div>
                                            <div class="form-row">

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_aadhar_card" name="aadhar_card" class="form-control" autocomplete="off">
                                                    <label for="edit_aadhar_card" class="input-active">Aadhar Card</label>
                                                </div></div>
                                       
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_driving_license" name="driving_license" class="form-control" autocomplete="off">
                                                    <label for="edit_driving_license" class="input-active">Driving License</label>
                                                </div></div>
                                            </div>
                                            <div class="form-row">

                                            <div class="col">
                                                <select name="car_id" id="edit_car_id" class="mdb-select colorful-select dropdown-primary">

                                                </select>
                                            </div>
                                        

                                       
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_current_latitude" name="current_latitude" class="form-control" autocomplete="off">
                                                    <label for="edit_current_latitude" class="input-active">Current Latitude</label>
                                                </div></div>
                                            </div>
                                            <div class="form-row">

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_current_longitude" name="current_longitude" class="form-control" autocomplete="off">
                                                    <label for="edit_current_longitude" class="input-active">Current Longitude</label>
                                                </div></div>
                                                <div class="col">
                                                    <select name="vendor_id" id="edit_vendor_id" class="mdb-select colorful-select dropdown-primary">
                                                        
                                                        
                                                        <option value="" disabled selected>Select Vendor</option>
                                                        @php
                                                            $vendors = DB::table('vendors')->select('id', 'vendor_name')->get();
                                                        @endphp
                                                        @foreach ($vendors as $vendor)
                                                            <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
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


