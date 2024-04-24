<?php

namespace App\Http\Controllers;

use App\City;
use App\Coupon;
use App\TravelType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function allCoupon()
    {
        $output = array('data' => array());
        $coupons = DB::table('coupon')
            ->join('city', 'city.id', '=', 'coupon.city_id')
            ->select('coupon.*',
                'city.name as city_name')
            ->orderBy('coupon.id', 'DESC')
            ->get();

        $x = 1;
        foreach ($coupons as $row)
        {
            $actionButton = '

          <td>
          
		  <a href="#"  data-toggle="modal" data-target="#modalShow" onclick="CouponDetails('.$row->id.')">
                        <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                            <i class="fa fa-eye"></i>
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
			
			<a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItemWebsite('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDeleteCoupon">
                    <i class="fa fa-refresh mt-0"></i>
                </button>
            </a>
</td>

            ';


            if ($row->coupon_image != NULL)
            {
                $image = '
                   <img src="'.asset('public/img/'.$row->coupon_image.'').'" class="rounded mx-auto d-block photo" height="50px" width="50px" data-toggle="modal" data-target="#imageModal">
            ';
            }
            else
            {
                $image = '
                   <img src="'.asset('public/img/no_photo.jpg').'" class="rounded mx-auto d-block photo" height="50px" width="50px" data-toggle="modal" data-target="#imageModal">
            ';
            }


            $city = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->city_name.' </span>';
            $from_date = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->from_date.' </span>';
            $to_date = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->to_date.' </span>';
            $coupon = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->name.' </span>';
			
			
			$status = $row->website_status;
            if ($status == true)
            {
                $status = '<span class="badge badge-success"> Show Website </span>';
            }
            else if($status == false)
            {
                $status = '<span class="badge badge-danger"> Hide Website </span>';
            }
			
            $output['data'][] = array(
                $city,
                $coupon,
                $from_date,
                $to_date,
                $row->variation,
                $row->value,
                $row->minimum_value,
                $image,
				$status,
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
            'city_id' => 'required',
            'name' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'variation' => 'required',
            'value' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $from_date = Carbon::parse($request['from_date'],'Asia/Kolkata')->format('Y-m-d');
        $to_date = Carbon::parse($request['to_date'],'Asia/Kolkata')->format('Y-m-d');

        $ride_from_date = Carbon::parse($request['ride_from_date'],'Asia/Kolkata')->format('Y-m-d');
        $ride_to_date = Carbon::parse($request['ride_to_date ='],'Asia/Kolkata')->format('Y-m-d');

        if($request['city_id'] == 'all')
        {
            $cities = DB::table('city')
                ->select('city.*')
                ->get();

            foreach ($cities as $city)
            {
                $coupon = new Coupon($request->input());
                $coupon->city_id = $city->id;
                $coupon->name = $request['name'];
                $coupon->from_date = $from_date;
                $coupon->to_date = $to_date;
                $coupon->variation = $request['variation'];
                $coupon->value = $request['value'];
                $coupon->minimum_value = $request['minimum_value'];
                $coupon->car_type = $request['car_type'];
                $coupon->after_completing_ride_no = $request['after_completing_ride_no'];
                $coupon->no_of_time_no = $request['no_of_times_no'];
                $coupon->ride_from_date = $ride_from_date;
                $coupon->ride_to_date = $ride_to_date;
                $coupon->type = implode(',', $request['type']);
                $coupon->description = $request['description'];
				$coupon->hide = $request['hide'];
                $coupon->save();
            }

                if($file = $request->hasFile('coupon_image')) {
                    $file = $request->file('coupon_image') ;
                    $fileName = $request->file('coupon_image')->hashName();
                    $destinationPath = public_path().'/img' ;
                    $file->move($destinationPath,$fileName);
                }

            $data = array(
                'coupon_image' =>$fileName
            );

            $query = DB::table('coupon')
                ->where('name',$request['name'])
                ->update($data);
        }

        else
        {
            $coupon = new Coupon($request->input());
            $coupon->city_id = $request['city_id'];
            $coupon->name = $request['name'];
            $coupon->from_date = $from_date;
            $coupon->to_date = $to_date;
            $coupon->variation = $request['variation'];
            $coupon->value = $request['value'];
            $coupon->minimum_value = $request['minimum_value'];
            $coupon->car_type = $request['car_type'];
            $coupon->after_completing_ride_no = $request['after_completing_ride_no'];
            $coupon->no_of_time_no = $request['no_of_times_no'];
            $coupon->ride_from_date = $ride_from_date;
            $coupon->ride_to_date = $ride_to_date;
            $coupon->type = implode(',', $request['type']);
            $coupon->description = $request['description'];
			$coupon->hide = $request['hide'];
			
            if($file = $request->hasFile('coupon_image')) {
                $file = $request->file('coupon_image') ;
                $fileName = $request->file('coupon_image')->hashName();
                $destinationPath = public_path().'/img' ;
                $file->move($destinationPath,$fileName);
                $coupon->coupon_image = $fileName ;
            }
            $query =$coupon->save();
        }



        if($query == TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Coupon Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Coupon";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeCouponWebsite(Request $request)
    {
        $id = $request['coupon'];
		$user = Coupon::select('website_status')->where('id',$id)->first();

        if ($user->website_status)
        {
            $coupon = Coupon::where('id',$id)->update(['website_status'=> false]);
        }
        else
        {
            $coupon = Coupon::where('id',$id)->update(['website_status'=> true]);
		}
        
        if($coupon == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }
	
	 public function removeCoupon(Request $request)
    {
        $id = $request['coupon'];
        $coupon = Coupon::find($id)->delete();

        if($coupon == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }

    public function editCoupon(Request $request)
    {
        $id = $request['id'];
        $coupon = DB::table('coupon')
            ->join('city', 'city.id', '=', 'coupon.city_id')
            ->select('coupon.*',
                'city.name as city_name')
            ->where('coupon.id',$id)
            ->get();

        $cities = City::all();
        foreach ($cities as $city)
        {
            $city_data[] = '<option value="'.$city['id'].'" '.($coupon[0]->city_id==$city['id']?"selected":"").'>'.$city['name'].'</option>';
        }

        $car_type[0] = '<option value="auto" '.($coupon[0]->car_type=='auto'?"selected":"").'> Auto</option>';
        $car_type[1] = '<option value="non_auto" '.($coupon[0]->car_type=='non_auto'?"selected":"").'> Non Auto</option>';


        $variation[0] = '<option value="percentage" '.($coupon[0]->variation=='percentage'?"selected":"").'> Percentage</option>';
        $variation[1] = '<option value="rupee" '.($coupon[0]->variation=='rupee'?"selected":"").'> Rupee</option>';

        $coupon_types = DB::table('coupon_types')
            ->select('coupon_types.*')
            ->get();

        $a = $coupon[0]->type;
        $b = explode(',',$a);
        $limit = count($b);
        foreach ($coupon_types as $plan)
        {
            $val = 0;

            for ($i = 0; $i < $limit; $i++)
            {
                $sp =  $b[$i];
                if($sp == $plan->type){
                    $val = 1;
                    break;
                }
            }
            if($val == 1)

                $plans_data[] = '<option value="' . $sp . '" ' . ($plan->type == $sp ? "selected" : "") . '>' . $plan->type . '</option>';
            else
                $plans_data[] = '<option value="' . $plan->type . '">' . $plan->type . '</option>';
        }

        $data= response()->json(array(
            'coupon' => $coupon[0],
            'cities' => $city_data,
            'car_type' => $car_type,
            'type' => $plans_data,
            'variation' => $variation
        ));
        return $data;
    }

    public function updateCoupon(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'city_id' => 'required',
            'name' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'variation' => 'required',
            'value' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
        $data = array(
            'city_id' =>$request['city_id'],
            'name' =>$request['name'],
            'from_date' =>$request['from_date'],
            'to_date' =>$request['to_date'],
            'variation' =>$request['variation'],
            'value' =>$request['value'],
            'minimum_value' =>$request['minimum_value'],
            'car_type' =>$request['car_type'],
            'type' => implode(',', $request['type']),
            'ride_from_date' =>$request['ride_from_date'],
            'ride_to_date' =>$request['ride_to_date'],
            'after_completing_ride_no' =>$request['after_completing_ride_no'],
            'no_of_time_no' =>$request['no_of_times_no']
        );

        $query = DB::table('coupon')
            ->where('id',$id)
            ->update($data);

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Coupon Data Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Coupon Data";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function showCoupon(Request $request)
    {
        $id = $request['id'];
        $coupon = DB::table('coupon')
            ->join('city', 'city.id', '=', 'coupon.city_id')
            ->select('coupon.*',
                'city.name as city_name')
            ->where('coupon.id',$id)
			->orderBy('coupon.id', 'DESC')
            ->get();

        $data= response()->json(array(
            'coupon' => $coupon[0]
        ));
        return $data;
    }
}
