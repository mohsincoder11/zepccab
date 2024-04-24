<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Menus</h5>

            </div>
            <form enctype="multipart/form-data" action="{{route('addMenus')}}" method="POST" id="addForm">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">

                        <div class="col">
                            <select name="menu_category" id="menu_category" class="browser-default custom-select" style="margin-top: 18px;">
                                <option value="">Select Category</option>
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    $menu_categories =DB::table('menu_categories')->select('id','name')->get();
                                @endphp
                                @foreach( $menu_categories as $menu_category )
                                    <option value="{{$menu_category->id}}">{{$menu_category->name}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>

					<div class="form-row">

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="name" name="name" class="form-control" autocomplete="off">
                                <label for="name">Name</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="price" name="price" class="form-control" autocomplete="off">
                                <label for="price">Price</label>
                            </div></div>

						</div>

                    <div class="form-row">
                    <div class="col">
                        <div class="md-form mt-3">
                            <textarea type="text" id="details" name="details" class="form-control" rows="2" autocomplete="off"></textarea>
                            <label for="details">Details</label>
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
                                        <input class="file-path validate" type="text" placeholder="Upload Menu Image">
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
