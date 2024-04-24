@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    CORPORATE BOOKING PAGE
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

        <section class="mb-5">

            <!--Card-->
            <div class="card card-cascade narrower">
                <div class="card-body card-body-cascade">
{{--                    <a class="btn-floating btn-sm btn-filter"  data-toggle="modal" data-target="#searchModal" title="Filter Student">--}}
{{--                        <i class="fa fa-filter mt-0" aria-hidden="true"></i>--}}
{{--                    </a>--}}
                    <div class="table-responsive text-nowrap">

                        <table id="list" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="th-sm">Customer Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Origin
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Destination
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Car Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Trip Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">From Date / To Date
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Comapny Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Status
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Driver Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Per Day Description
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Per Km Description
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
            <!--/.Card-->

        </section>

    </div>
@endsection

@section('delete')
    @include('delete')
@endsection

@section('create')
    @include('corporate.create')
@endsection

@section('edit')
    @include('corporate.edit')
@endsection

@section('show')
    @include('corporate.show')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    <script>
        function disableTab(element,condition) {
            if(condition){
                $(element).addClass('disabled')
            }
            else{
                $(element).removeClass('disabled');
                $(element).find('.nav-link').click();
            }
        }
    </script>
    @include('corporate.ajax')
@endsection


