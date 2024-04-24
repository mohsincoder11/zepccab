<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index(){
        return view('company.index');
        
    }

    public function allCompany()
{
    $output = array('data' => array());
    $companies = Company::all()->sortByDesc('id');
    $x = 1;
    foreach ($companies as $row)
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
            </td>';
            
        $output['data'][] = array(
            $row->company_name,
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
    $data= response()->json($output);
    return $data;
}


public function store(Request $request)
{
   
    $validator = Validator::make($request->all(), [
        'company_name' => 'required',
        'contact_number' => 'required|min:10|max:10',
        'alternate_contact_no' => 'required|min:10|max:10', // Add validation rules for new fields
        'email' => 'required|email',
        'person_name' => 'required',
        'designation' => 'required',
        'person_number' => 'required|min:10|max:10',
        'package_ids' => 'required|array|min:1',

    ]);

    if ($validator->fails()){
        return response()->json([
            'success' => false,
            'messages' => $validator->errors()->all()
        ]);
    }

    $company = new Company();
    $company->company_name = $request->input('company_name');
    $company->contact_number = $request->input('contact_number');
    $company->alternate_contact_no = $request->input('alternate_contact_no'); // Assign values for new fields
    $company->email = $request->input('email');
    $company->person_name = $request->input('person_name');
    $company->designation = $request->input('designation');
    $company->person_number = $request->input('person_number');
    $company->package_ids = $request->input('package_ids');

    
    $query = $company->save();

    if($query) {
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


    public function removeCompany(Request $request)
    {
        $id = $request['company'];
        $company = Company::find($id)->delete();

        if($company == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }

    public function editCompany(Request $request)
    {
        $id = $request['id'];
        $company = DB::table('companies')
            ->where('id',$id)
            ->get();

        $data= response()->json(array(
            'company' => $company[0]
        ));
        return $data;
    }
    
    public function updateCompany(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id' => 'required', // Ensure 'id' is required for updating
        'company_name' => 'required',
        'contact_number' => 'required|min:10|max:10',
        'alternate_contact_no' => 'required|min:10|max:10', // Add validation rules for new fields
        'email' => 'required|email',
        'person_name' => 'required',
        'designation' => 'required',
        'person_number' => 'required|min:10|max:10',
        'package_ids' => 'required|array|min:1',

    ]);

    if ($validator->fails()){
        return response()->json([
            'success' => false,
            'messages' => $validator->errors()->all()
        ]);
    } 
        
    $company = Company::find($request->input('id'));
    if (!$company) {
        return response()->json([
            'success' => false,
            'messages' => "Company not found"
        ]);
    }

    $company->company_name = $request->input('company_name');
    $company->contact_number = $request->input('contact_number');
    $company->alternate_contact_no = $request->input('alternate_contact_no'); // Assign values for new fields
    $company->email = $request->input('email');
    $company->person_name = $request->input('person_name');
    $company->designation = $request->input('designation');
    $company->person_number = $request->input('person_number');
    $company->package_ids = $request->input('package_ids');

    $updated = $company->save();

    if ($updated) {
        return response()->json([
            'success' => true,
            'messages' => "Company data updated successfully"
        ]);
    } else {
        return response()->json([
            'success' => false,
            'messages' => "Error while updating company data"
        ]);
    }
}

}
