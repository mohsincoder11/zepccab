<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BlogsController extends Controller
{
    public function allBlogs()
    {
        $output = array('data' => array());
        $blogs = DB::table('blogs')
            ->select('blogs.*')
            ->orderBy('id', 'DESC')
            ->get();

        $x = 1;
        foreach ($blogs as $row)
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
                $row->title,
                $row->date,
                $image,
                $row->description,
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
            'title' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $date = Carbon::parse($request['date'],'Asia/Kolkata')->format('Y-m-d');
        $blog = new Blogs($request->input());
        $blog->title = $request['title'];
        $blog->description = $request['description'];
        $blog->date = $date;

        if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $request->file('image')->hashName();
            $destinationPath = public_path().'/img' ;
            $file->move($destinationPath,$fileName);
            $blog->image = $fileName ;
        }

        $query =$blog->save();

        if($query == TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Blog Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Blog";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeBlog(Request $request)
    {
        $id = $request['blog'];
        $blog = DB::table('blogs')
            ->where('id', '=', $id)
            ->delete();

        if($blog == TRUE) {
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
