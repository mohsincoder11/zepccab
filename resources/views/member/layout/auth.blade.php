<!DOCTYPE html>
<html lang="en">
<head>
@yield('meta')
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
@yield('head')
<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script type="text/javascript">
        window.history.forward();
        function noBack()
        {
            window.history.forward();
        }
    </script>
</head>
<body class="@yield('theme')" onLoad="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
<!--Main Navigation-->
<header>

@yield('header')
<!--/.Navbar-->

    <!-- Sidebar navigation -->
@yield('sidebar')
<!--/. Sidebar navigation -->

</header>


<!--Main layout-->
<main>
    @yield('content')
</main>
<!--Main layout-->

<!--Footer-->
@yield('footer')
<!--/.Footer-->

<!-- SCRIPTS -->
<!-- JQuery -->
@yield('script')
</body>
</html>
