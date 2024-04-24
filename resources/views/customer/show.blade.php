<!--Modal: modalVM-->
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">

        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Show Customer Details</h4>
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
                    <span><b>Name :- </b></span> &nbsp;&nbsp; <p id="show_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>Mobile :- </b></span> &nbsp;&nbsp; <p id="show_mobile_no"> </p>
                </div>

                <div class="form-row">
                    <span><b>Email :- </b></span> &nbsp;&nbsp; <p id="show_email_id"> </p>
                </div>

                <div class="form-row">
                    <span><b>Car Type :- </b></span> &nbsp;&nbsp; <p id="show_car_types_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>Travel Type :- </b></span> &nbsp;&nbsp; <p id="show_travel_type_name"> </p>
                </div>

                <div class="form-row">
                    <span><b>From Latitude :- </b></span> &nbsp;&nbsp; <p id="show_from_latitude"> </p>
                </div>

                <div class="form-row">
                    <span><b>From Longitude :- </b></span> &nbsp;&nbsp; <p id="show_from_longitude"> </p>

                </div>

                <div class="form-row">
                    <span><b>To Latitude :- </b></span> &nbsp;&nbsp; <p id="show_to_latitude"> </p>

                </div>

                <div class="form-row">
                    <span><b>To Longitude :- </b></span> &nbsp;&nbsp; <p id="show_to_longitude"> </p>

                </div>

            </div>

        </div>
    </div>
</div>


