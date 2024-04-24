<!--Modal: modalVM-->
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">

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
                    <span><b>First Name :- </b></span> &nbsp;&nbsp; <p id="show_first_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>Last Name :- </b></span> &nbsp;&nbsp; <p id="show_last_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>Age :- </b></span> &nbsp;&nbsp; <p id="show_age"> </p>
                </div>

                <div class="form-row">
                    <span><b>Email :- </b></span> &nbsp;&nbsp; <p id="show_email_id"> </p>
                </div>

                <div class="form-row">
                    <span><b>Level Name :- </b></span> &nbsp;&nbsp; <p id="show_level_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>District Name :- </b></span> &nbsp;&nbsp; <p id="show_district_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>School Name :- </b></span> &nbsp;&nbsp; <p id="show_school_name"> </p>

                </div>

                <div class="form-row">
                    <span><b>Address :- </b></span> &nbsp;&nbsp; <p id="show_address"> </p>

                </div>

                <div class="form-row">
                    <span><b>Payment Methed :- </b></span> &nbsp;&nbsp; <p id="show_payment_method"> </p>

                </div>

                <div class="form-row">
                    <span><b>Payment Description :- </b></span> &nbsp;&nbsp; <p id="show_payment_desc"> </p>

                </div>

                <div class="form-row">
                    <span><b>Student Status :- </b></span> &nbsp;&nbsp; <p id="show_status"> </p>

                </div>

                <div class="form-row">
                    <span><b>Student Type :- </b></span> &nbsp;&nbsp; <p id="show_student_type"> </p>

                </div>

            </div>

        </div>
    </div>
</div>


