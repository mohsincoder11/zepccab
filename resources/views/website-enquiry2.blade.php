@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    Website Enquiry 
@endsection

@section('head')
    @include('layouts.head')
@endsection

@section('theme')
    @include('layouts.theme')
@endsection

@section('header')
    @include('layouts.header')
 
@endsection

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        @include('delete')
        <section class="mb-5">
            <!--Card-->
            <div class="card card-cascade narrower">
                <div class="card-body card-body-cascade">
                    <a class="btn-floating btn-sm btn-filter"  data-toggle="modal" data-target="#searchModal" title="Filter Student">
                        <i class="fa fa-filter mt-0" aria-hidden="true"></i>
                    </a>
                    <div class="table-responsive text-nowrap">

                        <table id="list" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                              
                                <th class="th-sm">Pick Up Location
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th> 
                                 <th class="th-sm">Drop Location
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Mobile
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Ride Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm" style="width:20%">Enquiry Date Time
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                             
                                <th class="th-sm">Action
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>

                    </div>

                </div>
                <!--/.Card content-->

            </div>

        </section>
        <!--Section: Table-->

    </div>

    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
    
            <div class="modal-content">
                <div class="modal-body mx-3">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> <p class="heading">Are you sure?</p></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    
                    <div class="modal-footer flex-center" style="height: 21%;">
                        <button type="button" id="removeBtn" class="btn  btn-grey btn-rounded">Yes</button>
                        <button type="button" class="btn btn-grey btn-rounded " data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    <script>

    var manageTable;
//     $('#modalVM').on('shown.bs.modal', function (e) {
//         getll_driver();
// })
    $(document).ready(function() {
         dataTableInit();
    });


    /* -------All Records Show In CAR Table---------*/

function dataTableInit() {

    manageTable =   $("#list").DataTable({
        "ajax": "{{route('allwebsiteenquiry2')}}",
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
                    url: '{{route('removewebsiteenquiry2')}}',
                    type: 'get',
                    data: {id : id},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            manageTable.ajax.reload(null, false);

                            toastr.success('Delete Successfully.', 'Enquiry', {timeOut: 3000});
                            $("#modalConfirmDelete").modal('hide');
                            $(".loader-ajax").hide();
                        } else {
                            toastr.error('To Delete enquiry.', 'Failed', {timeOut: 3000});
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

    $(document).on('click','.read-more-link',function(e) {
                e.preventDefault();
                var $container = $(this).closest('.text-container');
                $container.find('.short-text').hide();
                $container.find('.full-text').toggle();
                $container.find('.show-less').show();
            });

            $(document).on('click','.show-less-link',function(e) {
                e.preventDefault();
                var $container = $(this).closest('.text-container');
                $container.find('.full-text').hide();
                $container.find('.short-text').show();
                $container.find('.show-less').hide();
            });


</script>
@endsection
