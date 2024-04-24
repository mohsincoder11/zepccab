<script>
    $(document).ready(function() {
        dataTableInit();

    });

    $(document).on('change', '#type', function() {
        manageTable.ajax.reload(null, false);

    })

    function dataTableInit() {

        manageTable = $("#list").DataTable({
            'ajax': {
                url: '{{ route('allPackageMaster') }}',
                data: function(d) {
                    d.package_type = $("#type").val();

                },
                type: 'get',
                datatype: "application/json",
            },
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
            $("#AddPackageMaster").unbind('submit').bind('submit', function() {

                $(".text-danger").remove();

                var form = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



                var postData = new FormData($("#AddPackageMaster")[0]);
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
                            toastr.success('Added Successfully.', 'PackageMaster', {
                                timeOut: 5000
                            });
                            $("#AddPackageMaster")[0].reset();
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
                    url: '{{ route('removePackageMaster') }}',
                    type: 'post',
                    data: {
                        package_master: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            // refresh the table
                            manageTable.ajax.reload(null, false);
                            // close the modal
                            toastr.success('Deleted Successfully.', 'PackageMaster', {
                                timeOut: 3000
                            });
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();

                        } else {
                            toastr.error('Not Deleted.', 'PackageMaster', {
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
                url: '{{ route('editPackageMaster2') }}',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $("#edit_package_title").val(response.package_master.package_title).focus();
                    $("#edit_package_type").val(response.package_master.package_type).change();
                    $("#edit_per_km_amount").val(response.package_master.per_km_amount).focus();
                    $("#edit_per_day_amount").val(response.package_master.per_day_amount).focus();
                    $("#edit_per_day_desc").val(response.package_master.per_day_desc).focus();
                    $("#edit_per_km_desc").val(response.package_master.per_km_desc).focus();
                    $("#edit_waiting_charge").val(response.package_master.waiting_charge).focus();
                    $("#edit_toll_n_parking_desc").val(response.package_master.toll_n_parking_desc).focus();
                    $("#edit_night_hault_desc").val(response.package_master.night_hault_desc).focus();
                    $("#edit_fixed_rate").val(response.package_master.fixed_rate).focus();


                    // mmeber id
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
