<div class="modal fade" id="editModal-old" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Link To Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updateLinkDriver') }}" method="POST" id="editForm">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
                            <select name="driver_id" id="driver_id" class="custom-select2" style="width:100%">
                                <option value="">Select Driver</option>
                                @php
                                    $drivers = DB::table('driver')->select('id', 'first_name', 'last_name', 'city')->orderby('first_name', 'ASC')->get();
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
                            <button class="btn btn-info btn-block" name="editBtn" id="editBtn"
                                type="submit">Link</button>
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




<div class="modal fade" id="editModalRental" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Rental Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updateRentalCustomer') }}" method="POST" id="editFormRentalPackage">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
                            <select name="city_id" id="city_list" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select City</option>

                            </select>
                        </div>

                        <div class="col">
                            <select name="package_id" id="package_list"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Package</option>

                            </select>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="cartype_id" id="cartype_list"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Car Type</option>

                            </select>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_amount" name="amount" class="form-control"
                                    autocomplete="off">
                                <label for="amount" class="input-active">Amount</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="travel_type" id="travel_type_list" onchange="showDiv('hidden_div', this);"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Travel Type</option>

                            </select>
                        </div>
                    </div>


                    <div class="form-row">

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_pick_location" name="pick_location" class="form-control"
                                    autocomplete="off">
                                <label for="pick_location" class="input-active">Pick Location</label>
                            </div>
                        </div>

                        <div class="col" style="margin-top:11px;">
                            <select name="driver_id" id="driver_list" class="custom-select2" style="width: 100%;">
                                <option value="">Select Driver</option>

                            </select>
                        </div>
                    </div>


                    <div class="form-row">


                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_distance_user_destination_km"
                                    name="distance_user_destination_km" class="form-control" autocomplete="off">
                                <label for="edit_distance_user_destination_km" class="input-active">Total Km</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_custoemr_amount" name="custoemr_amount"
                                    class="form-control" autocomplete="off">
                                <label for="edit_custoemr_amount" class="input-active">Customer Amount</label>
                            </div>
                        </div>

                        <div class="col">
                            <select name="status" id="status_list"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Status</option>

                            </select>
                        </div>

                    </div>




                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_driver_allowance" name="driver_allowance"
                                    class="form-control" autocomplete="off">
                                <label for="edit_driver_allowance" class="input-active">Driver Allowance</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_parking_and_tolltax" name="parking_and_tolltax"
                                    class="form-control" autocomplete="off">
                                <label for="edit_parking_and_tolltax" class="input-active">Parking and Tolltax</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_extra_perkm_rate" name="extra_perkm_rate"
                                    class="form-control" autocomplete="off">
                                <label for="edit_extra_perkm_rate" class="input-active">Extra Perkm Rate</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_customer_extra_kms" name="customer_extra_kms"
                                    class="form-control" autocomplete="off">
                                <label for="edit_customer_extra_kms" class="input-active">Customer Extra Kms</label>
                            </div>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_extra_min_rate" name="extra_min_rate"
                                    class="form-control" autocomplete="off">
                                <label for="edit_extra_min_rate" class="input-active">Extra Min Rate</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_customer_extra_time" name="customer_extra_time"
                                    class="form-control" autocomplete="off">
                                <label for="edit_customer_extra_time" class="input-active">Customer Extra Time</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="editBtnDetails" id="editBtnDetails"
                                type="submit">Update</button>
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


<div class="modal fade" id="viewModalRental" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Rental Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
                            <select name="city_id" id="show_city_list" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select City</option>

                            </select>
                        </div>

                        <div class="col">
                            <select name="package_id" id="show_package_list"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Package</option>

                            </select>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="cartype_id" id="show_cartype_list"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Car Type</option>

                            </select>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="show_edit_amount" name="amount" class="form-control"
                                    autocomplete="off">
                                <label for="amount" class="input-active">Amount</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="travel_type" id="show_travel_type_list" onchange="showDiv('hidden_div', this);"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Travel Type</option>

                            </select>
                        </div>
                    </div>


                    <div class="form-row">

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="show_edit_pick_location" name="pick_location" class="form-control"
                                    autocomplete="off">
                                <label for="pick_location" class="input-active">Pick Location</label>
                            </div>
                        </div>

                        <div class="col" style="margin-top:11px;">
                            <select name="driver_id" id="show_driver_list" class="custom-select2" style="width: 100%;">
                                <option value="">Select Driver</option>

                            </select>
                        </div>
                    </div>


                    <div class="form-row">


                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="show_edit_distance_user_destination_km"
                                    name="distance_user_destination_km" class="form-control" autocomplete="off">
                                <label for="edit_distance_user_destination_km" class="input-active">Total Km</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="show_edit_custoemr_amount" name="custoemr_amount"
                                    class="form-control" autocomplete="off">
                                <label for="edit_custoemr_amount" class="input-active">Customer Amount</label>
                            </div>
                        </div>

                        <div class="col">
                            <select name="status" id="show_status_list"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Status</option>

                            </select>
                        </div>

                    </div>




                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="show_edit_driver_allowance" name="driver_allowance"
                                    class="form-control" autocomplete="off">
                                <label for="edit_driver_allowance" class="input-active">Driver Allowance</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="show_edit_parking_and_tolltax" name="parking_and_tolltax"
                                    class="form-control" autocomplete="off">
                                <label for="edit_parking_and_tolltax" class="input-active">Parking and Tolltax</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="show_edit_extra_perkm_rate" name="extra_perkm_rate"
                                    class="form-control" autocomplete="off">
                                <label for="edit_extra_perkm_rate" class="input-active">Extra Perkm Rate</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="show_edit_customer_extra_kms" name="customer_extra_kms"
                                    class="form-control" autocomplete="off">
                                <label for="edit_customer_extra_kms" class="input-active">Customer Extra Kms</label>
                            </div>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="show_edit_extra_min_rate" name="extra_min_rate"
                                    class="form-control" autocomplete="off">
                                <label for="edit_extra_min_rate" class="input-active">Extra Min Rate</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="show_edit_customer_extra_time" name="customer_extra_time"
                                    class="form-control" autocomplete="off">
                                <label for="edit_customer_extra_time" class="input-active">Customer Extra Time</label>
                            </div>
                        </div>
                    </div>

                   
                </div>


        </div>
    </div>
</div>