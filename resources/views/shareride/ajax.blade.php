<script>

    $(document).ready(function() {
        dataTableInit();

    });

    function dataTableInit() {

        manageTable =   $("#list").DataTable({
            "ajax": "{{route('allShare')}}",
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
            $("#AddShare").unbind('submit').bind('submit', function() {

                $(".text-danger").remove();

                var form = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



                var postData = new FormData($("#AddShare")[0]);
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

                            toastr.success('Added Successfully.', 'Share Ride', {timeOut: 5000});
                            $("#AddShare")[0].reset();
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

    /* -------REMOVE SHARE RIDE---------*/
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
                    url: '{{route('removeShare')}}',
                    type: 'post',
                    data: {share : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            // refresh the table
                            manageTable.ajax.reload(null, false);
                            // close the modal
                            toastr.success('Deleted Successfully.', 'Share Ride', {timeOut: 3000});
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();

                        } else {
                            toastr.error('Not Deleted.', 'Share Ride', {timeOut: 3000});
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
                url: '{{route('editShare')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
                    $("#edit_from_origin").val(response.share.from_origin);
                    $("#edit_to_destination").val(response.share.to_destination);
                    $("#edit_vacancy").val(response.share.vacancy);
                    $("#edit_charges_per_person").val(response.share.charges_per_person);

                    $("#edit_car_type").empty();
                    $("#edit_car_type").append(response.cars_type);
                    $('#edit_car_type').material_select();

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

     function ShareRideDetails(id = null){
        if(id) {
            $(".loader-ajax").fadeOut("slow").show();

            $.ajax({
                url: '{{route('showShareRide')}}',
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
	
	
	  function removeItemStatus(id = null) {
        if(id) {
            // click on remove button
            $("#removeBtnStatusShare").unbind('click').bind('click', function() {
                $(".loader-ajax").fadeOut("slow").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{route('removeShareStatus')}}',
                    type: 'post',
                    data: {share_status : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            // refresh the table
                            manageTable.ajax.reload(null, false);
                            // close the modal
                            toastr.success('Status Change Successfully.', 'Share Ride', {timeOut: 3000});
                            $("#modalConfirmDeleteStatus").modal('hide');
                            $(".loader-ajax").hide();

                        } else {
                            toastr.error('Not Status.', 'Share Ride', {timeOut: 3000});
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

</script>
