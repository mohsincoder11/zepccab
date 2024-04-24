<!--Modal: modalVM-->
<div class="modal fade" id="modalInsertCarType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog cascading-modal" role="document">

	<div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Car Type Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form action="{{route('addPackage1')}}" method="POST" id="editFormCarType">
                    {{ csrf_field() }}
                           <div class="form-row">

                            <div class="col">
                                <select name="cartype_id" id="car_type_fetch1" class="mdb-select colorful-select dropdown-primary">
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
                                    <input type="text" id="charge_amount" name="amount" class="form-control" autocomplete="off">
                                    <label for="charge_amount">Charge Amount</label>
                                </div></div>

                        </div>


                    <!-- / Collapsible element -->
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="form-row">

                            <div class="col">
                                <button class="btn btn-info btn-block" name="submitBtn" id="editBtn" type="submit">Add</button>
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
</div>
