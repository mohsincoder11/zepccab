<!--Modal: modalVM-->
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Show Donor Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                {{csrf_field()}}
                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="show_first_name" name="first_name" class="form-control" autocomplete="off" disabled>
                            <label for="first_name" class="input-active">First Name</label>
                        </div></div>

                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="show_last_name" name="last_name" class="form-control" autocomplete="off" disabled>
                            <label for="last_name" class="input-active">Last Name</label>
                        </div></div>

                    <div class="col">
                        <div class="md-form mt-3">
                        <input type="text" id="show_gender" name="gender" class="form-control" autocomplete="off" disabled>
                        <label for="first_name" class="input-active">Gender</label>
                        </div></div>

                </div>

                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="show_mobile_number" maxlength="10" minlength="10" name="mobile_number" class="form-control" autocomplete="off" disabled>
                            <label for="mobile_number" class="input-active">Mobile Number</label>
                        </div></div>

                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="show_address" name="address" class="form-control" autocomplete="off" disabled>
                            <label for="address" class="input-active">Address</label>
                        </div></div>

                </div>

                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input placeholder="From Date" name="from_date" type="text" id="show_from_date" class="form-control datepicker" disabled>
                            <label for="date-picker-example" class="input-active">From Date</label>
                        </div></div>

                    <div class="col">
                        <div class="md-form mt-3">
                            <input placeholder="To Date" name="to_date" type="text" id="show_to_date" class="form-control datepicker" disabled>
                            <label for="date-picker-example" class="input-active">To Date</label>
                        </div></div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" id="show_quantity" name="quantity" class="form-control" autocomplete="off" disabled>
                            <label for="quantity" class="input-active">Quantity</label>
                        </div></div>

                    <div class="col">
                        <div class="md-form mt-3">
                        <input type="text" id="show_dialysis_type" name="gender" class="form-control" autocomplete="off" disabled>
                        <label for="dialysis_type" class="input-active">Dialysis Type</label>
                        </div></div>
                </div>
            </div>

        </div>
    </div>
</div>


