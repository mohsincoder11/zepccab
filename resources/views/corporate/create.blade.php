<div class="modal fade" id="modalVM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Booking Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('AddCorporateBookingDetails')}}" method="POST" id="editFormAddBooking">
                {{ csrf_field() }}
                <div class="modal-body">
					
					<div class="form-row">
					<div class="col">
                            <div class="md-form mt-3">
                                <label for="date-picker-example" style="margin-top: -30px;">From Date</label>
                                <input placeholder="From date" type="date" name="from_date"  class="form-control">
                            </div></div>
						
						<div class="col">
                            <div class="md-form mt-3">
                                <label for="date-picker-example" style="margin-top: -30px;">To Date</label>
                                <input placeholder="To date" type="date" name="to_date"  class="form-control">
                            </div></div>
						</div>

                    <div class="form-row">
                        <div class="col">
                            <select name="driver_id" id="driver_id" class="browser-default custom-select">
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

					<br><br>
                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="editBtnAddBooking" id="editBtnAddBooking" type="submit">Add</button>
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
