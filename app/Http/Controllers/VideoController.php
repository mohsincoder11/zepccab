<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function allVideo()
    {
        $output = array('data' => array());
        $videos = DB::table('video_section')
            ->select('video_section.*')
            ->orderBy('id', 'DESC')
            ->get();

        $x = 1;
        foreach ($videos as $row)
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
                $row->title,
                $row->url,
                $row->description,
                $row->created_at,
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
            'url' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }

        $video = new Video($request->input());
        $video->title = $request['title'];
        $video->description = $request['description'];
        $video->url = $request['url'];
        $query =$video->save();

        if($query == TRUE) {
            $validator['success'] = true;
            $validator['messages'] = "Video Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Adding Video";
        }
        // close the database connection
        echo json_encode($validator);
    }

    public function removeVideo(Request $request)
    {
        $id = $request['video_url'];
        $video = DB::table('video_section')
            ->where('id', '=', $id)
            ->delete();

        if($video == TRUE) {
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
