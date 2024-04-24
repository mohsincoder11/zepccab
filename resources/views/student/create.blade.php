<!--Modal: modalVM-->
<div class="modal fade" id="modalVM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid cascading-modal modal-full-height" role="document">
        <div class="modal-content">
            <div class="edge-header white">
                <ul class="nav nav-tabs md-tabs nav-justified gray mt-3" role="tablist">
                    <li class="nav-item" id="tab1">
                        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
                            <i class="fa fa-user pr-2"></i>Student Details</a>
                    </li>
                    <li class="nav-item disabled" id="tab2">
                        <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">
                            <i class="fa fa-heart pr-2"></i>Parents Details</a>
                    </li>
                    <li class="nav-item disabled " id="tab3">
                        <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">
                            <i class="fa fa-list pr-2"></i>About My Self</a>
                    </li>
                    <li class="nav-item disabled " id="tab4">
                        <a class="nav-link" data-toggle="tab" href="#panel4" role="tab">
                            <i class="fa fa-rupee pr-2"></i>Fees Details</a>
                    </li>
                </ul>
            </div>

            <div class=" free-bird modal-body mx-3">
                <div class="row">
                    <div class="col-md-8 col-lg-7 mx-auto float-none white z-depth-1 py-2 px-2">

                        <!--Naked Form-->
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{route('addStudent')}}" method="POST" id="StudentForm">
                            {{ csrf_field() }}

                            <!-- Tab panels -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">

                                        <div class="form-row">

                                            <div class="col">
                                                <select name="section_id" id="section_list" onchange="getClass(this.value)"  class="mdb-select colorful-select dropdown-primary" searchable="Search here..">
                                                    <option value="">Select Section</option>
                                                    <option value="1">Pre Primary</option>
                                                    <option value="2">Primary</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <select name="class_id" id="class_list" class="mdb-select colorful-select dropdown-primary" searchable="Search here..">
                                                    <option value="">Select Class</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off">
                                                    <label for="name">Full Name</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="marathi_name" name="marathi_name" class="form-control" autocomplete="off">
                                                    <label for="marathi_name">Marathi Name</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="admission_no" name="admission_no" class="form-control" autocomplete="off">
                                                    <label for="admission_no">Admission No.</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input placeholder="Date Of Birth" name="student_dob" type="text" id="date-picker-example" class="form-control datepicker">
                                                    <label for="date-picker-example">Date Of Birth</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="aadhar_no" name="aadhar_no" class="form-control" autocomplete="off">
                                                    <label for="aadhar_no">Addhar No</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="mobile_no" name="mobile_no" class="form-control" autocomplete="off">
                                                    <label for="mobile_no">Mobile No</label>
                                                </div></div>

                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="address" name="address" class="form-control" autocomplete="off">
                                                    <label for="address">Address</label>
                                                </div></div>

                                            <div class="file-field" style="margin-top: 25px;">
                                                <div class="btn-sm float-left" style="background-color: #0078D7!important; color: #fff!important;">
                                                    <span>Choose file</span>
                                                    <input type="file" name="photo" id="photo">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Student Image">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="step-actions">
                                                <div class="waves-effect waves-dark btn btn-sm btn-primary next-step" onclick="disableTab('#tab2',false)">CONTINUE</div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Panel 1 -->

                                    <!-- Panel 2 -->
                                    <div class="tab-pane fade" id="panel2" role="tabpanel">

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="father_name" name="father_name" class="form-control" autocomplete="off">
                                                    <label for="father_name">Father Name</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="father_qualification" name="father_qualification" class="form-control" autocomplete="off">
                                                    <label for="father_qualification">Qualification</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="father_occupation" name="father_occupation" class="form-control" autocomplete="off">
                                                    <label for="father_occupation">Occupation</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="mother_name" name="mother_name" class="form-control" autocomplete="off">
                                                    <label for="mother_name">Mother Name</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="mother_qualification" name="mother_qualification" class="form-control" autocomplete="off">
                                                    <label for="mother_qualification">Qualification</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="mother_occupation" name="mother_occupation" class="form-control" autocomplete="off">
                                                    <label for="mother_occupation">Occupation</label>
                                                </div></div>
                                        </div>

                                        <div class="step-actions">
                                            <div class="waves-effect waves-dark btn btn-sm btn-primary next-step" onclick="disableTab('#tab3',false)">CONTINUE</div>
                                            <div class="waves-effect waves-dark btn btn-sm btn-primary previous-step" onclick="disableTab('#tab1',false)">BACK</div>
                                        </div>
                                    </div>
                                    <!-- Panel 2 -->

                                    <!-- Panel 3 -->
                                    <div class="tab-pane fade" id="panel3" role="tabpanel">

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="brother_name" name="brother_name" class="form-control" autocomplete="off">
                                                    <label for="brother_name">Brother Name</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input placeholder="Date Of Birth" name="brother_dob" type="text" id="date-picker-example" class="form-control datepicker">
                                                    <label for="date-picker-example">Date Of Birth</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="sister_name" name="sister_name" class="form-control" autocomplete="off">
                                                    <label for="sister_name">Sister Name</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input placeholder="Date Of Birth" name="sister_dob" type="text" id="date-picker-example" class="form-control datepicker">
                                                    <label for="date-picker-example">Date Of Birth</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="grand_father_name" name="grand_father_name" class="form-control" autocomplete="off">
                                                    <label for="grand_father_name">Grand Father Name</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input placeholder="Date Of Birth" name="grand_father_dob" type="text" id="date-picker-example" class="form-control datepicker">
                                                    <label for="date-picker-example">Date Of Birth</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="grand_father_mobile" name="grand_father_mobile" class="form-control" autocomplete="off">
                                                    <label for="grand_father_mobile">Grand Father Mobile</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="grand_mother_name" name="grand_mother_name" class="form-control" autocomplete="off">
                                                    <label for="grand_mother_name">Grand Mother Name</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input placeholder="Date Of Birth" name="grand_mother_dob" type="text" id="date-picker-example" class="form-control datepicker">
                                                    <label for="date-picker-example">Date Of Birth</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="grand_mother_mobile" name="grand_mother_mobile" class="form-control" autocomplete="off">
                                                    <label for="grand_mother_mobile">Grand Mother Mobile</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="my_close_friends" name="my_close_friends" class="form-control" autocomplete="off">
                                                    <label for="my_close_friends">My Close Friend</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input placeholder="Date Of Birth" name="close_friend_dob" type="text" id="date-picker-example" class="form-control datepicker">
                                                    <label for="date-picker-example">Date Of Birth</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="close_friend_mobile" name="close_friend_mobile" class="form-control" autocomplete="off">
                                                    <label for="close_friend_mobile">Close Friend Mobile</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="neighbourer_first_name" name="neighbourer_first_name" class="form-control" autocomplete="off">
                                                    <label for="neighbourer_first_name">My Neighbourer First</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input placeholder="Date Of Birth" name="neignbourer_first_dob" type="text" id="date-picker-example" class="form-control datepicker">
                                                    <label for="date-picker-example">Date Of Birth</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="neignbourer_first_mobile" name="neignbourer_first_mobile" class="form-control" autocomplete="off">
                                                    <label for="neignbourer_first_mobile">Neignbourer Mobile (First)</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="neighbourer_second_name" name="neighbourer_second_name" class="form-control" autocomplete="off">
                                                    <label for="neighbourer_second_name">My Neighbourer Second</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input placeholder="Date Of Birth" name="neignbourer_second_dob" type="text" id="date-picker-example" class="form-control datepicker">
                                                    <label for="date-picker-example">Date Of Birth</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="neignbourer_second_mobile" name="neignbourer_second_mobile" class="form-control" autocomplete="off">
                                                    <label for="neignbourer_second_mobile">Neignbourer Mobile (Second)</label>
                                                </div></div>
                                        </div>

                                        <div class="step-actions">
                                            <div class="waves-effect waves-dark btn btn-sm btn-primary next-step" onclick="disableTab('#tab4',false)">CONTINUE</div>
                                            <div class="waves-effect waves-dark btn btn-sm btn-primary previous-step" onclick="disableTab('#tab2',false)">BACK</div>
                                        </div>

                                    </div>
                                    <!-- Panel 3 -->

                                    <!-- Panel 4 -->
                                    <div class="tab-pane fade" id="panel4" role="tabpanel">

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="total_fees" name="total_fees" class="form-control" autocomplete="off">
                                                    <label for="total_fees">Total Fees</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="deposite_fees" name="deposite_fees" class="form-control" autocomplete="off" onkeyup="getPendingFees(this.value)">
                                                    <label for="deposite_fees">Deposit Fees</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="pending_fees" name="pending_fees" class="form-control" autocomplete="off">
                                                    <label for="pending_fees" class="input-active">Pending Fees</label>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="modal-footer d-flex justify-content-center">
                                            <div class="form-row">
                                                <div class="col">
                                                    <button class="btn btn-info btn-block" name="submitBtn" id="submitBtn" type="submit">Add</button>
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-info btn-block" type="reset">Reset</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="step-actions">
                                            <div class="waves-effect waves-dark btn btn-sm btn-primary previous-step" onclick="disableTab('#tab3',false)">BACK</div>
                                        </div>

                                    </div>
                                    <!-- Panel 3 -->



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


