<script>

    var manageTable;

    $(document).ready(function() {
        dataTableInit();
    });

    /* -------All Records Show In DRIVER Table---------*/

    function dataTableInit() {

        manageTable =   $("#list").DataTable({
            "ajax": "{{route('allCustomerRegister')}}",
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
                        toastr.success('Added Successfully.', 'Customer', {timeOut: 5000});
                        $("#CustomerForm")[0].reset();
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

      /* -------INSERT DRIVER---------*/
      $("#submitadd2").on('click', function() {

$(".form-group").removeClass('has-error').removeClass('has-success');
$(".text-danger").remove();
$(".messages").html("");
$("#CustomerForm2").unbind('submit').bind('submit', function() {

    $(".text-danger").remove();

    var form = $(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var postData = new FormData($("#CustomerForm2")[0]);
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
                toastr.success('Added Successfully.', 'Customer', {timeOut: 5000});
                $("#CustomerForm2")[0].reset();
                $('#modalAddCustomer').modal('hide');
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
                    url: '{{route('removeCustomer2')}}',
                    type: 'post',
                    data: {customer : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Deleted Successfully.', 'Customer', {timeOut: 3000});
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Delete Customer.', 'Failed', {timeOut: 3000});
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
    function editCustomer(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editCustomer')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
                    $("#edit_company_name").val(response.customer.company_name);


// mmeber id
                    $("#EditCustomerForm").append('<input type="hidden" name="id" id="edit_id" value="'+id+'"/>');

// here update the location data
                    $("#EditCustomerForm").unbind('submit').bind('submit', function() {
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

                                    $('#editModal2').modal('hide');
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


    function editCustomer2(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editCustomer2')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
                    console.log(response);
                    $("#edit_first_name").val(response.customer.first_name);
                    $("#edit_last_name").val(response.customer.last_name);
                    $("#edit_mobile_no").val(response.customer.mobile_no);
                    $("#edit_email_id").val(response.customer.email_id);
                    $("#edit_id_proof").val(response.customer.id_proof);
                    $('#EditCustomerForm2 input').each(function() {
        $(this).focus();
                    })
        //$("#edit_first_name").focus();

// mmeber id
                    $("#EditCustomerForm2").append('<input type="hidden" name="id" id="edit_id" value="'+id+'"/>');

// here update the location data
                    $("#EditCustomerForm2").unbind('submit').bind('submit', function() {
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

                                    $('#modalEditCustomer').modal('hide');
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

     /* -------Show EDIT ITEM Data---------*/
     function editItem(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editCompany')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
                    $("#edit_company_name").val(response.customer.company_name);


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

    function CustomerDetails(id = null) {
        if(id) {

// fetch the member data
            $.ajax({
                url: '{{route('showCustomer')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {

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

	function removeItemBooking(id = null) {
        if(id) {
            // click on remove button
            $("#removeBtnBooking").unbind('click').bind('click', function() {
                $(".loader-ajax").fadeOut("slow").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{route('customerBooking')}}',
                    type: 'post',
                    data: {booking : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Successfully.', 'Approved Corporate Booking', {timeOut: 3000});
                            $("#removeModalBooking").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Approved Corporate Booking', 'Failed', {timeOut: 3000});
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
