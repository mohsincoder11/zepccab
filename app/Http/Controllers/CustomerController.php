<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarType;
use App\Customer;
use App\CustomerTravelLinking;
use App\DriverCustomerLinking;
use App\Driver;
use App\DriverCarLinking;
use App\TravelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Enquiry;
use App\TempCustomerTravelLinking;



class CustomerController extends Controller
{
    public function store2(Request $request)
    {

        $validators = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
			'mobile_no' => 'required',
            'email_id' => 'required',
        ]);
        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }
        $customer = new Customer($request->input()) ;
        $customer->first_name= $request['first_name'];
        $customer->last_name = $request['last_name'];
        $customer->mobile_no = $request['mobile_no'];
        $customer->email_id = $request['email_id'];
        $customer->id_proof = $request['id_proof'];
		        $customer->password = '25d55ad283aa400af464c76d713c07ad'; //this line added for default 12345678 password


        
        $query=$customer->save();
		
        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Customer Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Customer";
        }
        echo json_encode($validator);
    }

    public function editCustomer2(Request $request){
        $validators = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }
        $customer = Customer::find($request->id);
        $data= response()->json(array(
            'customer' => $customer
        ));
        return $data;

    }
    public function updateCustomer2(Request $request)
    {

        $validators = Validator::make($request->all(), [
            'id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
			'mobile_no' => 'required',
            'email_id' => 'required',
        ]);
        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }
        $customer = Customer::find($request->id) ;
        $customer->first_name= $request['first_name'];
        $customer->last_name = $request['last_name'];
        $customer->mobile_no = $request['mobile_no'];
        $customer->email_id = $request['email_id'];
        $customer->id_proof = $request['id_proof'];
        
        $query=$customer->save();
		
        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Customer Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Customer";
        }
        echo json_encode($validator);
    }

    public function removeCustomer2(Request $request)
    {
        $id = $request['customer'];
        $customer = Customer::find($id)->delete();
       
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

    public function store(Request $request)
    {
		//  'mobile_no' => 'required|unique:customer',
        $validators = Validator::make($request->all(), [
            'customer_id' => 'required',
			'driver_id' => 'required',
            'travel_type' => 'required',
            'car_type_id' => 'required'
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
            $send=app('App\Http\Controllers\SendSmsController')->send_sms( $six_digit,$mobile_number);

		    // 
			// 

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
				$ride_later_time = date('H:i:s');	
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

        $customerlinking = new CustomerTravelLinking($request->input()) ;
        $customerlinking->customer_id= $request['customer_id'];
        $customerlinking->travel_type = $request['travel_type'];
        $customerlinking->car_type_id = $request['car_type_id'];
        $customerlinking->from_latitude = $request['from_latitude'];
        $customerlinking->from_longitude = $request['from_longitude'];
        $customerlinking->to_latitude = $request['to_latitude'];
        $customerlinking->to_longitude = $request['to_longitude'];
		$customerlinking->from_location = $request['from_location'];
		$customerlinking->to_location = $request['to_location'];
		$customerlinking->ride_later_date = $ride_later_date;
		$customerlinking->ride_later_time = $ride_later_time;
        $customerlinking->save();
		
		$customerdriverlinking = new DriverCustomerLinking($request->input()) ;
        $customerdriverlinking->customer_travel_id= $customerlinking->id;
        $customerdriverlinking->driver_id = $request['driver_id'];
        $customerdriverlinking->otp = $six_digit;
		$customerdriverlinking->status = "accepted";
		$customerdriverlinking->average_per_litre = $request['average_per_litre'];
		$customerdriverlinking->driver_allowance = $request['driver_allowance'];
		$customerdriverlinking->route_direction = $request['route_direction'];
        $query = $customerdriverlinking->save();

        if(isset($request['enquiry_id']) && $request['enquiry_id']!=null){
            TempCustomerTravelLinking::find($request['enquiry_id'])
            ->update(['status'=>"Converted",'ref_id'=>$customerlinking->id]);

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
                'body'      => "You have got a Local Ride",
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
            $validator['messages'] = "Customer Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Customer";
        }
        echo json_encode($validator);
    }

    public function temp_store(Request $request)
    {
       
        $validators = Validator::make($request->all(), [
            'customer_id' => 'required',
            'local_travel_type' => 'required',
            'local_car_type_id' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }
		
			if ($request['local_travel_type'] == "ride_now")
			{
				date_default_timezone_set('Asia/Kolkata');
				$ride_later_date = date('Y-m-d');
				$ride_later_time = date('H:i:s');	
			}
			else if ($request['local_travel_type'] == "ride_later")
			{
				$ride_later_date = $request['local_ride_later_date'];
				$ride_later_time = $request['local_ride_later_time'];
			}

        $customerlinking = new TempCustomerTravelLinking($request->input()) ;
        $customerlinking->customer_id= $request['customer_id'];
        $customerlinking->travel_type = $request['local_travel_type'];
        $customerlinking->car_type_id = $request['local_car_type_id'];
        $customerlinking->from_latitude = $request['local_from_latitude'];
        $customerlinking->from_longitude = $request['local_from_longitude'];
        $customerlinking->to_latitude = $request['local_to_latitude'];
        $customerlinking->to_longitude = $request['local_to_longitude'];
		$customerlinking->from_location = $request['local_from_location'];
		$customerlinking->to_location = $request['local_to_location'];
		$customerlinking->ride_later_date = $ride_later_date;
		$customerlinking->ride_later_time = Carbon::parse($ride_later_time)->format('H:i:00');
        $query=$customerlinking->save();
		
        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Enquiry Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Enquiry";
        }echo json_encode($validator);
    }

    public function temp_update(Request $request)
    {
       
        $validators = Validator::make($request->all(), [
            'customer_id' => 'required',
            'enquiry_id' => 'required',
            'travel_type' => 'required',
            'car_type_id' => 'required'
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
				$ride_later_time = date('H:i:s');	
			}
			else if ($request['travel_type'] == "ride_later")
			{
				$ride_later_date = $request['ride_later_date'];
				$ride_later_time = $request['ride_later_time'];
			}

        $customerlinking =  TempCustomerTravelLinking::find($request['enquiry_id']);
        $customerlinking->customer_id= $request['customer_id'];
        $customerlinking->travel_type = $request['travel_type'];
        $customerlinking->car_type_id = $request['car_type_id'];
        $customerlinking->from_latitude = $request['from_latitude'];
        $customerlinking->from_longitude = $request['from_longitude'];
        $customerlinking->to_latitude = $request['to_latitude'];
        $customerlinking->to_longitude = $request['to_longitude'];
		$customerlinking->from_location = $request['from_location'];
		$customerlinking->to_location = $request['to_location'];
		$customerlinking->ride_later_date = $ride_later_date;
		$customerlinking->ride_later_time = Carbon::parse($ride_later_time)->format('H:i:00');
        $query=$customerlinking->save();
		
        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Enquiry Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Enquiry";
        }echo json_encode($validator);
    }

    public function allCustomer(Request $request)
    {
       //local ride
        $output = array('data' => array());
		
	    $customer = DB::table('customer')
            ->join('customer_travel_linking', 'customer_travel_linking.customer_id', '=', 'customer.id')
            ->join('car_types', 'car_types.id', '=', 'customer_travel_linking.car_type_id')
			->join('driver_customer_linking', 'driver_customer_linking.customer_travel_id', '=', 'customer_travel_linking.id')
			->join('driver', 'driver.id', '=', 'driver_customer_linking.driver_id')
            ->select('customer.*',
					 'driver_customer_linking.id as driver_customer_linking_id',
					 'driver_customer_linking.otp as otp',
					 'customer_travel_linking.added_by as added_by',
					 'driver_customer_linking.status as customer_travel_status',
					 'driver_customer_linking.custoemr_amount as customer_travel_amount',
					 'driver_customer_linking.cancelled_by as cancelled_by',
					 'driver_customer_linking.reason as reason',
					 'driver.first_name as driver_first_name',
					 'driver.last_name as driver_last_name',
					 'driver_customer_linking.without_coupon_amount as without_coupon_amount',
					 'driver_customer_linking.custoemr_amount as custoemr_amount',
                	 'car_types.name as car_types_name',
					 'customer_travel_linking.ride_later_date as ride_later_date',
					 'customer_travel_linking.id as ctl_id',
					 'customer_travel_linking.ride_later_time as ride_later_time',
					 'customer_travel_linking.coupon as coupon_name',
                	 'customer_travel_linking.travel_type as travel_type',
                	 'customer_travel_linking.from_location',
                	 'customer_travel_linking.to_location',
                	 'customer_travel_linking.estimated_cost',
                	 'customer_travel_linking.created_at as enq_time',
                	 'driver_customer_linking.distance_user_destination_km',
                	 'driver_customer_linking.without_coupon_amount',
                     )
			->whereNotIn('driver_customer_linking.status', ['rejected','pending'])
            ->orderBy('driver_customer_linking.id', 'DESC');
            
            if(isset($request->role) && $request->role!='1'){
                $customer=$customer->
                whereBetween('ride_later_date',[Carbon::today(), Carbon::today()->addDays(2)]);
            }
            $customer=$customer->get(); 
           
		
	//	 ->orderBy('customer.first_name', 'ASC')



        $x = 1;
        foreach ($customer as $row)
        {
			$statics = "RX1400";
			$refid =$statics.''.$row->ctl_id;
            $delete_button='';
            if($request->role=='1'){
                $delete_button='<a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem('.$row->ctl_id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>';
            }
            $actionButton = '

          <td>


 
          <a href="'.url('/').'/print_format/receipt.php?driver_car_linking_id='.$row->driver_customer_linking_id.'&&ref_id='.$refid.'"  target="_blank"  >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-print"></i>
                </button>
        </a>
		
        <a href="#"  data-toggle="modal" data-target="#modalShow" onclick="CustomerDetails('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-eye"></i>
                </button>
        </a>

           <a href="#" data-toggle="modal" data-target="#editModal" onclick="editItem('.$row->driver_customer_linking_id.')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a>'.$delete_button.'

            
</td>

            ';


            $name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->first_name.' '.$row->last_name.' </span>';
            $travel_type = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->travel_type.' </span>';
            $car_type = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->car_types_name.' </span>';

            $destination_details='<span class="badge" style="color: #000 !important;font-size: 12px;"> Start: '.$row->from_location.' <br>
            End: '.$row->to_location.'<br>
            Total KM: '.$row->distance_user_destination_km.'<br>
            Rate: '.$row->estimated_cost ?? 'N/A'.'<br>
            </span>';
			$ride_details = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Driver Name: '.$row->driver_first_name.' '.$row->driver_last_name.' <br>
				   Amount: '.$row->customer_travel_amount.'<br>
				   Status: '.$row->customer_travel_status.'<br>
				   Cancelled By: '.$row->cancelled_by.'<br>
				   Reason: '.$row->reason.'<br> </span>';

                //    $date_time = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Date: '.date('d-m-Y',strtotime($row->ride_later_date)).'<br>
				//    Time: '.$row->ride_later_time.'<br></span>';
                $date_time = date('d-m-Y',strtotime($row->ride_later_date)).' '.$row->ride_later_time;
                //    $enq_time = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Date: '.date('d-m-Y',strtotime($row->enq_time)).'<br>
				//    Time: '.date('H:i:s',strtotime($row->enq_time)).'<br></span>';
                $enq_time = date('d-m-Y',strtotime($row->enq_time)).' '.date('H:i:s',strtotime($row->enq_time));
			
			$coupon_details = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Coupon Code : '.$row->coupon_name.' <br> 
				   Amount Before Coupon: '.$row->without_coupon_amount.'<br> 
				   Final Amount: '.$row->custoemr_amount.'</span>';

            $output['data'][] = array(
				$refid,
                $name,
                $row->mobile_no,
                $travel_type,
                $car_type,
				$date_time,
				$enq_time,
				$destination_details,
				$ride_details,
				$coupon_details,
				$row->otp,
				$row->added_by,
                $actionButton,
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

	public function allCustomerRegister()
    {
        $output = array('data' => array());
        $customer = DB::table('customer')
            ->select('customer.*')
            ->orderBy('customer.first_name', 'ASC')
            ->get();

        $x = 1;
        foreach ($customer as $row)
        {
            $actionButton = '

          <td>
<!--
        <a href="#"  data-toggle="modal" data-target="#modalShow" onclick="CustomerDetails('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-eye"></i>
                </button>
        </a>  -->

           <a href="#" data-toggle="modal" data-target="#editModal" onclick="editItem('.$row->id.')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a> 
            
             <a href="#" data-toggle="modal" data-target="#removeModalBooking" onclick="removeItemBooking('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#removeModalBooking">
                    <i class="fa fa-refresh mt-0"> Approve Corporate Booking</i>
                </button>
            </a>

            <a href="#" data-toggle="modal" data-target="#modalEditCustomer" onclick="editCustomer2('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-edit mt-0"></i>
                </button>
            </a>
            <a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem('.$row->id.')">
            <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                <i class="fa fa-trash mt-0"></i>
            </button>
        </a>
</td>

            ';

            $status = $row->is_corporate_booking_accessible;
            $status = '<span class="badge badge-success"> '.$row->is_corporate_booking_accessible.' </span>';
           
            $name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->first_name.' '.$row->last_name.' </span>';



            $output['data'][] = array(
                $name,
                $row->mobile_no,
                $status,
				$row->company_name,
                $actionButton
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }


    public function showCustomer(Request $request)
    {
        $id = $request['id'];
        $customer = DB::table('customer')
            ->join('customer_travel_linking', 'customer_travel_linking.customer_id', '=', 'customer.id')
            ->join('car_types', 'car_types.id', '=', 'customer_travel_linking.car_type_id')
            ->select('customer.*',
                'car_types.name as car_types_name',
                'customer_travel_linking.from_latitude as from_latitude',
                'customer_travel_linking.from_longitude as from_longitude',
                'customer_travel_linking.to_latitude as to_latitude',
                'customer_travel_linking.travel_type as travel_type',
                'customer_travel_linking.to_longitude as to_longitude')
            ->where('customer.id',$id)
            ->get();


        $name = $customer[0]->first_name.' '.$customer[0]->last_name;

        $data= response()->json(array(
            'customer' => $customer[0],
            'full_name' => $name
        ));
        return $data;
    }

    public function editCustomer(Request $request)
    {
        $id = $request['id'];
        $customer = DB::table('customer')
            ->join('customer_travel_linking', 'customer_travel_linking.customer_id', '=', 'customer.id')
            ->join('car_types', 'car_types.id', '=', 'customer_travel_linking.car_type_id')
			->join('driver_customer_linking', 'customer_travel_linking.id', '=', 'driver_customer_linking.customer_travel_id')
            ->select('customer.*',
				'driver_customer_linking.status as driver_customer_status',
                'driver_customer_linking.distance_user_destination_km as end_reading',
                'driver_customer_linking.custoemr_amount as custoemr_amount',
				'driver_customer_linking.average_per_litre as average_per_litre',
				'driver_customer_linking.driver_allowance as driver_allowance',
				'driver_customer_linking.parking_and_tolltax as parking_and_tolltax',
				'driver_customer_linking.route_direction as route_direction',
				'customer_travel_linking.ride_later_date as ride_later_date',
				'customer_travel_linking.ride_later_time as ride_later_time',
				'customer_travel_linking.from_location as from_location',
				'customer_travel_linking.to_location as to_location',
				'driver_customer_linking.driver_id as driver_id',
                'car_types.name as car_types_name',
                'customer_travel_linking.car_type_id as car_type_id',
                'customer_travel_linking.travel_type as travel_type',
                'customer_travel_linking.from_latitude as from_latitude',
                'customer_travel_linking.from_longitude as from_longitude',
                'customer_travel_linking.to_latitude as to_latitude',
                'customer_travel_linking.to_longitude as to_longitude')
            ->where('driver_customer_linking.id',$id)
            ->get();
		

        $cars_types = CarType::all();
        foreach ($cars_types as $car)
        {
            $cars_data[] = '<option value="'.$car['id'].'" '.($customer[0]->car_type_id==$car['id']?"selected":"").'>'.$car['name'].'</option>';
        }
		
		$drivers = Driver::orderBy('first_name', 'ASC')->get();
        foreach ($drivers as $driver)
        {
            $driver_data[] = '<option value="'.$driver['id'].'" '.($customer[0]->driver_id==$driver['id']?"selected":"").'>'.$driver['first_name'].' '.$driver['last_name'].'</option>';
        }


        $travel_type[0] = '<option value="ride_now" '.($customer[0]->travel_type=='ride_now'?"selected":"").'>Ride Now</option>';
        $travel_type[1] = '<option value="ride_later" '.($customer[0]->travel_type=='ride_later'?"selected":"").'>Ride later</option>';
		
		$statuses[0] = '<option value="completed" '.($customer[0]->driver_customer_status=='completed'?"selected":"").'>Completed</option>';
        $statuses[1] = '<option value="cancelled" '.($customer[0]->driver_customer_status=='cancelled'?"selected":"").'>Cancelled</option>';
        $statuses[2] = '<option value="pending" '.($customer[0]->driver_customer_status=='pending'?"selected":"").'>Pending</option>';
        $statuses[3] = '<option value="accepted" '.($customer[0]->driver_customer_status=='accepted'?"selected":"").'>Accepted</option>';
        $statuses[4] = '<option value="rejected" '.($customer[0]->driver_customer_status=='rejected'?"selected":"").'>Rejected</option>';
        $statuses[5] = '<option value="start" '.($customer[0]->driver_customer_status=='start'?"selected":"").'>Start</option>';
		
		$old_date_timestamp = strtotime($customer[0]->ride_later_date);
		$new_date = date('Y-m-d', $old_date_timestamp);


        $data= response()->json(array(
            'customer' => $customer[0],
            'cars' => $cars_data,
            'travel' => $travel_type,
			'drivers' => $driver_data,
			'statuses' => $statuses,
			'current_date_show' => $new_date
        ));
        return $data;
    }

    public function updateCustomer(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'first_name' => 'required',
            'mobile_no' => 'required',
            'travel_type_id' => 'required',
            'car_type_id' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];

        $data = array(
            'first_name' =>$request['first_name'],
            'last_name' => $request['last_name'],
            'mobile_no' => $request['mobile_no'],
            'email_id' => $request['email_id'],
            'travel_type' =>$request['travel_type_id'],
            'car_type_id' =>$request['car_type_id'],
            'from_latitude' =>$request['from_latitude'],
            'from_longitude' =>$request['from_longitude'],
            'to_latitude' =>$request['to_latitude'],
            'to_longitude' =>$request['to_longitude'],
			'from_location' =>$request['from_location'],
			'to_location' =>$request['to_location'],
			'ride_later_date' =>$request['ride_later_date'],
			'ride_later_time' =>$request['ride_later_time'],
			'driver_id' =>$request['driver_id'],
			'average_per_litre' =>$request['average_per_litre'],
			'driver_allowance' =>$request['driver_allowance'],
			'parking_and_tolltax' =>$request['parking_and_tolltax'],
			'status' =>$request['status'],
			'distance_user_destination_km' =>$request['distance_user_destination_km'],
			'custoemr_amount' =>$request['custoemr_amount'],
			'route_direction' =>$request['route_direction']
        );
		
		
        $query = DB::table('customer')
            ->join('customer_travel_linking', 'customer_travel_linking.customer_id', '=', 'customer.id')
			->join('driver_customer_linking', 'customer_travel_linking.id', '=', 'driver_customer_linking.customer_travel_id')
            ->where('driver_customer_linking.id',$id)
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

    public function removeCustomer(Request $request)
    {
        $id = $request['customer'];
        $customer = CustomerTravelLinking::find($id)->delete();
        $driver = DriverCustomerLinking::where('customer_travel_id', $id)->delete();
     //   $customer = Customer::find($id)->delete();

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

	public function customerBooking(Request $request)
    {
        $id = $request['booking'];
        $user = Customer::select('is_corporate_booking_accessible')->where('id',$id)->first();

        if($user->is_corporate_booking_accessible == "pending")
        {
            $customer = Customer::where('id',$id)->update(['is_corporate_booking_accessible'=> "approved"]);
        }
        else
        {
            $customer = Customer::where('id',$id)->update(['is_corporate_booking_accessible'=> "pending"]);
        }

        if($customer == true) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
           // $response['success'] = false;
           // $response['messages'] = "Error while Delete!";
			$response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }

        echo json_encode( $response);

    }

    public function editCompany(Request $request)
    {
        $id = $request['id'];
        $customer = DB::table('customer')
            ->select('customer.*')
            ->where('id',$id)
            ->get();


        $data= response()->json(array(
            'customer' => $customer[0]
        ));
        return $data;
    }

    public function updateCompany(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'company_name' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];

        $data = array(
            'company_name' =>$request['company_name']
        );

        $query = DB::table('customer')
            ->where('id',$id)
            ->update($data);

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Company Data Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Company";
        }
        // close the database connection
        echo json_encode($validator);
    }


}
