<?php

namespace App\Http\Controllers;

use App\AdminNotification;
use App\CarType;
use App\City;
use App\Driver;
use App\ShareRideCityLinking;
use App\Sos;
use App\Package;
use App\Customer;
use App\PackageCarTypeLinking;
use App\CustomerPackageLinking;
use App\TempCustomerPackageLinking;
use App\DriverPackageLinking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Enquiry;

class AdminNotificationController extends Controller
{
    public function allNotification()
    {
        $output = array('data' => array());
        $notification = AdminNotification::all()->sortByDesc('id');
        $x = 1;
        foreach ($notification as $row)
        {
            $actionButton = '

     <td>
            <a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>
    </td>

            ';

            $sent_by = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->sent_type.' </span>';
            $date = $row->created_at->toDateString();

            if ($row->image != NULL)
            {
            $image = '
                   <img src="'.asset('public/img/'.$row->image.'').'"  class="rounded mx-auto d-block photo" height="50px" width="50px" data-toggle="modal" data-target="#imageModal">
            ';
            }
            else
            {
            $image = '
                   <img src="'.asset('public/img/no_photo.jpg').'"  class="rounded mx-auto d-block photo" height="50px" width="50px" data-toggle="modal" data-target="#imageModal">
            ';
            }


            $output['data'][] = array(
                $row->title,
                $row->message,
                $sent_by,
                $image,
                $date,
                $actionButton,
            );
            $x++;
        }
        $data= response()->json($output);
        return $data;
    }

    public function store(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'title' => 'required',
            'message' => 'required',
            'sent_type' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $notification = new AdminNotification($request->input());
        $notification->title = $request['title'];
        $notification->message = $request['message'];
        $notification->sent_type = $request['sent_type'];

         if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $request->file('image')->hashName();
            $destinationPath = public_path().'/img';
            $file->move($destinationPath,$fileName);
            $notification->image = $fileName;
         }
        $query = $notification->save();

            define('API_ACCESS_KEY','AAAAGdGMkvo:APA91bGEIhwxQVCnVe1mY5E0Pc4gGOmuSm8FenhfBXVNSuA3n7bbFawHIWDUXiwygRchV0Wl_VVbH8xm4mxsEacUtrpJnHaFXmoUqdoHtuu05RAsuSycdZMCfPD-arYx6IirTRL6Tas9');
            $url = 'https://fcm.googleapis.com/fcm/send';
            // $registrationIds = array($_GET['id']);
            // prepare the message
            $message = array(
                'title'     => $request['title'],
                'body'      => $request['message'],
				'image'      => 'https://zhepcab.com/public/img/'.$fileName,
                'vibrate'   => true,
                'sound'      => 'sound.mp3'
            );

