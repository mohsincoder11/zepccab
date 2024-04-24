<!--Modal: modalVM-->
<div class="modal fade" id="modalVM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid cascading-modal modal-full-height" role="document">
        <div class="modal-content">
            <div class="edge-header white">
                <ul class="nav nav-tabs md-tabs nav-justified gray mt-3" role="tablist">
                    <li class="nav-item" id="tab1">
                        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
                            <i class="fa fa-user pr-2"></i>Customer Details</a>
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
                            <form enctype="multipart/form-data" action="{{ route('addCustomer') }}" method="POST"
                                id="CustomerForm">
                                {{ csrf_field() }}

                                <!-- Tab panels -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">

                                        <div class="form-row">
                                            <div class="col-md-10">
                                                <select name="customer_id" id="customer_list" class="custom-select2"
                                                    style="width:100%">
                                                    <option value="">Select Customer</option>

                                                </select>
                                            </div>
                                            <a style="background-color: #f77014; margin-top: 18px;"
                                                class="btn-floating btn-sm " data-toggle="modal"
                                                data-target="#modalAddCustomer">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>


                                        <div class="form-row">
                                            <div class="step-actions">
                                                <div class="waves-effect waves-dark btn btn-sm btn-primary next-step open_modal2"
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
                                                <select name="travel_type" id="travel_type"
                                                    onchange="showDiv('hidden_div', this);"
                                                    class="mdb-select colorful-select dropdown-primary">
                                                    <option value="">Select Travel Type</option>
                                                    <option value="ride_now">Ride Now</option>
                                                    <option value="ride_later">Ride Later</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <select name="car_type_id" id="car_type_id"
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
                                                    <input type="text" id="from_location" name="from_location"
                                                        class="form-control" autocomplete="off">
                                                    <label for="from_location">From Location</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="to_location" name="to_location"
                                                        class="form-control" autocomplete="off">
                                                    <label for="to_location">To Location</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="from_latitude" name="from_latitude"
                                                        class="form-control" autocomplete="off">
                                                    <label for="from_latitude">From Latitude</label>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="from_longitude" name="from_longitude"
                                                        class="form-control" autocomplete="off">
                                                    <label for="from_longitude">From Longitude</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="to_latitude" name="to_latitude"
                                                        class="form-control" autocomplete="off">
                                                    <label for="to_latitude">To Latitude</label>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="to_longitude" name="to_longitude"
                                                        class="form-control" autocomplete="off">
                                                    <label for="to_longitude">To Longitude</label>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="form-row" id="purpose" style="display:none">

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="date" id="ride_later_date" name="ride_later_date"
                                                        class="form-control" autocomplete="off">
                                                    <label for="ride_later_date" class="input-active">Date</label>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="time" id="ride_later_time" name="ride_later_time"
                                                        class="form-control" autocomplete="off">
                                                    <label for="ride_later_time" class="input-active">Time</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="col">
                                                <select name="driver_id" id="driver_id"
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


                                        <!--
          <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                         <input type="text" id="average_per_litre" name="average_per_litre" class="form-control" autocomplete="off">
                                                    <label for="average_per_litre">Average / Litre</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                           <input type="text" id="driver_allowance" name="driver_allowance" class="form-control" autocomplete="off">
                                                    <label for="driver_allowance">Driver Allowance</label>
                                                </div></div>
           
           <div class="col">
                                                <div class="md-form mt-3">
                                             <input type="text" id="route_direction" name="route_direction" class="form-control" autocomplete="off">
                                                    <label for="route_direction">Route Direction</label>
                                                </div></div>
                                        </div>


-->
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
