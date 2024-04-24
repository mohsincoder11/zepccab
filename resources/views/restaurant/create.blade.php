<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Restaurant</h5>

            </div>
            <form enctype="multipart/form-data" action="{{route('addRestaurant')}}" method="POST" id="addForm">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="name" name="name" class="form-control" autocomplete="off">
                                <label for="name">Name</label>
                            </div></div>
                    </div>
					<div class="form-row">

                        <div class="col">
                            <select name="city" id="city" class="browser-default custom-select" style="margin-top: 18px;">
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


                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="tags" name="tags" class="form-control" autocomplete="off">
                                <label for="tags">Tag</label>
                            </div></div>

						</div>
                    <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <textarea type="text" id="address" name="address" class="form-control" rows="2" autocomplete="off"></textarea>
                            <label for="description">Address</label>
                        </div></div>
                    </div>
                     <div class="form-row">
                        <div class="col">
                                <div class="file-field" style="margin-top: 25px;">
                                    <div class="btn-sm float-left" style="background-color: #66bcb2!important; color: #fff!important;">
                                        <span>Choose file</span>
                                        <input type="file" name="image" id="image">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="Upload Restaurant Image">
                                    </div>
                                </div>
                            </div>
                        </div>

                    <br>
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
            </form>


        </div>
    </div>
</div>
