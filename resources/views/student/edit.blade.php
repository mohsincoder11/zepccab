<!--Modal: modalVM-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">

<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title w-100 font-weight-bold">Update Student Details</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body mx-3">
<form enctype="multipart/form-data" action="{{route('updateStudent')}}" method="POST" id="editForm" >
{{ csrf_field() }}

    <div class="form-row">
        <div class="col">
            <select name="section_id" id="edit_section_id"  class="mdb-select colorful-select dropdown-primary" searchable="Search here..">
                <option value="">Select Section</option>

            </select>
        </div>

        <div class="col">
            <select name="class_id" id="edit_class_id" class="mdb-select colorful-select dropdown-primary" searchable="Search here..">
                <option value="">Select Class</option>

            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <div class="md-form mt-3">
                <input type="text" id="edit_name" name="name" class="form-control" autocomplete="off">
                <label for="name" class="input-active">Full Name</label>
            </div></div>

        <div class="col">
            <div class="md-form mt-3">
                <input type="text" id="edit_marathi_name" name="marathi_name" class="form-control" autocomplete="off">
                <label for="marathi_name" class="input-active">Marathi Name</label>
            </div></div>
    </div>

    <div class="form-row">

        <div class="col">
            <div class="md-form mt-3">
                <input type="text" id="edit_admission_no" name="admission_no" class="form-control" autocomplete="off">
                <label for="admission_no" class="input-active">Admission No.</label>
            </div></div>

        <div class="col">
            <div class="md-form mt-3">
                <input type="text" id="edit_mobile_no" name="mobile_no" class="form-control" autocomplete="off">
                <label for="mobile_no" class="input-active">Mobile No</label>
            </div></div>
    </div>

    <div class="form-row">
        <div class="col">
            <div class="md-form mt-3">
                <input type="text" id="edit_aadhar_no" name="aadhar_no" class="form-control" autocomplete="off">
                <label for="aadhar_no" class="input-active">Addhar No</label>
            </div></div>

        <div class="col">
            <div class="md-form mt-3">
                <input type="text" id="edit_address" name="address" class="form-control" autocomplete="off">
                <label for="address" class="input-active">Address</label>
            </div></div>

    </div>







    <!-- / Collapsible element -->

<div class="modal-footer d-flex justify-content-center">
<div class="form-row">
<div class="col">
<button class="btn btn-info btn-block" id="editBtn" type="submit">Update</button>
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
</div>


