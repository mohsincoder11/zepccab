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

class DriverController extends Controller
{
    public function allDriver()
    {
        $output = array('data' => array());
        $driver = DB::table('driver')
            ->join('driver_car_linking', 'driver_car_linking.driver_id', '=', 'driver.id')
            ->join('cars', 'cars.id', '=', 'driver_car_linking.car_id')
            ->join('city', 'city.id', '=', 'driver.city_id')
            ->leftjoin('vendors', 'vendors.id', '=', 'driver.vendor_id')
            ->select(
                'driver.*',
                'city.name as city_name',
                'cars.car_name as car_name',
                'vendors.vendor_name'
            )
            ->orderBy('driver.first_name', 'asc')
            ->get();

        $x = 1;
        foreach ($driver as $row) {
            $actionButton = '

          <td>

       <a href="#"  data-toggle="modal" data-target="#modalShow" onclick="DriverDetails(' . $row->id . ')">
                        <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                            <i class="fa fa-eye"></i>
                        </button>
                    </a>

           <a href="#" data-toggle="modal" data-target="#editModal" onclick="editItem(' . $row->id . ')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a>

            <a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem(' . $row->id . ')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>
			
			<a title="Status Change" href="#" data-toggle="modal" data-target="#removeModal1" onclick="removeItem1(' . $row->id . ')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete1">
                    <i class="fa fa-refresh mt-0"></i>
                </button>
            </a>
</td>

            ';


            $name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> ' . $row->first_name . ' ' . $row->last_name . ' </span>';
            $car_name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> ' . $row->car_name . ' </span>';
            $city = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> ' . $row->city_name . ' </span>';

            //$status = $row->available; //active/deactive status column change
            $status = $row->admin_set_active;

            if ($status == true) {
                $status = '<span class="badge badge-success"> ACTIVE </span>';
            } else if ($status == false) {
                $status = '<span class="badge badge-danger"> INACTIVE </span>';
            }

            $output['data'][] = array(
                $city,
                $name,
                $row->mobile_no,
                $car_name,
                $row->vendor_name ?? '',
                $status,
                $actionButton,
            );
            $x++;
        }

        $data = response()->json($output);
        return $data;
    }

    public function store(Request $request)
    {
        $files = array();
        $photos_names = array();
        $validators = Validator::make($request->all(), [
            'city_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_no' => 'required',
            'city' => 'required',
            'aadhar_card' => 'required',
            'driving_license' => 'required'
        ]);

        if ($validators->fails()) {
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $driver = new Driver($request->input());
        $driver->city_id = $request['city_id'];
        $driver->vendor_id = $request['vendor_id'];
        $driver->first_name = $request['first_name'];
        $driver->last_name = $request['last_name'];
        $driver->email_id = $request['email_id'];
        $driver->mobile_no = $request['mobile_no'];
        $driver->address = $request['address'];
        $driver->city = $request['city'];
        $driver->bank_details = $request['bank_details'];
        $driver->aadhar_card = $request['aadhar_card'];
        $driver->driving_license = $request['driving_license'];
        $driver->driver_photo = $request['driver_photo'];
        $driver->current_latitude = $request['current_latitude'];
        $driver->current_longitude = $request['current_longitude'];
        $driver->secondary_mobile_no = $request['secondary_mobile_no'];

        if ($files = $request->hasFile('driver_photo')) {
            foreach ($request->file('driver_photo') as $file) {
                $fileName = $file->hashName();
                $destinationPath = public_path() . '/img';
                $file->move($destinationPath, $fileName);
                $photos_names[] = $fileName;
            }
        }
        $driver->driver_photo = implode(',', $photos_names);
        $query = $driver->save();


        if ($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Driver Added successfully";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Driver";
        }
        echo json_encode($validator);
    }

    public function get_driver()
    {
        $output = array();
        $drivers = Driver::select('id', 'first_name', 'last_name', 'city')
            ->orderby('first_name', 'ASC')
            ->get();
        foreach ($drivers as $index => $driver) {
            $output[0] = ' <option disabled selected>Select Driver</option>';
            $output[] = '<option value="' . $driver['id'] . '">' . $driver['first_name'] . ' ' . $driver['last_name'] . ' , ' . $driver['city'] . '</option>';
        }
        echo json_encode($output);
    }

    public function editDriver(Request $request)
    {
        $id = $request['id'];
        $driver = DB::table('driver')
            ->join('driver_car_linking', 'driver_car_linking.driver_id', '=', 'driver.id')
            ->join('cars', 'cars.id', '=', 'driver_car_linking.car_id')
            ->join('city', 'city.id', '=', 'driver.city_id')
            ->select(
                'driver.*',
                'driver_car_linking.car_id as car_id',
                'city.name as city_name',
                'cars.car_name as car_name'
            )
            ->where('driver.id', $id)
            ->get();

        $cities = City::all();
        foreach ($cities as $city) {
            $city_data[] = '<option value="' . $city['id'] . '" ' . ($driver[0]->city_id == $city['id'] ? "selected" : "") . '>' . $city['name'] . '</option>';
        }

        $cars = Car::all();
        foreach ($cars as $car) {
            $cars_data[] = '<option value="' . $car['id'] . '" ' . ($driver[0]->car_id == $car['id'] ? "selected" : "") . '>' . $car['car_name'] . '</option>';
        }

        $data = response()->json(array(
            'driver' => $driver[0],
            'cities' => $city_data,
            'cars' => $cars_data
        ));
        return $data;
    }

    public function updateDriver(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'city_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_no' => 'required',
            'city' => 'required',
            'aadhar_card' => 'required',
            'driving_license' => 'required',
            'car_id' => 'required'
        ]);

