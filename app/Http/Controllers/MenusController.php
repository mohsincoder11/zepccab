<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Menus;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenusController extends Controller
{
    public function allMenus()
    {
        $output = array('data' => array());
        $menus = DB::table('menu_items')
            ->join('menu_categories', 'menu_categories.id', '=', 'menu_items.menu_category')
            ->select('menu_items.*',
                'menu_categories.name as category_name')
            ->orderBy('menu_items.id', 'DESC')
            ->get();

        $x = 1;
        foreach ($menus as $row)
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


            if ($row->image != NULL)
            {
                $image = '
                   <img src="'.asset('public/img/'.$row->image.'').'" class="rounded mx-auto d-block photo" height="50px" width="50px" data-toggle="modal" data-target="#imageModal">
            ';
            }
            else
            {
                $image = '
                   <img src="'.asset('public/img/no_photo.jpg').'" class="rounded mx-auto d-block photo" height="50px" width="50px" data-toggle="modal" data-target="#imageModal">
            ';
            }


            $output['data'][] = array(
                $row->category_name,
                $row->name,
                $row->price,
                $image,
                $row->details,
                $actionButton
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

    public function store(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'menu_category' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $menus = new Menus($request->input());
        $menus->menu_category = $request['menu_category'];
        $menus->name = $request['name'];
        $menus->price = $request['price'];
        $menus->details = $request['details'];

        if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $request->file('image')->hashName();
            $destinationPath = public_path().'/img' ;
            $file->move($destinationPath,$fileName);
            $menus->image = $fileName ;
        }
        $query =$menus->save();

        if($query == TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Menus Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Menus";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function editMenus(Request $request)
    {
        $id = $request['id'];
        $menus = DB::table('menu_items')
            ->join('menu_categories', 'menu_categories.id', '=', 'menu_items.menu_category')
            ->select('menu_items.*',
                'menu_categories.name as category_name')
            ->where('menu_items.id',$id)
            ->get();

        $categories = Category::all();
        foreach ($categories as $category)
        {
            $categories_data[] = '<option value="'.$category['id'].'" '.($menus[0]->menu_category==$category['id']?"selected":"").'>'.$category['name'].'</option>';
        }

        $data= response()->json(array(
            'menus' => $menus[0],
            'categories' => $categories_data
        ));
        return $data;
    }

    public function updateMenus(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'menu_category' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];

        $menus = DB::table('menu_items')
            ->select('menu_items.*')
            ->where('id',$id)
            ->get();
        $fileName = $menus[0]->image;

        if($file = $request->hasFile('edit_image')) {
            $file = $request->file('edit_image') ;
            $fileName = $request->file('edit_image')->hashName();
            $destinationPath = public_path().'/img' ;
            $file->move($destinationPath,$fileName);
        }

        $data = array(
            'menu_category' =>$request['menu_category'],
            'name' =>$request['name'],
            'price' =>$request['price'],
            'image' =>$fileName,
            'details' =>$request['details'],
        );

        $query = DB::table('menu_items')
            ->where('id',$id)
            ->update($data);

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Menus Data Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Menus Data";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeMenus(Request $request)
    {
        $id = $request['menus'];
        $menus = Menus::find($id)->delete();

        if($menus == TRUE) {
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
