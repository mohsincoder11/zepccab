<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Share Ride</h5>
                
            </div>
            <form action="{{route('updateShare')}}" method="POST" id="editForm">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_from_origin" name="from_origin" class="form-control" autocomplete="off">
                                <label for="edit_from_origin" class="input-active">From Origin</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_to_destination" name="to_destination" class="form-control" autocomplete="off">
                                <label for="edit_to_destination" class="input-active">From Destination</label>
                            </div></div>

                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="car_type" id="edit_car_type" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Car Type</option>
                            </select>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_vacancy" name="vacancy" class="form-control" autocomplete="off">
                                <label for="edit_vacancy" class="input-active"> Vacancy</label>
                            </div></div>

                    </div>

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
            </form>


        </div>
    </div>
</div>
