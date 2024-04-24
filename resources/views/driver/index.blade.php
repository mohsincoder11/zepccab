@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    DRIVER PAGE
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
                    <a class="btn-floating btn-sm btn-filter"  data-toggle="modal" data-target="#searchModal" title="Filter Student">
                        <i class="fa fa-filter mt-0" aria-hidden="true"></i>
                    </a>
                    <div class="table-responsive text-nowrap">

                        <table id="list" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="th-sm">City
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Driver Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Mobile
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Car Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Vendor
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

                </div>
                <!--/.Card content-->

            </div>
            <!--/.Card-->

            <a title="Add Driver" href="" class="btn-floating gray fixed-bottom-right" data-toggle="modal" data-target="#modalVM"><i class="fa fa-plus mt-0"></i></a>

        </section>

    </div>
@endsection

@section('delete')
    @include('delete')
@endsection

@section('search')
    @include('driver.search')
@endsection

@section('edit')
    @include('driver.edit')
@endsection

@section('create')
    @include('driver.create')
@endsection

@section('show')
    @include('driver.show')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    <script>
        
        // $('#city_id1').select2({
        //     placeholder: "Search for a city...",
        //     theme: "classic", // You can change the theme as needed
        //     dropdownParent: $('#modalVM .modal-content')

        // });
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
    @include('driver.ajax')
@endsection


