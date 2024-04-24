<?php

namespace App\Http\Controllers;

use App\CarType;
use App\Company;
use App\Customer;
use App\Driver;
use App\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Enquiry;
use App\OutstationStop;
use App\PackageMaster;
use App\TempOutStation;
use App\Vendor;

class RentalController extends Controller
{
    public function allRental(Request $request)
    {
        $output = array('data' => array());
        $rental = DB::table('outstation')
            ->leftJoin('car_types', 'car_types.id', '=', 'outstation.car_type_id')
            ->leftJoin('customer', 'customer.id', '=', 'outstation.customer_id')
            ->leftJoin('driver', 'driver.id', '=', 'outstation.driver_id')
            ->select(
                'outstation.*',
                'customer.first_name as first_name',
                'customer.last_name as last_name',
                'customer.mobile_no as mobile_no',
                'driver.first_name as driver_first_name',
                'driver.mobile_no as driver_mobile_no',
                'driver.last_name as driver_last_name',
                'car_types.name as car_type_name'
            )
            ->orderBy('outstation.id', 'DESC');
        if (isset($request->role) && $request->role != '1') {
            $rental = $rental->whereBetween('outstation.created_at', [Carbon::today(), Carbon::today()->addDays(2)]);
        }
        if(isset($request->from_date_filter) && $request->from_date_filter!=null && isset($request->to_date_filter) && $request->to_date_filter!=null){
            $rental=$rental->
            whereBetween('outstation.created_at',[$request->from_date_filter, $request->to_date_filter]);
        }
        if(isset($request->outstation_ride_type) && $request->outstation_ride_type!='All'){
            $rental=$rental->where('outstation_ride_type',$request->outstation_ride_type);
        }
        $rental = $rental->get();

        $x = 1;
        foreach ($rental as $row) {
            $statics = "RX1400";
            $refid = $statics . '' . $row->id;

            if ($row->driver_id != null) {

                if ($row->per_day_amount != NULL) {
                    $pdf = '
				<td>
 <a href="' . url('/') . '/print_format/outstation.php?outstation_id=' . $row->id . '&&ref_id=' . $refid . '"  target="_blank"  >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-print"></i>
                </button>
				</a>
				</td>
				';
                } elseif ($row->fixed_rate != NULL) {
                    $pdf = '
				<td>
 <a href="' . url('/') . '/print_format/outstation3.php?outstation_id=' . $row->id . '&&ref_id=' . $refid . '"  target="_blank"  >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-print"></i>
                </button>
				</a>
				</td>
				';
                } else {
                    $pdf = '
				<td>
 <a href="' . url('/') . '/print_format/outstation2.php?outstation_id=' . $row->id . '&&ref_id=' . $refid . '"  target="_blank"  >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-print"></i>
                </button>
				</a>
				</td>
				';
                }



                $delete_button = '';
                if ($request->role == '1') {
                    $delete_button = '<a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem(' . $row->id . ')">
                    <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                        <i class="fa fa-trash mt-0"></i>
                    </button>
                </a>';
                }
                $actionButton = '
            <a title="Change Driver" href="#" data-toggle="modal" data-target="#editModal" onclick="editItem(' . $row->id . ')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-exchange mt-0"></i>
                </button>
            </a>

	    <a title="Edit Details" href="#" data-toggle="modal" data-target="#editModalDetails" onclick="editItemDetails(' . $row->id . ')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a>' . $delete_button . '

            
            </td>

            ';
            } else {

                if ($row->per_day_amount != NULL) {
                    $pdf = '
				<td>
<a href="' . url('/') . '/print_format/outstation.php?outstation_id=' . $row->id . '&&ref_id=' . $refid . '"  target="_blank"  >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-print"></i>
                </button>
				</a>
				</td>
				';
                } elseif ($row->fixed_rate != NULL) {
                    $pdf = '
				<td>
 <a href="' . url('/') . '/print_format/outstation3.php?outstation_id=' . $row->id . '&&ref_id=' . $refid . '"  target="_blank"  >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-print"></i>
                </button>
				</a>
				</td>
				';
                } else {
                    $pdf = '
				<td>
 <a href="' . url('/') . '/print_format/outstation2.php?outstation_id=' . $row->id . '&&ref_id=' . $refid . '"  target="_blank"  >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-print"></i>
                </button>
				</a>
				</td>
				';
                }

                $actionButton = '
          <td>
		  
		 <a href="' . url('/') . '/print_format/outstation.php?outstation_id=' . $row->id . '&&perkm_amount=' . $row->perkm_amount . '&&ref_id=' . $refid . '"  target="_blank"  >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                    <i class="fa fa-print"></i>
                </button>
				</a>
				

            <a title="Link to Driver" href="#" data-toggle="modal" data-target="#editModal" onclick="editItem(' . $row->id . ')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-link mt-0"></i>
                </button>
            </a>
			
			    <a title="Edit Details" href="#" data-toggle="modal" data-target="#editModalDetails" onclick="editItemDetails(' . $row->id . ')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a>

            <a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem(' . $row->id . ')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>
            </td>

    	    ';
            }




            $from_origin = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> ' . $row->from_origin . ' </span>';
            $to_destination = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> ' . $row->to_destination . ' </span>';

            if ($row->from_time != null) {
                $time = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> ' . $row->from_time . ' To ' . $row->to_time . ' </span>';
            } else {
                $time = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Any Time </span>';
            }

            if ($row->type == 'one_way') {
                $type = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> One Way </span>';
            } else if ($row->type == 'round_trip') {
                $type = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Round Trip </span>';
            } else {
                $type = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> No Type </span>';
            }


            if ($row->driver_id != null) {
                $driver_link = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> ' . $row->driver_first_name . ' ' . $row->driver_last_name . ' <br>
                <label style="padding:5px 10px 0 10px">
                ' . $row->driver_mobile_no . '</label></span>';
            } else {
                $driver_link = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Driver Not Link </span>';
            }

            $coupon_details = '<span class="badge badge-warning" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Coupon Code : ' . $row->coupon . ' <br> 
				   Amount Before Coupon: ' . $row->without_coupon_amount . '<br> 
				   Final Amount: ' . $row->amount . '</span>';

            if ($row->driver_id != NULL) {
                $driver_name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> ' . $row->driver_first_name . ' ' . $row->driver_last_name . ' </span>';
            } else {
                $driver_name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Driver Not Available </span>';
            }
            $outstation_stops = DB::table('outstation_stops')
                ->select('location')
                ->where('outstation_id', $row->id)
                ->orderBy('id','asc')
                ->get();
            $stops = ''; // Initialize an empty string to store the concatenated locations

            if ($outstation_stops->isEmpty()) {
                $stops = 'N/A';
            } else {
                foreach ($outstation_stops as $key => $os) {
                    $stops .= '<b style="font-weight:bold !important">Stop: ' . ($key + 1) . '</b> ' . $os->location . ',<br> '; // Concatenate each location with a comma and space
                }
            }
            $company_name='N/A';
            $vendor_name='N/A';
            
            if(isset($row->company_id)){
                $company_name=Company::find($row->company_id)->company_name ?? '';
            }
            if(isset($row->vendor_id)){
                $vendor_name=Vendor::find($row->vendor_id)->vendor_name ?? '';
            }
            $output['data'][] = array(
                $refid,
                date('d-m-Y', strtotime($row->date)),
                date('d-m-Y H:i:s', strtotime($row->created_at)),

                $row->first_name . ' ' . $row->last_name,
                // $driver_name,
                $row->mobile_no,
                $from_origin,
                $stops,
                $to_destination,
                $row->distance,
                $company_name,
                $vendor_name,
                $row->car_type_name,
                $row->days,
                $type,
                $time,
                $driver_link,
                $row->amount,
                $row->otp,
                $row->status,
                $row->perkm_amount,
                $row->per_day_amount,
                $row->per_day_desc,
                $row->per_km_desc,
                $row->waiting_charge,
                $row->toll_n_parking_desc,
                $row->night_hault_desc,
                $row->fixed_rate,
                $coupon_details,
                $pdf,
                $actionButton,
            );
            $x++;
        }

        $data = response()->json($output);
        return $data;
    }

