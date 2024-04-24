<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Package Master</h5>

            </div>
            <form id="editForm" action="{{ route('updatePackageMaster2') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_package_title" name="package_title" class="form-control"
                                    autocomplete="off">
                                <label for="package_title">Package Title</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class=" ">
                                <select name="package_type" id="edit_package_type" class="mdb-select colorful-select dropdown-primary">
                                    <option value="" disabled>Select Package Type</option>
                                    <option value="Company">Company</option>
                                    <option value="Vendor">Vendor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_per_km_amount" name="per_km_amount" class="form-control"
                                    autocomplete="off">
                                <label for="per_km_amount">Per KM Amount</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_per_day_amount" name="per_day_amount" class="form-control"
                                    autocomplete="off">
                                <label for="per_day_amount">Per Day Amount</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_per_day_desc" name="per_day_desc" class="form-control"
                                    autocomplete="off">
                                <label for="per_day_desc">Per Day Description</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_per_km_desc" name="per_km_desc" class="form-control"
                                    autocomplete="off">
                                <label for="per_km_desc">Per KM Description</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_waiting_charge" name="waiting_charge" class="form-control"
                                    autocomplete="off">
                                <label for="waiting_charge">Waiting Charge</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_toll_n_parking_desc" name="toll_n_parking_desc"
                                    class="form-control" autocomplete="off">
                                <label for="toll_n_parking_desc">Toll & Parking Description</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_night_hault_desc" name="night_hault_desc" class="form-control"
                                    autocomplete="off">
                                <label for="night_hault_desc">Night Hault Description</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_fixed_rate" name="fixed_rate" class="form-control"
                                    autocomplete="off">
                                <label for="fixed_rate">Fixed Rate</label>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="submitadd" id="editBtn"
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
    </div>
</div>
