<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Video</h5>

            </div>
            <form enctype="multipart/form-data" action="{{route('addVideo')}}" method="POST" id="addVideo">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="title" name="title" class="form-control" autocomplete="off">
                                <label for="title">Title</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="url" name="url" class="form-control" autocomplete="off">
                                <label for="url">Video Url</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <textarea type="text" id="description" name="description" class="form-control" rows="2" autocomplete="off"></textarea>
                                <label for="description">Description</label>
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
