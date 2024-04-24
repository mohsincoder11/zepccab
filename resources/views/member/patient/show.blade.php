<!--Modal: modalVM-->
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Show Student Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                {{csrf_field()}}
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" disabled id="show_first_name" name="first_name" class="form-control" autocomplete="off">
                                <label for="first_name" class="input-active">First Name</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" disabled id="show_last_name" name="last_name" class="form-control" autocomplete="off">
                                <label for="last_name" class="input-active">Last Name</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="number" disabled id="show_mobile_no" name="mobile_no" class="form-control" autocomplete="off">
                                <label for="mobile_no" class="input-active">Mobile Number</label>
                            </div></div>

                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" disabled id="show_gender" name="gender" class="form-control" autocomplete="off">
                                <label for="show_gender" class="input-active">Gender</label>
                            </div></div>


                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" disabled id="show_city" name="city" class="form-control" autocomplete="off">
                                <label for="city" class="input-active">City</label>
                            </div></div>


                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" disabled name="pincode" id="show_pincode" class="form-control" autocomplete="off">
                                <label for="pincode" class="input-active">Pincode</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" disabled name="email" id="show_email" class="form-control" autocomplete="off">
                                <label for="email" class="input-active">Email</label>
                            </div></div>

                    </div>


                    <div class="form-row">

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" disabled id="show_plan_id" name="plan_id" class="form-control" autocomplete="off">
                                <label for="show_plan_id" class="input-active">Plan</label>
                            </div></div>


                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" disabled id="show_board_id" name="board_id" class="form-control" autocomplete="off">
                                <label for="show_board_id" class="input-active">Board</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" disabled id="show_class_id" name="class_id" class="form-control" autocomplete="off">
                                <label for="show_class_id" class="input-active">Class</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" disabled id="show_type_id" name="type_id" class="form-control" autocomplete="off">
                                <label for="show_type_id" class="input-active">Student Type</label>
                            </div></div>

                    </div>

                <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" disabled id="show_collage" name="collage" class="form-control" autocomplete="off">
                            <label for="show_collage" class="input-active">College</label>
                        </div></div>

                    <div class="col">
                        <div class="md-form mt-3">
                            <input type="text" disabled id="show_address" name="address" class="form-control" autocomplete="off">
                            <label for="address" class="input-active">Address</label>
                        </div></div>

                </div>

            </div>

        </div>
    </div>
</div>


