<script>

    $(document).ready(function() {
        dataTableInit();

    });
    function RentalDetails(id = null) {
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

    function dataTableInit() {

             manageTable =   $("#list").DataTable({
                'ajax' : {
                url: '{{ route('allRentalEnq') }}',
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
            targets: [6,7], // Assuming the datetime column is the fourth column (index 3)
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




    /* -------REMOVE CAR TYPE---------*/
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
                    url: '{{route('deleteRentalEnquiry')}}',
                    type: 'post',
                    data: {id : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            // refresh the table
                            manageTable.ajax.reload(null, false);
                            // close the modal
                            toastr.success('Deleted Successfully.', 'Rental Enquiry', {timeOut: 3000});
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();

                        } else {
                            toastr.error('Not Deleted.', 'SOS', {timeOut: 3000});
                        }
                    }
                });
            }); // click remove btn
        }
        else
        {
            alert('Error: Refresh the page again');
        }
    }
	
	   function editItem(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editLinkDriverRental')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
// mmeber id
                    $("#editForm").append('<input type="hidden" name="id" id="edit_id" value="'+id+'"/><input type="hidden" name="customer_package_id" value="'+response['link'].customer_package_id+'"/>');

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
	
	
	   function getCustomer() {
        $.ajax({
            url: '{{route('getAllCustomer')}}',
            type: 'get',
            dataType: 'json',
            success:function(response) {
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
                            $('#modalAddCustomer').modal('hide');
                            toastr.success('Added Successfully.', 'Customer', {timeOut: 5000});
                            $("#AddRentalCustomer")[0].reset();
                            getCustomer();

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

    });
	
	
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
                            $('#createModal').modal('hide');
                            toastr.success('Added Successfully.', 'Rental', {timeOut: 5000});
                            $("#AddRental")[0].reset();
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

    });
	
    function RentalDetails(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editRentalCustomer')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
					$("#show_edit_amount").val(response.rentalride.amount);
                    $("#show_edit_ride_later_date").val(response.rentalride.ride_later_date);
                    $("#show_edit_ride_later_time").val(response.rentalride.ride_later_time);
                    //$("#show_edit_start_time").val(response.rentalride.start_time);
                    //$("#show_edit_end_time").val(response.rentalride.end_time);
                    $("#show_edit_pick_location").val(response.rentalride.pick_location);
                    $("#show_edit_distance_driver_user_km").val(response.rentalride.distance_driver_user_km);
                    								$("#show_edit_distance_user_destination_km").val(response.rentalride.distance_user_destination_km);
					$("#show_edit_custoemr_amount").val(response.rentalride.custoemr_amount);
				
				$("#show_edit_driver_allowance").val(response.rentalride.driver_allowance);
				$("#show_edit_parking_and_tolltax").val(response.rentalride.parking_and_tolltax);
				$("#show_edit_extra_perkm_rate").val(response.rentalride.extra_perkm_rate);
				$("#show_edit_customer_extra_kms").val(response.rentalride.customer_extra_kms);
				$("#show_edit_extra_min_rate").val(response.rentalride.extra_min_rate);
				$("#show_edit_customer_extra_time").val(response.rentalride.customer_extra_time);
				
				
				  	$("#show_cartype_list").empty();
                    $("#show_cartype_list").append(response.cars);
                    $('#show_cartype_list').material_select();

                    $("#show_travel_type_list").empty();
                    $("#show_travel_type_list").append(response.travel);
                    $('#show_travel_type_list').material_select();
				
					$("#show_driver_list").empty();
                    $("#show_driver_list").append(response.drivers);
                    $('#show_driver_list').material_select();
				
					$("#show_city_list").empty();
                    $("#show_city_list").append(response.city);
                    $('#show_city_list').material_select();
				
				
					$("#show_package_list").empty();
                    $("#show_package_list").append(response.package);
                    $('#show_package_list').material_select();
				
					$("#show_status_list").empty();
                    $("#show_status_list").append(response.statuses);
                    $('#show_status_list').material_select();
				
				
	

// mmeber id
                    $("#show_editFormRentalPackage").append('<input type="hidden" name="id" id="edit_id" value="'+id+'"/>');

// here update the location data
                    $("#show_editFormRentalPackage").unbind('submit').bind('submit', function() {
// remove error messages
                        $(".text-danger").remove();

                        var form = $(this);
// validation
                      


                        return false;
                    });

                } // /success
            }); // /fetch selected member info

        } else {
            alert("Error : Refresh the page again");
        }
    }
	
	
	 function editItemRental(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editRentalCustomer')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
					$("#edit_amount").val(response.rentalride.amount);
                    $("#edit_ride_later_date").val(response.rentalride.ride_later_date);
                    $("#edit_ride_later_time").val(response.rentalride.ride_later_time);
                    //$("#edit_start_time").val(response.rentalride.start_time);
                    //$("#edit_end_time").val(response.rentalride.end_time);
                    $("#edit_pick_location").val(response.rentalride.pick_location);
                    $("#edit_distance_driver_user_km").val(response.rentalride.distance_driver_user_km);
                    								$("#edit_distance_user_destination_km").val(response.rentalride.distance_user_destination_km);
					$("#edit_custoemr_amount").val(response.rentalride.custoemr_amount);
				
				$("#edit_driver_allowance").val(response.rentalride.driver_allowance);
				$("#edit_parking_and_tolltax").val(response.rentalride.parking_and_tolltax);
				$("#edit_extra_perkm_rate").val(response.rentalride.extra_perkm_rate);
				$("#edit_customer_extra_kms").val(response.rentalride.customer_extra_kms);
				$("#edit_extra_min_rate").val(response.rentalride.extra_min_rate);
				$("#edit_customer_extra_time").val(response.rentalride.customer_extra_time);
				
				
				  	$("#cartype_list").empty();
                    $("#cartype_list").append(response.cars);
                    $('#cartype_list').material_select();

                    $("#travel_type_list").empty();
                    $("#travel_type_list").append(response.travel);
                    $('#travel_type_list').material_select();
				
					$("#driver_list").empty();
                    $("#driver_list").append(response.drivers);
                    $('#driver_list').material_select();
				
					$("#city_list").empty();
                    $("#city_list").append(response.city);
                    $('#city_list').material_select();
				
				
					$("#package_list").empty();
                    $("#package_list").append(response.package);
                    $('#package_list').material_select();
				
					$("#status_list").empty();
                    $("#status_list").append(response.statuses);
                    $('#status_list').material_select();
				
				
	

// mmeber id
                    $("#editFormRentalPackage").append('<input type="hidden" name="id" id="edit_id" value="'+id+'"/>');

// here update the location data
                    $("#editFormRentalPackage").unbind('submit').bind('submit', function() {
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

                                    $('#editModalRental').modal('hide');
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
	
	
	function getPackagesList(city_id) {
        $(".loader-ajax").fadeOut("slow").show();
        $.ajax({
            url: '{{route('getPackagesList')}}',
            type: 'post',
            data: {city_id : city_id},
            dataType: 'json',
            success:function(response) {
                $(".loader-ajax").hide();

                $("#package_list").empty();
                $("#package_list").append('<option value="" disabled>Select Packages</option>');
                $("#package_list").append(response);
                $('#package_list').material_select();

            }
        });
    }

	
	
	

</script>
