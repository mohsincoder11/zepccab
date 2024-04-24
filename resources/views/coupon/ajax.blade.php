<script>

    $(document).ready(function() {
        dataTableInit();

    });


    function dataTableInit() {

        manageTable =   $("#list").DataTable({
            "ajax": "{{route('allCoupon')}}",
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


    $(document).ready(function() {

        $("#submitadd").on('click', function() {

            $(".form-group").removeClass('has-error').removeClass('has-success');
            $(".text-danger").remove();
            $(".messages").html("");
            $("#AddCoupon").unbind('submit').bind('submit', function() {

                $(".text-danger").remove();

                var form = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



                var postData = new FormData($("#AddCoupon")[0]);
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

                            toastr.success('Added Successfully.', 'Coupon', {timeOut: 5000});
                            $("#AddCoupon")[0].reset();
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


	
	
	
	 function removeItemWebsite(id = null) {
        if(id) {
            // click on remove button
            $("#removeBtnCoupon").unbind('click').bind('click', function() {
                $(".loader-ajax").fadeOut("slow").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{route('removeCouponWebsite')}}',
                    type: 'post',
                    data: {coupon : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            // refresh the table
                            manageTable.ajax.reload(null, false);
                            // close the modal
                            toastr.success('Status Change Successfully.', 'Coupon', {timeOut: 3000});
                            $("#modalConfirmDeleteCoupon").modal('hide');
                            $(".loader-ajax").hide();

                        } else {
                            toastr.error('Status Failed', 'Coupon', {timeOut: 3000});
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
	
    /* -------REMOVE TRAVEL---------*/
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
                    url: '{{route('removeCoupon')}}',
                    type: 'post',
                    data: {coupon : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            // refresh the table
                            manageTable.ajax.reload(null, false);
                            // close the modal
                            toastr.success('Deleted Successfully.', 'Coupon', {timeOut: 3000});
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();

                        } else {
                            toastr.error('Not Deleted.', 'Coupon', {timeOut: 3000});
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
                url: '{{route('editCoupon')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
                    $("#edit_name").val(response.coupon.name);
                    $("#edit_from_date").val(response.coupon.from_date);
                    $("#edit_to_date").val(response.coupon.to_date);
                    $("#edit_value").val(response.coupon.value);
                    $("#edit_minimum_value").val(response.coupon.minimum_value);
                    $("#edit_after_completing_ride_no").val(response.coupon.after_completing_ride_no);
                    $("#edit_no_of_times_no").val(response.coupon.no_of_times_no);
                    $("#edit_ride_from_date").val(response.coupon.ride_from_date);
                    $("#edit_ride_to_date").val(response.coupon.ride_to_date);

                    $("#edit_city_id").empty();
                    $("#edit_city_id").append(response.cities);
                    $('#edit_city_id').material_select();

                    $("#edit_car_type").empty();
                    $("#edit_car_type").append(response.car_type);
                    $('#edit_car_type').material_select();

                    $("#edit_type").empty();
                    $("#edit_type").append(response.type);
                    $('#edit_type').material_select();

                    $("#edit_variation").empty();
                    $("#edit_variation").append(response.variation);
                    $('#edit_variation').material_select();

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

	function CouponDetails(id = null) {
        if(id) {

// fetch the member data
            $.ajax({
                url: '{{route('showCoupon')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {

                    $("#show_city").empty();
                    $("#show_city").append(response.coupon.city_name);

                    $("#show_name").empty();
                    $("#show_name").append(response.coupon.name);

                    $("#show_from_date").empty();
                    $("#show_from_date").append(response.coupon.from_date);

                    $("#show_to_date").empty();
                    $("#show_to_date").append(response.coupon.to_date);

                    $("#show_car_type").empty();
                    $("#show_car_type").append(response.coupon.car_type);

                    $("#show_variation").empty();
                    $("#show_variation").append(response.coupon.variation);

                    $("#show_type").empty();
                    $("#show_type").append(response.coupon.type);

                    $("#show_after_completing_ride_no").empty();
                    $("#show_after_completing_ride_no").append(response.coupon.after_completing_ride_no);

                    $("#show_no_of_times_no").empty();
                    $("#show_no_of_times_no").append(response.coupon.no_of_times_no);

                    $("#show_value").empty();
                    $("#show_value").append(response.coupon.value);

                    $("#show_minimum_value").empty();
                    $("#show_minimum_value").append(response.coupon.minimum_value);

                    $("#show_description").empty();
                    $("#show_description").append(response.coupon.description);

                    $("#show_ride_from_date").empty();
                    $("#show_ride_from_date").append(response.coupon.ride_from_date);

                    $("#show_ride_to_date").empty();
                    $("#show_ride_to_date").append(response.coupon.ride_to_date);

                } // /success
            }); // /fetch selected member info

        } else {
            alert("Error : Refresh the page again");
        }
    }

</script>
