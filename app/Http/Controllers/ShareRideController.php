<?php

namespace App\Http\Controllers;

use App\CarType;
use App\CustomerTravelLinking;
use App\Rental;
use App\RideCustomerLinking;
use App\ShareRide;
use App\ShareRideCityLinking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShareRideController extends Controller
{
    public function allShare()
    {
        $output = array('data' => array());
        $share = DB::table('share_ride')
			->join('customer', 'customer.id', '=', 'share_ride.customer_id')
            ->select('share_ride.*',
                'customer.first_name as first_name',
                'customer.last_name as last_name',
				'customer.mobile_no as mobile_no')
            ->orderBy('id', 'DESC')
            ->get();

        

        $x = 1;
        foreach ($share as $row)
        {
			$name = $row->first_name.' '.$row->last_name;
			
			$statics = "RX1400";
			$refid =$statics.''.$row->id;
            $actionButton = '

          <td>
          
          <a href="#"  data-toggle="modal" data-target="#modalShow" onclick="ShareRideDetails('.$row->id.')">  
                        <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                            <i class="fa fa-list"></i>
                        </button>
                    </a>
                    

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
			
			<a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItemStatus('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDeleteStatus">
                    <i class="fa fa-refresh mt-0"></i>
                </button>
            </a>
</td>

            ';

            $from_origin = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->from_origin.' </span>';
            $to_destination = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->to_destination.' </span>';
            $amount=$this->getshare_ride_amount($row->id);

            if ($row->pickup_time != null)
            {
                $pickup_time  = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->pickup_time.' </span>';
            }
            else
            {
                $pickup_time  = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Any Time </span>';
            }

            $travel_date  = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->travel_date.' </span>';
			
			 if ($row->available == 1)
            {
                $status = '<span class="badge badge-success"> Done </span>';
            }
            else if($row->available == 0)
            {
                $status = '<span class="badge badge-danger"> Pending </span>';
            }
			
			$ride_status = '<span class="badge badge-danger" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 10px;"> '.$row->status.' </span>';


            $output['data'][] = array(
				$refid,
				$name,
				$row->mobile_no,
                $from_origin,
                $to_destination,
                $amount,
                $travel_date,
                $pickup_time,
                $row->car_type_name,
                $row->vacancy,
				$status,
				$ride_status,
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
            'from_origin' => 'required',
            'to_destination' => 'required',
            'travel_date' => 'required',
            'car_type' => 'required',
            'vacancy' => 'required',
            'customer_id' => 'required',
            'charges_per_person' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $travel_date = Carbon::parse($request['travel_date'],'Asia/Kolkata')->format('Y-m-d');
        $share = new ShareRide($request->input());
        $share->customer_id = $request['customer_id'];
        $share->from_origin = $request['from_origin'];
        $share->to_destination = $request['to_destination'];
        $share->travel_date = $travel_date;
        $share->pickup_time = $request['pickup_time'];
        $share->car_type = $request['car_type'];
        $share->vacancy = $request['vacancy'];
        $query =$share->save();

        $ridecustomer = new RideCustomerLinking($request->input()) ;
        $ridecustomer->share_ride_id= $share->id;
        $ridecustomer->customer_id = $request['customer_id'];
        $ridecustomer->consession = $request['consession'];
        $ridecustomer->save();

        $city_name = $request['city_name'];
        $charges_per_person = $request['charges_per_person'];
        $limit = count($charges_per_person);
        for ($i = 0; $i < $limit; $i++)
        {
            $ride_city = new ShareRideCityLinking($request->input()) ;
            $ride_city->share_ride_id= $share->id;
            $ride_city->city_name = $city_name[$i];
            $ride_city->charges_per_person = $charges_per_person[$i];
            $ride_city->save();
        }

        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Share Ride Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Share Ride";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeShare(Request $request)
    {
        $id = $request['share'];
        // ShareRideCityLinking::where('share_ride_id', $id)->delete();
       // RideCustomerLinking::where('share_ride_id', $id)->delete();
        $share = ShareRide::find($id)->delete();

        if($share == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }
	
	public function removeShareStatus(Request $request)
    {
		$id = $request['share_status'];
        $user = ShareRide::select('available')->where('id',$id)->first();

        if ($user->available)
        {
            $share = ShareRide::where('id',$id)->update(['available'=> false, 'status'=> 'pending']);
					// ShareRide::where('id',$id)->update(['status'=> 'accepted']);
        }
        else
        {
            $share = ShareRide::where('id',$id)->update(['available'=> true, 'status'=> 'accepted']);
				//	 ShareRide::where('id',$id)->update(['status'=> 'accepted']);
        }
		
        if($share == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }

    public function editShare(Request $request)
    {
        $id = $request['id'];
        $share = DB::table('share_ride')
            ->select('share_ride.*')
            ->where('share_ride.id',$id)
            ->get();



        $data= response()->json(array(
            'share' => $share[0]
        ));
        return $data;
    }

    public function updateShare(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'from_origin' => 'required',
            'to_destination' => 'required',
            'car_type' => 'required',
            'vacancy' => 'required',
            'charges_per_person' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
        $data = array(
            'from_origin' =>$request['from_origin'],
            'to_destination' => $request['to_destination'],
            'car_type' => $request['car_type'],
            'vacancy' => $request['vacancy'],
            'charges_per_person' => $request['charges_per_person']
        );

        $query = DB::table('share_ride')->where('id',$id)->update($data);

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Share Ride Data Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Share Ride";
        }
        // close the database connection
        echo json_encode($validator);
    }
 
	
	public function showShareRide(Request $request)
    {
        $id = $request['id'];
		$output = array('data' => array());
		$query="SELECT DISTINCT src.`customer_id`,CONCAT(c.`first_name`,c.`last_name`) AS customer_name, c.`mobile_no` AS mobile ,
		sr.`from_origin` AS from_origin ,
sr.`to_destination` AS to_destination ,
srcl.`city_name`, srcl.`charges_per_person` 
FROM `share_ride` sr
INNER JOIN `share_ride_city_linking` srcl
ON srcl.`share_ride_id` = sr.`id`
INNER JOIN `share_ride_customer_linking` src
ON src.`srcl_id` = srcl.id
INNER JOIN `customer` c
ON c.`id` = src.`customer_id`
WHERE sr.id = $id";
        $share = DB::select(DB::raw($query));
		

        $x = 1;
        foreach ($share as $row)
        {
            $output['data'][] = array(
                $row->customer_name,
				$row->mobile,
				$row->city_name,
				$row->charges_per_person,
				$row->from_origin,
				$row->to_destination
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

    function getshare_ride_amount($id){
        $amount=DB::table('share_ride_city_linking')->where('share_ride_id',$id)->sum('charges_per_person');
        return $amount;
    }
}
