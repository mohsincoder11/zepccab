<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Share Ride</h5>
               
            </div>
            <form action="{{route('addShare')}}" method="POST" id="AddShare">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
                            <select name="customer_id" id="customer_id" class="custom-select2" style="width:100%">
                                <option value="">Select Customer Name</option>
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    $cust_names =DB::table('customer')->select('id','first_name','last_name')->get();
                                @endphp
                                @foreach( $cust_names as $names )
                                    <option value="{{$names->id}}">{{$names->first_name}} {{$names->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="from_origin" name="from_origin" class="form-control" autocomplete="off">
                                <label for="from_origin">From Origin</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="to_destination" name="to_destination" class="form-control" autocomplete="off">
                                <label for="to_destination">From Destination</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input placeholder="Follow Up Date" name="travel_date" type="text" id="date-picker-example" class="form-control datepicker" style="margin-top: 42px;">
                                <label for="date-picker-example">Travel Date</label>
                            </div></div>

                        <div class="col">
                            <label>Pickup Time</label>
                            <div class="md-form mt-3">
                                <input type="time" id="pickup_time" name="pickup_time" class="form-control" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="car_type" id="car_type" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Car Type</option>
                                @php
                                    $cartypes =DB::table('car_types')->select('id','name')->get();
                                @endphp
                                @foreach( $cartypes as $cartype )
                                    <option value="{{$cartype->id}}">{{$cartype->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="vacancy" name="vacancy" class="form-control" autocomplete="off">
                                <label for="vacancy"> Vacancy</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="consession" name="consession" class="form-control" autocomplete="off">
                                <label for="consession"> Consession</label>
                            </div></div>
                    </div>


                    <div class="form-row field_wrapper">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="city_name" name="city_name[]" class="form-control" autocomplete="off">
                                <label for="city_name">City Name</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="charges_per_person" name="charges_per_person[]" class="form-control" autocomplete="off">
                                <label for="charges_per_person">Charges Per Person</label>
                            </div></div>
                        <a href="javascript:void(0);" class="add_button" title="Add field"><img src="{{asset('public/images/add-icon.png')}}"/></a>
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
