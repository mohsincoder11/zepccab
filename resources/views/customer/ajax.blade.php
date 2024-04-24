<script>
    var manageTable;

    $(document).ready(function() {
        dataTableInit();
    });

    /* -------All Records Show In DRIVER Table---------*/

    function dataTableInit() {

        manageTable = $("#list").DataTable({
            'ajax' : {
                url: '{{ route('allCustomer') }}',
                data: function(d) {
                    d.role = '{{Auth::guard('admin')->user()->role}}';
                },
                type: 'get',
                datatype: "application/json",
            },
            "order": [],
            responsive: true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            dom: 'Bfrtip',
            columnDefs: [
        
        {
            targets: [5,6], // Assuming the datetime column is the fourth column (index 3)
            type: 'datetime', // Set the type to handle datetime sorting
            render: function (data, type, row) {
                if (type === 'sort') {
                    var dateTimeParts = data.split(' ');
                    if (dateTimeParts.length === 2) {
                        var dateParts = dateTimeParts[0].split('-');
                        var timeParts = dateTimeParts[1].split(':');
                        if (dateParts.length === 3 && timeParts.length === 3) {
                            var sortableDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                            return sortableDate + ' ' + dateTimeParts[1];
                        }
                    }
                }
                return data;
            }
        }
    ],

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
                className: "btn bg-red btn-flat margin",
                text: '<img src="{{ asset('public/images/icons/print.svg') }}">',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                },
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

    /* -------INSERT DRIVER---------*/
    $("#submitBtn").on('click', function() {

        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        $(".messages").html("");
        $("#CustomerForm").unbind('submit').bind('submit', function() {

            $(".text-danger").remove();

            var form = $(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var postData = new FormData($("#CustomerForm")[0]);
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
                    $(".form-group").removeClass('has-error').removeClass('has-success');
                    if (response.success == true) {
                        toastr.success('Added Successfully.', 'Customer', {
                            timeOut: 5000
                        });
                        $("#CustomerForm")[0].reset();
                        $('#modalVM').modal('hide');
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

    /* -------REMOVE DRIVER---------*/
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
                    url: '{{ route('removeCustomer') }}',
                    type: 'post',
                    data: {
                        customer: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Delete Successfully.', 'Driver', {
                                timeOut: 3000
                            });
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Delete Driver.', 'Failed', {
                                timeOut: 3000
                            });
                        }
                    }
                });
            });
        } else {
            alert('Error: Refresh the page again');
        }
    }
    /* -------END REMOVE DRIVER---------*/

    /* -------Show EDIT ITEM Data---------*/
    function editItem(id = null) {
        if (id) {

            $("#edit_id").remove();

            // fetch the member data
            $.ajax({
                url: '{{ route('editCustomer') }}',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $("#edit_first_name").val(response.customer.first_name);
                    $("#edit_last_name").val(response.customer.last_name);
                    $("#edit_mobile_no").val(response.customer.mobile_no);
                    $("#edit_email_id").val(response.customer.email_id);
                    $("#edit_from_latitude").val(response.customer.from_latitude);
                    $("#edit_from_longitude").val(response.customer.from_longitude);
                    $("#edit_to_latitude").val(response.customer.to_latitude);
                    $("#edit_to_longitude").val(response.customer.to_longitude);
                    $("#edit_from_location").val(response.customer.from_location);
                    $("#edit_to_location").val(response.customer.to_location);
                    $("#edit_ride_later_date").val(response.current_date_show);
                    $("#edit_ride_later_time").val(response.customer.ride_later_time);
                    $("#edit_average_per_litre").val(response.customer.average_per_litre);
                    $("#edit_driver_allowance").val(response.customer.driver_allowance);
                    $("#edit_parking_and_tolltax").val(response.customer.parking_and_tolltax);
                    $("#edit_route_direction").val(response.customer.route_direction);
                    //$("#edit_distance_driver_user_km").val(response.customer.start_reading);
                    $("#edit_distance_user_destination_km").val(response.customer.end_reading);
                    $("#edit_custoemr_amount").val(response.customer.custoemr_amount);




                    $("#edit_car_type_id").empty();
                    $("#edit_car_type_id").append(response.cars);
                    $('#edit_car_type_id').material_select();

                    $("#edit_travel_type_id").empty();
                    $("#edit_travel_type_id").append(response.travel);
                    $('#edit_travel_type_id').material_select();

                    $("#driver_list").empty();
                    $("#driver_list").append(response.drivers);
                    $('#driver_list').material_select();

                    $("#status_list").empty();
                    $("#status_list").append(response.statuses);
                    $('#status_list').material_select();




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
                                    location.reload();

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
    /* -------END EDIT ITEM Data---------*/

    function resetSearchForm() {
        $('#list').DataTable().clear().destroy();
        dataTableInit();
    }

    function CustomerDetails(id = null) {
        if (id) {

            // fetch the member data
            $.ajax({
                url: '{{ route('showCustomer') }}',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {

                    $("#show_name").empty();
                    $("#show_name").append(response.full_name);

                    $("#show_mobile_no").empty();
                    $("#show_mobile_no").append(response.customer.mobile_no);

                    $("#show_email_id").empty();
                    $("#show_email_id").append(response.customer.email_id);

                    $("#show_car_types_name").empty();
                    $("#show_car_types_name").append(response.customer.car_types_name);

                    $("#show_travel_type_name").empty();
                    $("#show_travel_type_name").append(response.customer.travel_type);

                    $("#show_from_latitude").empty();
                    $("#show_from_latitude").append(response.customer.from_latitude);

                    $("#show_from_longitude").empty();
                    $("#show_from_longitude").append(response.customer.from_longitude);

                    $("#show_to_latitude").empty();
                    $("#show_to_latitude").append(response.customer.to_latitude);

                    $("#show_to_longitude").empty();
                    $("#show_to_longitude").append(response.customer.to_longitude);

                } // /success
            }); // /fetch selected member info

        } else {
            alert("Error : Refresh the page again");
        }
    }



    function getCustomer() {
        $.ajax({
            url: '{{ route('getAllCustomer') }}',
            type: 'get',
            dataType: 'json',
            success: function(response) {
                $(".loader-ajax").hide();
                $("#customer_list").empty();
                $("#customer_list").append(response);
                $('#customer_list').material_select();
            }
        });
    }



    $(document).ready(function() {

        $("#submitadd1").on('click', function() {

            $(".form-group").removeClass('has-error').removeClass('has-success');
            $(".text-danger").remove();
            $(".messages").html("");
            $("#AddRentalCustomer").unbind('submit').bind('submit', function() {

                $(".text-danger").remove();

                var form = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



                var postData = new FormData($("#AddRentalCustomer")[0]);
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
                            $('#modalAddCustomer').modal('hide');
                            toastr.success('Added Successfully.', 'Customer', {
                                timeOut: 5000
                            });
                            $("#AddRentalCustomer")[0].reset();
                            getCustomer();

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
</script>
