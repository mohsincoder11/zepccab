<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add City</h5>
               
            </div>
            <form action="{{route('addCity')}}" method="POST" id="Addcity">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="city_name" name="name" class="form-control" autocomplete="off">
                                <label for="from_location">City Name</label>
                            </div></div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="latitude" name="latitude" class="form-control" autocomplete="off">
                                <label for="latitude">Latitude</label>
                            </div></div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="longitude" name="longitude" class="form-control" autocomplete="off">
                                    <label for="longitude">Longitude</label>
                                </div></div>
                    </div>
                    <div class="form-row">
                       

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="radius_km" name="radius_km" class="form-control" autocomplete="off">
                                <label for="radius_km">Radius Km</label>
                            </div></div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="mobile_no" name="mobile_no" class="form-control" autocomplete="off">
                                    <label for="mobile_no">Mobile No</label>
                                </div></div>


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
                        <button class="btn btn-info btn-block" type="button" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
