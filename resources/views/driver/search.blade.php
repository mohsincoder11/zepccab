<!--Modal: modalVM-->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog cascading-modal" role="document">

<div class="modal-content">
<div class="modal-body mx-3">
    <form class="text-center" style="color: #757575;" action="{{route('searchDriver')}}" method="POST" id="searchDriverForm">
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
                <div class="md-form mt-3">
                    <input type="text" id="name" name="name" class="form-control" autocomplete="off">
                    <label for="name">Full Name</label>
                </div></div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="md-form mt-3">
                    <input type="text" id="mobile_no" name="mobile_no" class="form-control" autocomplete="off">
                    <label for="mobile_no">Mobile No</label>
                </div></div>
        </div>


        <!-- Send button -->
        <div class="row">
            <div class="col">

            </div>
            <div class="col">
                <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" id="searchDriverBtn" type="submit">Search</button>
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



