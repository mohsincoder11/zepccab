<?php

namespace App\Http\Controllers;

use App\Corporate;
use App\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CorporateController extends Controller
{
    public function allCorporateCustomer()
    {
        $output = array('data' => array());
        $corporate = DB::table('corporate_booking')
            ->join('customer', 'customer.id', '=', 'corporate_booking.customer_id')
            ->join('car_types', 'car_types.id', '=', 'corporate_booking.car_type_id')
            ->leftjoin('driver_corporate_booking_linking', 'driver_corporate_booking_linking.corporate_id', '=', 'corporate_booking.id')
            ->leftjoin('driver', 'driver.id', '=', 'driver_corporate_booking_linking.driver_id')
            ->select('corporate_booking.*',
                'driver_corporate_booking_linking.driver_id as driver_id',
				'driver_corporate_booking_linking.status as driver_status',
                'driver.first_name as driver_first_name',
                'driver.last_name as driver_last_name',
                'car_types.name as car_types_name',
			    'customer.company_name as customer_company_name',
                'customer.first_name as customer_first_name',
                'customer.last_name as customer_last_name')
            ->groupBy('corporate_booking.id')
            ->orderBy('corporate_booking.id', 'DESC')
            ->get();

        $x = 1;
        foreach ($corporate as $row)
        {

			if ($row->status == 'approved')
            {
                $actionButton = '

          <td>
          
           <a title="add" href="#"  data-toggle="modal" data-target="#modalVM" onclick="AddCorporateBookingDetails('.$row->id.')">  
                        <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                            <i class="fa fa-plus"></i>
                        </button>
                    </a>
                    
          
            <a href="#"  data-toggle="modal" data-target="#modalShow" onclick="CorporateBookingDetails('.$row->id.')">  
                        <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                            <i class="fa fa-list"></i>
                        </button>
                    </a>
					
					   <a href="#" data-toggle="modal" data-target="#editCorporateData" onclick="editCorporateData('.$row->id.')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a>
                    
           
              <a title="Assign Driver" href="#" data-toggle="modal" data-target="#editModal" onclick="editItem('.$row->id.')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-exchange mt-0"></i>
                </button>
            </a>
</td>

            ';
            }

			else

			{
				$actionButton = '

          <td>
          
           <a title="add" href="#"  data-toggle="modal" data-target="#modalVM" onclick="AddCorporateBookingDetails('.$row->id.')">  
                        <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                            <i class="fa fa-plus"></i>
                        </button>
                    </a>
                    
          
            <a href="#"  data-toggle="modal" data-target="#modalShow" onclick="CorporateBookingDetails('.$row->id.')">  
                        <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                            <i class="fa fa-list"></i>
                        </button>
                    </a>
					
					   <a href="#" data-toggle="modal" data-target="#editCorporateData" onclick="editCorporateData('.$row->id.')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a>
</td>

            ';
			}

            if ($row->type == 'one_way')
            {
                $trip = '<span class="badge badge-warning"> One Way </span>';
            }
            else if ($row->type == 'round_trip')
            {
                $trip = '<span class="badge badge-warning"> Round Trip </span>';
            }

            if ($row->driver_id == NULL)
            {
                $driver = '<span class="badge badge-danger"> Not Assign </span>';
            }
            else
            {
                $driver = '<span class="badge badge-success"> '.$row->driver_first_name.' '.$row->driver_last_name.'  </span>';
            }

			$per_day_desc = wordwrap($row->per_day_desc,40,"<br>\n");
			
			$from_origin = wordwrap($row->from_origin,40,"<br>\n");
			$to_destination = wordwrap($row->to_destination,40,"<br>\n");
            $output['data'][] = array(
                $row->customer_first_name.' '.$row->customer_last_name,
                $from_origin,
                $to_destination,
                $row->car_types_name,
                $trip,
                $row->from_date.' To '.$row->to_date,
                $row->customer_company_name,
                $row->status,
                $driver,
				$per_day_desc,
				$row->per_km_desc,
                $actionButton
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

    public function EditCorporateLinkDriver(Request $request)
    {
        $id = $request['id'];
        $link = DB::table('corporate_booking')
            ->select('corporate_booking.*')
            ->where('id',$id)
            ->get();

        $data= response()->json(array(
            'link' => $link[0],
        ));
        return $data;
    }

    public function updateCorporateLinkDriver(Request $request)
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
		$status = "accepted";
        $data = array(
            'driver_id' =>$request['driver_id'],
			'status' => $status
        );
		

        if($query == true) {
            $validator['success'] = true;
            $validator['messages'] = "Link To Driver Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Link To Driver";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function CorporateBookingDetails(Request $request)
    {
        $id = $request['id'];
        $output = array('data' => array());
        $booking = DB::table('driver_corporate_booking_linking')
            ->join('corporate_booking', 'driver_corporate_booking_linking.corporate_id', '=', 'corporate_booking.id')
            ->join('driver', 'driver.id', '=', 'driver_corporate_booking_linking.driver_id')
            ->select('driver_corporate_booking_linking.*',
                'driver.first_name as driver_first_name',
                'driver.last_name as driver_last_name')
            ->where('driver_corporate_booking_linking.corporate_id',$id)
            ->orderBy('driver_corporate_booking_linking.id', 'DESC')
            ->get();

        $x = 1;
        foreach ($booking as $row)
        {
            $actionButton = '

          <td>
           <a href="#" data-toggle="modal" data-target="#editModalBookingItem" onclick="editItemBookingItem('.$row->id.')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a>

            <a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItemBookingItem('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDeleteBookingItem">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>
            </td>

            ';
            $driver = '<span class="badge badge-success"> '.$row->driver_first_name.' '.$row->driver_last_name.'  </span>';
            $output['data'][] = array(
                $driver,
                $row->date,
                $row->status,
                $row->distance_km,
                $row->desc_by_driver,
				$row->start_reading,
				$row->end_reading,
				$row->distance_km,
				$row->amount,
                $actionButton
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

    public function AddCorporateBookingDetails(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'driver_id' => 'required',
			'from_date' => 'required',
            'to_date' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
		DB::table('driver_corporate_booking_linking')
			->where('corporate_id', '=', $id)
			->delete();
		
		$from_date = $request['from_date'];
        $to_date = $request['to_date'];


		$date_from = strtotime($from_date);
        $date_to = strtotime($to_date);

        $limit = 1;
        for ($j = 0; $j < $limit; $j++)
        {
            for ($i = $date_from; $i <= $date_to; $i += 86400) {
                $multiple_date = date("Y-m-d", $i);
				$fourdigitrandom = rand(1000,9999); 
				$query = DB::table('driver_corporate_booking_linking')
            	->insert(['corporate_id' => $id,
                'driver_id' => $request['driver_id'],
                'date' => $multiple_date,
				'otp' => $fourdigitrandom,
                'status' => "accepted"]);
            }
        }
		
		$status = "approved";
		$data2 = array('status' => $status);
        DB::table('corporate_booking')
            ->where('id',$id)
            ->update($data2);
		

        if($query == true) {
            $validator['success'] = true;
            $validator['messages'] = "Data Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Data";
        }
        // close the database connection
        echo json_encode($validator);
    }

	 public function editCorporateBooking(Request $request)
    {
        $id = $request['corporate_booking_id'];
        $corporate = DB::table('driver_corporate_booking_linking')
            ->select('driver_corporate_booking_linking.*')
            ->where('id',$id)
            ->get();


        $drivers = Driver::orderBy('first_name')->get();

        foreach ($drivers as $driver)
        {
            $drivers_data[] = '<option value="'.$driver['id'].'" '.($corporate[0]->driver_id==$driver['id']?"selected":"").'>'.$driver['first_name'].' '.$driver['last_name'].'</option>';
        }


        $status[0] = '<option value="pending" '.($corporate[0]->status=='pending'?"selected":"").'>Pending</option>';
        $status[1] = '<option value="start" '.($corporate[0]->status=='start'?"selected":"").'>Start</option>';
        $status[2] = '<option value="accepted" '.($corporate[0]->status=='accepted'?"selected":"").'>Accepted</option>';
        $status[3] = '<option value="completed" '.($corporate[0]->status=='completed'?"selected":"").'>Completed</option>';
        $status[4] = '<option value="cancelled" '.($corporate[0]->status=='cancelled'?"selected":"").'>Cancelled</option>';

        $data= response()->json(array(
            'c_booking' => $corporate[0],
            'drivers' => $drivers_data,
            'status' => $status
        ));
        return $data;
    }

    public function UpdateCorporateBooking(Request $request)
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
            'driver_id' =>$request['driver_id'],
            'date' =>$request['date'],
            'status' =>$request['status'],
            'distance_km' =>$request['distance_km'],
            'amount' =>$request['amount'],
            'desc_by_driver' =>$request['desc_by_driver'],
			'start_time' =>$request['start_time'],
			'end_time' =>$request['end_time'],
			'start_reading' =>$request['start_reading'],
			'end_reading' =>$request['end_reading']
        );

        $query = DB::table('driver_corporate_booking_linking')
            ->where('id',$id)
            ->update($data);

        if($query == true) {
            $validator['success'] = true;
            $validator['messages'] = "Corporate Booking Data Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Corporate Booking Data";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeCorporateBooking(Request $request)
    {
        $id = $request['remove_booking'];
        $corporate = DB::table('driver_corporate_booking_linking')->where('id', '=', $id)->delete();

        if($corporate == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }

	public function editCorporateData(Request $request)
    {
        $id = $request['corporate_data_id'];
        $corporate = DB::table('corporate_booking')
            ->select('corporate_booking.*')
            ->where('id',$id)
            ->get();

        $status[0] = '<option value="pending" '.($corporate[0]->status=='pending'?"selected":"").'>Pending</option>';
        $status[1] = '<option value="approved" '.($corporate[0]->status=='approved'?"selected":"").'>Approved</option>';
        $status[2] = '<option value="declined" '.($corporate[0]->status=='declined'?"selected":"").'>Cancelled</option>';
        $status[3] = '<option value="completed" '.($corporate[0]->status=='completed'?"selected":"").'>Completed</option>';

        $data= response()->json(array(
            'corporate_data' => $corporate[0],
            'status_data' => $status
        ));
        return $data;
    }

    public function UpdateCorporateData(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'status' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
        if($request['status'] == 'approved')
        {
            $get_date = DB::table('corporate_booking')
                ->select('corporate_booking.*')
                ->where('id',$id)
                ->get();
            $from_date = $get_date[0]->from_date;
            $to_date = $get_date[0]->to_date;

            $date_from = strtotime($from_date);
            $date_to = strtotime($to_date);
            $limit = 1;
            for ($j = 0; $j < $limit; $j++){
                for ($i = $date_from; $i <= $date_to; $i += 86400) {
                    $multiple_date = date("Y-m-d", $i);
					$fourdigitrandom = rand(1000,9999); 
                    $query = DB::table('driver_corporate_booking_linking')
                        ->insert(['corporate_id' => $id,
                            'driver_id' => NULL,
                            'date' => $multiple_date,
							'otp' => $fourdigitrandom,
                            'status' => "pending"]);
                }
            }
            $data = array(
                'status' =>$request['status'],
                'perkm_amount' =>$request['perkm_amount'],
                'per_day_amount' =>$request['per_day_amount'],
                'per_day_desc' =>$request['per_day_desc'],
                'per_km_desc' =>$request['per_km_desc'],
                'waiting_charge' =>$request['waiting_charge'],
                'toll_n_parking_desc' =>$request['toll_n_parking_desc'],
                'night_hault_desc' =>$request['night_hault_desc']
            );
            $query1 = DB::table('corporate_booking')
                ->where('id',$id)
                ->update($data);
        }

        else
        {
            $data = array(
                'status' =>$request['status'],
                'perkm_amount' =>$request['perkm_amount'],
                'per_day_amount' =>$request['per_day_amount'],
                'per_day_desc' =>$request['per_day_desc'],
                'per_km_desc' =>$request['per_km_desc'],
                'waiting_charge' =>$request['waiting_charge'],
                'toll_n_parking_desc' =>$request['toll_n_parking_desc'],
                'night_hault_desc' =>$request['night_hault_desc']
            );
            $query = DB::table('corporate_booking')
                ->where('id',$id)
                ->update($data);
        }



        if($query == true) {
            $validator['success'] = true;
            $validator['messages'] = "Corporate Data Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Corporate Data";
        }
        // close the database connection
        echo json_encode($validator);
    }
}
