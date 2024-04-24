<?php

namespace App\Http\Controllers;

use App\Rental;
use App\TravelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TravelTypeController extends Controller
{
    public function allTravel()
    {
        $output = array('data' => array());
        $travels = DB::table('travel_type')
            ->select('travel_type.*')
            ->orderBy('id', 'DESC')
            ->get();

        $x = 1;
        foreach ($travels as $row)
        {
            $actionButton = '

          <td>
            <a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem('.$row->id.')"> 
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>
</td>
            
		    ';

            $output['data'][] = array(
                $row->name,
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
            'name' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $travel = new TravelType($request->input());
        $travel->name = $request['name'];
        $query =$travel->save();

        if($query === TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Travel Type Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Travel Type";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeTravel(Request $request)
    {
        $id = $request['travel'];
        $travel = TravelType::find($id)->delete();

        if($travel == TRUE) {
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


