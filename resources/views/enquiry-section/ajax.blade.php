<script>
    var manageTable;

    $(document).ready(function() {
        dataTableInit();
    });

    /* -------All Records Show In DRIVER Table---------*/
    $(document).on('change', '#type', function() {
        manageTable.ajax.reload(null, false);

    })

    function dataTableInit() {

        manageTable = $("#list").DataTable({
            'ajax': {
                url: '{{ route('enquiry-get-all-rides') }}',
                data: function(d) {
                    d.role = '{{ Auth::guard('admin')->user()->role }}';
                    d.type = $("#type").val()
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

            order: [
                [2, 'desc']
            ],
            columnDefs: [{
                targets: 2, // Assuming the date column is the second column (0-based index)
                type: 'date', // Set the date type for sorting
                render: function(data, type, row) {
                    // Parse the date from "d-m-Y" to "Y-m-d" format for sorting
                    if (type === 'sort') {
                        var parts = data.split('-');
                        if (parts.length === 3) {
                            return parts[2] + '-' + parts[1] + '-' + parts[0];
                        }
                    }
                    return data;
                }
            }],

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

    /* -------INSERT Enquiry---------*/
    $("#submitBtn").on('click', function() {

        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        $(".messages").html("");
        $("#EnquiryForm").unbind('submit').bind('submit', function() {

            $(".text-danger").remove();

            var form = $(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var postData = new FormData($("#EnquiryForm")[0]);
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
                        toastr.success('Added Successfully.', 'Enquiry', {
                            timeOut: 5000
                        });
                        $("#EnquiryForm")[0].reset();
                        $('#modalVM').modal('hide');
                        manageTable.ajax.reload(null, false);
                        setTimeout(() => {
                            location.reload(true);

                        }, 2000);
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


    $("#local_submitBtn").on('click', function() {

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
                setTimeout(() => {
                    location.reload(true);
                }, 2000);
            } else {
                toastr.error(response.messages, '', {
                    timeOut: 5000
                });
            } // /else
        } // success
    }); // ajax subit

    return false;
}); // /submit form for create member
});

$("#edit_local_submitBtn").on('click', function() {

$(".form-group").removeClass('has-error').removeClass('has-success');
$(".text-danger").remove();
$(".messages").html("");
$("#edit_CustomerForm").unbind('submit').bind('submit', function() {


    var form = $(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var postData = new FormData($("#edit_CustomerForm")[0]);
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
                toastr.success('Updated Successfully.', 'Local Enquiry', {
                    timeOut: 5000
                });
                $("#edit_CustomerForm")[0].reset();
                setTimeout(() => {
                    location.reload(true);
                }, 2000);
            } else {
                toastr.error(response.messages, '', {
                    timeOut: 5000
                });
            } // /else
        } // success
    }); // ajax subit

    return false;
}); // /submit form for create member
});


$("#edit_rental_submitBtn").on('click', function() {
$(".form-group").removeClass('has-error').removeClass('has-success');
$(".text-danger").remove();
$(".messages").html("");
$("#UpdateRental").unbind('submit').bind('submit', function() {
    var form = $(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var postData = new FormData($("#UpdateRental")[0]);
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
                toastr.success('Updated Successfully.', 'Rental Enquiry', {
                    timeOut: 5000
                });
                $("#UpdateRental")[0].reset();
                setTimeout(() => {
                    location.reload(true);
                }, 2000);
            } else {
                toastr.error(response.messages, '', {
                    timeOut: 5000
                });
            } // /else
        } // success
    }); // ajax subit

    return false;
}); // /submit form for create member
});

