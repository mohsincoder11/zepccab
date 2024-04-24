<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Customer;
use App\CustomerTravelLinking;
use App\DriverCustomerLinking;
use App\DriverPackageLinking;
use App\CustomerPackageLinking;
use App\Mail\NewUserMail;
use App\Feedback;
use App\Rental;
use App\RideCustomerLinking;
use App\ShareRide;
use App\ShareRideCityLinking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AppApiController extends Controller
{
    public function AppApiLogin(Request $request)
    {
        $output = array('data' => array());
        $mobile_no = $request['mobile_no'];
        $appshowLogin = DB::table('customer')
            ->select('customer.*')
            ->where('mobile_no',$mobile_no)
            ->get();

        if(count($appshowLogin)>0)
        {
            return json_encode(array("status"=>true,"message"=>"Login successfull...") + (array) $appshowLogin[0]);
        }
        else
        {
            return json_encode(array("status"=>false,"message"=>"Login failed..."));
        }

    }

     public function DriverLoginStatus(Request $request)
    {
        $output = array('data' => array());
        $driver_id = $request['driver_id'];
        $login_status = $request['login_status'];

        $data = array(
            'driver_login_status' =>$login_status
        );
        $query = DB::table('driver')
            ->where('id',$driver_id)
            ->update($data);

        return json_encode(array("status"=>true));

    }



     public function AppApiRegister(Request $request)
    {

        $customer = new Customer($request->input());
        $customer->first_name = $request['first_name'];
        $customer->last_name = $request['last_name'];
        $customer->mobile_no = $request['mobile_no'];
        $customer->email_id = $request['email_id'];
        $customer->id_proof_type = $request['id_proof_type'];
        $customer->id_proof = $request['id_proof'];
        $query = $customer->save();

        $show_id = DB::table('customer')
            ->select('customer.*')
            ->where('id',$customer->id)
            ->get();

            if($query === TRUE)
            {
                return json_encode(array("status"=>true,"message"=>"Regsiter successfull...") + (array) $show_id[0]);
            }
            else
            {
                return json_encode(array("status"=>false,"message"=>"Regsiter failed..."));
            }


   }

    public function AppApiLinking(Request $request)
    {

        $customer_id = $request['customer_id'];

        $customerlinking = new CustomerTravelLinking($request->input()) ;
        $customerlinking->customer_id= $customer_id;
        $customerlinking->travel_type = $request['travel_type'];
        $customerlinking->car_type_id = $request['car_type_id'];
        $customerlinking->from_latitude = $request['from_latitude'];
        $customerlinking->from_longitude = $request['from_longitude'];
        $customerlinking->to_latitude = $request['to_latitude'];
        $customerlinking->to_longitude = $request['to_longitude'];
        $customerlinking->from_location = $request['from_location'];
        $customerlinking->to_location = $request['to_location'];
        $customerlinking->ride_later_date = $request['ride_later_date'];
        $customerlinking->ride_later_time = $request['ride_later_time'];
        $customerlinking->save();


        $driver_cust_link = new DriverCustomerLinking($request->input()) ;
        $driver_cust_link->customer_travel_id= $customerlinking->id;
        $driver_cust_link->driver_id = $request['driver_id'];
        $driver_cust_link->status = 'pending';
        $driver_cust_link->distance_driver_user_km = $request['distance_driver_user_km'];
        $driver_cust_link->distance_user_destination_km = $request['distance_user_destination_km'];
        $driver_cust_link->custoemr_amount = $request['custoemr_amount'];
        $driver_cust_link->otp = $request['otp'];
        $query = $driver_cust_link->save();


         $show_driver_cust = DB::table('driver_customer_linking')
            ->select('driver_customer_linking.*')
            ->where('id',$driver_cust_link->id)
            ->get();

            define('API_ACCESS_KEY','AIzaSyAcSwLs7ymb5mhdIUmLHYL08jPxHGIJffU');
            $url = 'https://fcm.googleapis.com/fcm/send';
            // $registrationIds = array($_GET['id']);
            // prepare the message
            $message = array(
                'title'     => 'Title Name',
                'body'      => 'Body Name',
                'vibrate'   => true,
                'sound'      => 'sound.mp3'
            );
            $fields = array(
                // 'registration_ids' => $registrationIds,
                'data'             => $message,
                'notification'=>$message,
                'to'=>"/topics/9898989898",
                'data'=> array(
              'paramType'     => 'driverRideNow',
                    'paramRideID'     =>$driver_cust_link->id
            )
            );
            $headers = array(
                'Authorization: key='.API_ACCESS_KEY,
                'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL,$url);
            curl_setopt( $ch,CURLOPT_POST,true);
            curl_setopt( $ch,CURLOPT_HTTPHEADER,$headers);
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);



            if($query === TRUE)
            {
                return json_encode(array("status"=>true,"message"=>"Customer Link successfull...") + (array) $show_driver_cust[0]);
            }
            else
            {
                return json_encode(array("status"=>false,"message"=>"Customer Link failed..."));
            }
   }


    public function AppApiLinkingAgain(Request $request)
    {
        $driver_cust_link = new DriverCustomerLinking($request->input()) ;
        $driver_cust_link->customer_travel_id= $request['customer_travel_id'];
        $driver_cust_link->driver_id = $request['driver_id'];
        $driver_cust_link->status = 'pending';
        $driver_cust_link->distance_driver_user_km = $request['distance_driver_user_km'];
        $driver_cust_link->distance_user_destination_km = $request['distance_user_destination_km'];
        $driver_cust_link->custoemr_amount = $request['custoemr_amount'];
        $driver_cust_link->otp = $request['otp'];
        $query = $driver_cust_link->save();


         $show_driver_cust = DB::table('driver_customer_linking')
            ->select('driver_customer_linking.*')
            ->where('id',$driver_cust_link->id)
            ->get();


            if($query === TRUE)
            {
                return json_encode(array("status"=>true,"message"=>"Customer Link successfull...") + (array) $show_driver_cust[0]);
            }
            else
            {
                return json_encode(array("status"=>false,"message"=>"Customer Link failed..."));
            }
   }


      public function AppApiCheckStatus(Request $request)
    {

        $customer_travel_id = $request['customer_travel_id'];
        $driver_lk_show = DB::table('driver_customer_linking')
            ->select('driver_customer_linking.*')
            ->where('customer_travel_id',$customer_travel_id)
            ->get();


            if(count($driver_lk_show)>0)
            {
                return json_encode(array("query_status"=>true,"data"=>$driver_lk_show));
            }
            else
            {

                return json_encode(array("query_status"=>false));
            }

    }


     public function AppApiCheckRentalsStatus(Request $request)
    {

        $customer_travel_id = $request['customer_travel_id'];
        $driver_lk_show = DB::table('driver_customer_linking')
            ->select('driver_customer_linking.*')
            ->where('customer_travel_id',$customer_travel_id)
            ->get();


            if(count($driver_lk_show)>0)
            {
                return json_encode(array("query_status"=>true,"data"=>$driver_lk_show));
            }
            else
            {

                return json_encode(array("query_status"=>false));
            }

    }


      public function DriverApiCheckRides(Request $request)
    {

        $driver_id = $request['driver_id'];
        $travel_type = $request['travel_type'];
        $rides_travels = DB::table('driver_customer_linking')
            ->leftjoin('customer_travel_linking', 'customer_travel_linking.id', '=', 'driver_customer_linking.customer_travel_id')
            ->leftjoin('customer', 'customer.id', '=', 'customer_travel_linking.customer_id')
            ->select('driver_customer_linking.*',
            'customer_travel_linking.travel_type as travel_type',
            'customer_travel_linking.car_type_id as car_type_id',
            'customer_travel_linking.ride_later_date as ride_later_date',
            'customer_travel_linking.ride_later_time as ride_later_time',
            'customer_travel_linking.from_latitude as from_latitude',
            'customer_travel_linking.from_longitude as from_longitude',
            'customer_travel_linking.to_latitude as to_latitude',
            'customer_travel_linking.to_longitude as to_longitude',
            'customer_travel_linking.from_location as from_location',
            'customer_travel_linking.to_location as to_location',
            'customer_travel_linking.coupon_id as coupon_id',
            'customer.first_name as customer_first_name',
            'customer.last_name as customer_last_name',
            'customer.mobile_no as customer_mobile_no',
            'customer.email_id as customer_email_id')
            ->where('driver_customer_linking.driver_id',$driver_id)
            ->orderBy('driver_customer_linking.id','DESC')
            ->get();

           return json_encode(array("query_status"=>true,"data"=>$rides_travels));

    }


   public function DriverApiUpdateStatus(Request $request)
    {

        $driver_customer_linking_id = $request['driver_customer_linking_id'];
        $status = $request['status'];
        $cancelled_by = $request['cancelled_by'];


        $data = array(
            'status' =>$status,
            'reason' => $request['reason'],
            'cancelled_by' => $cancelled_by
        );

        $query = DB::table('driver_customer_linking')
            ->leftjoin('customer_travel_linking', 'customer_travel_linking.id', '=', 'driver_customer_linking.customer_travel_id')
            ->where('driver_customer_linking.id',$driver_customer_linking_id)
            ->update($data);



        if($query === 1) {

            $fetch_data = DB::table('driver_customer_linking')
            ->leftjoin('customer_travel_linking', 'customer_travel_linking.id', '=', 'driver_customer_linking.customer_travel_id')
            ->select('customer_travel_linking.*')
            ->where('driver_customer_linking.id',$driver_customer_linking_id)
            ->get();
            return json_encode(array("status"=>true,"data"=>$fetch_data));

        }
        else {

            return json_encode(array("status"=>false));

        }


    }


     public function getDriverDetails(Request $request)
    {
        $driver_id = $request['driver_id'];
        $get_driver = DB::table('driver')
            ->select('driver.*')
            ->where('id',$driver_id)
            ->get();


            if(count($get_driver)>0)
            {
                return json_encode(array("status"=>true,"message"=>"successfull...") + (array) $get_driver[0]);
            }
            else
            {

                return json_encode(array("status"=>false));
            }

    }

    public function AppApiLoginDriver(Request $request)
    {
        $output = array('data' => array());
        $mobile_no = $request['mobile_no'];
        $appshowLoginDriver = DB::table('driver')
            ->select('driver.*')
            ->where('mobile_no',$mobile_no)
            ->get();

    if(count($appshowLoginDriver)>0)
    {
        return json_encode(array("status"=>true,"message"=>"Login successfull...") + (array) $appshowLoginDriver[0]);
    }
    else
    {
        return json_encode(array("status"=>false,"message"=>"Login failed..."));
    }

    }


     public function DriverUpdateLocation(Request $request)
    {

        $driver_id = $request['driver_id'];
        $latitude = $request['latitude'];
        $longitude = $request['longitude'];


        $data = array(
            'current_latitude' => $latitude,
            'current_longitude' => $longitude
        );

        $query = DB::table('driver')
            ->where('id',$driver_id)
            ->update($data);



        if($query === 1) {
            return json_encode(array("status"=>true));

        }
        else {

            return json_encode(array("status"=>false));

        }


    }

      public function AddCustomerOutstation(Request $request)
    {

        $rental = new Rental($request->input());
        $rental->from_origin = $request['from_origin'];
        $rental->to_destination = $request['to_destination'];
        $rental->car_type_id = $request['car_type_id'];
        $rental->days = $request['days'];
        $rental->from_time = $request['from_time'];
        $rental->to_time = $request['to_time'];
        $rental->customer_id = $request['customer_id'];
        $rental->type = $request['type'];
		  $rental->date = $request['date'];
        $query =$rental->save();

            if($query === TRUE)
            {
                return json_encode(array("status"=>true,"message"=>"Outstaion Successfull..."));
            }
            else
            {
                return json_encode(array("status"=>false,"message"=>"Outstaion failed..."));
            }


   }


    public function getPackages(Request $request)
    {
        $city_id = $request['city_id'];
        $show_packages = DB::table('package')
                        ->join('package_cartype_linking', 'package_cartype_linking.package_id', '=', 'package.id')
                        ->join('city', 'city.id', '=', 'package_cartype_linking.city_id')
                        ->select('package.*',
                                'package_cartype_linking.city_id as city_id',
                                'city.name as city_name')
                        ->where('package_cartype_linking.city_id',$city_id)
                        ->distinct('package_cartype_linking.package_id')
                        ->get();

            if(count($show_packages)>0)
            {
                return json_encode(array("data"=>true,"data"=>$show_packages));
            }
            else
            {

                return json_encode(array("data"=>false));
            }

    }

    public function getPackageLinking(Request $request)
    {
       $package_id = $request['package_id'];
       $city_id = $request['city_id'];
       $show_package_linking = DB::table('package_cartype_linking')
                        ->join('car_types', 'car_types.id', '=', 'package_cartype_linking.cartype_id')
                        ->join('city', 'city.id', '=', 'package_cartype_linking.city_id')
                        ->select('package_cartype_linking.*',
                                'car_types.name as car_type_name','car_types.icon as car_type_icon')
                        ->where('package_cartype_linking.city_id',$city_id)
                        ->where('package_cartype_linking.package_id',$package_id)
                        ->get();

            if(count($show_package_linking)>0)
            {
                return json_encode(array("data"=>true,"data"=>$show_package_linking));
            }
            else
            {

                return json_encode(array("data"=>false));
            }

    }

    public function customerPackageLinkingSubmit(Request $request)
    {
        $customer_package_link = new CustomerPackageLinking($request->input()) ;
        $customer_package_link->travel_type= $request['travel_type'];
        $customer_package_link->ride_later_date = $request['ride_later_date'];
        $customer_package_link->ride_later_time = $request['ride_later_time'];
        $customer_package_link->pctl_id = $request['pctl_id'];
        $customer_package_link->customer_id = $request['customer_id'];
        $customer_package_link->coupun_id = $request['coupun_id'];
        $customer_package_link->latitude = $request['latitude'];
        $customer_package_link->longitude = $request['longitude'];
        $customer_package_link->save();

        $driver_package_link = new DriverPackageLinking($request->input()) ;
        $driver_package_link->customer_package_id= $customer_package_link->id;
        $driver_package_link->driver_id = $request['driver_id'];
        $driver_package_link->status = 'pending';
        $driver_package_link->distance_driver_user_km = $request['distance_driver_user_km'];
        $driver_package_link->distance_user_destination_km = $request['distance_user_destination_km'];
        $driver_package_link->custoemr_amount = $request['custoemr_amount'];
        $driver_package_link->otp = $request['otp'];
        $driver_package_link->cancelled_by = $request['cancelled_by'];
        $driver_package_link->reason = $request['reason'];
        $driver_package_link->journey_time = $request['journey_time'];
        $query = $driver_package_link->save();

        if($query === TRUE)
        {
            return json_encode(array("status"=>true,"driver_package_link_id"=>$driver_package_link->id, "customer_package_link_id"=>$customer_package_link->id));
        }
        else
        {
            return json_encode(array("status"=>false,"message"=>"Package Submit Rental failed..."));
        }

    }

    public function getRentalApp(Request $request)
    {
       $driver_id = $request['driver_id'];
       $show_package_driver = DB::table('driver_package_linking')
                        ->select('driver_package_linking.*')
                        ->where('driver_id',$driver_id)
                        ->get();

            if(count($show_package_driver)>0)
            {
                return json_encode(array("data"=>true,"data"=>$show_package_driver));
            }
            else
            {

                return json_encode(array("data"=>false));
            }

    }

    public function getOutstaionApp(Request $request)
    {
        // isme thoda Confussion hai Meko
       $driver_id = $request['driver_id'];
       $outstation = DB::table('outstation')
                        ->select('outstation.*')
                        ->get();

        if(count($outstation)>0)
        {
            return json_encode(array("data"=>true,"data"=>$outstation));
        }
        else
        {

            return json_encode(array("data"=>false));
        }

    }


     public function AddShareApp(Request $request)
    {
        $share = new ShareRide($request->input());
        $share->customer_id = $request['customer_id'];
        $share->from_origin = $request['from_origin'];
        $share->to_destination = $request['to_destination'];
        $share->travel_date = $request['travel_date'];
        $share->pickup_time = $request['pickup_time'];
        $share->car_type_name = $request['car_type_name'];
        $share->car_type = $request['car_type'];
        $share->vacancy = $request['vacancy'];
        $query =$share->save();

       // $ridecustomer = new RideCustomerLinking($request->input()) ;
      //  $ridecustomer->share_ride_id= $share->id;
      //  $ridecustomer->customer_id = $request['customer_id'];
      //  $ridecustomer->consession = 0;
      //  $ridecustomer->save();

        $city_name = $request['city_name'];
        $charges_per_person = $request['charges_per_person'];

        $per_person_implode = explode(',', $charges_per_person);
        $city_implode = explode(',', $city_name);


        $limit = count($city_implode);
        for ($i = 0; $i < $limit; $i++)
        {
            $ride_city = new ShareRideCityLinking($request->input()) ;
            $ride_city->share_ride_id= $share->id;
            $ride_city->city_name = $city_implode[$i];
            $ride_city->charges_per_person = $per_person_implode[$i];
            $ride_city->save();
        }


        if($query === TRUE)
        {
            return json_encode(array("status"=>true,"message"=>"Share Ride Successfull..."));
        }
        else
        {
            return json_encode(array("status"=>false,"message"=>"Share Ride failed..."));
        }

   }

    public function getShareRidesApp(Request $request)
    {
        $current_date = date('Y-m-d');

        if ($request['from_origin'] != NULL)
        {

             $show_data = DB::table('share_ride')
                        ->leftJoin('customer', 'customer.id', '=', 'share_ride.customer_id')
                        ->select('share_ride.*',
                        'customer.mobile_no as mobile_no',
                        'customer.first_name as first_name',
                        'customer.last_name as last_name')
                        ->where('from_origin',$request['from_origin'])
                        ->where('to_destination',$request['to_destination'])
                        ->where('travel_date', '>=', Carbon::today())
                        ->get();

            $data_count = DB::table('share_ride')
            ->where('from_origin',$request['from_origin'])
            ->where('to_destination',$request['to_destination'])
            ->where('travel_date', '>=', Carbon::today())
            ->count();

         for ($i = 0; $i < $data_count; $i++)
         {
             $show_data[$i]->cities = DB::table('share_ride_city_linking')
                        ->select('share_ride_city_linking.*')
                        ->where('share_ride_id',$show_data[$i]->id)
                        ->get();

         }

        }
        else
        {
            $show_data = DB::table('share_ride')
                        ->leftJoin('customer', 'customer.id', '=', 'share_ride.customer_id')
                        ->select('share_ride.*',
                        'customer.mobile_no as mobile_no',
                        'customer.first_name as first_name',
                        'customer.last_name as last_name')
                        ->where('travel_date', '>=', Carbon::today())
                        ->get();

            $data_count = DB::table('share_ride')->where('travel_date', '>=', Carbon::today())->count();

         for ($i = 0; $i < $data_count; $i++)
         {
             $show_data[$i]->cities = DB::table('share_ride_city_linking')
                        ->select('share_ride_city_linking.*')
                        ->where('share_ride_id',$show_data[$i]->id)
                        ->get();

         }

        }

        if(count($show_data)>0)
            {
                return json_encode(array("status"=>true,"data"=>$show_data));
            }
            else
            {

                return json_encode(array("status"=>false));
            }

    }

     public function getShareRidesCities(Request $request)
    {
		 	 $to = DB::table('share_ride_city_linking')
			 ->leftJoin('share_ride', 'share_ride.id', '=', 'share_ride_city_linking.share_ride_id')
			 ->select('share_ride_city_linking.city_name as to_origin_city_name')
			 ->where('share_ride.status','accepted')
			 ->whereDate('share_ride.travel_date', '>=', Carbon::now())
			 ->distinct('city_name')
			 ->get();

			 $from = DB::table('share_ride')
			->select('share_ride.from_origin  as from_origin_city_name')
			->where('status','accepted')
		    ->whereDate('share_ride.travel_date', '>=', Carbon::now())
			->distinct('from_origin')
			->get();

            if(count($from)>0)
            {
                return json_encode(array("to_origin"=>$to) + array("from_origin"=>$from));
            }
            else
            {
                return json_encode(array("status"=>false));
            }
    }

    public function getDriverReports(Request $request)
    {
        $driver_id = $request['driver_id'];
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];



        $get_driver_reports = DB::table('driver_customer_linking')
            ->select('driver_customer_linking.*');

         if ($from_date != null)
        {
                $get_driver_reports = $get_driver_reports
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->where('driver_id',$driver_id);
        }

        $get_driver_reports = $get_driver_reports->orderBy('id', 'DESC')->get();



         if(count($get_driver_reports)>0)
            {
                return json_encode(array("status"=>true,"data"=>$get_driver_reports));
            }
            else
            {

                return json_encode(array("status"=>false));
            }

    }


    public function applyCoupon(Request $request)
    {
        $coupon_name = $request['coupon_name'];
        $city_id = $request['city_id'];
        $compare_date = date('Y-m-d');



        $get_coupons = DB::table('coupon')
            ->select('coupon.*')
            ->where('name',$coupon_name)
            ->where('city_id',$city_id)
            ->whereDate('from_date', '<=', $compare_date)
            ->whereDate('to_date', '>=', $compare_date)
            ->get();



         if(count($get_coupons)>0)
            {
                return json_encode(array("status"=>true,"data"=>$get_coupons));
            }
            else
            {

                return json_encode(array("status"=>false));
            }

    }

     public function getDriverPackageLinking(Request $request)
    {
       $driver_package_linking_id = $request['driver_package_linking_id'];
       $driver_package_linking = DB::table('driver_package_linking')
                        ->select('driver_package_linking.*')
                        ->where('id',$driver_package_linking_id)
                        ->get();

            if(count($driver_package_linking)>0)
            {
                return json_encode(array("data"=>true,"data"=>$driver_package_linking));
            }
            else
            {

                return json_encode(array("data"=>false));
            }

    }

       public function driverGetRentals(Request $request)
    {
       $driver_id = $request['driver_id'];
       $data_show = DB::table('driver_package_linking')
                        ->join('customer_package_linking', 'customer_package_linking.id', '=', 'driver_package_linking.customer_package_id')
                        ->join('customer', 'customer_package_linking.customer_id', '=', 'customer.id')
                        ->select('driver_package_linking.*',
                        'customer_package_linking.travel_type as customer_travel_type',
                        'customer_package_linking.ride_later_date as customer_ride_later_date',
                        'customer_package_linking.ride_later_time as customer_ride_later_time',
                        'customer_package_linking.customer_id as customer_id',
                        'customer_package_linking.latitude as customer_latitude',
                        'customer_package_linking.longitude as customer_longitude',
                        'customer.first_name as first_name',
                        'customer.last_name as last_name',
                        'customer.mobile_no as mobile_no')
                        ->where('driver_package_linking.driver_id',$driver_id)
                        ->get();


            if(count($data_show)>0)
            {
                return json_encode(array("data"=>true,"data"=>$data_show));
            }
            else
            {

                return json_encode(array("data"=>false));
            }

    }


     public function driverUpdateRentalsStatus(Request $request)
    {

        $driver_package_linking_id = $request['driver_package_linking_id'];
        $status = $request['status'];
        $cancelled_by = $request['cancelled_by'];


        $data = array(
            'status' =>$status,
            'reason' => $request['reason'],
            'cancelled_by' => $cancelled_by
        );

        $query = DB::table('driver_package_linking')
            ->where('id',$driver_package_linking_id)
            ->update($data);


        if($query === 1) {

            return json_encode(array("status"=>true));

        }
        else {

            return json_encode(array("status"=>false));

        }


    }


    public function getAllCities(Request $request)
    {
       $all_cities = DB::table('city')
                        ->select('city.*')
                        ->get();

        if(count($all_cities)>0)
        {
            return json_encode(array("status"=>true,"data"=>$all_cities));
        }
        else
        {

            return json_encode(array("status"=>false));
        }

    }

    public function customerGetLocalRides(Request $request)
    {

        $customer_id = $request['customer_id'];
        $get_rides = DB::table('customer_travel_linking')
                        ->leftJoin('driver_customer_linking', 'driver_customer_linking.customer_travel_id', '=', 'customer_travel_linking.id')
                        ->leftJoin('driver', 'driver.id', '=', 'driver_customer_linking.driver_id')
                        ->leftJoin('car_types', 'car_types.id', '=', 'customer_travel_linking.car_type_id')
                        ->select('customer_travel_linking.*',
                                'driver_customer_linking.id as driver_customer_linking_id',
                                'driver_customer_linking.status as drive_status',
                                'driver_customer_linking.distance_user_destination_km as distance_user_destination_km',
                                'driver_customer_linking.custoemr_amount as custoemr_amount',
                                'driver_customer_linking.otp as otp',
                                'driver_customer_linking.cancelled_by as cancelled_by',
                                'driver_customer_linking.reason as reason',
                                'driver_customer_linking.journey_time as journey_time',
                                'driver.first_name as driver_first_name',
                                'driver.last_name as driver_last_name',
                                'driver.mobile_no as driver_mobile_no',
                                'car_types.name as car_types_name')
                        ->where('customer_travel_linking.customer_id',$customer_id)
                        ->get();

        if(count($get_rides)>0)
        {
            return json_encode(array("status"=>true,"data"=>$get_rides));
        }
        else
        {

            return json_encode(array("status"=>false));
        }

    }


    public function customerGetOutstationRides(Request $request)
    {

        $customer_id = $request['customer_id'];
        $get_outstation = DB::table('outstation')
                        ->leftJoin('car_types', 'car_types.id', '=', 'outstation.car_type_id')
                        ->select('outstation.*',
                                'car_types.name as car_types_name')
                        ->where('outstation.customer_id',$customer_id)
                        ->get();

        if(count($get_outstation)>0)
        {
            return json_encode(array("status"=>true,"data"=>$get_outstation));
        }
        else
        {

            return json_encode(array("status"=>false));
        }

    }


    public function customerGetRentalRides(Request $request)
    {

        $customer_id = $request['customer_id'];
        $get_rentals = DB::table('customer_package_linking')
                        ->leftJoin('package_cartype_linking', 'package_cartype_linking.id', '=', 'customer_package_linking.pctl_id')
                        ->leftJoin('car_types', 'car_types.id', '=', 'package_cartype_linking.cartype_id')
                        ->leftJoin('package', 'package.id', '=', 'package_cartype_linking.package_id')
                        ->leftJoin('driver_package_linking', 'driver_package_linking.customer_package_id', '=', 'customer_package_linking.id')
                         ->leftJoin('driver', 'driver.id', '=', 'driver_package_linking.driver_id')
                        ->select('customer_package_linking.*',
                                'package_cartype_linking.amount as amount',
                                'car_types.name as car_types_name',
                                'package.name as package_name',
                                'package.km as package_km',
                                'package.hour as package_hour',
                                'driver_package_linking.id as driver_package_linking_id',
                                'driver_package_linking.status as drive_status',
                                'driver_package_linking.distance_user_destination_km as distance_user_destination_km',
                                'driver_package_linking.custoemr_amount as customer_amount',
                                'driver_package_linking.otp as otp',
                                'driver_package_linking.cancelled_by as cancelled_by',
                                'driver_package_linking.reason as reason',
                                'driver_package_linking.journey_time as journey_time')
                        ->where('customer_package_linking.customer_id',$customer_id)
                        ->get();

        if(count($get_rentals)>0)
        {
            return json_encode(array("status"=>true,"data"=>$get_rentals));
        }
        else
        {

            return json_encode(array("status"=>false));
        }

    }


    public function submitFeedback(Request $request)
    {

        $feeback = new Feedback($request->input());
        $feeback->customer_id = $request['customer_id'];
        $feeback->driver_customer_linking_id = $request['driver_customer_linking_id'];
        $feeback->driver_package_linking = $request['driver_package_linking'];
        $feeback->rating = $request['rating'];
        $feeback->review = $request['review'];
        $query = $feeback->save();

        if($query === TRUE)
        {
            return json_encode(array("status"=>true,"message"=>"Feedback Regsiter successfull..."));
        }
        else
        {
            return json_encode(array("status"=>false,"message"=>"Regsiter failed..."));
        }


   }
}
