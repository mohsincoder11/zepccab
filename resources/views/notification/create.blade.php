<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Notification</h5>

            </div>
            <form action="{{route('addNotification')}}" method="POST" id="Addnotification">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-row">
                            <div class="col">
                                <select name="sent_type" id="sent_type" class="mdb-select colorful-select dropdown-primary">
                                    <option value="">Select Sent Type</option>
                                    <option value="Customer">Customer</option>
                                    <option value="Driver">Driver</option>
                                </select>
                            </div>

                             <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="title" name="title" class="form-control" autocomplete="off">
                                <label for="title">Notification Title</label>
                            </div>
                    </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <textarea type="text" id="message" name="message" class="form-control" rows="2" autocomplete="off"></textarea>
                                <label for="message">Message</label>
                            </div></div>

                             <div class="col">
                             <div class="file-field" style="margin-top: 50px;">
                            <div class="btn-sm float-left" style="background-color: #0078D7!important; color: #fff!important;">
                                <span>Choose file</span>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload Notification Image">
                            </div>
                        </div>
                            </div>
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
