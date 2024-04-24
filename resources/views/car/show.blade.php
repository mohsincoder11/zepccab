<!--Modal: modalVM-->
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Show Car Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                {{csrf_field()}}


                <div class="form-row">
                    <span><b>City :- </b></span> &nbsp;&nbsp; <p id="show_city"> </p>
                </div>

                <div class="form-row">
                    <span><b>Car Type :- </b></span> &nbsp;&nbsp; <p id="show_car_type"> </p>
                </div>

                <div class="form-row">
                    <span><b>Car Name :- </b></span> &nbsp;&nbsp; <p id="show_car_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>Car Model :- </b></span> &nbsp;&nbsp; <p id="show_car_model"> </p>
                </div>

                <div class="form-row">
                    <span><b>Owner Name :- </b></span> &nbsp;&nbsp; <p id="show_owner_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>Owner Primary Mobile No :- </b></span> &nbsp;&nbsp; <p id="show_primary_mobile"> </p>
                </div>

                <div class="form-row">
                    <span><b>Owner Secondary Mobile No :- </b></span> &nbsp;&nbsp; <p id="show_secondary_mobile"> </p>
                </div>

                <div class="form-row">
                    <span><b>Fuel Type :- </b></span> &nbsp;&nbsp; <p id="show_fuel_type"> </p>

                </div>

                <div class="form-row">
                    <span><b>Registration No :- </b></span> &nbsp;&nbsp; <p id="show_reg_no"> </p>
                </div>

                <div class="form-row">
                    <span><b>Car Number :- </b></span> &nbsp;&nbsp; <p id="show_car_number"> </p>
                </div>

                <div class="form-row">
                    <span><b>Car Insurance Validity :- </b></span> &nbsp;&nbsp; <p id="show_car_validity"> </p>
                </div>

                 <div class="form-row">
                    <span><b>Owner Bank Details :- </b></span> &nbsp;&nbsp; <p id="show_bank_details"> </p>
                </div>


                <div class="form-row">
                    <div class="col">
                        <span><b>Front Image :- </b></span> &nbsp;&nbsp; <div id="show_photos"></div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


