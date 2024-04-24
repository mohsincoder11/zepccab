<!DOCTYPE html>
<html lang="en">
<head>
   @yield('meta')
    <title>@yield('title')</title>
   @yield('head')
</head>

<body class="@yield('theme')" >

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
    @yield('content')

    @yield('show')

    @yield('create')

    @yield('edit')

    @yield('delete')
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
