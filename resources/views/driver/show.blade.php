<!--Modal: modalVM-->
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">

        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Show Driver Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                {{csrf_field()}}
{{--                <div class="form-row">--}}
{{--                    <div id="driver_image"></div>--}}
{{--                </div>--}}

                <div class="form-row">
                    <span><b>Drive City :- </b></span> &nbsp;&nbsp; <p id="show_city_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>Name :- </b></span> &nbsp;&nbsp; <p id="show_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>Email :- </b></span> &nbsp;&nbsp; <p id="show_email_id"> </p>
                </div>

                <div class="form-row">
                    <span><b>Mobile :- </b></span> &nbsp;&nbsp; <p id="show_mobile_no"> </p>
                </div>

                <div class="form-row">
                    <span><b>Address :- </b></span> &nbsp;&nbsp; <p id="show_address"> </p>
                </div>

                <div class="form-row">
                    <span><b>City :- </b></span> &nbsp;&nbsp; <p id="show_city"> </p>
                </div>

                <div class="form-row">
                    <span><b>Bank Details :- </b></span> &nbsp;&nbsp; <p id="show_bank_details"> </p>
                </div>

                <div class="form-row">
                    <span><b>Aadhar No :- </b></span> &nbsp;&nbsp; <p id="show_aadhar_card"> </p>

                </div>

                <div class="form-row">
                    <span><b>Licence No :- </b></span> &nbsp;&nbsp; <p id="show_driving_license"> </p>

                </div>

                <div class="form-row">
                    <span><b>Secondary Mobile Number :- </b></span> &nbsp;&nbsp; <p id="show_secondary_mobile_no"> </p>
                </div>

                <div class="form-row">
                    <span><b>Car Number :- </b></span> &nbsp;&nbsp; <p id="show_car_number"> </p>
                </div>

                <div class="form-row">
                    <span><b>Owner Name :- </b></span> &nbsp;&nbsp; <p id="show_owner_name"> </p>
                </div>
                <div class="form-row">
                    <span><b>Vendor Name :- </b></span> &nbsp;&nbsp; <p id="show_vendor_name"> </p>
                </div>
                
                <div class="form-row">
                    <div class="col">
                        <span><b>Driver Image :- </b></span> &nbsp;&nbsp; <div id="show_photos"></div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>


