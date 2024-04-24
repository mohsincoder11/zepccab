<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarType;
use App\City;
use App\Driver;
use App\DriverCarLinking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function allCar()
    {
        $output = array('data' => array());
        $cars = DB::table('cars')
            ->join('city', 'city.id', '=', 'cars.city_id')
            ->join('car_types', 'car_types.id', '=', 'cars.car_type_id')
			->leftjoin('driver_car_linking', 'driver_car_linking.car_id', '=', 'cars.id')
			->leftjoin('driver', 'driver_car_linking.driver_id', '=', 'driver.id')
            ->select('cars.*',
				'driver.first_name as first_name',
				'driver.last_name as last_name',
				'driver.mobile_no as mobile_no',
                'city.name as city_name',
                'car_types.name as car_type_name')
            ->orderBy('cars.car_name', 'ASC')
            ->get();

        $x = 1;
        foreach ($cars as $row)
        {
            $actionButton = '

          <td>

           <a href="#"  data-toggle="modal" data-target="#modalShow" onclick="CarDetails('.$row->id.')">
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
			
			<a title="Status Change" href="#" data-toggle="modal" data-target="#removeModal1" onclick="removeItem1('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete1">
                    <i class="fa fa-refresh mt-0"></i>
                </button>
            </a>
</td>

            ';

			 $status = $row->available;

            if ($status == true)
            {
                $status = '<span class="badge badge-success"> ACTIVE </span>';
            }
            else if($status == false)
            {
                $status = '<span class="badge badge-danger"> INACTIVE </span>';
            }


            $car_number = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->car_number.' </span>';
            $car_name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->car_name.' </span>';
            $city = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->city_name.' </span>';
            $output['data'][] = array(
                $city,
                $row->car_type_name,
                $car_name,
                $row->car_model,
                $row->fuel_type,
                $car_number,
                $row->owner_name,
				$row->first_name.' '.$row->last_name.'-'.$row->mobile_no,
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
        $files = array();
        $photos_names = array();
        $validators = Validator::make($request->all(), [
            'city_id' => 'required',
            'car_type_id' => 'required',
            'car_name' => 'required',
            'car_model' => 'required',
            'owner_name' => 'required',
            'fuel_type' => 'required',
            'owner_primary_mobile' => 'required',
            'car_number' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $car_validity = Carbon::parse($request['car_validity'],'Asia/Kolkata')->format('Y-m-d');
        $car = new Car($request->input());
        $car->car_type_id = $request['car_type_id'];
        $car->city_id = $request['city_id'];
        $car->car_name = $request['car_name'];
        $car->car_model = $request['car_model'];
        $car->owner_name = $request['owner_name'];
        $car->fuel_type = $request['fuel_type'];
        $car->registration_number = $request['registration_number'];
        $car->car_number = $request['car_number'];
        $car->owner_primary_mobile = $request['owner_primary_mobile'];
        $car->owner_secondary_mobile = $request['owner_secondary_mobile'];
        $car->bank_details = $request['bank_details'];
        $car->car_validity = $car_validity;

         if($files = $request->hasFile('photos')) {
            foreach ($request->file('photos') as $file){
                $fileName = $file->hashName();
                $destinationPath = public_path().'/img';
                $file->move($destinationPath,$fileName);
                $photos_names[] = $fileName;
            }
        }
        $car->photos = implode(',',$photos_names);
        $query =$car->save();

        $driverlinking = new DriverCarLinking($request->input()) ;
        $driverlinking->driver_id= $request['driver_id'];
        $driverlinking->car_id = $car->id;
        $query = $driverlinking->save();

        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Car Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Car";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeCar(Request $request)
    {
        $id = $request['car'];
        $cartype = Car::find($id)->delete();

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

    public function editCar(Request $request)
    {
        $id = $request['id'];
        $cars = DB::table('cars')
            ->join('city', 'city.id', '=', 'cars.city_id')
            ->join('car_types', 'car_types.id', '=', 'cars.car_type_id')
			->join('driver_car_linking', 'driver_car_linking.car_id', '=', 'cars.id')
			->join('driver', 'driver.id', '=', 'driver_car_linking.driver_id')
            ->select('cars.*',
                'city.name as city_name',
                'car_types.name as car_type_name',
				'driver_car_linking.driver_id as driver_id',
				'driver.first_name as first_name',
				'driver.last_name as last_name')
            ->where('cars.id',$id)
            ->get();


		$drivers = Driver::orderBy('first_name', 'ASC')->get();
        foreach ($drivers as $driver)
        {
            $driver_data[] = '<option value="'.$driver['id'].'" '.($cars[0]->driver_id==$driver['id']?"selected":"").'>'.$driver['first_name'].' '.$driver['last_name'].'</option>';
        }



        $cities = City::all();
        foreach ($cities as $city)
        {
            $city_data[] = '<option value="'.$city['id'].'" '.($cars[0]->city_id==$city['id']?"selected":"").'>'.$city['name'].'</option>';
        }


        $cartypes = CarType::all();
        foreach ($cartypes as $cartype)
        {
            $car_type_data[] = '<option value="'.$cartype['id'].'" '.($cars[0]->car_type_id==$cartype['id']?"selected":"").'>'.$cartype['name'].'</option>';
        }

        $fuel_type[0] = '<option value="petrol" '.($cars[0]->fuel_type=='petrol'?"selected":"").'> Petrol</option>';
        $fuel_type[1] = '<option value="diesel" '.($cars[0]->fuel_type=='diesel'?"selected":"").'> Diesel</option>';
        $fuel_type[2] = '<option value="gas" '.($cars[0]->fuel_type=='gas'?"selected":"").'> Gas</option>';


        $data= response()->json(array(
            'car' => $cars[0],
            'cities' => $city_data,
            'car_type' => $car_type_data,
			'driver_data' => $driver_data,
            'fuel_type' => $fuel_type
        ));
        return $data;
    }

    public function updateCar(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'city_id' => 'required',
            'car_type_id' => 'required',
            'car_name' => 'required',
            'car_model' => 'required',
            'owner_name' => 'required',
            'fuel_type' => 'required',
			'driver_id' => 'required',
            'car_number' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
            $data = array(
                'city_id' =>$request['city_id'],
                'car_type_id' =>$request['car_type_id'],
                'car_name' => $request['car_name'],
                'car_model' => $request['car_model'],
                'owner_name' => $request['owner_name'],
                'fuel_type' =>$request['fuel_type'],
                'registration_number' =>$request['registration_number'],
                'car_number' =>$request['car_number'],
                'owner_primary_mobile' =>$request['owner_primary_mobile'],
                'owner_secondary_mobile' =>$request['owner_secondary_mobile'],
                'bank_details' =>$request['bank_details'],
                'car_validity' =>$request['car_validity']
            );

            $query = DB::table('cars')->where('id',$id)->update($data);

			$data1 = array('driver_id' =>$request['driver_id']);
        	DB::table('driver_car_linking')->where('car_id',$id)->update($data1);

			$validator['success'] = true;
            $validator['messages'] = "Car Data Updated successfully";

        		echo json_encode($validator);
    }

    public function searchCar(Request $request)
    {
        $output = array('data' => array());

        $city_id = $request['city_id'];
        $car_type_id = $request['car_type_id'];
        $fuel_type = $request['fuel_type'];
        $car_model = $request['car_model'];
        $car_number = $request['car_number'];

        $cars = DB::table('cars')
            ->join('city', 'city.id', '=', 'cars.city_id')
            ->join('car_types', 'car_types.id', '=', 'cars.car_type_id')
			->leftjoin('driver_car_linking', 'driver_car_linking.car_id', '=', 'cars.id')
			->leftjoin('driver', 'driver_car_linking.driver_id', '=', 'driver.id')
            ->select('cars.*',
				'driver.first_name as first_name',
				'driver.last_name as last_name',
				'driver.mobile_no as mobile_no',
                'city.name as city_name',
                'car_types.name as car_type_name');



        if ($city_id != null)
        {
            $cars = $cars
                ->where('cars.city_id',$city_id);
        }

        if ($car_type_id != null)
        {
            $cars = $cars
                ->where('cars.car_type_id',$car_type_id);
        }

        if ($fuel_type != null)
        {
            $cars = $cars
                ->where('cars.fuel_type',$fuel_type);
        }

        if ($car_model != null)
        {
            $cars = $cars
                ->where('cars.car_model',$car_model);
        }

        if ($car_number != null)
        {
            $cars = $cars
                ->where('cars.car_number','like','%'.$car_number.'%');
        }

        $cars = $cars->orderBy('cars.id', 'DESC')->get();

        $x = 1;
        foreach ($cars as $row)
        {
            $actionButton = '

          <td>

           <a href="#"  data-toggle="modal" data-target="#modalShow" onclick="CarDetails('.$row->id.')">
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
			
			<a title="Status Change" href="#" data-toggle="modal" data-target="#removeModal1" onclick="removeItem1('.$row->id.')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete1">
                    <i class="fa fa-refresh mt-0"></i>
                </button>
            </a>
</td>

            ';

			 $status = $row->available;

            if ($status == true)
            {
                $status = '<span class="badge badge-success"> ACTIVE </span>';
            }
            else if($status == false)
            {
                $status = '<span class="badge badge-danger"> INACTIVE </span>';
            }


            $car_number = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->car_number.' </span>';
            $car_name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->car_name.' </span>';
            $city = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->city_name.' </span>';
            $output['data'][] = array(
                $city,
                $row->car_type_name,
                $car_name,
                $row->car_model,
                $row->fuel_type,
                $car_number,
                $row->owner_name,
				$row->first_name.' '.$row->last_name.'-'.$row->mobile_no,
				$status,
                $actionButton,
            );
            $x++;
        }

        if (count($output['data'])>0)
        {
            $output['success']= true;
            $output['messages']= 'Data Found';
            return response()->json($output);
        }
        else{
            $output['success']= false;
            $output['messages']= 'Data not Found';
            return response()->json($output);

        }
    }


     public function showCar(Request $request)
    {
        $id = $request['id'];
        $car = DB::table('cars')
            ->join('city', 'city.id', '=', 'cars.city_id')
            ->join('car_types', 'car_types.id', '=', 'cars.car_type_id')
            ->select('cars.*',
                'city.name as city_name',
                'car_types.name as car_type_name')
            ->where('cars.id',$id)
            ->get();

             $photos = explode(',',$car[0]->photos);

            foreach ($photos as $photo){
                $image[] = '
                   <img src="'.asset('public/img/'.$photo.'').'" class="rounded mx-auto d-block photo" height="200px" width="150px">
            ';
            }


        $data= response()->json(array(
            'car' => $car[0],
            'image' => $image
        ));
        return $data;
    }

	public function removeCarStatus(Request $request)
    {
        $id = $request['car_status'];
		$user = Car::select('available')->where('id',$id)->first();

		$get_driver_id = DB::table('driver_car_linking')
            ->select('driver_car_linking.*')
            ->where('car_id',$id)
            ->get();
		$driver_id = $get_driver_id[0]->driver_id;

        if ($user->available)
        {
            $cartype = Car::where('id',$id)->update(['available'=> false]);
					   Driver::where('id',$driver_id)->update(['available'=> false]);
        }
        else
        {
            $cartype = Car::where('id',$id)->update(['available'=> true]);
					   Driver::where('id',$driver_id)->update(['available'=> true]);
        }

        if($cartype == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Status Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Status!";
        }
        echo json_encode( $response);
    }
}
