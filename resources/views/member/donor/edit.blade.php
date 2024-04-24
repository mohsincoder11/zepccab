<!--Modal: modalVM-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">

<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title w-100 font-weight-bold">Update Donor Details</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body mx-3">
    <form action="{{route('updateDonor')}}" method="POST" id="editForm">
        {{ csrf_field() }}
        <div class="form-row">
            <div class="col">
                <div class="md-form mt-3">
                    <input type="text" id="edit_first_name" name="first_name" class="form-control" autocomplete="off">
                    <label for="first_name" class="input-active">First Name</label>
                </div></div>

            <div class="col">
                <div class="md-form mt-3">
                    <input type="text" id="edit_last_name" name="last_name" class="form-control" autocomplete="off">
                    <label for="last_name" class="input-active">Last Name</label>
                </div></div>

            <div class="col">
                <select name="gender" id="edit_gender" class="mdb-select colorful-select dropdown-primary">
                    <option>Select Gender</option>
                </select>
            </div>

        </div>

        <div class="form-row">
            <div class="col">
                <div class="md-form mt-3">
                    <input type="text" id="edit_mobile_number" maxlength="10" minlength="10" name="mobile_number" class="form-control" autocomplete="off">
                    <label for="mobile_number" class="input-active">Mobile Number</label>
                </div></div>

            <div class="col">
                <div class="md-form mt-3">
                    <input type="text" id="edit_address" name="address" class="form-control" autocomplete="off">
                    <label for="address" class="input-active">Address</label>
                </div></div>

        </div>

        <div class="form-row">
            <div class="col">
                <div class="md-form mt-3">
                    <input name="from_date" type="date" id="edit_from_date" class="form-control">
                    <label for="from_date" class="input-active">From Date</label>
                </div></div>

            <div class="col">
                <div class="md-form mt-3">
                    <input name="to_date" type="date" id="edit_to_date" class="form-control">
                    <label for="to_date" class="input-active">To Date</label>
                </div></div>

        </div>

        <div class="form-row">
            <div class="col">
                <div class="md-form mt-3">
                    <input type="text" id="edit_quantity" name="quantity" class="form-control" autocomplete="off">
                    <label for="quantity" class="input-active">Quantity</label>
                </div></div>

            <div class="col">
                <select name="dialysis_type" id="edit_dialysis_type" class="mdb-select colorful-select dropdown-primary">
                    <option>Select Type</option>

                </select></div>
        </div>

        <div class="justify-content-center">
            <div class="form-row">

                <div class="col">
                    <button class="btn btn-info btn-block" name="submitBtn" id="editBtn" type="submit">Update</button>
                </div>
                <div class="col">
                    <button class="btn btn-info btn-block" type="reset">Reset</button>
                </div>

            </div>
        </div>

</div>
    </form>
</div>

</div>
</div>
</div>


