<!--Modal: modalVM-->
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Patient Dialysis Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form action="{{route('addPatientDetails')}}" method="POST" id="editForm1">
                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="col">
                            <select name="dialysis_type" id="dialysis_type" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Type</option>
                                <option value="free">Free</option>
                                <option value="special">Special</option>
                                <option value="paid">Paid</option>
                            </select></div>

                        <div class="col">
                            <select name="assign_by" id="assign_by" class="mdb-select colorful-select dropdown-primary">
                                <option>Assign By</option>
                                <option value="admin">Admin</option>
                                <option value="hospital">Hospital</option>
                                <option value="bc">Booking Center</option>
                            </select></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" name="submitBtn" id="editBtn" type="submit">Create</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="reset">Reset</button>
                        </div>
                        <div class="col">
                        </div>
                    </div>
            </div>
            </form>
        </div>

    </div>
</div>
</div>


