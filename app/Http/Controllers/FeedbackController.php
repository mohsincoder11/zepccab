<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function allFeedback()
    {
        $output = array('data' => array());
        $feedback = DB::table('feedback')
			->join('customer', 'customer.id', '=', 'feedback.customer_id')
            ->select('feedback.*',
					'customer.first_name as first_name',
					'customer.last_name as last_name',
					'customer.mobile_no as mobile_no')
            ->orderBy('feedback.id', 'DESC')
            ->get();
        $x = 1;
        foreach ($feedback as $row)
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
			
			if($row->rating == 5)
			{
		$rating = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 );">
		  <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i></span>';
			}
			else if($row->rating == 4)
			{
				$rating = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 );">
		  <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span>';
			}
			else if($row->rating == 3)
			{
				$rating = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 );">
		  <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span>';
			}
			else if($row->rating == 2)
			{
				$rating = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 );">
		  <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span>';
			}
			else if($row->rating == 1)
			{
				$rating = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 );">
		  <i class="fa fa-star" aria-hidden="true"></i> </span>';
			}
			else
			{
				$rating = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 );">
		  No Data </span>';
			}
			
			
			
			
			

            $output['data'][] = array(
				$row->first_name.' '.$row->last_name,
				$row->mobile_no,
                $rating,
                $row->review,
                $row->created_at,
                $actionButton,
            );
            $x++;
        }
        $data= response()->json($output);
        return $data;
    }

    public function removeFeedback(Request $request)
    {
        $id = $request['feedback'];
        $feedback = Feedback::find($id)->delete();

        if($feedback == TRUE) {
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
