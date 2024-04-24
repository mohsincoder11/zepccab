<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $output = array('data' => array());
        $categories = DB::table('menu_categories')
            ->join('restaurants', 'restaurants.id', '=', 'menu_categories.restaurant')
            ->select('menu_categories.*',
                'restaurants.name as restaurant_name')
            ->orderBy('menu_categories.id', 'DESC')
            ->get();

        $x = 1;
        foreach ($categories as $row)
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

            $output['data'][] = array(
                $row->name,
                $row->restaurant_name,
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
            'restaurant' => 'required',
            'name' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $category = new Category($request->input());
        $category->name = $request['name'];
        $category->restaurant = $request['restaurant'];

        $query =$category->save();

        if($query == TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Category Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Category";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function editCategory(Request $request)
    {
        $id = $request['id'];
        $categories = DB::table('menu_categories')
            ->join('restaurants', 'restaurants.id', '=', 'menu_categories.restaurant')
            ->select('menu_categories.*',
                'restaurants.name as restaurant_name')
            ->where('menu_categories.id',$id)
            ->get();

        $restaurants = Restaurant::all();
        foreach ($restaurants as $restaurant)
        {
            $restaurant_data[] = '<option value="'.$restaurant['id'].'" '.($categories[0]->restaurant==$restaurant['id']?"selected":"").'>'.$restaurant['name'].'</option>';
        }


        $data= response()->json(array(
            'categories' => $categories[0],
            'restaurant' => $restaurant_data
        ));
        return $data;
    }

    public function updateCategory(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'restaurant' => 'required',
            'name' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];
        $data = array(
            'restaurant' =>$request['restaurant'],
            'name' =>$request['name']
        );

        $query = DB::table('menu_categories')
            ->where('id',$id)
            ->update($data);

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Category Data Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Category Data";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeCategory(Request $request)
    {
        $id = $request['category'];
        $category = Category::find($id)->delete();

        if($category == TRUE) {
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
