@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    ORDERS PAGE
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
    <div class="container-fluid" >
        @include('delete')

        <section class="mb-5">
            <!--Card-->
            <div class="card card-cascade narrower">

                <div class="card-body card-body-cascade">

                    <div class="table-responsive">
                        <table id="list" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th class="th-sm">Customer Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Restaurant
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Amount
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Status
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
                    <!--Bottom Table UI-->
                </div>
                <!--/.Card content-->
            </div>
        </section>
        <!--Section: Table-->

    </div>
@endsection


<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Orders Details List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card-body card-body-cascade">
                <div class="table-responsive text-nowrap">
                    <table id="list_details" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="th-sm">Item / Menu
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                            </th>
                            <th class="th-sm">Price
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                            </th>
                            <th class="th-sm">Qunatity
                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>


@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('orders.ajax')
@endsection

