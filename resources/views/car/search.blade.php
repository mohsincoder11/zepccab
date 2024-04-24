<!--Modal: modalVM-->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog cascading-modal" role="document">

<div class="modal-content">
<div class="modal-body mx-3">
    <form class="text-center" style="color: #757575;" action="{{route('searchCar')}}" method="POST" id="searchCarForm">
    {{csrf_field()}}
    <!-- Name -->
        
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
        </div>
        

        <div class="form-row">
            <div class="col">
                <select name="car_type_id" id="car_type_id" class="mdb-select colorful-select dropdown-primary">
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
                <select name="fuel_type" id="fuel_type" class="mdb-select colorful-select dropdown-primary">
                    <option value="">Select Fuel Type</option>
                    <option value="petrol"> Petrol</option>
                    <option value="diesel"> Diesel</option>
                    <option value="gas"> Gas</option>
                </select>
            </div>
        </div>

        <div class="form-row">

            <div class="col">
                <div class="md-form mt-3">
                    <input type="text" id="car_model" name="car_model" class="form-control" autocomplete="off">
                    <label for="car_model">Car Model</label>
                </div></div>

            <div class="col">
                <div class="md-form mt-3">
                    <input type="text" id="car_number" name="car_number" class="form-control" autocomplete="off">
                    <label for="car_number"> Car Number</label>
                </div></div>
        </div>

        <!-- Send button -->
        <div class="row">
            <div class="col">

            </div>
            <div class="col">
                <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" id="searchCarBtn" type="submit">Search</button>
            </div>
            <div class="col">
                <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" onclick="resetSearchForm()" type="reset">Reset</button>
            </div>
            <div class="col">

            </div>
        </div>

    </form>
</div>

</div>
</div>
</div>



