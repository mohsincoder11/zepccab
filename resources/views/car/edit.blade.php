<!--Modal: modalVM-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Update Car Details</h4>

            </div>
            <div class="modal-body mx-3">
                <form enctype="multipart/form-data" action="{{ route('updateCar') }}" method="POST" id="editForm">
                    {{ csrf_field() }}

                    <div class="form-row">

                        <div class="col">
                            <select name="city_id" id="edit_cities" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select City</option>
                            </select>
                        </div>

                        <div class="col">
                            <select name="car_type_id" id="edit_car_type_id"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Car Type</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_car_name" name="car_name" class="form-control"
                                    autocomplete="off">
                                <label for="edit_car_name" class="input-active">Car Name</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_owner_name" name="owner_name" class="form-control"
                                    autocomplete="off">
                                <label for="edit_owner_name" class="input-active">Owner Name</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_car_model" name="car_model" class="form-control"
                                    autocomplete="off">
                                <label for="edit_car_model" class="input-active">Year Of Model</label>
                            </div>
                        </div>

                        <div class="col">
                            <select name="fuel_type" id="edit_fuel_type"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Fuel Type</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_car_number" name="car_number" class="form-control"
                                    autocomplete="off">
                                <label for="edit_car_number" class="input-active">Car Number</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_registration_number" name="registration_number"
                                    class="form-control" autocomplete="off">
                                <label for="edit_registration_number" class="input-active">Chassis Number</label>
                            </div>
                        </div>

                    </div>



                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_owner_primary_mobile" name="owner_primary_mobile"
                                    class="form-control" autocomplete="off">
                                <label for="edit_owner_primary_mobile" class="input-active">Owner's Primary Mobile
                                    No</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_owner_secondary_mobile" name="owner_secondary_mobile"
                                    class="form-control" autocomplete="off">
                                <label for="edit_owner_secondary_mobile" class="input-active">Owner's Secondary Mobile
                                    No</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_bank_details" name="bank_details"
                                    class="form-control" autocomplete="off">
                                <label for="edit_bank_details" class="input-active">Bank Details</label>
                            </div>
                        </div>

                        <div class="col">
                            <select name="driver_id" id="edit_driver_id"
                                class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Driver</option>
                            </select>
                            <label>Select Driver</label>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-info btn-block" id="editBtn" type="submit">Update</button>
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
</div>
