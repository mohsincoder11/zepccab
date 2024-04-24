<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Menus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('updateMenus')}}" method="POST" id="editForm">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">

                        <div class="col">
                            <select name="menu_category" id="edit_menu_category" class="browser-default custom-select" style="margin-top: 18px;">
                                <option value="">Select Category</option>
                            </select>
                        </div>


                    </div>

                    <div class="form-row" style="margin-top: 18px;">

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_name" name="name" class="form-control" autocomplete="off">
                                <label for="name" class="input-active">Name</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_price" name="price" class="form-control" autocomplete="off">
                                <label for="price" class="input-active">Price</label>
                            </div></div>

                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <textarea type="text" id="edit_details" name="details" class="form-control" rows="2" autocomplete="off"></textarea>
                                <label for="details" class="input-active">Details</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="file-field" style="margin-top: 25px;">
                                <div class="btn-sm float-left" style="background-color: #66bcb2!important; color: #fff!important;">
                                    <span>Choose file</span>
                                    <input type="file" name="edit_image" id="edit_image">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Upload Menus Image">
                                </div>
                            </div>
                        </div>
                    </div>


                    <br>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-info btn-block" id="editBtn" type="submit">Update</button>
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
            </form>


        </div>
    </div>
</div>
