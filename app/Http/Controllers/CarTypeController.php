<?php

namespace App\Http\Controllers;

use App\CarType;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CarTypeController extends Controller
{
    public function allCartype()
    {
        $output = array('data' => array());
        $cartype = DB::table('car_types')
            ->join('city', 'city.id', '=', 'car_types.city_id')
            ->select('car_types.*',
                'city.name as city_name')
            ->orderBy('car_types.id', 'DESC')
            ->get();

        $x = 1;
        foreach ($cartype as $row)
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

            $city = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->city_name.' </span>';
            if ($row->variation == 'call_now')
            {
                $variation = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Call Now </span>';
            }
            else if ($row->variation == 'rates')
            {
                $variation = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Rates </span>';
            }

            $output['data'][] = array(
                $row->name,
                $city,
                $variation,
                $row->base_price,
                $actionButton,
            );
            $x++;
        }
        $data= response()->json($output);
        return $data;
    }

    public function store(Request $request)
    {
         if ($request['input_name'] != NULL)
        {
            $validators = Validator::make($request->all(), [
                'city_id' => 'required',
                'variation' => 'required'
            ]);
        }
        else
        {
            $validators = Validator::make($request->all(), [
                'city_id' => 'required',
                'name' => 'required',
                'variation' => 'required'
            ]);
        }

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }




        if ($request['input_name'] != NULL)
        {
            $cartype = new CarType($request->input());
            $cartype->name = $request['input_name'];
            $cartype->city_id = $request['city_id'];
            $cartype->variation = $request['variation'];
            $cartype->base_price = $request['base_price'];
            if($file = $request->hasFile('icon')) {
            $file = $request->file('icon') ;
            $fileName = $request->file('icon')->hashName();
            $destinationPath = public_path().'/img';
            $file->move($destinationPath,$fileName);
            copy($destinationPath.'/'.$fileName,'img/'.$fileName);
            $cartype->icon = $fileName;
        }
            $query =$cartype->save();
        }

        else
        {
                $cartype = new CarType($request->input());
                $cartype->name = $request['name'];
                $cartype->city_id = $request['city_id'];
                $cartype->variation = $request['variation'];
                $cartype->base_price = $request['base_price'];
                    if($file = $request->hasFile('icon')) {
                $file = $request->file('icon') ;
                $fileName = $request->file('icon')->hashName();
                $destinationPath = public_path().'/img';
                $file->move($destinationPath,$fileName);
                copy($destinationPath.'/'.$fileName,'img/'.$fileName);

                $cartype->icon = $fileName;
               }
                $query =$cartype->save();
        }



        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Car Type Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Car Type";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeCartype(Request $request)
    {
        $id = $request['cartype'];
        $cartype = CarType::find($id)->delete();

        if($cartype == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }

     public function AppCarTypeShow(Request $request)
    {
        $output = array('data' => array());
        $city_id = $request['city_id'];
        $cartype = DB::table('car_types')
                    ->join('city', 'city.id', '=', 'car_types.city_id')
                    ->select('car_types.*', 'city.name as city_name', 'city.id as city_id')
                    ->where('car_types.city_id', $city_id)
                    ->orderBy('car_types.id', 'DESC')
                    ->get()
                    ->toArray(); // Convert the collection to an array

                $order = ["Sedan", "Mini", "SUV", "Bus", "Auto"];

                usort($cartype, function ($a, $b) use ($order) {
                    $aIndex = array_search($a->name, $order);
                    $bIndex = array_search($b->name, $order);

                    return $aIndex - $bIndex;
                });

      return json_encode($cartype);
    }

      public function AppCarShowCity(Request $request)
    {
        $output = array('data' => array());
        $id = $request['city_id'];
        $query="SELECT driver.*,
                car_types.name AS car_type_name,
                car_types.id AS car_type_id,
                city.name AS city_name
                FROM driver INNER JOIN city ON city.id = driver.city_id
                INNER JOIN driver_car_linking ON driver_car_linking.driver_id=driver.id
                INNER JOIN cars ON cars.id= driver_car_linking.car_id
                INNER JOIN car_types ON cars.car_type_id= car_types.id
                WHERE driver.city_id = $id AND driver.driver_login_status = 1";
        $cab_show_city = DB::select(DB::raw($query));


      return json_encode($cab_show_city);
    }

     public function editCarType(Request $request)
    {
        $id = $request['id'];
        $cartype = DB::table('car_types')
            ->join('city', 'car_types.city_id', '=', 'city.id')
            ->select('car_types.*',
                'city.name as city_name')
            ->where('car_types.id',$id)
            ->get();


        $cities = City::all();
        foreach ($cities as $city)
        {
            $city_data[] = '<option value="'.$city['id'].'" '.($cartype[0]->city_id==$city['id']?"selected":"").'>'.$city['name'].'</option>';
        }

        $variations[0] = '<option value="call_now" '.($cartype[0]->variation=='call_now'?"selected":"").'> Call Now</option>';
        $variations[1] = '<option value="rates" '.($cartype[0]->variation=='rates'?"selected":"").'> Rates</option>';

        $data= response()->json(array(
            'cartype' => $cartype[0],
            'city_data' => $city_data,
            'variations' => $variations
        ));
        return $data;
    }

    public function updateCartype(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'city_id' => 'required',
            'name' => 'required',
            'variation' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
        $data = array(
            'city_id' =>$request['city_id'],
            'name' => $request['name'],
            'variation' => $request['variation'],
            'base_price' => $request['base_price']
        );

        $query = DB::table('car_types')
            ->where('id',$id)
            ->update($data);

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Car Type Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Car Type";
        }
        // close the database connection
        echo json_encode($validator);
    }

     public function getCarType()
    {
        $output = array();
        $cartypes = CarType::all();

        foreach ($cartypes as $index => $cartype) {
            $output[0] = ' <option value="">Select Car Type</option>';
            $output[] = '<option value="'.$cartype['name'].'">'.$cartype['name'].'</option>';
        }
        return json_encode($output);
    }
    
     public function getCarTypeAdmin(Request $request)
    {
        $city_id = $request['city_id'];
        $cartypes = CarType::select('id','name')->where('city_id',$city_id)->get();

        if ($cartypes->count() == 0)
        {
            $data[] = '<option value="" disabled></option>';
        }
        else
        {
            foreach ($cartypes as $cartype)
            {
                $data[] = '<option value="'.$cartype->id.'">'.$cartype->name.'</option>';
            }
        }

        return json_encode($data);
    }

}



