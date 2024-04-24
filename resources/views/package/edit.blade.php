<div class="modal fade" id="editModalPackage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid cascading-modal modal-full-height" role="document">
		
        <div class="modal-content">
            <div class="edge-header white">
                <ul class="nav nav-tabs md-tabs nav-justified gray mt-3" role="tablist">
                    <li class="nav-item" id="tab1">
                        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
                            <i class="fa fa-user pr-2"></i>Update Package Details</a>
                    </li>
                </ul>
            </div>

            <div class=" free-bird modal-body mx-3">
                <div class="row">
                    <div class="col-md-8 col-lg-7 mx-auto float-none white z-depth-1 py-2 px-2">

                        <!--Naked Form-->
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{route('updatePackage')}}" method="POST" id="editForm" >
                            {{ csrf_field() }}
								<input type="hidden" id="edit_cartype_id_hidden" name="cartype_id_hidden">
                            <!-- Tab panels -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">

                                        <div class="form-row">

                                         <div class="col">
                                                <select name="city_id" id="edit_cities" class="mdb-select colorful-select dropdown-primary">
                                                    <option value="">Select Package City</option>
                                                </select>
                                            </div>


                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_name" name="name" class="form-control" autocomplete="off">
                                                    <label for="edit_name" class="input-active">Package Name</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_km" name="km" class="form-control" autocomplete="off">
                                                    <label for="edit_km" class="input-active">Kilometer</label>
                                                </div></div>

                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_hour" name="hour" class="form-control" autocomplete="off">
                                                    <label for="edit_hour" class="input-active">Hours</label>
                                                </div></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="md-form mt-3">
                                                    <input type="text" id="edit_amount" name="amount" class="form-control" autocomplete="off">
                                                    <label for="edit_amount" class="input-active">Amount</label>
                                                </div></div>

                                            <div class="col">
                                                <select name="cartype_id" id="edit_cartype_id" class="mdb-select colorful-select dropdown-primary">
                                                    <option value="">Select Car Type</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="modal-footer d-flex justify-content-center">
                                            <div class="form-row">
                                                <div class="col">
                                                    <button class="btn btn-info btn-block" name="editBtn" id="editBtnPackage" type="submit">Update</button>
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


