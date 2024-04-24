<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PackageMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PackageMasterController extends Controller
{
    public function index(){
        return view('package-master.index');
        
    }

    public function allPackageMaster(Request $request)
    {
        $output = array('data' => array());
        $packages = PackageMaster::orderby('id','desc');
         if(isset($request->package_type) && $request->package_type!='All'){
                $packages=$packages->where('package_type',$request->package_type);
            }
            $packages=$packages->get();
        foreach ($packages as $row)
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
                $row->package_title,
                $row->package_type,
                $row->per_km_amount,
                $row->per_day_amount,
                $row->per_day_desc,
                $row->per_km_desc,
                $row->waiting_charge,
                $row->toll_n_parking_desc,
                $row->night_hault_desc,
                $row->fixed_rate,
                $actionButton
            );
        }
        $data = response()->json($output);
        return $data;
    }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_title' => 'required',
            'package_type' => 'required',
            'per_km_amount' => 'required',
            'per_day_amount' => 'required',
            'per_day_desc' => 'required',
            'per_km_desc' => 'required',
            'waiting_charge' => 'required',
            'toll_n_parking_desc' => 'required',
            'night_hault_desc' => 'required',
            'fixed_rate' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()->all()
            ]);
        }
    
        $package = new PackageMaster();
        $package->package_title = $request->input('package_title');
        $package->package_type = $request->input('package_type');
        $package->per_km_amount = $request->input('per_km_amount');
        $package->per_day_amount = $request->input('per_day_amount');
        $package->per_day_desc = $request->input('per_day_desc');
        $package->per_km_desc = $request->input('per_km_desc');
        $package->waiting_charge = $request->input('waiting_charge');
        $package->toll_n_parking_desc = $request->input('toll_n_parking_desc');
        $package->night_hault_desc = $request->input('night_hault_desc');
        $package->fixed_rate = $request->input('fixed_rate');
    
        if ($package->save()) {
            return response()->json([
                'success' => true,
                'messages' => 'Package Added successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'messages' => 'Error while Adding Package'
            ]);
        }
    }
    

    public function removePackageMaster(Request $request)
    {
        $id = $request['package_master'];
        $package_master = PackageMaster::find($id)->delete();

        if($package_master == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }

    public function editPackageMaster(Request $request)
    {
        $id = $request['id'];
        $package_master = DB::table('package_masters')
            ->where('id',$id)
            ->get();

        $data= response()->json(array(
            'package_master' => $package_master[0]
        ));
        return $data;
    }
    
    
    public function updatePackageMaster(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_title' => 'required',
            'package_type' => 'required',
            'per_km_amount' => 'required',
            'per_day_amount' => 'required',
            'per_day_desc' => 'required',
            'per_km_desc' => 'required',
            'waiting_charge' => 'required',
            'toll_n_parking_desc' => 'required',
            'night_hault_desc' => 'required',
            'fixed_rate' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()->all()
            ]);
        }
    
        $id = $request->input('id');
        $package = PackageMaster::find($id);
        $package->package_title = $request->input('package_title');
        $package->package_type = $request->input('package_type');
        $package->per_km_amount = $request->input('per_km_amount');
        $package->per_day_amount = $request->input('per_day_amount');
        $package->per_day_desc = $request->input('per_day_desc');
        $package->per_km_desc = $request->input('per_km_desc');
        $package->waiting_charge = $request->input('waiting_charge');
        $package->toll_n_parking_desc = $request->input('toll_n_parking_desc');
        $package->night_hault_desc = $request->input('night_hault_desc');
        $package->fixed_rate = $request->input('fixed_rate');
    
        if ($package->save()) {
            return response()->json([
                'success' => true,
                'messages' => 'Package Data Updated successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'messages' => 'Error while Updating Package Data'
            ]);
        }
    }
    
}

