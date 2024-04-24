<script>

    $(document).ready(function() {
        dataTableInit();

    });


    function dataTableInit() {

        manageTable =   $("#list").DataTable({
            "ajax": "{{route('allFeedback')}}",
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
                    url: '{{route('removeFeedback')}}',
                    type: 'post',
                    data: {feedback : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            // refresh the table
                            manageTable.ajax.reload(null, false);
                            // close the modal
                            toastr.success('Deleted Successfully.', 'Feedback', {timeOut: 3000});
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();

                        } else {
                            toastr.error('Not Deleted.', 'Feedback', {timeOut: 3000});
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
