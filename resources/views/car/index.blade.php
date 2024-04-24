@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    CAR PAGE
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
                                <th class="th-sm">Car Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Car Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Year of Model
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Fuel Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Number
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Owner Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Driver Name / Mobile No
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

            <a title="Add Student" href="" class="btn-floating gray fixed-bottom-right" data-toggle="modal" data-target="#modalVM"><i class="fa fa-plus mt-0"></i></a>

        </section>

    </div>
@endsection

@section('delete')
    @include('delete')
@endsection

@section('search')
    @include('car.search')
@endsection

@section('edit')
    @include('car.edit')
@endsection

@section('show')
    @include('car.show')
@endsection

@section('create')
    @include('car.create')
@endsection

{{--@section('show')--}}
{{--    @include('car.show')--}}
{{--@endsection--}}

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

<script>
   
</script>
    @include('car.ajax')
@endsection