        if ($validators->fails()) {
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];

        $data = array(
            'city_id' => $request['city_id'],
            'vendor_id' => $request['vendor_id'],

            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email_id' => $request['email_id'],
            'mobile_no' => $request['mobile_no'],
            'address' => $request['address'],
            'city' => $request['city'],
            'bank_details' => $request['bank_details'],
            'aadhar_card' => $request['aadhar_card'],
            'driving_license' => $request['driving_license'],
            'current_latitude' => $request['current_latitude'],
            'current_longitude' => $request['current_longitude'],
            'secondary_mobile_no' => $request['secondary_mobile_no'],
            'car_id' => $request['car_id']
        );

        $query = DB::table('driver')
            ->join('driver_car_linking', 'driver_car_linking.driver_id', '=', 'driver.id')
            ->where('driver.id', $id)
            ->update($data);

        if ($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Driver Data Updated successfully";
        } else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Driver";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeDriver(Request $request)
    {
        $id = $request['driver'];
        DriverCarLinking::where('driver_id', $id)->delete();
        $driver = Driver::find($id)->delete();

        if ($driver == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        } else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode($response);
    }

    public function searchDriver(Request $request)
    {
        $output = array('data' => array());

        $city_id = $request['city_id'];
        $name = $request['name'];
        $mobile_no = $request['mobile_no'];

        $driver = DB::table('driver')
            ->join('driver_car_linking', 'driver_car_linking.driver_id', '=', 'driver.id')
            ->join('cars', 'cars.id', '=', 'driver_car_linking.car_id')
            ->join('city', 'city.id', '=', 'driver.city_id')
            ->select(
                'driver.*',
                'city.name as city_name',
                'cars.car_name as car_name'
            );



        if ($city_id != null) {
            $driver = $driver
                ->where('driver.city_id', $city_id);
        }

        if ($name != null) {
            $driver = $driver
                ->where(DB::raw("CONCAT(driver.first_name,' ', driver.last_name)"), 'like', '%' . $name . '%');
        }

        if ($mobile_no != null) {
            $driver = $driver
                ->where('driver.mobile_no', $mobile_no);
        }

        $driver = $driver->orderBy('driver.id', 'DESC')->get();

        $x = 1;
        foreach ($driver as $row) {
            $actionButton = '

          <td>

       <a href="#"  data-toggle="modal" data-target="#modalShow" onclick="DriverDetails(' . $row->id . ')">
                        <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                            <i class="fa fa-eye"></i>
                        </button>
                    </a>

           <a href="#" data-toggle="modal" data-target="#editModal" onclick="editItem(' . $row->id . ')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" >
                    <i class="fa fa-pencil mt-0"></i>
                </button>
            </a>

            <a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem(' . $row->id . ')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>
			
			<a title="Status Change" href="#" data-toggle="modal" data-target="#removeModal1" onclick="removeItem1(' . $row->id . ')">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete1">
                    <i class="fa fa-refresh mt-0"></i>
                </button>
            </a>
</td>

            ';


            $name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> ' . $row->first_name . ' ' . $row->last_name . ' </span>';
            $car_name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> ' . $row->car_name . ' </span>';
            $city = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> ' . $row->city_name . ' </span>';

            $status = $row->available;

            if ($status == true) {
                $status = '<span class="badge badge-success"> ACTIVE </span>';
            } else if ($status == false) {
                $status = '<span class="badge badge-danger"> INACTIVE </span>';
            }

            $output['data'][] = array(
                $city,
                $name,
                $row->mobile_no,
                $car_name,
                $status,
                $actionButton,
            );
            $x++;
        }

        if (count($output['data']) > 0) {
            $output['success'] = true;
            $output['messages'] = 'Data Found';
            return response()->json($output);
        } else {
            $output['success'] = false;
            $output['messages'] = 'Data not Found';
            return response()->json($output);
        }
    }

