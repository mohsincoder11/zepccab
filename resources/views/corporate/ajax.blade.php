<script>

    var manageTable;

    $(document).ready(function() {
        dataTableInit();
    });

    /* -------All Records Show In DRIVER Table---------*/

    function dataTableInit() {

        manageTable =   $("#list").DataTable({
            "ajax": "{{route('allCorporateCustomer')}}",
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
                , {
                    extend: "print",
                    className: "btn bg-red btn-flat margin",
                    text: '<img src="{{asset('public/images/icons/print.svg')}}">',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    },
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

    function editItem(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('EditCorporateLinkDriver')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
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

    function AddCorporateBookingDetails(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('EditCorporateLinkDriver')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
// mmeber id
                    $("#editFormAddBooking").append('<input type="hidden" name="id" id="edit_id" value="'+id+'"/>');

// here update the location data
                    $("#editFormAddBooking").unbind('submit').bind('submit', function() {
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

                                    $('#modalVM').modal('hide');
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

    function resetSearchForm(){
        $('#list').DataTable().clear().destroy();
        dataTableInit();
    }

    function CorporateBookingDetails(id = null){
        if(id) {
            $(".loader-ajax").fadeOut("slow").show();

            $.ajax({
                url: '{{route('CorporateBookingDetails')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function (response) {

                    $("#list_details").DataTable().clear().destroy();
                    showListTable = $("#list_details").DataTable(response);
                    new $.fn.dataTable.Buttons(showListTable, {
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
                            },{
                                extend:"print",
                                className:"btn bg-blue btn-flat margin",
                                text: '<img src="{{asset('public/images/icons/print.svg')}}">',
                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            }
                        ]
                    } );

                    showListTable.buttons( 0, null ).container().prependTo(
                        showListTable.table().container()
                    );

                    $('#list_details_length').hide();
                    $(".loader-ajax").hide();

                }
            });
        }
        else
        {
            toastr.warning(response.messages, 'Error', {timeOut: 3000});
            $(".loader-ajax").hide();
        }
    }
	
	 function editItemBookingItem(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editCorporateBooking')}}',
                type: 'post',
                data: {corporate_booking_id: id},
                dataType: 'json',
                success:function(response) {
                    $("#edit_date").val(response.c_booking.date);
                    $("#edit_distance_km").val(response.c_booking.distance_km);
                    $("#edit_amount").val(response.c_booking.amount);
                    $("#edit_desc_by_driver").val(response.c_booking.desc_by_driver);
					$("#edit_start_time").val(response.c_booking.start_time);
					$("#edit_end_time").val(response.c_booking.end_time);
					$("#edit_start_reading").val(response.c_booking.start_reading);
					$("#edit_end_reading").val(response.c_booking.end_reading);

                    $("#edit_driver_id").empty();
                    $("#edit_driver_id").append(response.drivers);
                    $('#edit_driver_id').material_select();

                    $("#edit_status").empty();
                    $("#edit_status").append(response.status);
                    $('#edit_status').material_select();



// mmeber id
                    $("#editFormCorporateBooking").append('<input type="hidden" name="id" id="edit_id" value="'+id+'"/>');

// here update the location data
                    $("#editFormCorporateBooking").unbind('submit').bind('submit', function() {
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

                                    $('#editModalBookingItem').modal('hide');
                                    $('#modalShow').modal('hide');
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

    function removeItemBookingItem(id = null) {
        if(id) {
            // click on remove button
            $("#removeBtnDeleteBookingItem").unbind('click').bind('click', function() {
                $(".loader-ajax").fadeOut("slow").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{route('removeCorporateBooking')}}',
                    type: 'post',
                    data: {remove_booking : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Delete Successfully.', 'Corporate Booking', {timeOut: 3000});
                            $("#modalConfirmDeleteBookingItem").modal('hide');
                            $('#modalShow').modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Delete Corporate Booking.', 'Failed', {timeOut: 3000});
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
	
	function editCorporateData(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editCorporateData')}}',
                type: 'post',
                data: {corporate_data_id: id},
                dataType: 'json',
                success:function(response) {
                    $("#edit_perkm_amount").val(response.corporate_data.perkm_amount);
                    $("#edit_per_day_amount").val(response.corporate_data.per_day_amount);
                    $("#edit_per_day_desc").val(response.corporate_data.per_day_desc);
                    $("#edit_per_km_desc").val(response.corporate_data.per_km_desc);
                    $("#edit_waiting_charge").val(response.corporate_data.waiting_charge);
                    $("#edit_toll_n_parking_desc").val(response.corporate_data.toll_n_parking_desc);
                    $("#edit_night_hault_desc").val(response.corporate_data.night_hault_desc);

                    $("#edit_status_data").empty();
                    $("#edit_status_data").append(response.status_data);
                    $('#edit_status_data').material_select();



// mmeber id
                    $("#editFormCorporateData").append('<input type="hidden" name="id" id="edit_id" value="'+id+'"/>');

// here update the location data
                    $("#editFormCorporateData").unbind('submit').bind('submit', function() {
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

                                    $('#editCorporateData').modal('hide');
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
</script>
