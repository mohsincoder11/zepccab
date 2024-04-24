<?php

namespace App\Http\Controllers;

use App\CarType;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function allCity()
    {
        $output = array('data' => array());
        $cars = City::all()->sortByDesc('id');
        $x = 1;
        foreach ($cars as $row)
        {
            $actionButton = '

     <td>
      <a href="#" data-toggle="modal" data-target="#editModal" onclick="editItem('.$row->id.')" >
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 open_modal2" >
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

            $output['data'][] = array(
                $row->name,
                $row->mobile_no,
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
            'name' => 'required',
            'mobile_no' => 'required|min:11|numeric'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $city = new City($request->input());
        $city->name = $request['name'];
        $city->mobile_no = $request['mobile_no'];
        $city->latitude = $request['latitude'];
        $city->longitude = $request['longitude'];
        $city->radius_km = $request['radius_km'] ?? 1;
        
        $query =$city->save();

        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "City Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding City";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeCity(Request $request)
    {
        $id = $request['city'];
        $city = City::find($id)->delete();

        if($city == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }

    public function editCity(Request $request)
    {
        $id = $request['id'];
        $city = DB::table('city')
            ->select('city.*')
            ->where('id',$id)
            ->get();

        $data= response()->json(array(
            'city' => $city[0]
        ));
        return $data;
    }
    
    
      public function updateCity(Request $request)
    {
       $validators = Validator::make($request->all(), [
            'name' => 'required',
            'mobile_no' => 'required|min:11|numeric'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

            $id = $request['id'];
            $data = array(
                'name' =>$request['name'],
                'mobile_no' =>$request['mobile_no'],              
                'latitude'=> $request['latitude'],
                'longitude'=> $request['longitude'],
                'radius_km'=> $request['radius_km'] ?? 1,
            );

            $query = DB::table('city')->where('id',$id)->update($data);

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "City Data Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated City";
        }
        // close the database connection
        echo json_encode($validator);
    }
}
