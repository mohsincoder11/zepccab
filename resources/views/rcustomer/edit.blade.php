<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid cascading-modal modal-full-height" role="document">
        <div class="modal-content">
            <div class="edge-header white">
                <ul class="nav nav-tabs md-tabs nav-justified gray mt-3" role="tablist">
                    <li class="nav-item" id="tab1">
                        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">
                            <i class="fa fa-user pr-2"></i>Update Company Details</a>
                    </li>
                </ul>
            </div>

            <div class=" free-bird modal-body mx-3">
                <div class="row">
                    <div class="col-md-8 col-lg-7 mx-auto float-none white z-depth-1 py-2 px-2">

                        <!--Naked Form-->
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{route('updateCompany')}}" method="POST" id="editForm" >
                            {{ csrf_field() }}

                            <!-- Tab panels -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_company_name" name="company_name" class="form-control" autocomplete="off">
                                <label for="edit_company_name" class="input-active">Company Name</label>
                            </div></div>
                    </div>

                                        <div class="modal-footer d-flex justify-content-center">
                                            <div class="form-row">
                                                <div class="col">
                                                    <button class="btn btn-info btn-block" name="editBtn" id="editBtn" type="submit">Update</button>
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


