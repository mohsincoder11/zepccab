<script>

    var manageTable;

    $(document).ready(function() {
        dataTableInit();
    });

    /* -------All Records Show In PACKAGES Table---------*/

    function dataTableInit() {

        manageTable =   $("#list").DataTable({
            "ajax": "{{route('allPackage')}}",
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


    /* -------INSERT PACKAGES---------*/
    $("#submitBtn").on('click', function() {

        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        $(".messages").html("");
        $("#PackageForm").unbind('submit').bind('submit', function() {

            $(".text-danger").remove();

            var form = $(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var postData = new FormData($("#PackageForm")[0]);
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
                        toastr.success('Added Successfully.', 'Package', {timeOut: 5000});
                        $("#PackageForm")[0].reset();
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


    /* -------SEARCH PACKAGES---------*/
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
    /* -------END SEARCH PACKAGES---------*/

    /* -------REMOVE PACKAGES---------*/
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
                    url: '{{route('removePackage')}}',
                    type: 'post',
                    data: {package : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Delete Successfully.', 'Package', {timeOut: 3000});
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Delete Package.', 'Failed', {timeOut: 3000});
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
    /* -------END REMOVE PACKAGES---------*/

    /* -------Show EDIT ITEM Data---------*/
    function editItemPackage(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('editPackage')}}',
                type: 'post',
                data: {package_cartype_linking_id: id},
                dataType: 'json',
                success:function(response) {
                    $("#edit_name").val(response.package.name);
                    $("#edit_km").val(response.package.km);
                    $("#edit_hour").val(response.package.hour);
                    $("#edit_amount").val(response.package.amount);
					$("#edit_cartype_id_hidden").val(response.package.cartype_id);
				
				

                    $("#edit_cartype_id").empty();
                    $("#edit_cartype_id").append(response.cars_type);
                    $('#edit_cartype_id').material_select();

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

                                    $('#editModalPackage').modal('hide');
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
                
                $("#car_type_fetch1").empty();
                $("#car_type_fetch1").append('<option value="">Select Car Type </option>');
                $("#car_type_fetch1").append(response);
                $('#car_type_fetch1').material_select();
  
            }
        });
    }


       function CarDetailsInsert(id = null) {
        if(id) {

            $("#edit_id").remove();

// fetch the member data
            $.ajax({
                url: '{{route('addPackage1')}}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {

// mmeber id
                    $("#editFormCarType").append('<input type="hidden" name="id" id="edit_id" value="'+id+'"/>');

// here update the location data
                    $("#editFormCarType").unbind('submit').bind('submit', function() {
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

                                    $('#modalShow').modal('hide');
                                    toastr.success(response.messages, '', {timeOut: 3000});
                                    $("#editFormCarType")[0].reset();
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