    public function showDriver(Request $request)
    {
        $id = $request['id'];
        $driver = DB::table('driver')
            ->join('driver_car_linking', 'driver_car_linking.driver_id', '=', 'driver.id')
            ->join('cars', 'cars.id', '=', 'driver_car_linking.car_id')
            ->join('city', 'city.id', '=', 'driver.city_id')
            ->leftjoin('vendors', 'vendors.id', '=', 'driver.vendor_id')
            ->select(
                'driver.*',
                'driver_car_linking.car_id as car_id',
                'city.name as city_name',
                'cars.car_name as car_name',
                'cars.car_number as car_number',
                'cars.owner_name as owner_name',
                'vendors.vendor_name'
            )
            ->where('driver.id', $id)
            ->get();


        $name = $driver[0]->first_name . ' ' . $driver[0]->last_name;

        //        $image = '
        //                   <img src="'.asset('public/img/'.$driver[0]->driver_photo.'').'" alt="'.$name.'" title="'.$name.'" class="rounded mx-auto d-block" height="200px" width="150px">
        //            ';


        $photos = explode(',', $driver[0]->driver_photo);
        foreach ($photos as $photo) {
            $image[] = '
                   <img src="' . asset('public/img/' . $photo . '') . '" class="rounded mx-auto d-block photo" height="200px" width="150px">
            ';
        }

        $data = response()->json(array(
            'driver' => $driver[0],
            'full_name' => $name,
            'image' => $image,

        ));
        return $data;
    }

    public function removeDriverStatus(Request $request)
    {
        $id = $request['driver_status'];
        // $user = Driver::select('available')->where('id',$id)->first();

        // if ($user->available)
        // {
        //     $driver = Driver::where('id',$id)->update(['available'=> false]);
        // }
        // else
        // {
        //     $driver = Driver::where('id',$id)->update(['available'=> true]);
        // }
        //active/deactive status column change
        $user = Driver::select('admin_set_active')->where('id', $id)->first();

        if ($user->admin_set_active) {
            $driver = Driver::where('id', $id)->update(['admin_set_active' => false]);
        } else {
            $driver = Driver::where('id', $id)->update(['admin_set_active' => true]);
        }

        if ($driver == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Status Successfully";
        } else {
            $response['success'] = false;
            $response['messages'] = "Error while Status!";
        }
        echo json_encode($response);
    }
}
