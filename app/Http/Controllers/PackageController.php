<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarType;
use App\City;
use App\Driver;
use App\DriverCarLinking;
use App\Package;
use App\PackageCarTypeLinking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function allPackage()
    {
        $output = array('data' => array());
        $package = DB::table('package')
            ->join('package_cartype_linking', 'package_cartype_linking.package_id', '=', 'package.id')
            ->join('car_types', 'car_types.id', '=', 'package_cartype_linking.cartype_id')
            ->join('city', 'city.id', '=', 'package_cartype_linking.city_id')
            ->select('package.*',
                'package_cartype_linking.amount as amount',
                'package_cartype_linking.city_id as city_id',
				'package_cartype_linking.id as package_cartype_linking_id',
                'city.name as city_name',
                'car_types.name as car_type_name')
            ->orderBy('package.name', 'ASC')
            ->get();

        $x = 1;
        foreach ($package as $row)
        {
            $actionButton = '

          <td>


  <a href="#"  data-toggle="modal" data-target="#modalInsertCarType" onclick="CarDetailsInsert('.$row->id.'); getCarTypeAdmin('.$row->city_id.')">
                        <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                           Add Car Type <i class="fa fa-car mt-0"></i>
                        </button>
                    </a>


  <a href="#" data-toggle="modal" data-target="#editModalPackage" onclick="editItemPackage('.$row->package_cartype_linking_id.');" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a>

            <a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem('.$row->package_cartype_linking_id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>
</td>

            ';

            $name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->name.' </span>';
            $amount = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->amount.' </span>';
            $city = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->city_name.' </span>';
            $output['data'][] = array(
                $name,
                $city,
                $row->car_type_name,
                $row->km,
                $row->hour,
                $amount,
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
            'km' => 'required',
            'hour' => 'required',
            'cartype_id' => 'required',
            'amount' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $package = new Package($request->input());
        $package->name = $request['name'];
        $package->km = $request['km'];
        $package->hour = $request['hour'];
        $package->save();

        $packagecartype = new PackageCarTypeLinking($request->input()) ;
        $packagecartype->package_id= $package->id;
        $packagecartype->cartype_id = $request['cartype_id'];
        $packagecartype->city_id = $request['city_id'];
        $query = $packagecartype->save();

        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Package Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Package";
        }
        echo json_encode($validator);
    }


     public function addPackage1(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'cartype_id' => 'required',
            'amount' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
        $package = DB::table('package_cartype_linking')
            ->select('package_cartype_linking.*')
            ->where('package_id',$id)
            ->get();

        $city_id = $package[0]->city_id;
        $packagecartype = new PackageCarTypeLinking($request->input()) ;
        $packagecartype->package_id= $id;
        $packagecartype->cartype_id = $request['cartype_id'];
        $packagecartype->city_id = $city_id;
        $query = $packagecartype->save();

        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Car Type Details Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Car Type Details";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function editPackage(Request $request)
    {
        $id = $request['package_cartype_linking_id'];
        $package = DB::table('package')
            ->join('package_cartype_linking', 'package_cartype_linking.package_id', '=', 'package.id')
            ->join('car_types', 'car_types.id', '=', 'package_cartype_linking.cartype_id')
            ->join('city', 'city.id', '=', 'package_cartype_linking.city_id')
            ->select('package.*',
                'city.name as city_name',
                'package_cartype_linking.amount as amount',
                'package_cartype_linking.cartype_id as cartype_id',
                'package_cartype_linking.city_id as city_id',
                'car_types.name as car_type_name')
            ->where('package_cartype_linking.id',$id)
            ->get();




        $cartypes = CarType::all();
        foreach ($cartypes as $cartype)
        {
            $car_type_data[] = '<option value="'.$cartype['id'].'" '.($package[0]->cartype_id==$cartype['id']?"selected":"").'>'.$cartype['name'].'</option>';
        }

        $cities = City::all();
        foreach ($cities as $city)
        {
            $city_data[] = '<option value="'.$city['id'].'" '.($package[0]->city_id==$city['id']?"selected":"").'>'.$city['name'].'</option>';
        }

        $data= response()->json(array(
            'package' => $package[0],
            'cities' => $city_data,
            'cars_type' => $car_type_data
        ));
        return $data;
    }

    public function updatePackage(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'city_id' => 'required',
            'name' => 'required',
            'km' => 'required',
            'hour' => 'required',
            'cartype_id' => 'required',
            'amount' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
		$package_id = DB::table('package_cartype_linking')
							->where('id',$id)
							->get();
		
		$package_id_get = $package_id[0]->package_id;
		
		
        $data = array(
            'name' =>$request['name'],
            'km' => $request['km'],
            'hour' => $request['hour'],
        );

        $data1 = array(
            'city_id' => $request['city_id'],
            'cartype_id' => $request['cartype_id_hidden'],
            'amount' =>$request['amount']
        );

        DB::table('package_cartype_linking')->where('id',$id)->update($data1);
        $query = DB::table('package')->where('id',$package_id_get)->update($data);

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Package Data Updated successfully";
        }
        else {
			$validator['success'] = true;
            $validator['messages'] = "Package Data Updated successfully";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removePackage(Request $request)
    {
        $id = $request['package'];
         $package = PackageCarTypeLinking::where('id', $id)->delete();
       // $package = Package::find($id)->delete();

        if($package == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }
}