            if ($request['sent_type'] == 'Customer')
            {

                             $fields = array(
                            // 'registration_ids' => $registrationIds,
                            'data'             => $message,
                            'notification'=>$message,
                            'to'=>"/topics/allCustomers",
                            'data'=> array(
                          'paramType'     => 'driverRideNow',
                                'paramRideID'     =>'100'
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
            }

            else
            {
                             $fields = array(
                            // 'registration_ids' => $registrationIds,
                            'data'             => $message,
                            'notification'=>$message,
                            'to'=>"/topics/allDrivers",
                            'data'=> array(
                          'paramType'     => 'driverRideNow',
                                'paramRideID'     =>'100'
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
            }


         if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Notification Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Notification";
        }

        return json_encode($validator);



    }

    public function removeNotification(Request $request)
    {
        $id = $request['notification'];
        $notification = AdminNotification::find($id)->delete();

        if($notification == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }

     public function allSos()
     {
        $output = array('data' => array());
        $sos = DB::table('sos')
            ->join('city', 'city.id', '=', 'sos.city_id')
            ->select('sos.*',
                'city.name as city_name')
            ->orderBy('sos.id', 'DESC')
            ->get();

        $x = 1;
        foreach ($sos as $row)
        {
            $actionButton = '

     <td>
     
      <a href="#" data-toggle="modal" data-target="#editModal" onclick="editItem('.$row->id.')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a>
            
            <a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>
    </td>

            ';

            $output['data'][] = array(
                $row->city_name,
                $row->police_station_name,
                $row->phone_no,
                $row->address,
                $actionButton,
            );
            $x++;
        }
        $data= response()->json($output);
        return $data;
     }

      public function addSos(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'city_id' => 'required',
            'police_station_name' => 'required',
            'phone_no' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $sos = new Sos($request->input());
        $sos->city_id = $request['city_id'];
        $sos->police_station_name = $request['police_station_name'];
        $sos->address = $request['address'];
        $sos->phone_no = $request['phone_no'];
        $query = $sos->save();

         if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Sos Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Sos";
        }

        return json_encode($validator);

    }

     public function removeSos(Request $request)
    {
        $id = $request['sos'];
        $sos = Sos::find($id)->delete();

        if($sos == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }

    public function editSos(Request $request)
    {
        $id = $request['id'];
        $sos = DB::table('sos')
            ->join('city', 'city.id', '=', 'sos.city_id')
            ->select('sos.*',
                'city.name as city_name')
            ->where('sos.id',$id)
            ->get();

        $cities = City::all();
        foreach ($cities as $city)
        {
            $city_data[] = '<option value="'.$city['id'].'" '.($sos[0]->city_id==$city['id']?"selected":"").'>'.$city['name'].'</option>';
        }

        $data= response()->json(array(
            'sos' => $sos[0],
            'cities' => $city_data
        ));
        return $data;
    }

    public function updateSos(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'city_id' => 'required',
            'police_station_name' => 'required',
            'phone_no' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
        $data = array(
            'city_id' =>$request['city_id'],
            'police_station_name' =>$request['police_station_name'],
            'address' =>$request['address'],
            'phone_no' =>$request['phone_no']
        );

        $query = DB::table('sos')
            ->where('id',$id)
            ->update($data);

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "SOS Data Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated SOS Data";
        }
        // close the database connection
        echo json_encode($validator);
    }

    

     public function allRentalEnq(Request $request)
     {
        $output = array('data' => array());
        $sos = DB::table('customer')
            ->join('customer_package_linking', 'customer.id', '=', 'customer_package_linking.customer_id')
            ->leftjoin('driver_package_linking', 'driver_package_linking.customer_package_id', '=', 'customer_package_linking.id')
            ->leftjoin('package_cartype_linking', 'package_cartype_linking.id', '=', 'customer_package_linking.pctl_id')
            ->leftjoin('package', 'package.id', '=', 'package_cartype_linking.package_id')
            ->leftjoin('car_types', 'car_types.id', '=', 'package_cartype_linking.cartype_id')
			->leftjoin('driver', 'driver.id', '=', 'driver_package_linking.driver_id')
            ->select('customer.*',
					 'driver_package_linking.otp as otp',
					 'driver_package_linking.id as driver_package_linking_id',
					 'driver_package_linking.cancelled_by as ride_cancelled_by',
					 'driver_package_linking.reason as ride_reason',
					 'driver_package_linking.status as ride_status',
					 'package_cartype_linking.amount as amount',
					 'driver.first_name as driver_first_name',
					 'driver.last_name as driver_last_name',
					 'customer_package_linking.ride_later_date as ride_later_date',
					 'customer_package_linking.ride_later_time as ride_later_time',
                	'package.name as package_name',
					'driver_package_linking.id as driver_package_linking_id',
					'customer_package_linking.id as ref_id',
                	'car_types.name as cartype_name',
					'driver_package_linking.without_coupon_amount as without_coupon_amount',
					'driver_package_linking.custoemr_amount as custoemr_amount',
					'customer_package_linking.coupon as coupon_name',
					 'customer_package_linking.start_time as start_time',
					'customer_package_linking.end_time as end_time',
					'customer_package_linking.toAdmin as toAdmin',
                    'customer_package_linking.pick_location',
                    'customer_package_linking.created_at as enq_time',
                    'driver_package_linking.distance_user_destination_km',
                    'driver_package_linking.without_coupon_amount',
                    )
           	->whereNotIn('driver_package_linking.status', ['pending','rejected'])
			// ->where('customer_package_linking.toAdmin',1)
            // ->orderBy('customer_package_linking.id', 'DESC')
            // ->get();

            //->whereNotIn('driver_package_linking.status', ['pending'])
			//->where('customer_package_linking.toAdmin',1)
            ->orderBy('customer_package_linking.id', 'DESC')
            ->groupBy('ref_id');
            if(isset($request->role) && $request->role!='1'){
                $sos=$sos->
                whereBetween('ride_later_date',[Carbon::today(), Carbon::today()->addDays(2)]);
            }

            $sos=$sos->get();
           
        $x = 1;
        foreach ($sos as $row)
        {

			$statics = "RX1400";
			$refid =$statics.''.$row->ref_id;
			
			$actionButton = '
          <td>
		  <a href="#"  data-toggle="modal" data-target="#viewModalRental" onclick="RentalDetails('.$row->driver_package_linking_id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-eye"></i>
                </button>
        </a>
		   <a href="'.url('/').'/print_format/rental.php?driver_package_linking_id='.$row->driver_package_linking_id.'&&ref_id='.$refid.'"  target="_blank"  >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-print"></i>
                </button>
				</a>
				
		   <a href="Edit Details" data-toggle="modal" data-target="#editModalRental" onclick="editItemRental('.$row->driver_package_linking_id.')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a>
			
<a title="Change Driver" href="#" data-toggle="modal" data-target="#editModal" onclick="editItem('.$row->driver_package_linking_id.')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-exchange mt-0"></i>
                </button>
            </a>
            <a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem('.$row->ref_id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>
            
            </td>

            ';

			if($row->ride_status == 'cancelled')
			{
				$ride_status = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Status: '.$row->ride_status.'<br>
				   Cancelled By: '.$row->ride_cancelled_by.'<br>
				   Reason: '.$row->ride_reason.'<br></span>';
			}
			else
			{
				$ride_status = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->ride_status.' </span>';
			}




			// $date_time = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Date: '.date('d-m-Y',strtotime($row->ride_later_date)).'<br>
			// 	   Time: '.$row->ride_later_time.'<br></span>';
            $date_time = date('d-m-Y',strtotime($row->ride_later_date)).' '.$row->ride_later_time;

                //    $enq_time = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Date: '.date('d-m-Y',strtotime($row->enq_time)).'<br>
				//    Time: '.date('H:i:s',strtotime($row->enq_time)).'<br></span>';
                $enq_time =date('d-m-Y',strtotime($row->enq_time)).' '.date('H:i:s',strtotime($row->enq_time));

			
			
                   $destination_details='<span class="badge" style="color: #000 !important;font-size: 12px;"> Pick Location: '.$row->pick_location.' <br>
                   
                   Total KM: '.$row->distance_user_destination_km.'<br>
                   Rate: '.$row->custoemr_amount ?? 'N/A'.'<br>
                   </span>';

                   $coupon_details = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Coupon Code : '.$row->coupon_name.' <br> 
				   Amount Before Coupon: '.$row->without_coupon_amount.'<br> 
				   Final Amount: '.$row->custoemr_amount.'</span>';
			
			$ride_details = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Start Time : '.$row->start_time.' <br> 
				   End Time: '.$row->end_time.'</span>';
			
			$status_admin = $row->toAdmin;

            if ($status_admin == 0)
            {
                $status_admin = '<span class="badge badge-success"> Admin </span>';
            }
            else if($status_admin == 1)
            {
                $status_admin = '<span class="badge badge-danger"> App </span>';
            }

            $output['data'][] = array(
				$refid,
                $row->first_name.' '.$row->last_name,
                $row->mobile_no,
                $row->package_name,
                $row->cartype_name,
				$row->driver_first_name.' '.$row->driver_last_name,
				$date_time,
				$enq_time,
				$row->amount,
                $destination_details,
				$coupon_details,
				$ride_details,
				$row->otp,
				$ride_status,
				$status_admin,
				$actionButton
            );
            $x++;
        }
        $data= response()->json($output);
        return $data;
     }

     public function deleteRentalEnquiry(Request $request){
		
        $id = $request['id'];
        $driver = DriverPackageLinking::where('customer_package_id', $id)->delete();
        $customer = CustomerPackageLinking::find($id)->delete();

        if($customer == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);

     }

	 public function editLinkDriverRental(Request $request)
    {
        $id = $request['id'];
        $link = DB::table('driver_package_linking')
            ->select('driver_package_linking.*')
            ->where('id',$id)
            ->get();

        $data= response()->json(array(
            'link' => $link[0],
        ));
        return $data;
    }

	 public function updateLinkDriverRental(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'driver_id' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        // $id = $request['id'];
        // $data = array(
        //     'driver_id' =>$request['driver_id']
        // );

        // $query = DB::table('driver_package_linking')
        //     ->where('id',$id)
        //     ->update($data);

        
//new code start
DB::table('driver_package_linking')
->where('customer_package_id',$request->customer_package_id)
->delete();

$query = DB::table('driver_package_linking')
->insert([
    'customer_package_id' =>$request->customer_package_id,
    'driver_id' =>$request->driver_id,
    'status' =>'accepted',
]);
//new code end

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Link To Driver Updated successfully";
        }
        else {
			 $validator['success'] = true;
            $validator['messages'] = "Link To Driver Updated successfully";
			
           // $validator['success'] = false;
            //$validator['messages'] = "Error while Updated Link To Driver";
        }
        // close the database connection
        echo json_encode($validator);
    }
	
	
	public function addRentalEnquiry(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'city_id' => 'required',
			'package_id' => 'required',
            'cartype_id' => 'required',
			'travel_type' => 'required',
			'customer_id' => 'required',
            'driver_id' => 'required'
        ]);
		
		
        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

		
			$customer_mobile = DB::table('customer')
            ->select('customer.*')
            ->where('id', $request['customer_id'])
            ->get();

			$mobile_number= $customer_mobile[0]->mobile_no;
            $six_digit = mt_rand(1000,9999);
            if(isset($mobile_number) && $mobile_number!=null)
            $send=app('App\Http\Controllers\SendSmsController')->send_sms($six_digit,$mobile_number);

		  

			// $curl = curl_init();
			// curl_setopt_array($curl, array(CURLOPT_URL => 'https://bulksms.co/sendmessage.php?user=kdhoke&password=9593323&mobile='.$mobile_number.'&sender=ZHEPCB&type=3&template_id=1507161633922243528&message='.$six_digit.'%20is%20OTP%20for%20your%20Zhep%20Cab%20Account%20.%0A%20%20Do%20not%20share%20OTP%20with%20anyone%20due%20to%20security%20reasons',
 			// CURLOPT_RETURNTRANSFER => true,
  			// CURLOPT_ENCODING => '',
  			// CURLOPT_MAXREDIRS => 10,
  			// CURLOPT_TIMEOUT => 0,
  			// CURLOPT_FOLLOWLOCATION => true,
  			// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  			// CURLOPT_CUSTOMREQUEST => 'POST',
			// ));

			// $response = curl_exec($curl);
			// curl_close($curl);
		
		
		
			if ($request['travel_type'] == "ride_now")
			{
				date_default_timezone_set('Asia/Kolkata');
				$ride_later_date = date('Y-m-d');
				$ride_later_time = date('h:i:s');	
			}
			else if ($request['travel_type'] == "ride_later")
			{
                $rideLaterDate = Carbon::parse($request->input('ride_later_date'),'Asia/Kolkata')->endOfDay();
                if ($rideLaterDate->isPast()) {
                    $validator['success'] = false;
                    $validator['messages'] = 'Past date is not allowed.';
                    return json_encode($validator);
                }
				$ride_later_date = $request['ride_later_date'];
				$ride_later_time = $request['ride_later_time'];
			}

      /*  $packagecarlinking = new PackageCarTypeLinking($request->input()) ;
        $packagecarlinking->city_id= $request['city_id'];
        $packagecarlinking->package_id = $request['package_id'];
        $packagecarlinking->cartype_id = $request['cartype_id'];
        $packagecarlinking->amount = $request['amount'];
        $packagecarlinking->save(); */
		
		
		$get_pctl_id = DB::table('package_cartype_linking')
            ->select('package_cartype_linking.*')
            ->where('package_id', $request['package_id'])
			->where('cartype_id', $request['cartype_id'])
            ->get();
            if($get_pctl_id->isEmpty()){
                $validator['success'] = false;
                $validator['messages'] = "Package not available with this car type";
                 echo json_encode($validator);
                exit();
            }
		$get_pctl_id = $get_pctl_id[0]->id;
		
		
		$customerpackagelinking = new CustomerPackageLinking($request->input()) ;
        $customerpackagelinking->travel_type= $request['travel_type'];
		$customerpackagelinking->ride_later_date = $ride_later_date;
		$customerpackagelinking->ride_later_time = $ride_later_time;
        $customerpackagelinking->pctl_id = $get_pctl_id;
        $customerpackagelinking->customer_id = $request['customer_id'];
        $customerpackagelinking->pick_location = $request['pick_location'];
		$customerpackagelinking->start_time= $request['start_time'];
        $customerpackagelinking->end_time = $request['end_time'];
		$customerpackagelinking->toAdmin = 1;
        if(isset($request['latitude']) && isset($request['longitude'])){
            $customerpackagelinking->latitude = $request['latitude'];
		$customerpackagelinking->longitude = $request['longitude'];      
        }
		  $customerpackagelinking->save();
		
		

		$driverpackagelinking = new DriverPackageLinking($request->input()) ;
        $driverpackagelinking->customer_package_id= $customerpackagelinking->id;
        $driverpackagelinking->driver_id = $request['driver_id'];
        $driverpackagelinking->otp = $six_digit;
		$driverpackagelinking->status = "accepted";
		$driverpackagelinking->distance_driver_user_km = $request['distance_driver_user_km'];
		$driverpackagelinking->distance_user_destination_km = $request['distance_user_destination_km'];
		$driverpackagelinking->custoemr_amount = $request['custoemr_amount'];
        $query = $driverpackagelinking->save();

        if(isset($request['enquiry_id']) && $request['enquiry_id']!=null){
            TempCustomerPackageLinking::find($request['enquiry_id'])
            ->update(['status'=>"Converted",'ref_id'=>$customerpackagelinking->id]);
    
            }

		$get_fcm = DB::table('driver')
            ->select('driver.*')
            ->where('id', $request['driver_id'])
            ->get();
		$fcm = $get_fcm[0]->fcmToken;
		
		define('API_ACCESS_KEY','AAAAGdGMkvo:APA91bGEIhwxQVCnVe1mY5E0Pc4gGOmuSm8FenhfBXVNSuA3n7bbFawHIWDUXiwygRchV0Wl_VVbH8xm4mxsEacUtrpJnHaFXmoUqdoHtuu05RAsuSycdZMCfPD-arYx6IirTRL6Tas9');
            $url = 'https://fcm.googleapis.com/fcm/send';
            // $registrationIds = array($_GET['id']);
            // prepare the message
            $message = array(
                'title'     => "New Ride",
                'body'      => "You have got a Rental Ride",
			//	'image'      => 'https://zhepcab.com/img/'.$fileName,
                'vibrate'   => true,
                'sound'      => 'sound.mp3'
            );



  				$fields = array(
                            // 'registration_ids' => $registrationIds,
                            'data'             => $message,
                            'notification'=>$message,
                            'to'=> $fcm,
                            'data'=> array(
                          'paramType'     => 'driverRideNow',
                                'paramRideID'     =>'100'
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


        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Rental Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Rental";
        }
        echo json_encode($validator);
    }
	
    public function tempaddRentalEnquiry(Request $request)
    {
        
        $validators = Validator::make($request->all(), [
            'rental_city_id' => 'required',
			'rental_package_id' => 'required',
            'rental_cartype_id' => 'required',
			'rental_travel_type' => 'required',
			'customer_id' => 'required',
        ]);
		
		
        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

			if ($request['rental_travel_type'] == "ride_now")
			{
				date_default_timezone_set('Asia/Kolkata');
				$ride_later_date = date('Y-m-d');
				$ride_later_time = date('h:i:s');	
			}
			else if ($request['rental_travel_type'] == "ride_later")
			{
                $rideLaterDate = Carbon::parse($request->input('rental_ride_later_date'),'Asia/Kolkata')->endOfDay();
                if ($rideLaterDate->isPast()) {
                    $validator['success'] = false;
                    $validator['messages'] = 'Past date is not allowed.';
                    return json_encode($validator);
                }
				$ride_later_date = $request['rental_ride_later_date'];
				$ride_later_time = $request['rental_ride_later_time'];
			}

	
		$get_pctl_id = DB::table('package_cartype_linking')
            ->select('package_cartype_linking.*')
            ->where('package_id', $request['rental_package_id'])
			->where('cartype_id', $request['rental_cartype_id'])
            ->get();
            if($get_pctl_id->isEmpty()){
                $validator['success'] = false;
                $validator['messages'] = "Package not available with this car type";
                 echo json_encode($validator);
                exit();
            }
		$get_pctl_id = $get_pctl_id[0]->id;
		
		$customerpackagelinking = new TempCustomerPackageLinking($request->input()) ;
        $customerpackagelinking->travel_type= $request['rental_travel_type'];
		$customerpackagelinking->ride_later_date = $ride_later_date;
		$customerpackagelinking->ride_later_time = Carbon::parse($ride_later_time)->format('H:i:00');
        $customerpackagelinking->pctl_id = $get_pctl_id;
        $customerpackagelinking->customer_id = $request['customer_id'];
        $customerpackagelinking->pick_location = $request['rental_pick_location'];
		$customerpackagelinking->start_time= $request['rental_start_time'];
        $customerpackagelinking->end_time = $request['rental_end_time'];
		$customerpackagelinking->toAdmin = 1;
        //extra fields
        $customerpackagelinking->cartype_id = $request['rental_cartype_id'];
        $customerpackagelinking->city_id = $request['rental_city_id'];
        $customerpackagelinking->amount = $request['rental_amount'];
        $customerpackagelinking->distance_driver_user_km = $request['rental_distance_driver_user_km'];
        $customerpackagelinking->distance_user_destination_km = $request['rental_distance_user_destination_km'];
        $customerpackagelinking->custoemr_amount = $request['rental_custoemr_amount'];

        if(isset($request['rental_latitude']) && isset($request['rental_longitude'])){
            $customerpackagelinking->latitude = $request['rental_latitude'];
		$customerpackagelinking->longitude = $request['rental_longitude'];      
        }
        $query=$customerpackagelinking->save();

        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Enquiry Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Enquiry";
        }
        echo json_encode($validator);
    }

