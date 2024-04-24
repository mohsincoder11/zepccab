<!--Modal: modalVM-->
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Show Coupon Details</h4>
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
                    <span><b>Coupon Name :- </b></span> &nbsp;&nbsp; <p id="show_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>From Date :- </b></span> &nbsp;&nbsp; <p id="show_from_date"> </p>
                </div>

                <div class="form-row">
                    <span><b>To Date :- </b></span> &nbsp;&nbsp; <p id="show_to_date"> </p>
                </div>

                <div class="form-row">
                    <span><b>Variation :- </b></span> &nbsp;&nbsp; <p id="show_variation"> </p>
                </div>

                <div class="form-row">
                    <span><b>Car Type :- </b></span> &nbsp;&nbsp; <p id="show_car_type"> </p>
                </div>

                <div class="form-row">
                    <span><b>Type :- </b></span> &nbsp;&nbsp; <p id="show_type"> </p>
                </div>

                <div class="form-row">
                    <span><b>After Completing Ride No :- </b></span> &nbsp;&nbsp; <p id="show_after_completing_ride_no"> </p>

                </div>

                <div class="form-row">
                    <span><b>No Of Times No :- </b></span> &nbsp;&nbsp; <p id="show_no_of_times_no"> </p>
                </div>

                <div class="form-row">
                    <span><b>Value :- </b></span> &nbsp;&nbsp; <p id="show_value"> </p>
                </div>

                <div class="form-row">
                    <span><b>Minimum Value:- </b></span> &nbsp;&nbsp; <p id="show_minimum_value"> </p>
                </div>

                <div class="form-row">
                    <span><b>Description :- </b></span> &nbsp;&nbsp; <p id="show_description"> </p>
                </div>

                <div class="form-row">
                    <span><b>Ride From Date :- </b></span> &nbsp;&nbsp; <p id="show_ride_from_date"> </p>
                </div>

                <div class="form-row">
                    <span><b>Ride To Date :- </b></span> &nbsp;&nbsp; <p id="show_ride_to_date"> </p>
                </div>

            </div>

        </div>
    </div>
</div>


