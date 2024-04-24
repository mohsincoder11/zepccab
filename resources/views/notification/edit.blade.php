<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Chapter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('updateChapter')}}" method="POST" id="editForm">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="md-form mt-3">
                        <input type="text" id="edit_name" name="name" class="form-control " autocomplete="off">
                        <label for="edit_name" class="input-active">Chapter Name</label>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_duration"  name="duration" class="form-control " autocomplete="off">
                                <label for="edit_duration" class="input-active">Course Duration</label>
                            </div></div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="edit_number_of_topics" name="number_of_topics" class="form-control " autocomplete="off">
                                <label for="edit_number_of_topics" class="input-active">No. of Topics</label>
                            </div></div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="editBtn" id="editBtn" type="submit">Update</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
