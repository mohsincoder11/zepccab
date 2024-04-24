<script>
    $(document).ready(function() {
        dataTableInit();

    });


    function dataTableInit() {

        manageTable = $("#list").DataTable({
            "ajax": "{{ route('allVendor') }}",
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

            buttons: [{
                extend: "excel",
                className: "btn bg-excel btn-flat margin",
                text: '<img src="{{ asset('public/images/icons/excel.svg') }}">',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            }, {
                extend: "pdf",
                className: "btn bg-red btn-flat margin",
                text: '<img src="{{ asset('public/images/icons/pdf.svg') }}">',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            }, {
                extend: "print",
                className: "btn bg-blue btn-flat margin",
                text: '<img src="{{ asset('public/images/icons/print.svg') }}">',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            }]
        });
        $('#list_wrapper').find('label').each(function() {
            $(this).parent().append($(this).children());
        });
        $('#list_wrapper .dataTables_filter').find('input').each(function() {
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


    $(document).ready(function() {

        $("#submitadd").on('click', function() {

            $(".form-group").removeClass('has-error').removeClass('has-success');
            $(".text-danger").remove();
            $(".messages").html("");
            $("#AddVendor").unbind('submit').bind('submit', function() {

                $(".text-danger").remove();

                var form = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



                var postData = new FormData($("#AddVendor")[0]);
                $.ajax({
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: form.attr('action'),
                    type: form.attr('method'),
                    dataType: 'json',
                    data: postData,
                    // data : form.serialize(),
                    success: function(response) {

                        // remove the error
                        $(".form-group").removeClass('has-error').removeClass(
                            'has-success');

                        if (response.success == true) {
                            toastr.success('Added Successfully.', 'Vendor', {
                                timeOut: 5000
                            });
                            $("#AddVendor")[0].reset();
                            manageTable.ajax.reload(null, false);
                            location.reload(true);
                        } else {
                            toastr.error(response.messages, '', {
                                timeOut: 5000
                            });
                        } // /else
                    } // success
                }); // ajax subit

                return false;
            }); // /submit form for create member
        }); // /add modal

    });


    /* -------REMOVE CAR TYPE---------*/
    function removeItem(id = null) {
        if (id) {
            // click on remove button
            $("#removeBtn").unbind('click').bind('click', function() {
                $(".loader-ajax").fadeOut("slow").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('removeVendor') }}',
                    type: 'post',
                    data: {
                        vendor: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            // refresh the table
                            manageTable.ajax.reload(null, false);
                            // close the modal
                            toastr.success('Deleted Successfully.', 'Vendor', {
                                timeOut: 3000
                            });
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();

                        } else {
                            toastr.error('Not Deleted.', 'Vendor', {
                                timeOut: 3000
                            });
                        }
                    }
                });
            }); // click remove btn
        } else {
            alert('Error: Refresh the page again');
        }
    }

    function editItem(id = null) {
        if (id) {

            $("#edit_id").remove();

            // fetch the member data
            $.ajax({
                url: '{{ route('editVendor2') }}',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $("#edit_vendor_name").val(response.vendor.vendor_name).focus();
                    $("#edit_contact_number").val(response.vendor.contact_number).focus();
                    $("#edit_alternate_contact_no").val(response.vendor.alternate_contact_no)
                        .focus(); // Added
                    $("#edit_email").val(response.vendor.email).focus(); // Added
                    $("#edit_person_name").val(response.vendor.person_name).focus(); // Added
                    $("#edit_designation").val(response.vendor.designation).focus(); // Added
                    $("#edit_person_number").val(response.vendor.person_number).focus(); // Added
                    var packageIds = JSON.parse(response.vendor.package_ids);
                    $('#edit_package_ids').val(packageIds);
                    $('#edit_package_ids').material_select();

                   
                    $("#editForm").append('<input type="hidden" name="id" id="edit_id" value="' + id +
                        '"/>');

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
                            success: function(response) {
                                if (response.success == true) {

                                    $('#editModal').modal('hide');
                                    toastr.success(response.messages, '', {
                                        timeOut: 3000
                                    });
                                    manageTable.ajax.reload(null, false);

                                } else {
                                    toastr.error(response.messages, '', {
                                        timeOut: 3000
                                    });
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
</script>
