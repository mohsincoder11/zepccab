<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Chapter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('updateCoupon')}}" method="POST" id="editForm">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <select name="city_id" id="edit_city_id" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select City</option>

                            </select>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_name" name="name" class="form-control" autocomplete="off">
                                <label for="name" class="input-active">Name</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="car_type" id="edit_car_type" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Car Type</option>
                                <option value="auto">Auto</option>
                                <option value="non_auto">Non Auto</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="type[]" id="edit_type" multiple class="mdb-select colorful-select dropdown-primary">
                                <option value="" disabled>Select Type</option>
                                <option value="after_completing_ride">After Completing Ride</option>
                                <option value="no_of_times">No Of Times</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_after_completing_ride_no" name="after_completing_ride_no" class="form-control" autocomplete="off">
                                <label for="edit_after_completing_ride_no" class="input-active">After Completing Ride No</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_no_of_times_no" name="no_of_times_no" class="form-control" autocomplete="off">
                                <label for="edit_no_of_times_no" class="input-active">No Of Times No</label>
                            </div></div>
                    </div>


                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <label for="date-picker-example" style="margin-top: -30px;">From Date</label>
                                <input placeholder="From date" type="date" id="edit_from_date" name="from_date"  class="form-control">
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <label for="date-picker-example" style="margin-top: -30px;">To Date</label>
                                <input placeholder="From date" type="date" id="edit_to_date" name="to_date"  class="form-control">
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <label for="date-picker-example" style="margin-top: -30px;">Ride From Date</label>
                                <input placeholder="From date" type="date" id="edit_ride_from_date" name="ride_from_date"  class="form-control">
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <label for="date-picker-example" style="margin-top: -30px;">Ride To Date</label>
                                <input placeholder="From date" type="date" id="edit_ride_to_date" name="ride_to_date"  class="form-control">
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="variation" id="edit_variation" class="mdb-select colorful-select dropdown-primary">
                                <option value="variation">Select Variation</option>
                            </select>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_value" name="value" class="form-control" autocomplete="off">
                                <label for="value" class="input-active">Value (Amount / Percentage)</label>
                            </div></div>

                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_minimum_value" name="minimum_value" class="form-control" autocomplete="off">
                                <label for="minimum_value" class="input-active">Minimum Value (Amount)</label>
                            </div></div>
                    </div>
                    <br>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-info btn-block" id="editBtn" type="submit">Update</button>
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
            </form>


        </div>
    </div>
</div>
