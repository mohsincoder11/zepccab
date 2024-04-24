<div id="slide-out" class="side-nav fixed sn-bg-4">
    <ul class="custom-scrollbar list-unstyled" style="overflow-y: scroll;">
        <li>
            @php
            $id = Auth::id();

            $route_name = Request::route()->getName();
            $route_path = Request::path();


            @endphp
            @if(Auth::guard('admin')->user()->role=='1')
            <ul class="collapsible collapsible-accordion">

                <li>
                    <a href="{{url('admin/home')}}" class="waves-effect {{ ($route_path =='admin/home' ? 'active' : '') }}"><i class="fa fa-home"></i> Home</a>
                </li>

                <li> <a href="{{url('admin/analytic')}}" class="waves-effect {{ ($route_path =='admin/analytic' ? 'active' : '') }}"><i class="fa fa-dashboard"></i> Analytic</a></li>

               <!--    <li>
                    <a class="collapsible-header waves-effect mt-1 @if(Request::url() === route('restaurant')) font-weight-bold active @endif  @if(Request::url() === route('menus')) font-weight-bold active @endif  @if(Request::url() === route('category')) font-weight-bold active @endif @if(Request::url() === route('orders')) font-weight-bold active @endif">
                        <i class="fa fa-cutlery"></i>
                        Restaurants
                        <i style="margin-top: 7px;" class="fa fa-angle-down rotate-icon"></i>
                    </a>

                 <div class="collapsible-body" style="display: none;">
                        <ul class="sub-menu">
                            <li>
                                <a href="{{url('admin/restaurant')}}" class="waves-effect mt-1 {{ ($route_path =='admin/restaurant' ? 'active' : '') }}"><i class="fa fa-cutlery"></i>
                                    Restaurant
                                </a>
                            </li>

                            <li>
                                <a href="{{url('admin/category')}}" class="waves-effect mt-1 {{ ($route_path =='admin/category' ? 'active' : '') }}"><i class="fa fa-list-alt"></i>
                                    Category
                                </a>
                            </li>

                            <li>
                                <a href="{{url('admin/menus')}}" class="waves-effect mt-1 {{ ($route_path =='admin/menus' ? 'active' : '') }}"><i class="fa fa-bars"></i>
                                    Menus
                                </a>
                            </li>

                            <li>
                                <a href="{{url('admin/orders')}}" class="waves-effect mt-1 {{ ($route_path =='admin/orders' ? 'active' : '') }}"><i class="fa fa-first-order"></i>
                                    Orders
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>-->



                <li>
                    <a href="{{route('video_section')}}" class="waves-effect {{ ($route_path =='admin/video_section' ? 'active' : '') }}"><i class="fa fa-video-camera"></i> Video Section</a>
                </li>



                <li>
                    <a href="{{route('city')}}" class="waves-effect {{ ($route_path =='admin/city' ? 'active' : '') }}"><i class="fa fa-map-marker"></i> City</a>
                </li>

                <li>
                    <a href="{{route('cartype')}}" class="waves-effect {{ ($route_path =='admin/cartype' ? 'active' : '') }}"><i class="fa fa-taxi"></i> Car Type</a>
                </li>

                <li>
                    <a href="{{route('car')}}" class="waves-effect {{ ($route_path =='admin/car' ? 'active' : '') }}"><i class="fa fa-car"></i> Car</a>
                </li>

                <li>
                    <a href="{{route('driver')}}" class="waves-effect {{ ($route_path =='admin/driver' ? 'active' : '') }}"><i class="fa fa-user"></i> Driver</a>
                </li>
                <li>
                    <a href="{{route('package-master')}}" class="waves-effect {{ ($route_path =='admin/package-master' ? 'active' : '') }}"><i class="fa fa-user"></i> Package Master</a>
                </li>
                <li>
                    <a href="{{route('vendor')}}" class="waves-effect {{ ($route_path =='admin/vendor' ? 'active' : '') }}"><i class="fa fa-user"></i> Vendor</a>
                </li>
                <li>
                    <a href="{{route('company')}}" class="waves-effect {{ ($route_path =='admin/company' ? 'active' : '') }}"><i class="fa fa-user"></i> Company</a>
                </li>

                <li>
                    <a href="{{route('customer')}}" class="waves-effect {{ ($route_path =='admin/customer' ? 'active' : '') }}"><i class="fa fa-users"></i> Local Ride</a>
                </li>

                <li>
                    <a href="{{route('enquiryrental')}}" class="waves-effect {{ ($route_path =='admin/enquiryrental' ? 'active' : '') }}"><i class="fa fa-circle-o"></i>Rental Ride</a>
                </li>

                <li>
                    <a href="{{route('outstation')}}" class="waves-effect {{ ($route_path =='admin/outstation' ? 'active' : '') }}"><i class="fa fa-area-chart"></i> Outstation Ride</a>
                </li>
                <li>
                    <a href="{{route('all-rides')}}" class="waves-effect {{ ($route_path =='admin/all-rides' ? 'active' : '') }}"><i class="fa fa-globe"></i> All Rides</a>
                </li>
                <li>
                    <a href="{{route('enquiry-section')}}" class="waves-effect {{ ($route_path =='admin/enquiry-section' ? 'active' : '') }}"><i class="fa fa-question"></i> Enquiry Section</a>
                </li>

                <li>
                    <a href="{{route('shareride')}}" class="waves-effect {{ ($route_path =='admin/shareride' ? 'active' : '') }}"><i class="fa fa-share"></i> Share Ride</a>
                </li>

                <li>
                    <a href="{{route('corporate')}}" class="waves-effect {{ ($route_path =='admin/corporate' ? 'active' : '') }}"><i class="fa fa-bookmark"></i> Corporate Booking</a>
                </li>


                <li>
                    <a href="{{route('package')}}" class="waves-effect {{ ($route_path =='admin/package' ? 'active' : '') }}"><i class="fa fa-gift"></i> Rental Package</a>
                </li>

                <li>
                    <a href="{{route('notification')}}" class="waves-effect {{ ($route_path =='admin/notification' ? 'active' : '') }}"><i class="fa fa-bell"></i> Send Notification</a>
                </li>

                <li>
                    <a href="{{route('coupon')}}" class="waves-effect {{ ($route_path =='admin/coupon' ? 'active' : '') }}"><i class="fa fa-ticket"></i> Coupon</a>
                </li>


                <li>
                    <a href="{{route('register_customer')}}" class="waves-effect {{ ($route_path =='admin/register_customer' ? 'active' : '') }}"><i class="fa fa-user-circle"></i> Regsiter Customer</a>
                </li>
                
                <li>
                    <a href="{{route('website-enquiry')}}" class="waves-effect {{ ($route_path =='admin/website-enquiry' ? 'active' : '') }}"><i class="fa fa-question"></i> Website Enquiry</a>
                </li>

                <li>
                    <a href="{{route('website-contact')}}" class="waves-effect {{ ($route_path =='admin/website-contact' ? 'active' : '') }}"><i class="fa fa-phone"></i> Website Contact</a>
                </li>


                <li>
                    <a href="{{route('feedback')}}" class="waves-effect {{ ($route_path =='admin/feedback' ? 'active' : '') }}"><i class="fa fa-comments-o"></i> Feedback</a>
                </li>



                <li>
                    <a href="{{route('sos')}}" class="waves-effect {{ ($route_path =='admin/sos' ? 'active' : '') }}"><i class="fa fa-shield"></i> SOS</a>
                </li>

                <li>
                    <a href="{{route('blog')}}" class="waves-effect {{ ($route_path =='admin/blog' ? 'active' : '') }}"><i class="fa fa-rss"></i> Blogs</a>
                </li>


            </ul>
            @elseif(Auth::guard('admin')->user()->role=='2')
           <ul class="collapsible collapsible-accordion">

            <li>
                <a href="{{route('all-rides')}}" class="waves-effect {{ ($route_path =='admin/all-rides' ? 'active' : '') }}"><i class="fa fa-globe"></i> All Rides</a>
            </li>
                <li>
                    <a href="{{route('customer')}}" class="waves-effect {{ ($route_path =='admin/customer' ? 'active' : '') }}"><i class="fa fa-users"></i> Local Ride</a>
                </li>

                <li>
                    <a href="{{route('enquiryrental')}}" class="waves-effect {{ ($route_path =='admin/enquiryrental' ? 'active' : '') }}"><i class="fa fa-circle-o"></i>Rental Ride</a>
                </li>

                <li>
                    <a href="{{route('outstation')}}" class="waves-effect {{ ($route_path =='admin/outstation' ? 'active' : '') }}"><i class="fa fa-area-chart"></i> Outstation Ride</a>
                </li>

            </ul>
            @endif
           
        </li>
        <!--/. Side navigation links -->
    </ul>

</div>