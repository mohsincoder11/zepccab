<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CAB PROVIDERS | LOGIN</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('public/css/mdb.min.css')}}" rel="stylesheet">
    <style type="text/css">
        html,
        body,
        header,
        .intro-2 {
            height: 100%;
        }

        @media (min-width: 560px) and (max-width: 740px) {
            html,
            body,
            header,
            .intro-2 {
                height: 500px;
            }
        }
        @media (min-width: 800px) and (max-width: 850px) {
            html,
            body,
            header,
            .intro-2 {
                height: 500px;
            }
        }

        @media (min-width: 800px) and (max-width: 850px) {
            .navbar:not(.top-nav-collapse) {
                background: #3e4551!important;
            }
            .navbar {
                box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12) !important;
            }
        }
    </style>
</head>

<body class="medical-lp">

<!--Navigation & Intro-->
<header>

    <section class="view intro-2" style="background-image: url('{{asset('public/images/62.jpg')}}'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <div class="mask">
            <div class="container h-100 d-flex justify-content-center align-items-center">
                <div class="row flex-center pt-5 mt-3">
                    <div class="col-md-12 col-lg-6 text-center text-md-left margins">
                        <div class="dark-grey-text">
                            <a href="{{url('admin/login')}}" class="btn btn-red mt-5" data-wow-delay="0.3s">Admin Login</a>&nbsp;
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                        <img src="{{asset('public/images/admin-new.png')}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

</header>
<!--/Navigation & Intro-->

<!--Footer-->
<footer class="page-footer text-center text-md-left stylish-color-dark pt-0">

    <!-- Copyright-->
    <div class="footer-copyright py-3 text-center wow fadeIn" data-wow-delay="0.3s">
        <div class="container-fluid">
            © 2019 Copyright: <a href="https://orangebytetech.com/" target="_blank"> Orange Byte Technologies </a>
        </div>
    </div>
    <!--/.Copyright -->
</footer>
<!--/.Footer-->


<!-- SCRIPTS -->

<!-- JQuery -->
<script type="text/javascript" src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>

<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('public/js/popper.min.js')}}"></script>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{asset('public/js/mdb.min.js')}}"></script>

<script>
    //Animation init
    new WOW().init();

    //Modal
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    })

    // Material Select Initialization
    $(document).ready(function () {
        $('.mdb-select').material_select();
    });

    $(document).ready(function()
    {
        $(document).bind("contextmenu",function(e){
            return false;
        });
    })
</script>
<!--Google Maps-->

</body>

</html>
