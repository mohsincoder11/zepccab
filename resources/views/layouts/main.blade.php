<!DOCTYPE html>
<html lang="en">
    <link rel="icon" href="{{asset('public/images/new_logo.png')}}">

<head>
   @yield('meta')
    <title>@yield('title')</title>
   @yield('head')
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

   <style>
    .select2-selection__arrow{
    display: none !important;
}
.select2-container--classic .select2-selection--single {
     background-color: #f7f7f7 !important;
     border:0 !important;
    border-bottom: 1px solid #ced4da !important;
     border-radius: 0px !important; 
    outline: 0 !important;
    background-image: -webkit-linear-gradient(top, #ffffff 50%, #ffffff 100%) !important;
    padding: 0 !important;
    margin-top:15px !important;
    color:#757575;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left:0px !important;
    color:#757575 !important;

}
.select2-container--classic .select2-results__option--highlighted.select2-results__option--selectable {
    background-color: #fb2f08 !important;
    color: #fff !important;
}
   </style>

    <style>
        .loader-ajax {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url({{asset('public/images/new_logo.png')}}) 50% 50% no-repeat rgb(249,249,249);
            opacity: .8;
        }
    </style>
</head>

<body class="@yield('theme')">

<!--Main Navigation-->
<header>

    @yield('header')

    
    <!--/.Navbar-->

    <!-- Sidebar navigation -->
   @yield('sidebar')
    <!--/. Sidebar navigation -->

</header>
<!--Main Navigation-->

<!--Main layout-->
<main>
    <div class="loader-ajax"></div>
    @yield('content')

    @yield('search')

    @yield('show')

    @yield('create')

    @yield('image')

    @yield('edit')

    @yield('delete')
</main>
<!--Main layout-->

<!--Footer-->
@yield('footer')
<!--Footer-->

<!-- SCRIPTS -->
<!-- JQuery -->
@yield('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(window).on('load', function(){
        $(".loader-ajax").fadeOut("slow");
   
    });
</script>

</body>

</html>
