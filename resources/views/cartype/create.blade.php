<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Car Type</h5>

            </div>
            <form action="{{route('addCartype')}}" method="POST" id="Addcartype">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
                            <select name="city_id" id="city_id" onchange="getCarTypeAdmin(this.value)" class="mdb-select colorful-select dropdown-primary">
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

                          <div class="col cartype_panel_hide">
                            <select name="name" id="car_type_fetch" class="colorful-select dropdown-primary">
                            </select>
                        </div>

                         <a onclick="showDiv()" style="background-color: #f8570f; margin-top: 12px;" class="btn-floating btn-sm" data-toggle="modal" data-target="#modalVMcomplaints">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                    <div class="form-row" style="display:none;" id="defualt_charges">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="hide_charges" name="input_name" class="form-control" autocomplete="off">
                                <label for="input_name" >Car Type Name</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="variation" id="variation" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Variation</option>
                                <option value="call_now">Call Now</option>
                                <option value="rates">Rates</option>

                            </select>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="base_price" name="base_price" class="form-control" autocomplete="off">
                                <label for="base_price">Base Price</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="file-field" style="margin-top: 25px;">
                            <div class="btn-sm float-left" style="background-color: #0078D7!important; color: #fff!important;">
                                <span>Choose file</span>
                                <input type="file" name="icon" id="icon">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload Icon Image">
                            </div>
                        </div>
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
                            <button onClick="window.location.reload();" class="btn btn-info btn-block" type="button" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
