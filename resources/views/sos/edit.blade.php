<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Chapter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('updateSos')}}" method="POST" id="editForm">
                {{ csrf_field() }}
                <div class="modal-body">


                    <div class="form-row">
                        <div class="col">
                            <select name="city_id" id="edit_city_id" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select City</option>
                            </select>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_police_station_name" name="police_station_name" class="form-control" autocomplete="off">
                                <label for="police_station_name" class="input-active">Police Station Name</label>
                            </div></div>
                    </div>


                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_phone_no" name="phone_no" class="form-control" autocomplete="off">
                                <label for="phone_no" class="input-active">Phone No</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <textarea type="text" id="edit_address" name="address" class="form-control" rows="2" autocomplete="off"></textarea>
                                <label for="address" class="input-active">Address</label>
                            </div></div>
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
