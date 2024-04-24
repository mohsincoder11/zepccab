<!--Modal: modalVM-->
<div class="modal fade" id="modalVM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid cascading-modal modal-full-height" role="document">
        <div class="modal-content">
            <div class="edge-header white">
                <ul class="nav nav-tabs md-tabs nav-justified gray mt-3" role="tablist">
                    <li class="nav-item" id="tab1">
                        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
                            <i class="fa fa-user pr-2"></i>Driver Details</a>
                    </li>
                    <li class="nav-item disabled" id="tab2">
                        <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">
                            <i class="fa fa-heart pr-2"></i>Other Details</a>
                    </li>
                </ul>
            </div>

            <div class=" free-bird modal-body mx-3">



                <div class="row">
                    <div class="col-md-8 col-lg-7 mx-auto float-none white z-depth-1 py-2 px-2">

                        <!--Naked Form-->
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('addDriver') }}" method="POST"
                                id="DriverForm">
                                {{ csrf_field() }}

                                <!-- Tab panels -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">

                                        <div class="form-row">
                                            <div class="col">
                                                <select name="city_id" id="city_id" class="mdb-select colorful-select dropdown-primary">
                                                    
                                                    
                                                    <option value="">Select City</option>
                                                    @php
                                                        $cities = DB::table('city')->select('id', 'name')->get();
                                                    @endphp
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="first_name" name="first_name"
                                                        class="form-control" autocomplete="off">
                                                    <label for="first_name">First Name</label>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="last_name" name="last_name"
                                                        class="form-control" autocomplete="off">
                                                    <label for="last_name">Last Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="primary_mobile_number" name="mobile_no"
                                                        class="form-control" autocomplete="off">
                                                    <label for="primary_mobile_number">Primary Mobile No</label>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="secondary_mobile_no"
                                                        name="secondary_mobile_no" class="form-control"
                                                        autocomplete="off">
                                                    <label for="secondary_mobile_no">Secondary Mobile No.</label>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="email_id" name="email_id"
                                                        class="form-control" autocomplete="off">
                                                    <label for="email_id">Email</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="address" name="address"
                                                        class="form-control" autocomplete="off">
                                                    <label for="address">Address</label>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="city" name="city"
                                                        class="form-control" autocomplete="off">
                                                    <label for="city">City</label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="file-field" style="margin-top: 25px;">
                                                <div class="btn-sm float-left"
                                                    style="background-color: #0078D7!important; color: #fff!important;">
                                                    <span>Choose file</span>
                                                    <input type="file" name="driver_photo[]" id="driver_photo[]"
                                                        multiple>
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"
                                                        placeholder="Upload Driver Image">
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col">
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

                                        </div>

                                        <div class="form-row">
                                            <div class="step-actions">
                                                <div class="waves-effect waves-dark btn btn-sm btn-primary next-step"
                                                    onclick="disableTab('#tab2',false)" style="margin-left: 510px;">
                                                    CONTINUE</div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Panel 1 -->

                                    <!-- Panel 2 -->
                                    <div class="tab-pane fade" id="panel2" role="tabpanel">

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="bank_details" name="bank_details"
                                                        class="form-control" autocomplete="off">
                                                    <label for="bank_details">Bank Details</label>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="aadhar_card" name="aadhar_card"
                                                        class="form-control" autocomplete="off">
                                                    <label for="aadhar_card">Aadhar Card</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="driving_license" name="driving_license"
                                                        class="form-control" autocomplete="off">
                                                    <label for="driving_license">Driving License</label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="current_latitude"
                                                        name="current_latitude" class="form-control"
                                                        autocomplete="off">
                                                    <label for="current_latitude">Current Latitude</label>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="current_longitude"
                                                        name="current_longitude" class="form-control"
                                                        autocomplete="off">
                                                    <label for="current_longitude">Current Longitude</label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="modal-footer d-flex justify-content-center">
                                            <div class="form-row">
                                                <div class="col">
                                                    <button class="btn btn-info btn-block" name="submitBtn"
                                                        id="submitBtn" type="submit">Add</button>
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-info btn-block"
                                                        type="reset">Reset</button>
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-info btn-block" type="button"
                                                        data-dismiss="modal" aria-label="Close">Close</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="step-actions">
                                            <div class="waves-effect waves-dark btn btn-sm btn-primary previous-step"
                                                onclick="disableTab('#tab1',false)">BACK</div>
                                        </div>
                                    </div>
                                    <!-- Panel 2 -->



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