$("#edit_outstation_submitbtn").on('click', function() {
$(".form-group").removeClass('has-error').removeClass('has-success');
$(".text-danger").remove();
$(".messages").html("");
$("#editOutstation").unbind('submit').bind('submit', function() {
    var form = $(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var postData = new FormData($("#editOutstation")[0]);
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
                toastr.success('Updated Successfully.', 'Rental Enquiry', {
                    timeOut: 5000
                });
                $("#editOutstation")[0].reset();
                setTimeout(() => {
                    location.reload(true);
                }, 2000);
            } else {
                toastr.error(response.messages, '', {
                    timeOut: 5000
                });
            } // /else
        } // success
    }); // ajax subit

    return false;
}); // /submit form for create member
});

    $("#outstation_submitadd").on('click', function() {

        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        $(".messages").html("");
        $("#AddOutstation").unbind('submit').bind('submit', function() {

            $(".text-danger").remove();

            var form = $(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            var postData = new FormData($("#AddOutstation")[0]);
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

                        toastr.success('Added Successfully.', 'OUTSTATION', {
                            timeOut: 5000
                        });
                        $("#AddOutstation")[0].reset();
                        setTimeout(() => {
                            location.reload(true);
                        }, 2000);
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


    $("#rental_submitadd").on('click', function() {

        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        $(".messages").html("");
        $("#AddRental").unbind('submit').bind('submit', function() {

            $(".text-danger").remove();

            var form = $(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            var postData = new FormData($("#AddRental")[0]);
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
                        $('#createModal').modal('hide');
                        toastr.success('Added Successfully.', 'Rental', {
                            timeOut: 5000
                        });
                        $("#AddRental")[0].reset();
                        setTimeout(() => {
                            location.reload(true);
                        }, 2000);

                    } else {
                        toastr.error(response.messages, '', {
                            timeOut: 5000
                        });
                    } // /else
                },
                error: function(error) {
                    toastr.error('Something Error occured', '', {
                        timeOut: 5000
                    });

                }
            }); // ajax subit

            return false;
        }); // /submit form for create member
    }); // /add modal


    /* -------REMOVE DRIVER---------*/
    function removeItem(id = null, ride_type = null) {
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
                    url: '{{ route('removeEnquiry') }}',
                    type: 'post',
                    data: {
                        enquiry_id: id,
                        ride_type: ride_type
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Delete Successfully.', 'Enquiry', {
                                timeOut: 3000
                            });
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Delete Enquiry.', 'Failed', {
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

    function ConvertItem(id = null) {
        if (id) {
            // click on remove button
            $("#ConvertBtn").unbind('click').bind('click', function() {
                $(".loader-ajax").fadeOut("slow").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('convertEnquiry') }}',
                    type: 'post',
                    data: {
                        enquiry_id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Converted Successfully.', 'Enquiry', {
                                timeOut: 3000
                            });
                            $("#modalConfirmConvert").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Convert Enquiry.', 'Failed', {
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
                url: '{{ route('editEnquiry') }}',
                type: 'post',
                data: {
                    enquiry_id: id
                },
                dataType: 'json',
                success: function(response) {
                    $("#edit_from_location").val(response.enquiry.from_origin);
                    $("#edit_to_location").val(response.enquiry.to_destination);
                    $("#edit_from_latitude").val(response.enquiry.from_lat);
                    $("#edit_from_longitude").val(response.enquiry.from_lng);
                    $("#edit_to_latitude").val(response.enquiry.to_lat);
                    $("#edit_to_longitude").val(response.enquiry.to_lng);
                    $("#edit_number_of_days").val(response.enquiry.number_of_days);
                    $("#edit_rate").val(response.enquiry.rate);
                    $("#edit_ride_type").val(response.enquiry.ride_type);
                    $("#edit_cartype_id").val(response.enquiry.cartype_id);
                    $("#edit_date").val(response.enquiry.date);
                    $("#edit_time").val(response.enquiry.time);
                    $("#edit_customer_list").val(response.enquiry.customer_id).change();

                    setTimeout(() => {
                        $("#edit_from_location").focus();
                        $("#edit_to_location").focus();
                        $("#edit_from_latitude").focus();
                        $("#edit_from_longitude").focus();
                        $("#edit_to_latitude").focus();
                        $("#edit_to_longitude").focus();
                        $("#edit_number_of_days").focus();
                        $("#edit_rate").focus();
                    }, 800);

                    $("#edit_ride_type").material_select();
                    $("#edit_cartype_id").material_select();

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

                $("#edit_customer_list").empty();
                $("#edit_customer_list").append(response);
                $('#edit_customer_list').material_select();

                $("#local_customer_list").empty();
                $("#local_customer_list").append(response);
                $('#local_customer_list').material_select();

                $("#local2_customer_list").empty();
                $("#local2_customer_list").append(response);
                $('#local2_customer_list').material_select();

                $("#edit_local2_customer_list").empty();
                $("#edit_local2_customer_list").append(response);
                $('#edit_local2_customer_list').material_select();

                $("#rental_customer_list").empty();
                $("#rental_customer_list").append(response);
                $('#rental_customer_list').material_select();

                $("#rental2_customer_list").empty();
                $("#rental2_customer_list").append(response);
                $('#rental2_customer_list').material_select();

                $("#edit_rental2_customer_list").empty();
                $("#edit_rental2_customer_list").append(response);
                $('#edit_rental2_customer_list').material_select();

                $("#outstation_customer_list").empty();
                $("#outstation_customer_list").append(response);
                $('#outstation_customer_list').material_select();

                $("#outstation2_customer_list").empty();
                $("#outstation2_customer_list").append(response);
                $('#outstation2_customer_list').material_select();

                $("#edit_outstation2_customer_list").empty();
                $("#edit_outstation2_customer_list").append(response);
                $('#edit_outstation2_customer_list').material_select();

                

            }
        });
    }

    function getPackagesList(city_id) {
        $(".loader-ajax").fadeOut("slow").show();
        $.ajax({
            url: '{{ route('getPackagesList') }}',
            type: 'post',
            data: {
                city_id: city_id
            },
            dataType: 'json',
            success: function(response) {
                $(".loader-ajax").hide();

                $("#rental_package_list").empty();
                $("#rental_package_list").append('<option value="" disabled>Select Packages</option>');
                $("#rental_package_list").append(response);
                $('#rental_package_list').material_select();

                $("#rental2_package_list").empty();
                $("#rental2_package_list").append('<option value="" disabled>Select Packages</option>');
                $("#rental2_package_list").append(response);
                $('#rental2_package_list').material_select();

                $("#edit_rental2_package_list").empty();
                $("#edit_rental2_package_list").append('<option value="" disabled>Select Packages</option>');
                $("#edit_rental2_package_list").append(response);
                $('#edit_rental2_package_list').material_select();

            }
        });
    }


    $(document).ready(function() {
        $(".ride_span").addClass('hidespan');

        $(document).on('change', '#ride_type', function() {
            $(".ride_span").addClass('hidespan');
            if ($(this).val() == 'ctl') {
                $("#EnquiryForm").attr('action', "{{ route('tempaddCustomer') }}");
                $("#local_ride").removeClass('hidespan');
                $("#from_location").focus();
                $("#to_location").focus();
                $("#from_location").focus();
            } else if ($(this).val() == 'cpl') {
                $("#EnquiryForm").attr('action', "{{ route('tempaddRentalEnquiry') }}");
                $("#rental_ride").removeClass('hidespan');
                $("#rental_pick_location").focus();

            } else if ($(this).val() == 'outstation') {
                $("#EnquiryForm").attr('action', "{{ route('tempaddRental') }}");
                $("#outstation_ride").removeClass('hidespan');
                $("#outstation_to_destination").focus();
                $("#outstation_from_origin").focus();


            }
        })


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

        $(document).on('click', '.ConvertEnquiry', function() {
            $(".loader-ajax").fadeOut("slow").show();

            let id = $(this).attr('id');
            let ride_type = $(this).attr('ride_type');
            $.ajax({
                url: '{{ route('editEnquiry') }}',
                type: 'post',
                data: {
                    enquiry_id: id,
                    ride_type: $(this).attr('ride_type'),
                },
                dataType: 'json',
                success: function(response) {
                    $(".loader-ajax").fadeOut("slow").hide();

                    if (ride_type == 'Local') {
                        $('#localModal').modal('show');
                        $('#localModalHeader').text('Add Local Ride');
                        $('.view_hide_fields').show();
                        $("#CustomerForm :input").prop("disabled", false);
                        $("#local2_enquiry_id").val(response.enquiry.id);

                        $("#local2_from_latitude").val(response.enquiry.from_latitude);
                        $("#local2_from_longitude").val(response.enquiry.from_longitude);
                        $("#local2_to_latitude").val(response.enquiry.to_latitude);
                        $("#local2_to_longitude").val(response.enquiry.to_longitude);
                        $("#local2_from_location").val(response.enquiry.from_location);
                        $("#local2_to_location").val(response.enquiry.to_location);
                        $("#local2_ride_later_date").val(response.enquiry.ride_later_date);
                        $("#local2_ride_later_time").val(response.enquiry.ride_later_time);
                        $("#local2_travel_type").val(response.enquiry.travel_type);
                        $("#local2_cartype_id").val(response.enquiry.car_type_id);
                        $("#local2_custoemr_amount").val(response.enquiry.custoemr_amount);
                        $("#local2_customer_list").val(response.enquiry.customer_id)
                            .change();

                        setTimeout(() => {
                            $("#local2_from_location").focus();
                            $("#local2_to_location").focus();
                            $("#local2_from_latitude").focus();
                            $("#local2_from_longitude").focus();
                            $("#local2_to_latitude").focus();
                            $("#local2_to_longitude").focus();
                        }, 800);

                        $("#local2_travel_type").material_select();
                        $("#local2_cartype_id").material_select();
                    } else if (ride_type == 'Rental') {
                        $('#rentalModal').modal('show');
                        $('#rentalModalHeader').text('Add Rental Ride');
                        $('.view_hide_fields').show();
                        $("#AddRental :input").prop("disabled", false);

                        $("#rental2_enquiry_id").val(response.enquiry.temp_id);

                        $("#rental2_amount").val(response.enquiry.amount);
                        $("#rental2_ride_later_date").val(response.enquiry.ride_later_date);
                        $("#rental2_ride_later_time").val(response.enquiry.ride_later_time);
                        $("#rental2_pick_location").val(response.enquiry.pick_location);
                        $("#rental2_distance_driver_user_km").val(response.enquiry
                            .distance_driver_user_km);
                        $("#rental2_distance_user_destination_km").val(response.enquiry
                            .distance_user_destination_km);
                        $("#rental2_custoemr_amount").val(response.enquiry.custoemr_amount);
                        $("#rental2_driver_allowance").val(response.enquiry
                            .driver_allowance);
                        $("#rental2_parking_and_tolltax").val(response.enquiry
                            .parking_and_tolltax);
                        $("#rental2_extra_perkm_rate").val(response.enquiry
                            .extra_perkm_rate);
                        $("#rental2_customer_extra_kms").val(response.enquiry
                            .customer_extra_kms);
                        $("#rental2_extra_min_rate").val(response.enquiry.extra_min_rate);
                        $("#rental2_customer_extra_time").val(response.enquiry
                            .customer_extra_time);
                        $("#rental2_from_lat").val(response.enquiry.latitude);
                        $("#rental2_from_lng").val(response.enquiry.longitude);
                        $("#rental2_travel_type").val(response.enquiry.travel_type);
                        $("#rental2_start_time").val(response.enquiry.start_time);
                        $("#rental2_end_time").val(response.enquiry.end_time);
                        $("#rental2_customer_list").val(response.enquiry.customer_id)
                            .change();
                        $("#rental2_cartype_id").val(response.enquiry.cartype_id);
                        $("#rental2_city_id").val(response.enquiry.city_id).change();
                        $("#rental2_package_list").val(response.enquiry.pctl_id).change();

                        setTimeout(() => {
                            $("#rental2_amount").focus();

                            $("#rental2_pick_location").focus();
                            $("#rental2_from_lat").focus();
                            $("#rental2_from_lng").focus();
                            $("#rental2_days").focus();
                            $("#rental2_fixed_rate").focus();
                            $("#rental2_from_origin").focus();
                            $("#rental2_distance_driver_user_km").focus();
                            $("#rental2_distance_user_destination_km").focus();
                            $("#rental2_custoemr_amount").focus();

                        }, 800);

                        $("#rental2_cartype_id").material_select();
                        $("#rental2_travel_type").material_select();
                        $("#rental2_city_id").material_select();

                    } else {
                        $('#outstationModal').modal('show');
                        $('#outstatinoModalHeader').text('Add Outstation Ride');
                        $('.view_hide_fields').show();
                        $("#AddOutstation :input").prop("disabled", false);

                        $("#outstation2_enquiry_id").val(response.enquiry.id);
                        $("#outstation2_from_origin").val(response.enquiry.from_origin);
                        $("#outstation2_to_destination").val(response.enquiry
                            .to_destination);
                        $("#outstation2_from_lat").val(response.enquiry.from_lat);
                        $("#outstation2_from_lng").val(response.enquiry.from_lng);
                        $("#outstation2_days").val(response.enquiry.days);
                        $("#outstation2_fixed_rate").val(response.enquiry.rate);
                        $("#outstation2_car_type_id").val(response.enquiry.car_type_id);
                        $("#outstation2_date").val(response.enquiry.date);
                        $("#outstation2_customer_list").val(response.enquiry.customer_id)
                            .change();
                        $("#outstation2_type").val(response.enquiry.type);
                        $("#outstation2_from_time").val(response.enquiry.from_time);
                        $("#outstation2_to_time").val(response.enquiry.to_time);
                        $("#outstation2_perkm_amount").val(response.enquiry.perkm_amount);
                        $("#outstation2_per_day_amount").val(response.enquiry
                            .per_day_amount);
                        $("#outstation2_per_day_desc").val(response.enquiry.per_day_desc);
                        $("#outstation2_per_km_desc").val(response.enquiry.per_km_desc);
                        $("#outstation2_waiting_charge").val(response.enquiry
                            .waiting_charge);
                        $("#outstation2_toll_n_parking_desc").val(response.enquiry
                            .toll_n_parking_desc);
                        $("#outstation2_night_hault_desc").val(response.enquiry
                            .night_hault_desc);
                        $("#outstation2_fixed_rate").val(response.enquiry.fixed_rate);


                        setTimeout(() => {
                            $("#outstation2_to_destination").focus();
                            $("#outstation2_from_lat").focus();
                            $("#outstation2_from_lng").focus();
                            $("#outstation2_days").focus();
                            $("#outstation2_from_origin").focus();
                            $("#outstation2_perkm_amount").focus();
                            $("#outstation2_per_day_amount").focus();
                            $("#outstation2_per_day_desc").focus();
                            $("#outstation2_per_km_desc").focus();
                            $("#outstation2_waiting_charge").focus();
                            $("#outstation2_toll_n_parking_desc").focus();
                            $("#outstation2_night_hault_desc").focus();
                            $("#outstation2_fixed_rate").focus();

                        }, 800);

                        $("#outstation2_car_type_id").material_select();
                        $("#outstation2_type").material_select();
                    }
                }
            })
        })

        function format_date(dateStr) {
            var date = new Date(dateStr);
            var formattedDate = date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + (
                '0' + date.getDate()).slice(-2);
            return formattedDate;
        }

        $(document).on('click', '.EditEnquiry', function() {
            $(".loader-ajax").fadeOut("slow").show();

            let id = $(this).attr('id');
            let ride_type = $(this).attr('ride_type');
            $.ajax({
                url: '{{ route('editEnquiry') }}',
                type: 'post',
                data: {
                    enquiry_id: id,
                    ride_type: $(this).attr('ride_type'),
                },
                dataType: 'json',
                success: function(response) {
                    $(".loader-ajax").fadeOut("slow").hide();

                    if (ride_type == 'Local') {
                        $('#edit_localModal').modal('show');
                        $('.view_hide_fields').hide();
                        $("#edit_local2_from_latitude").val(response.enquiry.from_latitude);
                        $("#edit_local2_from_longitude").val(response.enquiry
                            .from_longitude);
                        $("#edit_local2_to_latitude").val(response.enquiry.to_latitude);
                        $("#edit_local2_to_longitude").val(response.enquiry.to_longitude);
                        $("#edit_local2_from_location").val(response.enquiry.from_location);
                        $("#edit_local2_to_location").val(response.enquiry.to_location);

                        $("#edit_local2_travel_type").val(response.enquiry.travel_type);
                        if (response.enquiry.travel_type == 'ride_later') {
                            $("#edit_local2_purpose").show();
                        } else {
                            $("#edit_local2_purpose").hide();

                        }


                        $("#edit_local2_ride_later_date").val(format_date(response.enquiry
                            .ride_later_date));
                        $("#edit_local2_ride_later_time").val(response.enquiry
                            .ride_later_time);
                        $("#edit_local2_cartype_id").val(response.enquiry.car_type_id);
                        $("#edit_local2_custoemr_amount").val(response.enquiry
                            .custoemr_amount);
                        $("#edit_local2_customer_list").val(response.enquiry.customer_id)
                        $("#edit_local2_enquiry_id").val(response.enquiry.id)
                            .change();

                        setTimeout(() => {
                            $("#edit_local2_from_location").focus();
                            $("#edit_local2_to_location").focus();
                            $("#edit_local2_from_latitude").focus();
                            $("#edit_local2_from_longitude").focus();
                            $("#edit_local2_to_latitude").focus();
                            $("#edit_local2_to_longitude").focus();
                            //$("#edit_CustomerForm :input").prop("disabled", true);

                        }, 800);

                        $("#edit_local2_travel_type").material_select();
                        $("#edit_local2_cartype_id").material_select();
                    } else if (ride_type == 'Rental') {
                        $('#edit_rentalModal').modal('show');
                        $("#edit_rental2_enquiry_id").val(response.enquiry.temp_id)

                        $('.view_hide_fields').hide();

                        if (response.enquiry.travel_type == 'ride_later') {
                            $("#edit_rental2_purpose").show();
                        } else {
                            $("#edit_rental2_purpose").hide();

                        }


                        $("#edit_rental2_amount").val(response.enquiry.amount);
                        $("#edit_rental2_ride_later_date").val(response.enquiry.ride_later_date);
                        $("#edit_rental2_ride_later_time").val(response.enquiry.ride_later_time);
                        $("#edit_rental2_pick_location").val(response.enquiry.pick_location);
                        $("#edit_rental2_distance_driver_user_km").val(response.enquiry
                            .distance_driver_user_km);
                        $("#edit_rental2_distance_user_destination_km").val(response.enquiry
                            .distance_user_destination_km);
                        $("#edit_rental2_custoemr_amount").val(response.enquiry.custoemr_amount);
                        $("#edit_rental2_driver_allowance").val(response.enquiry
                            .driver_allowance);
                        $("#edit_rental2_parking_and_tolltax").val(response.enquiry
                            .parking_and_tolltax);
                        $("#edit_rental2_extra_perkm_rate").val(response.enquiry
                            .extra_perkm_rate);
                        $("#edit_rental2_customer_extra_kms").val(response.enquiry
                            .customer_extra_kms);
                        $("#edit_rental2_extra_min_rate").val(response.enquiry.extra_min_rate);
                        $("#edit_rental2_customer_extra_time").val(response.enquiry
                            .customer_extra_time);
                        $("#edit_rental2_from_lat").val(response.enquiry.latitude);
                        $("#edit_rental2_from_lng").val(response.enquiry.longitude);
                        $("#edit_rental2_travel_type").val(response.enquiry.travel_type);
                        $("#edit_rental2_start_time").val(response.enquiry.start_time);
                        $("#edit_rental2_end_time").val(response.enquiry.end_time);
                        $("#edit_rental2_customer_list").val(response.enquiry.customer_id)
                            .change();
                        $("#edit_rental2_cartype_id").val(response.enquiry.cartype_id);
                        $("#edit_rental2_city_id").val(response.enquiry.city_id).change();
                        $("#edit_rental2_package_list").val(response.enquiry.pctl_id).change();


                        setTimeout(() => {
                            $("#edit_rental2_amount").focus();

                            $("#edit_rental2_pick_location").focus();
                            $("#edit_rental2_from_lat").focus();
                            $("#edit_rental2_from_lng").focus();
                            $("#edit_rental2_days").focus();
                            $("#edit_rental2_fixed_rate").focus();
                            $("#edit_rental2_from_origin").focus();
                            $("#edit_rental2_distance_driver_user_km").focus();
                            $("#edit_rental2_distance_user_destination_km").focus();
                            $("#edit_rental2_custoemr_amount").focus();
                           // $("#AddRental :input").prop("disabled", true);

                        }, 800);

                        $("#edit_rental2_cartype_id").material_select();
                        $("#edit_rental2_travel_type").material_select();
                        $("#edit_rental2_city_id").material_select();

                    } else {

                        $('#edit_outstationModal').modal('show');
                        $("#edit_outstation2_enquiry_id").val(response.enquiry.id)

                        $('.view_hide_fields').hide();
                        $("#edit_outstation2_from_origin").val(response.enquiry.from_origin);
                        $("#edit_outstation2_to_destination").val(response.enquiry
                            .to_destination);
                        $("#edit_outstation2_from_lat").val(response.enquiry.from_lat);
                        $("#edit_outstation2_from_lng").val(response.enquiry.from_lng);
                        $("#edit_outstation2_days").val(response.enquiry.days);
                        $("#edit_outstation2_fixed_rate").val(response.enquiry.rate);
                        $("#edit_outstation2_car_type_id").val(response.enquiry.car_type_id);
                        $("#edit_outstation2_date").val(response.enquiry.date);
                        $("#edit_outstation2_customer_list").val(response.enquiry.customer_id)
                            .change();
                        $("#edit_outstation2_type").val(response.enquiry.type);
                        $("#edit_outstation2_from_time").val(response.enquiry.from_time);
                        $("#edit_outstation2_to_time").val(response.enquiry.to_time);
                        $("#edit_outstation2_perkm_amount").val(response.enquiry.perkm_amount);
                        $("#edit_outstation2_per_day_amount").val(response.enquiry
                            .per_day_amount);
                        $("#edit_outstation2_per_day_desc").val(response.enquiry.per_day_desc);
                        $("#edit_outstation2_per_km_desc").val(response.enquiry.per_km_desc);
                        $("#edit_outstation2_waiting_charge").val(response.enquiry
                            .waiting_charge);
                        $("#edit_outstation2_toll_n_parking_desc").val(response.enquiry
                            .toll_n_parking_desc);
                        $("#edit_outstation2_night_hault_desc").val(response.enquiry
                            .night_hault_desc);
                        $("#edit_outstation2_fixed_rate").val(response.enquiry.fixed_rate);


                        setTimeout(() => {
                            $("#edit_outstation2_to_destination").focus();
                            $("#edit_outstation2_from_lat").focus();
                            $("#edit_outstation2_from_lng").focus();
                            $("#edit_outstation2_days").focus();
                            $("#edit_outstation2_from_origin").focus();
                            $("#edit_outstation2_perkm_amount").focus();
                            $("#edit_outstation2_per_day_amount").focus();
                            $("#edit_outstation2_per_day_desc").focus();
                            $("#edit_outstation2_per_km_desc").focus();
                            $("#edit_outstation2_waiting_charge").focus();
                            $("#edit_outstation2_toll_n_parking_desc").focus();
                            $("#edit_outstation2_night_hault_desc").focus();
                            $("#edit_outstation2_fixed_rate").focus();
                           // $("#AddOutstation :input").prop("disabled", true);

                        }, 1000);

                        $("#edit_outstation2_car_type_id").material_select();
                        $("#edit_outstation2_type").material_select();

                    }
                }
            })
        })


        $(document).on('click', '.viewEnquiry', function() {
            $(".loader-ajax").fadeOut("slow").show();

            let id = $(this).attr('id');
            let ride_type = $(this).attr('ride_type');
            $.ajax({
                url: '{{ route('editEnquiry') }}',
                type: 'post',
                data: {
                    enquiry_id: id,
                    ride_type: $(this).attr('ride_type'),
                },
                dataType: 'json',
                success: function(response) {
                    $(".loader-ajax").fadeOut("slow").hide();

                    if (ride_type == 'Local') {
                        $('#localModal').modal('show');
                        $('#localModalHeader').text('Local Enquiry Info');
                        $('.view_hide_fields').hide();
                        $("#local2_from_latitude").val(response.enquiry.from_latitude);
                        $("#local2_from_longitude").val(response.enquiry.from_longitude);
                        $("#local2_to_latitude").val(response.enquiry.to_latitude);
                        $("#local2_to_longitude").val(response.enquiry.to_longitude);
                        $("#local2_from_location").val(response.enquiry.from_location);
                        $("#local2_to_location").val(response.enquiry.to_location);
                        $("#local2_ride_later_date").val(response.enquiry.ride_later_date);
                        $("#local2_ride_later_time").val(response.enquiry.ride_later_time);
                        $("#local2_travel_type").val(response.enquiry.travel_type);
                        $("#local2_cartype_id").val(response.enquiry.car_type_id);
                        $("#local2_custoemr_amount").val(response.enquiry.custoemr_amount);
                        $("#local2_customer_list").val(response.enquiry.customer_id)
                            .change();

                        setTimeout(() => {
                            $("#local2_from_location").focus();
                            $("#local2_to_location").focus();
                            $("#local2_from_latitude").focus();
                            $("#local2_from_longitude").focus();
                            $("#local2_to_latitude").focus();
                            $("#local2_to_longitude").focus();
                            $("#CustomerForm :input").prop("disabled", true);

                        }, 800);

                        $("#local2_travel_type").material_select();
                        $("#local2_cartype_id").material_select();
                    } else if (ride_type == 'Rental') {
                        $('#rentalModal').modal('show');
                        $('#rentalModalHeader').text('Rental Enquiry Info');
                        $('.view_hide_fields').hide();


                        $("#rental2_amount").val(response.enquiry.amount);
                        $("#rental2_ride_later_date").val(response.enquiry.ride_later_date);
                        $("#rental2_ride_later_time").val(response.enquiry.ride_later_time);
                        $("#rental2_pick_location").val(response.enquiry.pick_location);
                        $("#rental2_distance_driver_user_km").val(response.enquiry
                            .distance_driver_user_km);
                        $("#rental2_distance_user_destination_km").val(response.enquiry
                            .distance_user_destination_km);
                        $("#rental2_custoemr_amount").val(response.enquiry.custoemr_amount);
                        $("#rental2_driver_allowance").val(response.enquiry
                            .driver_allowance);
                        $("#rental2_parking_and_tolltax").val(response.enquiry
                            .parking_and_tolltax);
                        $("#rental2_extra_perkm_rate").val(response.enquiry
                            .extra_perkm_rate);
                        $("#rental2_customer_extra_kms").val(response.enquiry
                            .customer_extra_kms);
                        $("#rental2_extra_min_rate").val(response.enquiry.extra_min_rate);
                        $("#rental2_customer_extra_time").val(response.enquiry
                            .customer_extra_time);
                        $("#rental2_from_lat").val(response.enquiry.latitude);
                        $("#rental2_from_lng").val(response.enquiry.longitude);
                        $("#rental2_travel_type").val(response.enquiry.travel_type);
                        $("#rental2_start_time").val(response.enquiry.start_time);
                        $("#rental2_end_time").val(response.enquiry.end_time);
                        $("#rental2_customer_list").val(response.enquiry.customer_id)
                            .change();
                        $("#rental2_cartype_id").val(response.enquiry.cartype_id);
                        $("#rental2_city_id").val(response.enquiry.city_id).change();
                        $("#rental2_package_list").val(response.enquiry.pctl_id).change();


                        setTimeout(() => {
                            $("#rental2_amount").focus();

                            $("#rental2_pick_location").focus();
                            $("#rental2_from_lat").focus();
                            $("#rental2_from_lng").focus();
                            $("#rental2_days").focus();
                            $("#rental2_fixed_rate").focus();
                            $("#rental2_from_origin").focus();
                            $("#rental2_distance_driver_user_km").focus();
                            $("#rental2_distance_user_destination_km").focus();
                            $("#rental2_custoemr_amount").focus();
                            $("#AddRental :input").prop("disabled", true);

                        }, 800);

                        $("#rental2_cartype_id").material_select();
                        $("#rental2_travel_type").material_select();
                        $("#rental2_city_id").material_select();

                    } else {

                        $('#outstationModal').modal('show');
                        $('#outstatinoModalHeader').text('Outstation Enquiry Info');
                        $('.view_hide_fields').hide();
                        $("#outstation2_from_origin").val(response.enquiry.from_origin);
                        $("#outstation2_to_destination").val(response.enquiry
                            .to_destination);
                        $("#outstation2_from_lat").val(response.enquiry.from_lat);
                        $("#outstation2_from_lng").val(response.enquiry.from_lng);
                        $("#outstation2_days").val(response.enquiry.days);
                        $("#outstation2_fixed_rate").val(response.enquiry.rate);
                        $("#outstation2_car_type_id").val(response.enquiry.car_type_id);
                        $("#outstation2_date").val(response.enquiry.date);
                        $("#outstation2_customer_list").val(response.enquiry.customer_id)
                            .change();
                        $("#outstation2_type").val(response.enquiry.type);
                        $("#outstation2_from_time").val(response.enquiry.from_time);
                        $("#outstation2_to_time").val(response.enquiry.to_time);
                        $("#outstation2_perkm_amount").val(response.enquiry.perkm_amount);
                        $("#outstation2_per_day_amount").val(response.enquiry
                            .per_day_amount);
                        $("#outstation2_per_day_desc").val(response.enquiry.per_day_desc);
                        $("#outstation2_per_km_desc").val(response.enquiry.per_km_desc);
                        $("#outstation2_waiting_charge").val(response.enquiry
                            .waiting_charge);
                        $("#outstation2_toll_n_parking_desc").val(response.enquiry
                            .toll_n_parking_desc);
                        $("#outstation2_night_hault_desc").val(response.enquiry
                            .night_hault_desc);
                        $("#outstation2_fixed_rate").val(response.enquiry.fixed_rate);


                        setTimeout(() => {
                            $("#outstation2_to_destination").focus();
                            $("#outstation2_from_lat").focus();
                            $("#outstation2_from_lng").focus();
                            $("#outstation2_days").focus();
                            $("#outstation2_from_origin").focus();
                            $("#outstation2_perkm_amount").focus();
                            $("#outstation2_per_day_amount").focus();
                            $("#outstation2_per_day_desc").focus();
                            $("#outstation2_per_km_desc").focus();
                            $("#outstation2_waiting_charge").focus();
                            $("#outstation2_toll_n_parking_desc").focus();
                            $("#outstation2_night_hault_desc").focus();
                            $("#outstation2_fixed_rate").focus();
                            $("#AddOutstation :input").prop("disabled", true);

                        }, 800);

                        $("#outstation2_car_type_id").material_select();
                        $("#outstation2_type").material_select();

                    }
                }
            })
        })




    });
</script>
