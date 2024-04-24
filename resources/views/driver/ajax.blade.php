<script>

    var manageTable;

    $(document).ready(function() {
        dataTableInit();
    });

    /* -------All Records Show In DRIVER Table---------*/

    function dataTableInit() {

        manageTable =   $("#list").DataTable({
            "ajax": "{{route('allDriver')}}",
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


    /* -------INSERT DRIVER---------*/
    $("#submitBtn").on('click', function() {

        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        $(".messages").html("");
        
        $("#DriverForm").unbind('submit').bind('submit', function() {

            $(".text-danger").remove();

            var form = $(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var postData = new FormData($("#DriverForm")[0]);
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
                        toastr.success('Added Successfully.', 'Driver', {timeOut: 5000});
                        $("#DriverForm")[0].reset();
                        $('#modalVM').modal('hide');
                        manageTable.ajax.reload(null, false);
                        location.reload(true);
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


    /* -------SEARCH DRIVER---------*/
    $("#searchDriverBtn").on('click', function() {

        $(".loader-ajax").fadeOut("slow").show();
// submit form
        $("#searchDriverForm").unbind('submit').bind('submit', function() {

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
            var postData = new FormData($("#searchDriverForm")[0]);
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
    /* -------END SEARCH DRIVER---------*/

    /* -------REMOVE DRIVER---------*/
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
                    url: '{{route('removeDriver')}}',
                    type: 'post',
                    data: {driver : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Delete Successfully.', 'Driver', {timeOut: 3000});
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Delete Driver.', 'Failed', {timeOut: 3000});
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
    /* -------END REMOVE DRIVER---------*/

    /* -------Show EDIT ITEM Data---------*/
    function editItem(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editDriver')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
                    $("#edit_first_name").val(response.driver.first_name);
                    $("#edit_last_name").val(response.driver.last_name);
                    $("#edit_mobile_no").val(response.driver.mobile_no);
                    $("#edit_secondary_mobile_no").val(response.driver.secondary_mobile_no);
                    $("#edit_email_id").val(response.driver.email_id);
                    $("#edit_address").val(response.driver.address);
                    $("#edit_city").val(response.driver.city);
                    $("#edit_bank_details").val(response.driver.bank_details);
                    $("#edit_aadhar_card").val(response.driver.aadhar_card);
                    $("#edit_driving_license").val(response.driver.driving_license);
                    $("#edit_current_latitude").val(response.driver.current_latitude);
                    $("#edit_current_longitude").val(response.driver.current_longitude);

                    $("#edit_car_id").empty();
                    $("#edit_car_id").append(response.cars);
                    $('#edit_car_id').material_select();

                     $("#edit_cities").empty();
                    $("#edit_cities").append(response.cities);
                    $('#edit_cities').material_select();
                    $("#edit_vendor_id").val(response.driver.vendor_id);
                    $('#edit_vendor_id').material_select();


                    


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

    function DriverDetails(id = null) {
        if(id) {

// fetch the member data
            $.ajax({
                url: '{{route('showDriver')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {

                    $("#show_city_name").empty();
                    $("#show_city_name").append(response.driver.city_name);

                    $("#show_name").empty();
                    $("#show_name").append(response.full_name);

                    $("#show_email_id").empty();
                    $("#show_email_id").append(response.driver.email_id);

                    $("#show_mobile_no").empty();
                    $("#show_mobile_no").append(response.driver.mobile_no);

                    $("#show_address").empty();
                    $("#show_address").append(response.driver.address);

                    $("#show_city").empty();
                    $("#show_city").append(response.driver.city);

                    $("#show_bank_details").empty();
                    $("#show_bank_details").append(response.driver.bank_details);

                    $("#show_aadhar_card").empty();
                    $("#show_aadhar_card").append(response.driver.aadhar_card);

                    $("#show_driving_license").empty();
                    $("#show_driving_license").append(response.driver.driving_license);

                    $("#show_secondary_mobile_no").empty();
                    $("#show_secondary_mobile_no").append(response.driver.secondary_mobile_no);

                    $("#show_car_number").empty();
                    $("#show_car_number").append(response.driver.car_number);

                    $("#show_owner_name").empty();
                    $("#show_owner_name").append(response.driver.owner_name);

                    $("#show_vendor_name").html(response.driver.vendor_name);

                    $("#show_photos").empty();
                    $("#show_photos").append(response.image);



                } // /success
            }); // /fetch selected member info

        } else {
            alert("Error : Refresh the page again");
        }
    }
	
	
	
	 function removeItem1(id = null) {
        if(id) {
            // click on remove button
            $("#removeBtnStatus").unbind('click').bind('click', function() {
                $(".loader-ajax").fadeOut("slow").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{route('removeDriverStatus')}}',
                    type: 'post',
                    data: {driver_status : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Change Successfully.', 'Status', {timeOut: 3000});
                            $("#modalConfirmDelete1").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Status Car.', 'Change', {timeOut: 3000});
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
</script>
