<!--Modal: modalVM-->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog cascading-modal" role="document">

<div class="modal-content">
<div class="modal-body mx-3">
    <form class="text-center" style="color: #757575;" action="{{route('searchStudent')}}" method="POST" id="searchStudentForm">
    {{csrf_field()}}
    <!-- Name -->

        <div class="form-row">

            <div class="col">
                <select name="section_id" id="section_list" onchange="getClass(this.value)"  class="mdb-select colorful-select dropdown-primary" searchable="Search here..">
                    <option value="">Select Section</option>
                    <option value="1">Pre Primary</option>
                    <option value="2">Primary</option>
                </select>
            </div>

            <div class="col">
                <select name="class_id" id="class_list1" class="mdb-select colorful-select dropdown-primary" searchable="Search here..">
                    <option value="">Select Class</option>

                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="md-form mt-3">
                    <input type="text" id="name" name="name" class="form-control" autocomplete="off">
                    <label for="name">Full Name</label>
                </div></div>

            <div class="col">
                <div class="md-form mt-3">
                    <input type="text" id="mobile_no" name="mobile_no" class="form-control" autocomplete="off">
                    <label for="mobile_no">Mobile No</label>
                </div></div>

        </div>


        <!-- Send button -->
        <div class="row">
            <div class="col">

            </div>
            <div class="col">
                <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" id="searchStudentBtn" type="submit">Search</button>
            </div>
            <div class="col">
                <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" onclick="resetSearchForm()" type="reset">Reset</button>
            </div>
            <div class="col">

            </div>
        </div>

    </form>
</div>

</div>
</div>
</div>



