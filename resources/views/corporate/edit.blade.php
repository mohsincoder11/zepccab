<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Driver Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('updateCorporateLinkDriver')}}" method="POST" id="editForm">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
                            <select name="driver_id" id="driver_id" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Driver</option>
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    $drivers =DB::table('driver')->select('id','first_name','last_name')->orderby('first_name','ASC')->get();
                                @endphp
                                @foreach( $drivers as $driver )
                                    <option value="{{$driver->id}}">{{$driver->first_name}} {{$driver->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="editBtn" id="editBtn" type="submit">Link</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

<div class="modal fade" id="editModalBookingItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Corporate Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('UpdateCorporateBooking')}}" method="POST" id="editFormCorporateBooking">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
							<label>Select Driver</label>
                            <select name="driver_id" id="edit_driver_id" class="browser-default custom-select">
                                <option value="">Select Driver</option>
                            </select>
                        </div>
                    </div>
					

                    <div class="form-row mt-2">
                        <div class="col">
                            <div class="md-form mt-3">
                                <label for="date-picker-example" style="margin-top: -30px;">Date</label>
                                <input placeholder="From date" type="date" name="date" id="edit_date"  class="form-control">
                            </div></div>

                        <div class="col">
                            <select name="status" id="edit_status" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Status</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_distance_km" name="distance_km" class="form-control" autocomplete="off">
                                <label for="distance_km" class="input-active">Distance Km</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_amount" name="amount" class="form-control" autocomplete="off">
                                <label for="amount" class="input-active">Amount</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_desc_by_driver" name="desc_by_driver" class="form-control" autocomplete="off">
                                <label for="desc_by_driver" class="input-active">Description By Driver</label>
                            </div></div>
                    </div>
					
					
					<div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="time" id="edit_start_time" name="start_time" class="form-control" autocomplete="off">
                                <label for="edit_start_time" class="input-active">Start Time</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="time" id="edit_end_time" name="end_time" class="form-control" autocomplete="off">
                                <label for="edit_end_time" class="input-active">End Time</label>
                            </div></div>
                    </div>
					
					<div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_start_reading" name="start_reading" class="form-control" autocomplete="off">
                                <label for="edit_start_reading" class="input-active">Start Reading</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_end_reading" name="end_reading" class="form-control" autocomplete="off">
                                <label for="edit_end_reading" class="input-active">End Reading</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="editBtn" id="editBtnCorporateBooking" type="submit">Update</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

<div class="modal fade" id="editCorporateData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Corporate Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('UpdateCorporateData')}}" method="POST" id="editFormCorporateData">
                {{ csrf_field() }}
                <div class="modal-body">

        <div class="form-row">
            <div class="col">
                <select name="status" id="edit_status_data" class="mdb-select colorful-select dropdown-primary">
                    <option value="">Select Status</option>
                </select>
            </div>
        </div>

            <div class="form-row">
                <div class="col">
                    <div class="md-form mt-3">
                        <input type="text" id="edit_perkm_amount" name="perkm_amount" class="form-control" autocomplete="off">
                        <label for="perkm_amount" class="input-active">Per Km Amount</label>
                    </div></div>

                <div class="col">
                    <div class="md-form mt-3">
                        <input type="text" id="edit_per_day_amount" name="per_day_amount" class="form-control" autocomplete="off">
                        <label for="per_day_amount" class="input-active">Per Day Amount</label>
                    </div></div>
            </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_per_day_desc" name="per_day_desc" class="form-control" autocomplete="off">
                                <label for="per_day_desc" class="input-active">Per Day Desc</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_per_km_desc" name="per_km_desc" class="form-control" autocomplete="off">
                                <label for="per_km_desc" class="input-active">Per Km Desc</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_waiting_charge" name="waiting_charge" class="form-control" autocomplete="off">
                                <label for="waiting_charge" class="input-active">Waiting Charge</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_toll_n_parking_desc" name="toll_n_parking_desc" class="form-control" autocomplete="off">
                                <label for="toll_n_parking_desc" class="input-active">Toll & Park Desc</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_night_hault_desc" name="night_hault_desc" class="form-control" autocomplete="off">
                                <label for="night_hault_desc" class="input-active">Night Hault Desc</label>
                            </div></div>
                    </div>



                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="editBtn" id="editBtnCorporateData" type="submit">Update</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