    public function tempupdateRentalEnquiry(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'city_id' => 'required',
			'package_id' => 'required',
            'cartype_id' => 'required',
			'travel_type' => 'required',
			'customer_id' => 'required',
            'enquiry_id'=> 'required',
        ]);
		
		
        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

			if ($request['travel_type'] == "ride_now")
			{
				date_default_timezone_set('Asia/Kolkata');
				$ride_later_date = date('Y-m-d');
				$ride_later_time = date('h:i:s');	
			}
			else if ($request['travel_type'] == "ride_later")
			{
                $rideLaterDate = Carbon::parse($request->input('ride_later_date'),'Asia/Kolkata')->endOfDay();
                if ($rideLaterDate->isPast()) {
                    $validator['success'] = false;
                    $validator['messages'] = 'Past date is not allowed.';
                    return json_encode($validator);
                }
				$ride_later_date = $request['ride_later_date'];
				$ride_later_time = $request['ride_later_time'];
			}

	
		$get_pctl_id = DB::table('package_cartype_linking')
            ->select('package_cartype_linking.*')
            ->where('package_id', $request['package_id'])
			->where('cartype_id', $request['cartype_id'])
            ->get();
            if($get_pctl_id->isEmpty()){
                $validator['success'] = false;
                $validator['messages'] = "Package not available with this car type";
                 echo json_encode($validator);
                exit();
            }
		$get_pctl_id = $get_pctl_id[0]->id;
		
		$customerpackagelinking = TempCustomerPackageLinking::find($request['enquiry_id']);
        $customerpackagelinking->travel_type= $request['travel_type'];
		$customerpackagelinking->ride_later_date = $ride_later_date;
		$customerpackagelinking->ride_later_time = Carbon::parse($ride_later_time)->format('H:i:00');
        $customerpackagelinking->pctl_id = $get_pctl_id;
        $customerpackagelinking->customer_id = $request['customer_id'];
        $customerpackagelinking->pick_location = $request['pick_location'];
		$customerpackagelinking->start_time= $request['start_time'];
        $customerpackagelinking->end_time = $request['end_time'];
		$customerpackagelinking->toAdmin = 1;
        //extra fields
        $customerpackagelinking->cartype_id = $request['cartype_id'];
        $customerpackagelinking->city_id = $request['city_id'];
        $customerpackagelinking->amount = $request['amount'];
        $customerpackagelinking->distance_driver_user_km = $request['distance_driver_user_km'];
        $customerpackagelinking->distance_user_destination_km = $request['distance_user_destination_km'];
        $customerpackagelinking->custoemr_amount = $request['custoemr_amount'];

        if(isset($request['latitude']) && isset($request['longitude'])){
            $customerpackagelinking->latitude = $request['latitude'];
		$customerpackagelinking->longitude = $request['longitude'];      
        }
        $query=$customerpackagelinking->save();

        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Enquiry Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Enquiry";
        }
        echo json_encode($validator);
    }
	
	
	
	 public function editRentalCustomer(Request $request)
    {
        $id = $request['id'];
        $rentalride = DB::table('package_cartype_linking')
            ->join('customer_package_linking', 'customer_package_linking.pctl_id', '=', 'package_cartype_linking.id')
            ->join('driver_package_linking', 'driver_package_linking.customer_package_id', '=', 'customer_package_linking.id')
            ->select('package_cartype_linking.*',
					 'driver_package_linking.driver_allowance as driver_allowance',
					 'driver_package_linking.parking_and_tolltax as parking_and_tolltax',
					 'driver_package_linking.extra_perkm_rate as extra_perkm_rate',
					 'driver_package_linking.customer_extra_kms as customer_extra_kms',
					 'driver_package_linking.extra_min_rate as extra_min_rate',
					 'driver_package_linking.customer_extra_time as customer_extra_time',
				'driver_package_linking.status as driver_package_status',
				'driver_package_linking.driver_id as driver_id',
				'driver_package_linking.distance_driver_user_km as distance_driver_user_km',
				'driver_package_linking.distance_user_destination_km as distance_user_destination_km',
				'driver_package_linking.custoemr_amount as custoemr_amount',
				'customer_package_linking.travel_type as travel_type',
				'customer_package_linking.ride_later_date as ride_later_date',
				'customer_package_linking.ride_later_time as ride_later_time',
				'customer_package_linking.customer_id as customer_id',
				'customer_package_linking.pick_location as pick_location',
				'customer_package_linking.start_time as start_time',
				'customer_package_linking.end_time as end_time')
            ->where('driver_package_linking.id',$id)
            ->get();
		
			
		

        $cars_types = CarType::all();
        foreach ($cars_types as $car)
        {
            $cars_data[] = '<option value="'.$car['id'].'" '.($rentalride[0]->cartype_id==$car['id']?"selected":"").'>'.$car['name'].'</option>';
        }
		
		$drivers = Driver::orderBy('first_name', 'ASC')->get();
        foreach ($drivers as $driver)
        {
            $driver_data[] = '<option value="'.$driver['id'].'" '.($rentalride[0]->driver_id==$driver['id']?"selected":"").'>'.$driver['first_name'].' '.$driver['last_name'].'</option>';
        }


        $travel_type[0] = '<option value="ride_now" '.($rentalride[0]->travel_type=='ride_now'?"selected":"").'>Ride Now</option>';
        $travel_type[1] = '<option value="ride_later" '.($rentalride[0]->travel_type=='ride_later'?"selected":"").'>Ride later</option>';
		
		$old_date_timestamp = strtotime($rentalride[0]->ride_later_date);
		$new_date = date('Y-m-d', $old_date_timestamp);
		 
		 $cities = City::all();
        foreach ($cities as $city)
        {
            $city_data[] = '<option value="'.$city['id'].'" '.($rentalride[0]->city_id==$city['id']?"selected":"").'>'.$city['name'].'</option>';
        }
		 
		 $packages = Package::all();
        foreach ($packages as $package)
        {
     	 $package_data[] = '<option value="'.$package['id'].'" '.($rentalride[0]->package_id==$package['id']?"selected":"").'>'.$package['name'].'</option>';
        }
		 
		 $statuses[0] = '<option value="completed" '.($rentalride[0]->driver_package_status=='completed'?"selected":"").'>Completed</option>';
        $statuses[1] = '<option value="cancelled" '.($rentalride[0]->driver_package_status=='cancelled'?"selected":"").'>Cancelled</option>';
        $statuses[2] = '<option value="pending" '.($rentalride[0]->driver_package_status=='pending'?"selected":"").'>Pending</option>';
        $statuses[3] = '<option value="accepted" '.($rentalride[0]->driver_package_status=='accepted'?"selected":"").'>Accepted</option>';
        $statuses[4] = '<option value="rejected" '.($rentalride[0]->driver_package_status=='rejected'?"selected":"").'>Rejected</option>';
        $statuses[5] = '<option value="start" '.($rentalride[0]->driver_package_status=='start'?"selected":"").'>Start</option>';
		 


        $data= response()->json(array(
            'rentalride' => $rentalride[0],
            'cars' => $cars_data,
            'travel' => $travel_type,
			'drivers' => $driver_data,
			'city' => $city_data,
			'package' => $package_data,
			'current_date_show' => $new_date,
			'statuses' => $statuses
        ));
        return $data;
    }
	
	 public function updateRentalCustomer(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'driver_id' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
		 

        $data = array(
            'pick_location' =>$request['pick_location'],
            'driver_id' => $request['driver_id'],
            'distance_user_destination_km' => $request['distance_user_destination_km'],
            'custoemr_amount' => $request['custoemr_amount'],
            'status' =>$request['status'],
            'driver_allowance' =>$request['driver_allowance'],
            'parking_and_tolltax' =>$request['parking_and_tolltax'],
            'extra_perkm_rate' =>$request['extra_perkm_rate'],
            'customer_extra_kms' =>$request['customer_extra_kms'],
            'extra_min_rate' =>$request['extra_min_rate'],
			'customer_extra_time' =>$request['customer_extra_time']
        );
		
		
        $query = DB::table('customer')
       ->join('customer_package_linking', 'customer_package_linking.customer_id', '=', 'customer.id')
       ->join('driver_package_linking', 'driver_package_linking.customer_package_id', '=', 'customer_package_linking.id')
            ->where('driver_package_linking.id',$id)
            ->update($data);

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Customer Data Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Customer";
        }
        // close the database connection
        echo json_encode($validator);
    }
	
	 public function getPackagesList(Request $request)
    {
         $city_id = $request['city_id'];
		 $packages = DB::table('package')
            ->join('package_cartype_linking', 'package_cartype_linking.package_id', '=', 'package.id')
            ->join('car_types', 'car_types.id', '=', 'package_cartype_linking.cartype_id')
            ->select('package.*',
                'car_types.name as car_type_name')
            ->groupBy('package_cartype_linking.package_id')
			->where('package_cartype_linking.city_id',$city_id)
            ->get();
      

        if ($packages->count() == 0)
        {
            $data[] = '<option value="" disabled></option>';
        }
        else
        {
            foreach ($packages as $package)
            {
                $data[] = '<option value="'.$package->id.'">'.$package->name.'</option>';
            }
        }

        return json_encode($data);
    }
	
	
	
}
