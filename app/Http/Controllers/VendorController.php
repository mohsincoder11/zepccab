<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function index()
    {
        return view('vendor.index');
    }

    public function allVendor()
    {
        $output = array('data' => array());
        $vendors = Vendor::all()->sortByDesc('id');
        $x = 1;
        foreach ($vendors as $row) {
            $actionButton = '
            <td>
                <a href="#" data-toggle="modal" data-target="#editModal" onclick="editItem(' . $row->id . ')" >
                    <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 open_modal2" >
                        <i class="fa fa-pencil mt-0"></i>
                    </button>
                </a>
                <a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem(' . $row->id . ')">
                    <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                        <i class="fa fa-trash mt-0"></i>
                    </button>
                </a>
            </td>';

            $output['data'][] = array(
                $row->vendor_name,
                $row->contact_number,
                $row->alternate_contact_no,
                $row->email,
                $row->person_name,
                $row->designation,
                $row->person_number,
                $row->packages,

                $actionButton
            );
            $x++;
        }
        $data = response()->json($output);
        return $data;
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'vendor_name' => 'required',
            'contact_number' => 'required|min:10|max:10',
            'alternate_contact_no' => 'required|min:10|max:10', // Add validation rules for new fields
            'email' => 'required|email',
            'person_name' => 'required',
            'designation' => 'required',
            'person_number' => 'required|min:10|max:10',
            'package_ids' => 'required|array|min:1',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()->all()
            ]);
        }

        $vendor = new Vendor();
        $vendor->vendor_name = $request->input('vendor_name');
        $vendor->contact_number = $request->input('contact_number');
        $vendor->alternate_contact_no = $request->input('alternate_contact_no'); // Assign values for new fields
        $vendor->email = $request->input('email');
        $vendor->person_name = $request->input('person_name');
        $vendor->designation = $request->input('designation');
        $vendor->person_number = $request->input('person_number');
        $vendor->package_ids = $request->input('package_ids');


        $query = $vendor->save();

        if ($query) {
            return response()->json([
                'success' => true,
                'messages' => "Company added successfully"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'messages' => "Error while adding Company"
            ]);
        }
    }


    public function removeVendor(Request $request)
    {
        $id = $request['vendor'];
        $vendor = Vendor::find($id)->delete();

        if ($vendor == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        } else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode($response);
    }

    public function editVendor(Request $request)
    {
        $id = $request['id'];
        $vendor = DB::table('vendors')
            ->where('id', $id)
            ->get();

        $data = response()->json(array(
            'vendor' => $vendor[0]
        ));
        return $data;
    }

    public function updateVendor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required', // Ensure 'id' is required for updating
            'vendor_name' => 'required',
            'contact_number' => 'required|min:10|max:10',
            'alternate_contact_no' => 'required|min:10|max:10', // Add validation rules for new fields
            'email' => 'required|email',
            'person_name' => 'required',
            'designation' => 'required',
            'person_number' => 'required|min:10|max:10',
            'package_ids' => 'required|array|min:1',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()->all()
            ]);
        }

        $vendor = Vendor::find($request->input('id'));
        if (!$vendor) {
            return response()->json([
                'success' => false,
                'messages' => "Company not found"
            ]);
        }

        $vendor->vendor_name = $request->input('vendor_name');
        $vendor->contact_number = $request->input('contact_number');
        $vendor->alternate_contact_no = $request->input('alternate_contact_no'); // Assign values for new fields
        $vendor->email = $request->input('email');
        $vendor->person_name = $request->input('person_name');
        $vendor->designation = $request->input('designation');
        $vendor->person_number = $request->input('person_number');
        $vendor->package_ids = $request->input('package_ids');

        $updated = $vendor->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'messages' => "Company data updated successfully"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'messages' => "Error while updating vendor data"
            ]);
        }
    }
}
