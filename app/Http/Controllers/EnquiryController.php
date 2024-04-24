<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enquiry;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Customer;
use App\TempCustomerPackageLinking;
use App\TempOutStation;
use App\TempCustomerTravelLinking;


class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'customer_id' => 'required',
            'number_of_days' => 'required',
            'rate' => 'required',
            'ride_type' => 'required',
            'cartype_id'=>'required',
            'date' => 'required',
            'time' => 'required',
			'from_location' => 'required',
            'to_location' => 'required',
           
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }
		
         
        $rental = new Enquiry($request->input());
        $rental->from_origin = $request['from_location'];
        $rental->to_destination = $request['to_location'];
        $rental->from_lat = $request['from_latitude'];
		$rental->from_lng = $request['from_longitude'];
        $rental->to_lat = $request['to_latitude'];
		$rental->to_lng = $request['to_longitude'];
		$rental->customer_id = $request['customer_id'];
		$rental->number_of_days = $request['number_of_days'];
		$rental->rate = $request['rate'];
		$rental->ride_type = $request['ride_type'];
		$rental->cartype_id = $request['cartype_id'];
		$rental->date = $request['date'];
		$rental->time = $request['time'];
        
        $query =$rental->save();
		
        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Enquiry Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Enquiry";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function allEnquiry(Request $request)
    {
       //local ride
        $output = array('data' => array());
		
		
	    $customer = DB::table('enquiries')
            ->join('car_types', 'car_types.id', '=', 'enquiries.cartype_id')
			->leftjoin('customer', 'customer.id', '=', 'enquiries.customer_id')
            ->select(
                    'customer.first_name','customer.last_name','customer.mobile_no',
					'car_types.name as car_types_name',
                	 'enquiries.*',
                
                     )
            ->orderBy('enquiries.id', 'DESC');
            
            if(isset($request->role) && $request->role!='1'){
                $customer=$customer->
                whereBetween('date',[Carbon::today(), Carbon::today()->addDays(2)]);
            }
            $customer=$customer->get(); 
           
		
	//	 ->orderBy('customer.first_name', 'ASC')



        $x = 1;
        foreach ($customer as $row)
        {
			$statics = "RX1400";
			$refid =$statics.''.$row->id;
            $delete_button='';
            if($request->role=='1'){
                $delete_button='<a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>';
            }
            $actionButton = '
          <td>	
           
          <a href="#" data-toggle="modal" data-target="#editModal" onclick="editItem('.$row->id.')" >
          <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
              <i class="fa fa-pencil mt-0"></i>
          </button>
      </a> <a href="#" onclick="ConvertItem('.$row->id.')" >
      <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 ConvertEnquiry" id="'.$row->id.'" ride_type="'.$row->ride_type.'" >
          <i class="fa fa-link mt-0"></i>
      </button>
  </a>'.$delete_button.'            
            </td>';

            $name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->first_name.' '.$row->last_name.' </span>';
          
            $car_type = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->car_types_name.' </span>';

            $destination_details='<span class="badge" style="color: #000 !important;font-size: 12px;"> Start: '.$row->from_origin.' <br>
            End: '.$row->to_destination.'<br>
          
            </span>';
			

			$date_time = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Date: '.$row->date.'<br>
				   Time: '.$row->time.'<br></span>';
                     $ride_type='Local';
                   if($row->ride_type=='cpl')
                     $ride_type='Rental';
                   if($row->ride_type=='outstation')
                     $ride_type='OutStation';

                   
			

            $output['data'][] = array(
				$refid,
                $name,
                $row->mobile_no,
                $ride_type,
                $car_type,
				$date_time,
                $row->number_of_days,
                $row->rate,
				$destination_details,
				'Admin',
                $row->status==0 ? 'Pending' : 'Converted',

                $actionButton,
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

    public function removeEnquiry(Request $request)
    {
        $id = $request['enquiry_id'];
        if($request['ride_type']=='1'){
            $enquiry=TempCustomerTravelLinking::where('id',$id)->delete();
        }
        else if($request['ride_type']=='2'){
       $enquiry=TempCustomerPackageLinking::where('id',$id)->delete();
        }
        else if($request['ride_type']=='3'){
           $enquiry= TempOutStation::where('id',$id)->delete();
        }

        if($enquiry == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }

    public function editEnquiry(Request $request){
        if($request['ride_type']=='Local'){
            $enquiry=TempCustomerTravelLinking:: join('car_types', 'car_types.id', '=', 'temp_customer_travel_linking.car_type_id')
        ->leftjoin('customer', 'customer.id', '=', 'temp_customer_travel_linking.customer_id')
        ->select(
                'customer.first_name','customer.last_name','customer.mobile_no',
                'car_types.name as car_types_name',
                 'temp_customer_travel_linking.*',
            
                 )->where('temp_customer_travel_linking.id',$request['enquiry_id'])->first();
        }
        else if($request['ride_type']=='Rental'){
       $enquiry= DB::table('package_cartype_linking')
       ->join('temp_customer_package_linking', 'temp_customer_package_linking.pctl_id', '=', 'package_cartype_linking.id')
       ->select(
                 'temp_customer_package_linking.travel_type as travel_type',
           'temp_customer_package_linking.ride_later_date as ride_later_date',
           'temp_customer_package_linking.ride_later_time as ride_later_time',
           'temp_customer_package_linking.customer_id as customer_id',
           'temp_customer_package_linking.pick_location as pick_location',
           'temp_customer_package_linking.start_time as start_time',
           'temp_customer_package_linking.end_time as end_time',
           'temp_customer_package_linking.latitude',
           'temp_customer_package_linking.longitude',

           'temp_customer_package_linking.city_id',
           'temp_customer_package_linking.amount',
           'temp_customer_package_linking.distance_driver_user_km',
           'temp_customer_package_linking.distance_user_destination_km',
           'temp_customer_package_linking.custoemr_amount',
           'temp_customer_package_linking.cartype_id',
           'temp_customer_package_linking.pctl_id',
           

           'temp_customer_package_linking.id as temp_id')
        ->where('temp_customer_package_linking.id',$request['enquiry_id'])->first();
        }
        else if($request['ride_type']=='Outstation'){
           $enquiry= TempOutStation:: join('car_types', 'car_types.id', '=', 'temp_outstation.car_type_id')
        ->leftjoin('customer', 'customer.id', '=', 'temp_outstation.customer_id')
        ->select(
                'customer.first_name','customer.last_name','customer.mobile_no',
                'car_types.name as car_types_name',
                 'temp_outstation.*',
            
                 )->where('temp_outstation.id',$request['enquiry_id'])->first();
        }

       
        $data= response()->json(array(
            'enquiry' => $enquiry),
        );
        return $data;
    }

    
    public function updateEnquiry(Request $request)
    {
    $validators = Validator::make($request->all(), [
            'customer_id' => 'required',
            'number_of_days' => 'required',
            'rate' => 'required',
            'ride_type' => 'required',
            'cartype_id'=>'required',
            'date' => 'required',
            'time' => 'required',
			'from_location' => 'required',
            'to_location' => 'required',
           
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }
		
         
        $rental = Enquiry::find($request->enquiry_id);
        $rental->from_origin = $request['from_location'];
        $rental->to_destination = $request['to_location'];
        $rental->from_lat = $request['from_latitude'];
		$rental->from_lng = $request['from_longitude'];
        $rental->to_lat = $request['to_latitude'];
		$rental->to_lng = $request['to_longitude'];
		$rental->customer_id = $request['customer_id'];
		$rental->number_of_days = $request['number_of_days'];
		$rental->rate = $request['rate'];
		$rental->ride_type = $request['ride_type'];
		$rental->cartype_id = $request['cartype_id'];
		$rental->date = $request['date'];
		$rental->time = $request['time'];
        
        $query =$rental->save();
		
        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Enquiry Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Enquiry";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function convertEnquiry(Request $request)
    {
        $enquiry = Enquiry::find($request['enquiry_id']);
        if($enquiry->ride_type='ctl'){
            
        }
        else if($enquiry->ride_type='cpl'){
            
        }
        else{

        }

    }
}
