<script>

    var manageTable;

    $(document).ready(function() {
         dataTableInit();
    });

    /* -------All Records Show In School Table---------*/

function dataTableInit() {

    manageTable =   $("#list").DataTable({
        "ajax": "{{route('allStudents')}}",
        "method": "get",
        "order": [],
        responsive: true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        dom: 'Bfrtip',

        buttons:[
            {
                extend:"excel",
                className:"btn bg-excel btn-flat margin",
                text: '<img src="{{asset('public/images/icons/excel.svg')}}">',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            }
            ,{
                extend:"pdf",
                className:"btn bg-red btn-flat margin",
                text: '<img src="{{asset('public/images/icons/pdf.svg')}}">',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            }
        ]
    });
    $('#list_wrapper').find('label').each(function () {
        $(this).parent().append($(this).children());
    });
    $('#list_wrapper .dataTables_filter').find('input').each(function () {
        // $('input').attr("placeholder", "Search");
        $('input').removeClass('form-control-sm');
    });
    $('#list_wrapper .dataTables_length').addClass('d-flex flex-row');
    $('#list_wrapper .dataTables_filter').addClass('md-form');
    $('#list_wrapper select').removeClass('custom-select custom-select-sm form-control form-control-sm');
    $('#list_wrapper select').addClass('mdb-select');
    $('#list_wrapper .mdb-select').material_select();
    $('#list_wrapper .dataTables_filter').find('label').remove();
}


    /* -------INSERT SCHOOL---------*/
    $("#submitBtn").on('click', function() {

    $(".form-group").removeClass('has-error').removeClass('has-success');
    $(".text-danger").remove();
    $(".messages").html("");
    $("#StudentForm").unbind('submit').bind('submit', function() {

        $(".text-danger").remove();

        var form = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var postData = new FormData($("#StudentForm")[0]);
        $.ajax({
            cache:false,
            contentType: false,
            processData: false,
            url : form.attr('action'),
            type : form.attr('method'),
            dataType : 'json',
            data : postData,
            // data : form.serialize(),
            success:function(response) {

// remove the error
                $(".form-group").removeClass('has-error').removeClass('has-success');
                if(response.success == true) {
                    toastr.success('Added Successfully.', 'Student', {timeOut: 5000});
                    $("#StudentForm")[0].reset();
                   manageTable.ajax.reload(null, false);
                }
                else
                {
                    toastr.error(response.messages, '', {timeOut: 5000});
                }  // /else
            } // success
        }); // ajax subit

        return false;
    }); // /submit form for create member
}); // /add modal


    /* -------SEARCH SCHOOL---------*/
    $("#searchStudentBtn").on('click', function() {

        $(".loader-ajax").fadeOut("slow").show();
// submit form
        $("#searchStudentForm").unbind('submit').bind('submit', function() {

            $(".text-danger").remove();

            var form = $(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /**
             * Search Date Ajax
             */
            var postData = new FormData($("#searchStudentForm")[0]);
            $.ajax({
                cache:false,
                contentType: false,
                processData: false,
                url : form.attr('action'),
                type : form.attr('method'),
                dataType : 'json',
                data : postData,

                success:function(response) {

                    if (response.success != false)
                    {
                        if (response.messages == 'Not Found.'){
                            toastr.error(response.messages, 'Record', {timeOut: 3000});
                        }
                        else{
                            toastr.success(response.messages, 'Record', {timeOut: 3000});
                        }

                        $('#list').DataTable().clear().destroy();

                        manageTable = $('#list').DataTable(response);

                        new $.fn.dataTable.Buttons(manageTable, {
                            buttons:[
                                {
                                    extend:"excel",
                                    className:"btn bg-excel btn-flat margin",
                                    text: '<img src="{{asset('public/images/icons/excel.svg')}}">',
                                    exportOptions: {
                                        columns: 'th:not(:last-child)'
                                    }
                                }
                                , {
                                    extend: "pdf",
                                    className: "btn bg-red btn-flat margin",
                                    text: '<img src="{{asset('public/images/icons/pdf.svg')}}">',
                                    exportOptions: {
                                        columns: 'th:not(:last-child)'
                                    },
                                }
                            ]
                        });

                        manageTable.buttons( 0, null ).container().prependTo(
                            manageTable.table().container()
                        );

                        $("#list_length").hide();
                        $(".loader-ajax").hide();
                    }
                    else {
                        toastr.warning(response.messages, 'Error', {timeOut: 3000});
                        $(".loader-ajax").hide();
                    }
                }
            });

            return false;
        });
    });
    /* -------END SEARCH STUDENT---------*/

    /* -------REMOVE SCHOOL---------*/
    function removeItem(id = null) {
        if(id) {
            // click on remove button
            $("#removeBtn").unbind('click').bind('click', function() {
                $(".loader-ajax").fadeOut("slow").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{route('removeStudent')}}',
                    type: 'post',
                    data: {student : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Changed Successfully.', 'Status', {timeOut: 3000});
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Change Status.', 'Failed', {timeOut: 3000});
                        }
                    }
                });
            });
        }
        else
        {
            alert('Error: Refresh the page again');
        }
    }
    /* -------END REMOVE STUDENT---------*/

    /* -------Show EDIT ITEM Data---------*/
    function editItem(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editStudent')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
                    $("#edit_name").val(response.student.name);
                    $("#edit_marathi_name").val(response.student.marathi_name);
                    $("#edit_admission_no").val(response.student.admission_no);
                    $("#edit_mobile_no").val(response.student.mobile_no);
                    $("#edit_aadhar_no").val(response.student.aadhar_no);
                    $("#edit_address").val(response.student.address);

                    $("#edit_section_id").empty();
                    $("#edit_section_id").append(response.section);
                    $('#edit_section_id').material_select();

                    $("#edit_class_id").empty();
                    $("#edit_class_id").append(response.class);
                    $('#edit_class_id').material_select();

// mmeber id
                    $("#editForm").append('<input type="hidden" name="id" id="edit_id" value="'+id+'"/>');

// here update the location data
                    $("#editForm").unbind('submit').bind('submit', function() {
// remove error messages
                        $(".text-danger").remove();

                        var form = $(this);
// validation
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success:function(response) {
                                if(response.success == true) {

                                    $('#editModal').modal('hide');
                                    toastr.success(response.messages, '', {timeOut: 3000});
                                    manageTable.ajax.reload(null, false);

                                } else {
                                    toastr.error(response.messages, '', {timeOut: 3000});
                                }
                            } // /success
                        }); // /ajax


                        return false;
                    });

                } // /success
            }); // /fetch selected member info

        } else {
            alert("Error : Refresh the page again");
        }
    }
    /* -------END EDIT ITEM Data---------*/

    function resetSearchForm(){
        $('#list').DataTable().clear().destroy();
        dataTableInit();
    }

    function getClass(section_id) {
        $(".loader-ajax").fadeOut("slow").show();
        $.ajax({
            url: '{{route('getClass')}}',
            type: 'post',
            data: {section_id : section_id},
            dataType: 'json',
            success:function(response) {
                $(".loader-ajax").hide();

                $("#class_list").empty();
                $("#class_list").append('<option value="">Select Class </option>');
                $("#class_list").append(response);
                $('#class_list').material_select();

                $("#class_list1").empty();
                $("#class_list1").append('<option value="">Select Class </option>');
                $("#class_list1").append(response);
                $('#class_list1').material_select();


            }
        });
    }

    function getPendingFees($deposite_fees) {
     $total_fees =   Number($('#total_fees').val());
     if (isNaN($deposite_fees)){
         toastr.error('Please provide valid amount', '', {timeOut: 3000});
         $('#pending_fees').val(null);
     }
     else{
         $pending_fees =   $total_fees - $deposite_fees;

         if ($deposite_fees <= $total_fees ){
             $('#pending_fees').val($pending_fees);
         }
         else{
             toastr.error('Please provide valid amount', '', {timeOut: 3000});
             $('#pending_fees').val(null);
         }

     }
    }


</script>
