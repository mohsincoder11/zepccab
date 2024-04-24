@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    SHARE RIDE PAGE
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
								<th class="th-sm">Ref No
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								<th class="th-sm">Customer Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								  <th class="th-sm">Customer Mobile No
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">From
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">To
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th> 
                                <th class="th-sm">Amount
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Travel Date
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Pickup Date
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Car Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>

                                <th class="th-sm">Vacancy
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								
								<th class="th-sm">Status
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
								
								<th class="th-sm">Ride Status
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
            <a title="Add Share Ride" href="" class="btn-floating gray fixed-bottom-right" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus mt-0"></i></a>
        </section>
        <!--Section: Table-->

    </div>
@endsection
@section('edit')
    @include('shareride.edit')
@endsection


@section('show')
    @include('shareride.show')
@endsection

@section('create')
    @include('shareride.create')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('shareride.ajax')
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div class="form-row ">\n' +
                '                        <div class="col">\n' +
                '                            <div class="md-form mt-3">\n' +
                '                                <input type="text" id="city_name" name="city_name[]" class="form-control" autocomplete="off">\n' +
                '                                <label for="city_name">City Name</label>\n' +
                '                            </div></div>\n' +
                '\n' +
                '                        <div class="col">\n' +
                '                            <div class="md-form mt-3">\n' +
                '                                <input type="text" id="charges_per_person" name="charges_per_person[]" class="form-control" autocomplete="off">\n' +
                '                                <label for="charges_per_person">Charges Per Person</label>\n' +
                '                            </div></div>\n' +
                '                    <a href="javascript:void(0);" class="remove_button"><img src="{{asset('public/images/remove-icon.png')}}"/></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });

            $('.custom-select2').select2({
        dropdownParent: $('#createModal .modal-content')
    });
    
        });
    </script>
@endsection

