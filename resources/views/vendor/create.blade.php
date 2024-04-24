<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Vendor</h5>

            </div>
            <form id="AddVendor" action="{{ route('addVendor') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="vendor_name" name="vendor_name" class="form-control"
                                    autocomplete="off">
                                <label for="vendor_name">vendor Name</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="contact_number" name="contact_number" class="form-control"
                                    autocomplete="off">
                                <label for="contact_number">Contact Number</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="alternate_contact_no" name="alternate_contact_no"
                                    class="form-control" autocomplete="off">
                                <label for="alternate_contact_no">Alternate Contact Number</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="email" id="email" name="email" class="form-control"
                                    autocomplete="off">
                                <label for="email">Email</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="person_name" name="person_name" class="form-control"
                                    autocomplete="off">
                                <label for="person_name">Person Name</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="designation" name="designation" class="form-control"
                                    autocomplete="off">
                                <label for="designation">Designation</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="md-form mt-3">
                                <input type="text" id="person_number" name="person_number" class="form-control"
                                    autocomplete="off">
                                <label for="person_number">Person Number</label>
                            </div>
                        </div>
                        <div class="col">
                            <select name="package_ids[]" id="package_ids" 
                                class="mdb-select colorful-select dropdown-primary" multiple>
                                <option value="" disabled>Select Package</option>
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    $packages = DB::table('package_masters')->where('package_type','Vendor')->select('id', 'package_title')->get();
                                @endphp
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->package_title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <br>
                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-info btn-block" name="submitadd" id="submitadd"
                                type="submit">Add</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="reset">Reset</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info btn-block" type="button" data-dismiss="modal"
                                aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </form>



        </div>
    </div>
</div>
