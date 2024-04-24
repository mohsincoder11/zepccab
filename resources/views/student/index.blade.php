@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    STUDENT PAGE
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
    @include('layouts.member-sidebar')
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
                                <th class="th-sm">Student Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Section
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Class
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Registration No.
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">DOB
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Mobile No.
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Status
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Photo
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

<div class="modal-container">
    <div id="imageModal"  class="modal modal-fixed-footer">

        <div class="modal-content" style="border:0">
            <div class="modal-header">
                <h4 class="modal-title">Photo</h4>
                <button type="button" class="close" data-dismiss="modal" style="color: black;">&times;</button>
            </div>
            <div class="modal-body">
                <img class="img-responsive img-fluid" src="" />
                <div class="container description-content">
                    <div class="row">
                        <div data-pg-collapsed class="col-md-12">
                            <h6 class="description"></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



@include('delete')

@section('search')
    @include('student.search')
@endsection

@section('edit')
    @include('student.edit')
@endsection

@section('create')
    @include('student.create')
@endsection

@section('show')
    @include('student.show')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    <script>
        $(document).ready(function () {
            $('#imageModal').on('show.bs.modal', function (e) {
                $(".description").empty();
                var image = $(e.relatedTarget).attr('src');
                var description = $(e.relatedTarget).attr('alt');
                $(".description").append('<span>'+description+'</span>');
                $(".img-responsive").attr("src", image);
            });
        });

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
    @include('student.ajax')
@endsection


