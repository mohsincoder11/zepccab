@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    NOTIFICATION PAGE
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
                            <th class="th-sm">Title
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Messeage
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Send by
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                 <th class="th-sm">Image
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Date
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
            <a title="Add Notification" href="" class="btn-floating gray fixed-bottom-right" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus mt-0"></i></a>
        </section>
        <!--Section: Table-->

    </div>


    <div class="modal-container">
    <div id="imageModal"  class="modal modal-fixed-footer">

        <div class="modal-content" style="border:0">
            <div class="modal-header">
                <h4 class="modal-title">Photo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
@endsection

@section('create')
    @include('notification.create')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')

    @include('layouts.script')
    @include('notification.ajax')
    
    <script>
        $(document).ready(function () {
            $('#imageModal').on('show.bs.modal', function (e) {
                $(".description").empty();
                var image = $(e.relatedTarget).attr('src');
                var description = $(e.relatedTarget).attr('alt');
                $(".img-responsive").attr("src", image);
            });
        });
        </script>
@endsection

