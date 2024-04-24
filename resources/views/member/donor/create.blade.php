<!--Modal: modalVM-->
<div class="modal fade" id="modalVM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Donors Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form action="{{route('addDonor')}}" method="POST" id="RegisterForm">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="first_name" name="first_name" class="form-control" autocomplete="off">
                                <label for="first_name">First Name</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="last_name" name="last_name" class="form-control" autocomplete="off">
                                <label for="last_name">Last Name</label>
                            </div></div>

                        <div class="col">
                            <select name="gender" id="gender" class="mdb-select colorful-select dropdown-primary">
                                <option>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="mobile_number" maxlength="10" minlength="10" name="mobile_number" class="form-control" autocomplete="off">
                                <label for="mobile_number">Mobile Number</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="address" name="address" class="form-control" autocomplete="off">
                                <label for="address">Address</label>
                            </div></div>

                    </div>

                    <div class="card-header" role="tab" id="headingOne" style="background-color: #e1f4fe;">
                        <a data-toggle="collapse" href="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                            <h5 class="mb-0">
                                Donation Details <i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Collapsible element -->
<div class="collapse" id="collapseExample1">
    <div class="mt-3">
        <div class="modal-body mx-3">
            <div class="form-row">
                <div class="col">
                    <div class="md-form mt-3">
                        <input placeholder="From Date" name="from_date" type="text" id="date-picker-example" class="form-control datepicker">
                        <label for="date-picker-example">From Date</label>
                    </div></div>

                <div class="col">
                    <div class="md-form mt-3">
                        <input placeholder="To Date" name="to_date" type="text" id="date-picker-example" class="form-control datepicker">
                        <label for="date-picker-example">To Date</label>
                    </div></div>

            </div>

            <div class="form-row">
                <div class="col">
                    <div class="md-form mt-3">
                        <input type="text" id="quantity" name="quantity" class="form-control" autocomplete="off">
                        <label for="quantity">Quantity</label>
                    </div></div>

                <div class="col">
                    <select name="dialysis_type" id="dialysis_type" class="mdb-select colorful-select dropdown-primary">
                        <option>Select Type</option>
                        <option value="free">Free</option>
                        <option value="special">Special</option>
                    </select></div>
            </div>
        </div>
    </div>
</div>
                    <!-- / Collapsible element -->
    <div class="modal-footer d-flex justify-content-center">
<div class="form-row">

    <div class="col">
        <button class="btn btn-info btn-block" name="submitBtn" id="submitBtn" type="submit">Register</button>
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
</div>


