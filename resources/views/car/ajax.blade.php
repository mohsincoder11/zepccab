    
    <script>

    var manageTable;
//     $('#modalVM').on('shown.bs.modal', function (e) {
//         getll_driver();
// })
    $(document).ready(function() {
         dataTableInit();
         getll_driver();
    });
function getll_driver() {
    $.ajax({
            url : "{{route('get-driver')}}",
            type : 'get',
            dataType : 'json',
            success:function(data) {
                $("#driver_id").empty();
                $("#driver_id").append(data);
                $("#driver_id").material_select();

            }
        })

}


    /* -------All Records Show In CAR Table---------*/

function dataTableInit() {

    manageTable =   $("#list").DataTable({
        "ajax": "{{route('allCar')}}",
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


    /* -------INSERT CAR---------*/
    $("#submitBtn").on('click', function() {

    $(".form-group").removeClass('has-error').removeClass('has-success');
    $(".text-danger").remove();
    $(".messages").html("");
    $("#CarForm").unbind('submit').bind('submit', function() {

        $(".text-danger").remove();

        var form = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var postData = new FormData($("#CarForm")[0]);
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
                    toastr.success('Added Successfully.', 'Car', {timeOut: 5000});
                    $("#CarForm")[0].reset();
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

$("#open_driver_model").on('click',function(){
    $('#modalVM').modal('show');
})

$("#submitBtn_driver").on('click', function() {

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
                $('#modalVM2').modal('hide');
                getll_driver();

              //manageTable.ajax.reload(null, false);
              //location.reload(true);
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


    /* -------SEARCH CAR---------*/
    $("#searchCarBtn").on('click', function() {

        $(".loader-ajax").fadeOut("slow").show();
// submit form
        $("#searchCarForm").unbind('submit').bind('submit', function() {

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
            var postData = new FormData($("#searchCarForm")[0]);
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
    /* -------END SEARCH CAR---------*/

    /* -------REMOVE CAR---------*/
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
                    url: '{{route('removeCar')}}',
                    type: 'post',
                    data: {car : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Delete Successfully.', 'Car', {timeOut: 3000});
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Delete Car.', 'Failed', {timeOut: 3000});
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
    /* -------END REMOVE CAR---------*/

    /* -------Show EDIT ITEM Data---------*/
    function editItem(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editCar')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
                    $("#edit_car_name").val(response.car.car_name);
                    $("#edit_owner_name").val(response.car.owner_name);
                    $("#edit_car_model").val(response.car.car_model);
                    $("#edit_car_number").val(response.car.car_number);
                    $("#edit_registration_number").val(response.car.registration_number);
                    $("#edit_owner_primary_mobile").val(response.car.owner_primary_mobile);
                    $("#edit_owner_secondary_mobile").val(response.car.owner_secondary_mobile);
                    $("#edit_bank_details").val(response.car.bank_details);

                    $("#edit_car_type_id").empty();
                    $("#edit_car_type_id").append(response.car_type);
                    $('#edit_car_type_id').material_select();
				
					$("#edit_driver_id").empty();
                    $("#edit_driver_id").append(response.driver_data);
                    $('#edit_driver_id').material_select();

                    $("#edit_fuel_type").empty();
                    $("#edit_fuel_type").append(response.fuel_type);
                    $('#edit_fuel_type').material_select();

                    $("#edit_cities").empty();
                    $("#edit_cities").append(response.cities);
                    $('#edit_cities').material_select();

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

     function CarDetails(id = null) {
        if(id) {

// fetch the member data
            $.ajax({
                url: '{{route('showCar')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {

                    $("#show_city").empty();
                    $("#show_city").append(response.car.city_name);

                    $("#show_car_type").empty();
                    $("#show_car_type").append(response.car.car_type_name);

                    $("#show_car_name").empty();
                    $("#show_car_name").append(response.car.car_name);

                    $("#show_car_model").empty();
                    $("#show_car_model").append(response.car.car_model);

                    $("#show_owner_name").empty();
                    $("#show_owner_name").append(response.car.owner_name);

                    $("#show_primary_mobile").empty();
                    $("#show_primary_mobile").append(response.car.owner_primary_mobile);

                    $("#show_secondary_mobile").empty();
                    $("#show_secondary_mobile").append(response.car.owner_secondary_mobile);

                    $("#show_fuel_type").empty();
                    $("#show_fuel_type").append(response.car.fuel_type);

                    $("#show_reg_no").empty();
                    $("#show_reg_no").append(response.car.registration_number);

                    $("#show_car_number").empty();
                    $("#show_car_number").append(response.car.car_number);

                    $("#show_car_validity").empty();
                    $("#show_car_validity").append(response.car.car_validity);

                    $("#show_bank_details").empty();
                    $("#show_bank_details").append(response.car.bank_details);


                    $("#show_photos").empty();
                    $("#show_photos").append(response.image);



                } // /success
            }); // /fetch selected member info

        } else {
            alert("Error : Refresh the page again");
        }
    }


     function getCarTypeAdmin(city_id) {
        $(".loader-ajax").fadeOut("slow").show();
        $.ajax({
            url: '{{route('getCarTypeAdmin')}}',
            type: 'post',
            data: {city_id : city_id},
            dataType: 'json',
            success:function(response) {
                $(".loader-ajax").hide();

                $("#car_type_fetch").empty();
                $("#car_type_fetch").append('<option value="">Select Car Type </option>');
                $("#car_type_fetch").append(response);
                $('#car_type_fetch').material_select();

            }
        });
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
                    url: '{{route('removeCarStatus')}}',
                    type: 'post',
                    data: {car_status : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Delete Successfully.', 'Status', {timeOut: 3000});
                            $("#modalConfirmDelete1").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Status Car.', 'Failed', {timeOut: 3000});
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
