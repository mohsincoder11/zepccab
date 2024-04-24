@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    Default OTP
@endsection

@section('head')
    @include('layouts.head')
@endsection

@section('theme')
    @include('layouts.theme')
@endsection

@section('header')
    @include('layouts.header')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        <section class="mb-5">
            <!--Card-->
            <div class="card card-cascade narrower">

                <div class="card-body card-body-cascade">
                    <!--Table and divs that hold the pie charts-->

                    <form action="{{ route('update-default-otp') }}" method="post" id="OTPForm">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="md-form mt-10">
                                    <label for="date-picker-example" >OTP</label>
                                    <input placeholder="Enter OTP" type="text" name="otp" class="form-control"
                                        value="{{ $otp }}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="md-form mt-3">
                                    <button class="btn btn-info " type="submit" name="submitBtn" id="submitBtn">Update</button>

                                </div>
                            </div>
                        </div>




                    </form>



                </div>
                <!--/.Card content-->
            </div>

        </section>
        <!--Section: Table-->

    </div>
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('video.ajax')
    <script>
        $("#submitBtn").on('click', function() {

            $(".form-group").removeClass('has-error').removeClass('has-success');
            $(".text-danger").remove();
            $(".messages").html("");
            $("#OTPForm").unbind('submit').bind('submit', function() {

                $(".text-danger").remove();

                var form = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var postData = new FormData($("#OTPForm")[0]);
                console.log(postData);
                $.ajax({
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: form.attr('action'),
                    type: form.attr('method'),
                    dataType: 'json',
                    data: postData,
                    // data : form.serialize(),
                    success: function(response) {

                        $(".form-group").removeClass('has-error').removeClass('has-success');
                        if (response.success == true) {
                            toastr.success('Updated Successfully.', 'OTP', {
                                timeOut: 5000
                            });
                            setTimeout(() => {
                            location.reload(true);
                                
                            }, 2000);
                        } else {
                            toastr.error(response.messages, '', {
                                timeOut: 5000
                            });
                        } // /else
                    } // success
                }); // ajax subit

                return false;
            }); // /submit form for create member
        });
    </script>
@endsection
