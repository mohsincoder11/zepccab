<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add SOS</h5>

            </div>
            <form action="{{route('addSos')}}" method="POST" id="Addsos">
                {{ csrf_field() }}
                <div class="modal-body">


                  <div class="form-row">

                          <div class="col">
                                    <select name="city_id" id="city_id" class="mdb-select colorful-select dropdown-primary">
                                        <option value="">Select City</option>
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
                                    <input type="text" id="police_station_name" name="police_station_name" class="form-control" autocomplete="off">
                                    <label for="police_station_name">Police Station Name</label>
                                </div></div>
                        </div>


                    <div class="form-row">

                             <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="phone_no" name="phone_no" class="form-control" autocomplete="off">
                                <label for="phone_no">Phone No</label>
                            </div>
                    </div>

                     <div class="col">
                            <div class="md-form mt-3">
                                <textarea type="text" id="address" name="address" class="form-control" rows="2" autocomplete="off"></textarea>
                                <label for="address">Address</label>
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
