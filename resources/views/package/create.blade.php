<!--Modal: modalVM-->
<div class="modal fade" id="modalVM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid cascading-modal modal-full-height" role="document">
        <div class="modal-content">
            <div class="edge-header white">
                <ul class="nav nav-tabs md-tabs nav-justified gray mt-3" role="tablist">
                    <li class="nav-item" id="tab1">
                        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
                            <i class="fa fa-user pr-2"></i>Package Details</a>
                    </li>
                </ul>
            </div>

            <div class=" free-bird modal-body mx-3">
                <div class="row">
                    <div class="col-md-8 col-lg-7 mx-auto float-none white z-depth-1 py-2 px-2">

        <!--Naked Form-->
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{route('addPackage')}}" method="POST" id="PackageForm">
            {{ csrf_field() }}

            <!-- Tab panels -->
                <div class="tab-content">
                    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">


                        <div class="form-row">

                          <div class="col">
                                    <select name="city_id" id="city_id" onchange="getCarTypeAdmin(this.value)" class="mdb-select colorful-select dropdown-primary">
                                        <option value="">Select Package City</option>
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
                                    <label for="name">Package Name</label>
                                </div></div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="km" name="km" class="form-control" autocomplete="off">
                                    <label for="km">Kilometer</label>
                                </div></div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="hour" name="hour" class="form-control" autocomplete="off">
                                    <label for="hour">Hours</label>
                                </div></div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="amount" name="amount" class="form-control" autocomplete="off">
                                    <label for="amount">Amount</label>
                                </div></div>

                            <div class="col">
                                <select name="cartype_id" id="car_type_fetch" class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Car Type</option>
                                    @php
                                        $cartypes =DB::table('car_types')->select('id','name')->get();
                                    @endphp
                                    @foreach( $cartypes as $cartype )
                                        <option value="{{$cartype->id}}">{{$cartype->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-info btn-block" name="submitBtn" id="submitBtn" type="submit">Add</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-info btn-block" type="reset">Reset</button>
                            </div>
                             <div class="col">
                            <button class="btn btn-info btn-block" type="button" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                        </div>
                    </div>

                    </div>
                                    <!-- Panel 1 -->
                                </div>
                            </form>
                        </div>
                        <!--Naked Form-->

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>






