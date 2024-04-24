<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    public function contact()
    {
        return view('website.contact');
    }

    public function about()
    {
        return view('website.about');
    }

    public function services()
    {
        return view('website.services');
    }

    public function offer()
    {
        return view('website.offer');
    }
	
	public function blogs()
    {
        return view('website.blogs');
    }
	
	 public function AddEnquiryWebsite(Request $request)
    {
		 
		 if($request['contact_form'] == 1)
		 {
			 $validators = Validator::make($request->all(), [
            'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'message' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }
		 }
		 else
		 {
			 $validators = Validator::make($request->all(), [
			'from_destination' => 'required',
			'to_destination' => 'required',
			'mobile_number' => 'required'
        ]);

        if ($validators->fails()){
            $validator['success'] = false;
            $validator['messages'] = $validators->errors()->all();
            return json_encode($validator);
        }
		 }
        
		
		 if($request['contact_form'] == 1)
		 {
		 	$query = DB::table('contact_us')
            	->insert([
				'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
				'message' => $request['message']
					]);
			 
			 $to      = $request['email'];
			 $subject = 'Thank You For Enquiry Zhep Cab';
			 $message = 'Dear '.$request['name'].', Thank You For Contacting we will Comminicate as soon as possible.';
			 $headers = 'From: zheptoursandtravels@gmail.com' . "\r\n" .
    					'Reply-To: zheptoursandtravels@gmail.com' . "\r\n" .
    					'X-Mailer: PHP/' . phpversion();
			  mail($to, $subject, $message, $headers);
		 }
		 else
		 {
		 		$query = DB::table('enquiry_from_website')
            	->insert([
                'from_destination' => $request['from_destination'],
                'to_destination' => $request['to_destination'],
				'mobile_number' => $request['mobile_number']
					]);
			 
			 $to      = 'zheptoursandtravels@gmail.com';
			 $subject = 'Website Enquiry Customer';
			 $message = ' From Origin '.$request['from_destination'].',  To Destination : '.$request['to_destination'].', Mobile Number '.$request['mobile_number'].' ';
			 $headers = 'From: zheptoursandtravels@gmail.com' . "\r\n" .
    					'Reply-To: zheptoursandtravels@gmail.com' . "\r\n" .
    					'X-Mailer: PHP/' . phpversion();
			  mail($to, $subject, $message, $headers);
		 }
        
		 
        if($query == true) {
            $validator['success'] = true;
            $validator['messages'] = "Data Added successfully";
        }
        else {
            $validator['success'] = false;
            $validator['messages'] = "Error while Data";
        }
        // close the database connection
        echo json_encode($validator);
    }
}
