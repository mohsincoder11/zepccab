<script>
    $(document).ready(function() {
        dataTableInit();

    });
    $(document).on('change', '#type,#from_date_filter,#to_date_filter', function() {
        manageTable.ajax.reload(null, false);

    })

    function dataTableInit() {

        manageTable = $("#list").DataTable({
            'ajax': {
                url: '{{ route('allRental') }}',
                data: function(d) {
                    d.role = '{{ Auth::guard('admin')->user()->role }}';
                    d.outstation_ride_type = $("#type").val();
                    d.from_date_filter = $("#from_date_filter").val();
                    d.to_date_filter = $("#to_date_filter").val();
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
            columnDefs: [{
                    targets: 1, // Assuming the date column is the second column (0-based index)
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
                },
                {
                    targets: 2, // Assuming the datetime column is the fourth column (index 3)
                    type: 'datetime', // Set the type to handle datetime sorting
                    render: function(data, type, row) {
                        if (type === 'sort') {
                            var dateTimeParts = data.split(' ');
                            if (dateTimeParts.length === 2) {
                                var dateParts = dateTimeParts[0].split('-');
                                var timeParts = dateTimeParts[1].split(':');
                                if (dateParts.length === 3 && timeParts.length === 3) {
                                    var sortableDate = dateParts[2] + '-' + dateParts[1] + '-' +
                                        dateParts[0];
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
                        $(".form-group").removeClass('has-error').removeClass(
                            'has-success');

                        if (response.success == true) {

                            toastr.success('Added Successfully.', 'OUTSTATION', {
                                timeOut: 5000
                            });
                            $("#AddRental")[0].reset();
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

    /* -------REMOVE RENTAL---------*/
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
                    url: '{{ route('removeRental') }}',
                    type: 'post',
                    data: {
                        rental: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            // refresh the table
                            manageTable.ajax.reload(null, false);
                            // close the modal
                            toastr.success('Deleted Successfully.', 'Rental', {
                                timeOut: 3000
                            });
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();

                        } else {
                            toastr.error('Not Deleted.', 'Rental', {
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


    function editItem(id = null) {
        if (id) {

            $("#edit_id").remove();

            // fetch the member data
            $.ajax({
                url: '{{ route('editLinkDriver') }}',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
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

    function editItemDetails(id = null) {
        if (id) {

            $("#edit_id").remove();

            // fetch the member data
            $.ajax({
                url: '{{ route('editOutstationDetails') }}',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $("#edit_amount").val(response.outstation.amount);
                    $("#edit_perkm_amount").val(response.outstation.perkm_amount);
                    $("#edit_per_day_amount").val(response.outstation.per_day_amount);
                    $("#edit_per_day_desc").val(response.outstation.per_day_desc);
                    $("#edit_per_km_desc").val(response.outstation.per_km_desc);
                    $("#edit_waiting_charge").val(response.outstation.waiting_charge);
                    $("#edit_toll_n_parking_desc").val(response.outstation.toll_n_parking_desc);
                    $("#edit_night_hault_desc").val(response.outstation.night_hault_desc);
                    $("#edit_from_lat").val(response.outstation.from_lat);
                    $("#edit_distance").val(response.outstation.distance);
                    $("#edit_from_lng").val(response.outstation.from_lng);
                    $("#edit_date").val(response.outstation.date);
                    $("#edit_days").val(response.outstation.days);
                    $("#edit_total_average_amount").val(response.outstation.total_average_amount);
                    $("#edit_extra_per_min_rate").val(response.outstation.extra_per_min_rate);
                    $("#edit_customer_extra_time").val(response.outstation.customer_extra_time);
                    $("#edit_extra_per_km_rate").val(response.outstation.extra_per_km_rate);
                    $("#edit_customer_extra_kms").val(response.outstation.customer_extra_kms);
                    $("#edit_fixed_rate").val(response.outstation.fixed_rate);

                    $("#edit_type").val(response.outstation.type);
                    $("#edit_car_type_id").val(response.outstation.car_type_id);




                    $("#status_list").empty();
                    $("#status_list").append(response.statuses);
                    $('#status_list').material_select();
                    $('#edit_car_type_id').material_select();
                    $('#edit_type').material_select();

                    //$("#edit_days").focus();




                    // mmeber id
                    $("#editFormDetails").append('<input type="hidden" name="id" id="edit_id" value="' +
                        id + '"/>');

                    // here update the location data
                    $("#editFormDetails").unbind('submit').bind('submit', function() {
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

                                    $('#editModalDetails').modal('hide');
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


    var stopIndex = 1;

    $('#add-stop-btn').on('click', function() {
        var stopHtml = `<div class="form-row stop-row">
                            <div class="col-9">
                                <div class="md-form mt-3">
                                    <input type="text" id="stop_location_${stopIndex}" name="location[]" class="form-control stop-location">
                                    <input type="hidden" name="location_lat[]">
                                    <input type="hidden" name="location_lng[]">
                                    <label>Stop Location ${stopIndex}</label>
                                </div>
                            </div>
                           
                            <div class="col-3">
                        <a href="#" class="delete-stop-btn">
                            <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                                <i class="fa fa-trash mt-0"></i>
                            </button>
                        </a>
                    </div>

                        </div>`;
        $('#stops-container').append(stopHtml);
        stopIndex++;
        $('#stops-container').find('.stop-location').last().focus();

        initializeAutocomplete11();

    });

    $(document).on('click', '.delete-stop-btn', function() {
        stopIndex--;

        $(this).closest('.stop-row').remove();
        $('.stop-row').each(function(index) {
            index++;
            $(this).find('label').text(`Stop Location ${index}`);

        });
    });

    function ShowHideDiv(element) {
        let value = element.value;
        $('.company_div, .vendor_div, .package_div').addClass('hide');
        $("#package_id").empty();
        $("#package_id").html('<option disabled>Select Package</option>');
        $('#package_id').material_select();

        // Show the respective div based on the value
        if (value === '1') {
           getall_drivers();
        } else if (value === '2') {
            $('.company_div').removeClass('hide');
            $('.package_div').removeClass('hide');
           getall_drivers();

        } else if (value === '3') {
            $('.package_div').removeClass('hide');
            $('.vendor_div').removeClass('hide');

        }
    }

    function getall_drivers() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('get_all_drivers') }}',
                type: 'post',
                dataType: 'json',
                success: function(response) {
                    $("#driver_id").html(response.drivers);
                    $('#driver_id').material_select();
                    $(".loader-ajax").hide();
                }
            });
    }

    $("#vendor_id,#company_id").on("change", function() {
        var type = $(this).attr('id') === 'vendor_id' ? 'Vendor' :
            'Company'; // Determine type based on the selected element

        //$(".loader-ajax").fadeOut("slow").show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{ route('get_pacakge_data') }}',
            type: 'post',
            data: {
                id: $(this).val(),
                package_type: type
            },
            dataType: 'json',
            success: function(response) {
                $("#package_id").empty();
                $("#package_id").append(response.packages);
                $('#package_id').material_select();
                $("#driver_id").html(response.drivers);
                $('#driver_id').material_select();

                $(".loader-ajax").hide();
            }
        });

    })

    $("#package_id").on("change", function() {

        $(".loader-ajax").fadeOut("slow").show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{ route('get_pacakge_info') }}',
            type: 'post',
            data: {
                id: $(this).val(),
            },
            dataType: 'json',
            success: function(response) {
                $("#perkm_amount").val(response.per_km_amount).focus();
                $("#per_day_amount").val(response.per_day_amount).focus();
                $("#per_day_desc").val(response.per_day_desc).focus();
                $("#per_km_desc").val(response.per_km_desc).focus();
                $("#waiting_charge").val(response.waiting_charge).focus();
                $("#toll_n_parking_desc").val(response.toll_n_parking_desc).focus();
                $("#night_hault_desc").val(response.night_hault_desc).focus();
                $("#fixed_rate").val(response.fixed_rate).focus();


                $(".loader-ajax").hide();
            }
        });
    })




    function initializeAutocomplete11() {
        var options2 = {
            componentRestrictions: {
                country: "in"
            }
        };

        // Find all input fields with class 'stop-location' and initialize autocomplete for them
        $(document).find('.stop-location').each(function(a, b) {
            var input = this;
            var autocomplete = new google.maps.places.Autocomplete(input, options2);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $(input).nextAll('input[name="location_lat[]"]').eq(0).val(place.geometry['location']
                    .lat());
                $(input).nextAll('input[name="location_lng[]"]').eq(0).val(place.geometry['location']
                    .lng());
            });
        });
    }
</script>
