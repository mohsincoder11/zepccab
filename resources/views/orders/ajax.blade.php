<script>

    $(document).ready(function() {
        dataTableInit();

    });

    function dataTableInit() {

        manageTable =   $("#list").DataTable({
            "ajax": "{{route('allOrder')}}",
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

    function OrdersDetails(id = null){
        if(id) {
            $(".loader-ajax").fadeOut("slow").show();

            $.ajax({
                url: '{{route('orderDetails')}}',
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

</script>
