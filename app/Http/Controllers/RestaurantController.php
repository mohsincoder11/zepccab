<?php

namespace App\Http\Controllers;

use App\City;
use App\Coupon;
use App\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function allRestaurant()
    {
        $output = array('data' => array());
        $restaurants = DB::table('restaurants')
            ->join('city', 'city.id', '=', 'restaurants.city')
            ->select('restaurants.*',
                'city.name as city_name')
            ->orderBy('restaurants.id', 'DESC')
            ->get();

        $x = 1;
        foreach ($restaurants as $row)
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
                $row->name,
                $row->city_name,
                $row->tags,
                $image,
                $row->address,
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
            'city' => 'required',
            'name' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $restaurants = new Restaurant($request->input());
        $restaurants->name = $request['name'];
        $restaurants->city = $request['city'];
        $restaurants->tags = $request['tags'];
        $restaurants->address = $request['address'];

        if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $request->file('image')->hashName();
            $destinationPath = public_path().'/img' ;
            $file->move($destinationPath,$fileName);
            $restaurants->image = $fileName ;
        }
        $query =$restaurants->save();

        if($query == TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Restaurants Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Restaurants";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function editRestaurant(Request $request)
    {
        $id = $request['id'];
        $restaurants = DB::table('restaurants')
            ->join('city', 'city.id', '=', 'restaurants.city')
            ->select('restaurants.*',
                'city.name as city_name')
            ->where('restaurants.id',$id)
            ->get();

        $cities = City::all();
        foreach ($cities as $city)
        {
            $city_data[] = '<option value="'.$city['id'].'" '.($restaurants[0]->city==$city['id']?"selected":"").'>'.$city['name'].'</option>';
        }


        $data= response()->json(array(
            'restaurants' => $restaurants[0],
            'cities' => $city_data
        ));
        return $data;
    }

    public function updateRestaurant(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'city' => 'required',
            'name' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $id = $request['id'];

        $restaurant = DB::table('restaurants')
            ->select('restaurants.*')
            ->where('id',$id)
            ->get();
        $fileName = $restaurant[0]->image;

        if($file = $request->hasFile('edit_image')) {
            $file = $request->file('edit_image') ;
            $fileName = $request->file('edit_image')->hashName();
            $destinationPath = public_path().'/img' ;
            $file->move($destinationPath,$fileName);
        }

        $data = array(
            'name' =>$request['name'],
            'city' =>$request['city'],
            'tags' =>$request['tags'],
            'image' =>$fileName,
            'address' =>$request['address'],
        );

        $query = DB::table('restaurants')
            ->where('id',$id)
            ->update($data);

        if($query === 1) {
            $validator['success'] = true;
            $validator['messages'] = "Restaurant Data Updated successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Updated Restaurant Data";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeRestaurant(Request $request)
    {
        $id = $request['restaurant'];
        $restaurant = Restaurant::find($id)->delete();

        if($restaurant == TRUE) {
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