    public function store(Request $request)
    {

        $validators = Validator::make($request->all(), [
            'customer_id' => 'required',
            'from_origin' => 'required',
            'to_destination' => 'required',
            'driver_id' => 'required',
            'car_type_id' => 'required'
        ]);

        if ($validators->fails()) {
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }


        $customer_mobile = DB::table('customer')
            ->select('customer.*')
            ->where('id', $request['customer_id'])
            ->get();

        $mobile_number = $customer_mobile[0]->mobile_no;
        $six_digit = mt_rand(1000, 9999);
        if (isset($mobile_number) && $mobile_number != null)
            $send = app('App\Http\Controllers\SendSmsController')->send_sms($six_digit, $mobile_number);

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
        $rideLaterDate = Carbon::parse($request->input('date'), 'Asia/Kolkata')->endOfDay();
        if ($rideLaterDate->isPast()) {
            $validator['success'] = false;
            $validator['messages'] = 'Past date is not allowed.';
            return json_encode($validator);
        }

        $rental = new Rental($request->input());
        $rental->from_origin = $request['from_origin'];
        $rental->to_destination = $request['to_destination'];
        $rental->car_type_id = $request['car_type_id'];
        $rental->days = $request['days'];
        $rental->from_time = $request['from_time'];
        $rental->to_time = $request['to_time'];
        $rental->customer_id = $request['customer_id'];
        $rental->type = $request['type'];
        $rental->outstation_ride_type = $request['outstation_ride_type'];
        $rental->company_id = $request['company_id'];
        $rental->vendor_id = $request['vendor_id'];
        $rental->package_id = $request['package_id'];
        $rental->perkm_amount = $request['perkm_amount'];
        $rental->per_day_amount = $request['per_day_amount'];
        $rental->per_day_desc = $request['per_day_desc'];
        $rental->per_km_desc = $request['per_km_desc'];
        $rental->waiting_charge = $request['waiting_charge'];
        $rental->toll_n_parking_desc = $request['toll_n_parking_desc'];
        $rental->night_hault_desc = $request['night_hault_desc'];
        $rental->from_lat = $request['from_lat'];
        $rental->from_lng = $request['from_lng'];
        $rental->driver_id = $request['driver_id'];
        $rental->otp = $six_digit;
        $rental->date = $request['date'];
        $rental->fixed_rate = $request['fixed_rate'];
        $query = $rental->save();

        if (!empty($request['location'])) {
            for ($i = 0; $i < count($request['location']); $i++) {
                $outstationStop = new OutstationStop();
                $outstationStop->outstation_id = $rental->id;
                $outstationStop->location = $request['location'][$i];
                $outstationStop->lat = $request['location_lat'][$i];
                $outstationStop->lng = $request['location_lng'][$i];
                $outstationStop->save();
            }
        }

        if (isset($request['enquiry_id']) && $request['enquiry_id'] != null) {
            TempOutStation::find($request['enquiry_id'])
                ->update(['status' => "Converted", 'ref_id' => $rental->id]);
        }

        if ($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "OUT STATION Added successfully";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding OUT STATION";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function get_pacakge_data(Request $request)
    {
        $drivers[] = '<option disabled selected>Select Driver</option>';

        if ($request->package_type == 'Company') {
            $package_ids = Company::find($request->id);
            $drivers_data = Driver::select('id', 'first_name', 'last_name')->get();
        } else {
            $package_ids = Vendor::find($request->id);
            $drivers_data = Driver::where('vendor_id', $request->id)->select('id', 'first_name', 'last_name')->get();
        }
        foreach ($drivers_data as $index => $driver) {
            $drivers[] = '<option value="' . $driver->id . '">' . $driver->first_name . ' ' . $driver->last_name . '</option>';
        }

        $packages = PackageMaster::where('package_type', $request->package_type)
            ->whereIn('id', $package_ids->package_ids)
            ->orderBy('package_title')
            ->get();

        // Reset output array before populating
        $output[] = '<option disabled selected>Select Package</option>';
        foreach ($packages as $index => $package) {
            $output[] = '<option value="' . $package->id . '">' . $package->package_title . '</option>';
        }

        echo json_encode([
            'packages' => $output,
            'drivers' => $drivers
        ]);
    }

    public function get_all_drivers(Request $request){
        $drivers_data = Driver::select('id', 'first_name', 'last_name')->get();
        $drivers[] = '<option disabled selected>Select Driver</option>';

        foreach ($drivers_data as $index => $driver) {
                   $drivers[] = '<option value="' . $driver->id . '">' . $driver->first_name . ' ' . $driver->last_name . '</option>';
               }
        echo json_encode([
                   'drivers' => $drivers
               ]);
    }

    public function get_pacakge_info(Request $request)
    {
        $packages = PackageMaster::find($request->id);

        return json_encode($packages);
    }

    public function temp_store(Request $request)
    {

        $validators = Validator::make($request->all(), [
            'customer_id' => 'required',
            'outstation_from_origin' => 'required',
            'outstation_to_destination' => 'required',
            'outstation_car_type_id' => 'required'
        ]);

        if ($validators->fails()) {
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }
        $rideLaterDate = Carbon::parse($request->input('outstation_date'), 'Asia/Kolkata')->endOfDay();
        if ($rideLaterDate->isPast()) {
            $validator['success'] = false;
            $validator['messages'] = 'Past date is not allowed.';
            return json_encode($validator);
        }
        $rental = new TempOutStation($request->input());
        $rental->from_origin = $request['outstation_from_origin'];
        $rental->to_destination = $request['outstation_to_destination'];
        $rental->car_type_id = $request['outstation_car_type_id'];
        $rental->days = $request['outstation_days'];
        $rental->from_time = $request['outstation_from_time'];
        $rental->to_time = $request['outstation_to_time'];
        $rental->customer_id = $request['customer_id'];
        $rental->type = $request['outstation_type'];
        $rental->perkm_amount = $request['outstation_perkm_amount'];
        $rental->per_day_amount = $request['outstation_per_day_amount'];
        $rental->per_day_desc = $request['outstation_per_day_desc'];
        $rental->per_km_desc = $request['outstation_per_km_desc'];
        $rental->waiting_charge = $request['outstation_waiting_charge'];
        $rental->toll_n_parking_desc = $request['outstation_toll_n_parking_desc'];
        $rental->night_hault_desc = $request['outstation_night_hault_desc'];
        $rental->from_lat = $request['outstation_from_lat'];
        $rental->from_lng = $request['outstation_from_lng'];
        $rental->otp = 000000;
        $rental->date = $request['outstation_date'];
        $rental->fixed_rate = $request['outstation_fixed_rate'];
        $query = $rental->save();

        if ($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Enquiry Added successfully";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Enquiry";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function tempupdateRental(Request $request)
    {

        $validators = Validator::make($request->all(), [
            'customer_id' => 'required',
            'from_origin' => 'required',
            'to_destination' => 'required',
            'car_type_id' => 'required'
        ]);

        if ($validators->fails()) {
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }
        $rideLaterDate = Carbon::parse($request->input('date'), 'Asia/Kolkata')->endOfDay();
        if ($rideLaterDate->isPast()) {
            $validator['success'] = false;
            $validator['messages'] = 'Past date is not allowed.';
            return json_encode($validator);
        }
        $rental = TempOutStation::find($request['enquiry_id']);
        $rental->from_origin = $request['from_origin'];
        $rental->to_destination = $request['to_destination'];
        $rental->car_type_id = $request['car_type_id'];
        $rental->days = $request['days'];
        $rental->from_time = $request['from_time'];
        $rental->to_time = $request['to_time'];
        $rental->customer_id = $request['customer_id'];
        $rental->type = $request['type'];
        $rental->perkm_amount = $request['perkm_amount'];
        $rental->per_day_amount = $request['per_day_amount'];
        $rental->per_day_desc = $request['per_day_desc'];
        $rental->per_km_desc = $request['per_km_desc'];
        $rental->waiting_charge = $request['waiting_charge'];
        $rental->toll_n_parking_desc = $request['toll_n_parking_desc'];
        $rental->night_hault_desc = $request['night_hault_desc'];
        $rental->from_lat = $request['from_lat'];
        $rental->from_lng = $request['from_lng'];
        $rental->otp = 000000;
        $rental->date = $request['date'];
        $rental->fixed_rate = $request['fixed_rate'];
        $query = $rental->save();

        if ($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Enquiry Updated successfully";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Enquiry";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeRental(Request $request)
    {
        $id = $request['rental'];
        $rental = Rental::find($id)->delete();

        if ($rental == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        } else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode($response);
    }

    public function getAllCustomer()
    {
        $output = array();
        $customers = Customer::orderBy('first_name')->get();

        foreach ($customers as $index => $company) {
            $output[0] = ' <option disabled>Select Customer</option>';
            $output[] = '<option value="' . $company['id'] . '">' . $company['first_name'] . ' ' . $company['last_name'] . ' ' . $company['mobile_no'] . '</option>';
        }
        return json_encode($output);
    }

    public function addCustomerRental(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'first_name' => 'required',
            'mobile_no' => 'required|unique:customer'
        ]);

        if ($validators->fails()) {
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $rental_cust = new Customer($request->input());
        $rental_cust->first_name = $request['first_name'] . ' ' . $request['last_name'];
        $rental_cust->mobile_no = $request['mobile_no'];
        $rental_cust->email_id = $request['email_id'];
        $rental_cust->id_proof = $request['id_proof'];
        $rental_cust->password = '25d55ad283aa400af464c76d713c07ad'; //this line added for default 12345678 password

        $query = $rental_cust->save();

        if ($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Customer Added successfully";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Customer";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function editLinkDriver(Request $request)
    {
        $id = $request['id'];
        $link = DB::table('outstation')
            ->select('outstation.*')
            ->where('id', $id)
            ->get();

        $data = response()->json(array(
            'link' => $link[0],
        ));
        return $data;
    }

    public function updateLinkDriver(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'driver_id' => 'required'
        ]);

        if ($validators->fails()) {
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
        $data = array(
            'driver_id' => $request['driver_id']
        );

        $query = DB::table('outstation')
            ->where('id', $id)
            ->update($data);

        $get_data = DB::table('outstation')
            ->where('id', $id)
            ->get();
        $customer_id = $get_data[0]->customer_id;
        $driver_id = $get_data[0]->driver_id;

        $get_customer_fcm = DB::table('customer')
            ->where('id', $customer_id)
            ->get();
        $customer_fcm = $get_customer_fcm[0]->fcmToken;

        $get_driver_fcm = DB::table('driver')
            ->where('id', $driver_id)
            ->get();
        $driver_fcm = $get_driver_fcm[0]->fcmToken;
        define('API_ACCESS_KEY', 'AAAAGdGMkvo:APA91bGEIhwxQVCnVe1mY5E0Pc4gGOmuSm8FenhfBXVNSuA3n7bbFawHIWDUXiwygRchV0Wl_VVbH8xm4mxsEacUtrpJnHaFXmoUqdoHtuu05RAsuSycdZMCfPD-arYx6IirTRL6Tas9');
        $url = 'https://fcm.googleapis.com/fcm/send';
        // $registrationIds = array($_GET['id']);
        // prepare the message
        $message = array(
            'title'     => "You got a outstation",
            'vibrate'   => true,
            'sound'      => 'sound.mp3'
        );

        $fields = array(
            'data' => $message,
            'notification' => $message,
            'to' => $customer_fcm,
            'data' => array(
                'paramType'     => 'driverRideNow',
                'paramRideID'     => '100'
            )
        );

        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);


        $url = 'https://fcm.googleapis.com/fcm/send';
        // $registrationIds = array($_GET['id']);
        // prepare the message
        $message = array(
            'title'     => "You got a outstation",
            'vibrate'   => true,
            'sound'      => 'sound.mp3'
        );

        $fields = array(
            'data' => $message,
            'notification' => $message,
            'to' => $driver_fcm,
            'data' => array(
                'paramType'     => 'driverRideNow',
                'paramRideID'     => '100'
            )
        );

        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);


        if ($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Link To Driver Updated successfully";
        } else {
            //   $validator['success'] = false;
            //  $validator['messages'] = "Error while Updated Link To Driver";
            $validator['success'] = true;
            $validator['messages'] = "Link To Driver Updated successfully";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function editOutstationDetails(Request $request)
    {
        $id = $request['id'];
        $outstation = DB::table('outstation')
            ->where('id', $id)
            ->get();
        // $outstation_stops = DB::table('outstation_stops')
        // ->where('outstation_id',$id)
        // ->get();

        $statuses[0] = '<option value="completed" ' . ($outstation[0]->status == 'completed' ? "selected" : "") . '>Completed</option>';
        $statuses[1] = '<option value="cancelled" ' . ($outstation[0]->status == 'cancelled' ? "selected" : "") . '>Cancelled</option>';
        $statuses[2] = '<option value="pending" ' . ($outstation[0]->status == 'pending' ? "selected" : "") . '>Pending</option>';
        $statuses[3] = '<option value="start" ' . ($outstation[0]->status == 'start' ? "selected" : "") . '>Start</option>';



        $data = response()->json(array(
            'outstation' => $outstation[0],
            // 'outstation_stops' => $outstation_stops,
            'statuses' => $statuses
        ));
        return $data;
    }

    public function updateOutstationDetails(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'status' => 'required'

        ]);

        if ($validators->fails()) {
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
        $data = array(
            'amount' => $request['amount'],
            'perkm_amount' => $request['perkm_amount'],
            'per_day_amount' => $request['per_day_amount'],
            'per_day_desc' => $request['per_day_desc'],
            'per_km_desc' => $request['per_km_desc'],
            'waiting_charge' => $request['waiting_charge'],
            'toll_n_parking_desc' => $request['toll_n_parking_desc'],
            'from_lat' => $request['from_lat'],
            'from_lng' => $request['from_lng'],
            'date' => $request['date'],
            'amount' => $request['amount'],
            'distance' => $request['distance'],
            'notification' => $request['notification'],
            'status' => $request['status'],
            'days' => $request['days'],
            'car_type_id' => $request['car_type_id'],
            'type' => $request['type'],
            'total_average_amount' => $request['total_average_amount'],
            'extra_per_min_rate' => $request['extra_per_min_rate'],
            'customer_extra_time' => $request['customer_extra_time'],
            'extra_per_km_rate' => $request['extra_per_km_rate'],
            'customer_extra_kms' => $request['customer_extra_kms'],
            'fixed_rate' => $request['fixed_rate'],
            'night_hault_desc' => $request['night_hault_desc']
        );


        $outstation_record = DB::table('outstation')->where('id', $id)->first();
        $query = DB::table('outstation')->where('id', $id)->update($data);

        $get_fcm = DB::table('customer')
            ->select('fcmToken')
            ->where('id', $outstation_record->customer_id)
            ->first();

        if ($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Outstation Data Updated successfully";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Outstation Data";
        }
        // close the database connection
        if (isset($request['notification']) && $request['notification'] != null) {
            $this->sendmsg($request['notification'], $get_fcm->fcmToken, $query);
        }
        echo json_encode($validator);
    }

    function sendmsg($notification, $token, $query)
    {
        define('API_ACCESS_KEY', 'AAAAGdGMkvo:APA91bGEIhwxQVCnVe1mY5E0Pc4gGOmuSm8FenhfBXVNSuA3n7bbFawHIWDUXiwygRchV0Wl_VVbH8xm4mxsEacUtrpJnHaFXmoUqdoHtuu05RAsuSycdZMCfPD-arYx6IirTRL6Tas9');
        $url = 'https://fcm.googleapis.com/fcm/send';
        // $registrationIds = array($_GET['id']);
        // prepare the message
        $message = array(
            'title'     => $notification,
            // 'body'      => '$request['message']',
            // 'image'      => 'https://zhepcab.com/img/'.$fileName,
            'vibrate'   => true,
            'sound'      => 'sound.mp3'
        );


        $fields = array(
            // 'registration_ids' => $registrationIds,
            'data'             => $message,
            'notification' => $message,
            'to' => $token,
            'data' => array(
                'paramType'     => 'driverRideNow',
                'paramRideID'     => '100'
            )
        );

        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);


        if ($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Notification Added successfully";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Notification";
        }
    }
}
