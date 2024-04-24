<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Car Type</h5>
               
            </div>
            <form action="{{route('updateCartype')}}" method="POST" id="editForm">
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
                                <input type="text" id="edit_name" name="name" class="form-control" autocomplete="off">
                                <label for="name" class="input-active">Car Type</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <select name="variation" id="edit_variation" class="mdb-select colorful-select dropdown-primary">
                                <option value="">Select Variation</option>
                            </select>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_base_price" name="base_price" class="form-control" autocomplete="off">
                                <label for="base_price" class="input-active">Base Price</label>
                            </div>
                        </div>
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
