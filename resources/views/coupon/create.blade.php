<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Coupon</h5>

            </div>
            <form enctype="multipart/form-data" action="{{route('addCoupon')}}" method="POST" id="AddCoupon">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
                            <select name="city_id" id="city_id" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select City</option>
								<option value="all">All</option>
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    $cities =DB::table('city')->select('id','name')->get();
                                @endphp
                                @foreach( $cities as $city )
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="name" name="name" class="form-control" autocomplete="off">
                                <label for="name">Name</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="car_type" id="car_type" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Car Type</option>
                                <option value="auto">Auto</option>
                                <option value="non_auto">Non Auto</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="type[]" id="type" multiple class="mdb-select colorful-select dropdown-primary">
                                <option value="" disabled>Select Type</option>
                                <option value="after_completing_ride">After Completing Ride</option>
                                <option value="no_of_times">No Of Times</option>
                            </select>
                        </div>
                    </div>
					
					<div class="form-row">
					 <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="after_completing_ride_no" name="after_completing_ride_no" class="form-control" autocomplete="off">
                                <label for="after_completing_ride_no">After Completing Ride No</label>
                            </div></div>
						
						<div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="no_of_times_no" name="no_of_times_no" class="form-control" autocomplete="off">
                                <label for="no_of_times_no">No Of Times No</label>
                            </div></div>
						</div>
					
					
					<div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input placeholder="Ride From Date" name="ride_from_date" type="text" id="date-picker-example" class="form-control datepicker" style="margin-top: 42px;">
                                <label for="date-picker-example">Ride From Date</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input placeholder="Ride To Date" name="ride_to_date" type="text" id="date-picker-example" class="form-control datepicker" style="margin-top: 42px;">
                                <label for="date-picker-example">Ride To Date</label>
                            </div></div>
                    </div>


                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input placeholder="From Date" name="from_date" type="text" id="date-picker-example" class="form-control datepicker" style="margin-top: 42px;">
                                <label for="date-picker-example">From Date</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input placeholder="To Date" name="to_date" type="text" id="date-picker-example" class="form-control datepicker" style="margin-top: 42px;">
                                <label for="date-picker-example">To Date</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="variation" id="variation" class="mdb-select colorful-select dropdown-primary">
                                <option value="variation">Select Variation</option>
                                <option value="percentage">Percentage</option>
                                <option value="rupee">Rupee</option>

                            </select>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="value" name="value" class="form-control" autocomplete="off">
                                <label for="value">Value (Amount / Percentage)</label>
                            </div></div>
						
						<div class="col">
                            <select name="hide" id="hide" class="mdb-select colorful-select dropdown-primary">
                                <option value="variation">Do You Want Show</option>
                                <option value="0">Yes</option>
                                <option value="1">No</option>

                            </select>
                        </div>

                    </div>

                     <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="minimum_value" name="minimum_value" class="form-control" autocomplete="off">
                                <label for="minimum_value">Minimum Value (Amount)</label>
                            </div></div>

                                        <div class="col">
                                                <div class="file-field" style="margin-top: 25px;">
                                                    <div class="btn-sm float-left" style="background-color: #66bcb2!important; color: #fff!important;">
                                                        <span>Choose file</span>
                                                        <input type="file" name="coupon_image" id="coupon_image">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text" placeholder="Upload Coupon Image">
                                                    </div>
                                                </div>
                                            </div>


                    </div>
					
					
					<div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <textarea type="text" id="description" name="description" class="form-control" rows="2" autocomplete="off"></textarea>
                                <label for="description">Description</label>
                            </div></div>
						
						</div>
						
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="submitadd" id="submitadd" type="submit">Add</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="reset">Reset</button>
                        </div>
                         <div class="col">
                            <button class="btn btn-info btn-block" type="button" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
