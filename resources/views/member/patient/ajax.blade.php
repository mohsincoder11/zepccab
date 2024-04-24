<script>

    var manageTable;

    $(document).ready(function() {
         dataTableInit();
    });


function dataTableInit() {

    manageTable =   $("#list").DataTable({
        "ajax": "{{route('allPatients')}}",
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

    $("#submitBtn").on('click', function() {

    $(".form-group").removeClass('has-error').removeClass('has-success');
    $(".text-danger").remove();

    $(".messages").html("");

    $("#RegisterForm").unbind('submit').bind('submit', function() {

        $(".text-danger").remove();

        var form = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        var postData = new FormData($("#RegisterForm")[0]);
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

                    $("#RegisterForm")[0].reset();

                    manageTable.ajax.reload(null, false);
                }
                else
                {
                    toastr.success(response.messages, '', {timeOut: 5000});
                }  // /else
            } // success
        }); // ajax subit

        return false;
    }); // /submit form for create member
}); // /add modal


    /* -------SEARCH STUDENT---------*/
    $("#searchPatientForm").on('click', function() {

        $(".loader-ajax").fadeOut("slow").show();
// submit form
        $("#searchPatientForm").unbind('submit').bind('submit', function() {

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
            var postData = new FormData($("#searchPatientForm")[0]);
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

    /* -------REMOVE STUDENT---------*/
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
                    url: '{{route('removePatient')}}',
                    type: 'post',
                    data: {patient : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Changed Successfully.', 'Status', {timeOut: 3000});
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.success('To Change Status.', 'Failed', {timeOut: 3000});
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
                url: '{{route('editPatient')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {

                    $("#edit_first_name").val(response.student.first_name);
                    $("#edit_last_name").val(response.student.last_name);
                    $("#edit_mobile_no").val(response.student.mobile_no);
                    $("#edit_address").val(response.student.address);
                    $("#edit_age").val(response.student.age);

                    $("#edit_gender").empty();
                    $("#edit_gender").append(response.genders);
                    $('#edit_gender').material_select();

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
                                    toastr.success(response.messages, '', {timeOut: 3000});
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


</script>
