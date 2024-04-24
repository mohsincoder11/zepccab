<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);

    }

     public function city()
    {
        return view('city.index');
    }

    public function cartype()
    {
        return view('cartype.index');
    }

    public function car()
    {
        return view('car.index');
    }

   

    public function driver()
    {
        return view('driver.index');
    }

    public function package()
    {
        return view('package.index');
    }

    public function outstation()
    {
        return view('rental.index');
    }

    public function coupon()
    {
        return view('coupon.index');
    }

    public function shareride()
    {
        return view('shareride.index');
    }

    public function customer()
    {
        return view('customer.index');
    }
	
	public function register_customer()
    {
        return view('rcustomer.index');
    }
	
	

     public function notification()
    {
        return view('notification.index');
    }

     public function feedback()
    {
        return view('feedback.index');
    }

    public function sos()
    {
        return view('sos.index');
    }
    
    public function enquiryrental()
    {
        return view('enquiryrental.index');
    }
	
	 public function corporate()
    {
        return view('corporate.index');
    }
	
	 public function blog()
    {
        return view('blog.index');
    }
	
	 public function video_section()
    {
        return view('video.index');
    }
	
	public function restaurant()
    {
        return view('restaurant.index');
    }
    public function menus()
    {
        return view('menus.index');
    }
    public function category()
    {
        return view('category.index');
    }
    public function orders()
    {
        return view('orders.index');
    }
 
    public function analytic(Request $request)
    { 
        $result=DB::table('driver_customer_linking')    
        ->select('status',DB::raw('count(*) as total'));

        if(isset($request->from_date) && isset($request->to_date)){
            $result= $result->whereDate('created_at','<=',$request->to_date)
            ->whereDate('created_at','>=',$request->from_date);
            //in this if block we concate the where condition on result variable. if date is set then if block will be executed.         
        }

        $result= $result->whereIn('status',['completed','cancelled'])
         ->groupBy('status')
         ->get();

    
        $data1 = "";
        foreach($result as $val)
        $data1 .= "['".$val->status."',  ".$val->total."],";
       
         $arr['data1'] = rtrim($data1,",");
        

         $result=DB::table('driver_package_linking')    
         ->select('status',DB::raw('count(*) as total'));
 
         if(isset($request->from_date) && isset($request->to_date)){
             $result= $result->whereDate('created_at','<=',$request->to_date)
             ->whereDate('created_at','>=',$request->from_date);
             //in this if block we concate the where condition on result variable. if date is set then if block will be executed.         
         }
 
         $result= $result->whereIn('status',['completed','cancelled'])
          ->groupBy('status')
          ->get();
 
     
         $data2 = "";
         foreach($result as $val)
         $data2 .= "['".$val->status."',  ".$val->total."],";
         // dd($result);
          $arr['data2'] = rtrim($data2,",");
         

          $result=DB::table('outstation')    
         ->select('status',DB::raw('count(*) as total'));
 
         if(isset($request->from_date) && isset($request->to_date)){
             $result= $result->whereDate('created_at','<=',$request->to_date)
             ->whereDate('created_at','>=',$request->from_date);
             //in this if block we concate the where condition on result variable. if date is set then if block will be executed.         
         }
 
         $result= $result->whereIn('status',['completed','cancelled'])
          ->groupBy('status')
          ->get();
 
     
         $data3 = "";
         foreach($result as $val)
         $data3 .= "['".$val->status."',  ".$val->total."],";
         // dd($result);
          $arr['data3'] = rtrim($data3,",");

          $pending=DB::table('customer')
            ->join('temp_customer_travel_linking', 'temp_customer_travel_linking.customer_id', '=', 'customer.id')
            ->where('temp_customer_travel_linking.status','pending')
            ->count();
            $pending+=DB::table('customer')
            ->join('temp_outstation', 'temp_outstation.customer_id', '=', 'customer.id')
            ->where('temp_outstation.status','pending')
            ->count();
            $pending+=DB::table('customer')
            ->join('temp_customer_package_linking', 'temp_customer_package_linking.customer_id', '=', 'customer.id')
            ->where('temp_customer_package_linking.status','pending')
            ->count();

            $converted=DB::table('customer')
            ->join('temp_customer_travel_linking', 'temp_customer_travel_linking.customer_id', '=', 'customer.id')
            ->where('temp_customer_travel_linking.status','Converted')
            ->count();
            $converted+=DB::table('customer')
            ->join('temp_outstation', 'temp_outstation.customer_id', '=', 'customer.id')
            ->where('temp_outstation.status','Converted')
            ->count();
            $converted+=DB::table('customer')
            ->join('temp_customer_package_linking', 'temp_customer_package_linking.customer_id', '=', 'customer.id')
            ->where('temp_customer_package_linking.status','Converted')
            ->count();
            
          $arr['data4']=['convert'=>$converted,'pending'=>$pending];
        // echo json_encode($arr['data4']);
        // exit();
        
        return view('analytic',$arr);
    }

    public function website_enquiry(){
        return view('website-enquiry');
    }

    public function allwebsiteenquiry()
    {
        $output = array('data' => array());
        $enquiry = DB::table('home_page_form')
            ->orderBy('id', 'desc')
            ->get();

        $x = 1;
        foreach ($enquiry as $row)
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
            $message ='<span class="text-container txt-overflow-200"><span class="short-text">'.Str::limit($row->message, 50);
            $message .= Str::length($row->message) > 20 ? '<a style="color: #007bff;" class="read-more-link">Read More</a>' : '';
            $message .=' </span>';
            $message .='<p class="full-text" style="display: none;">'.$row->message .'
                                        </p>';
            $message .='<p style="display: none;color: #007bff;" class="show-less" >
            <a href="#" style="color: #007bff;" class="show-less-link">Show Less</a>
        </p>';


            $message.='</span>';

          
            $output['data'][] = array(
                $row->name,
                $row->phone,
                $row->email,
                $message,
                date('d-m-Y H:i:s',strtotime($row->created_at)),

                $actionButton,
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

    public function removewebsiteenquiry(Request $request){
        $enquiry = DB::table('home_page_form')->where('id',$request->id)->delete();

        if($enquiry == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }


    public function website_enquiry2(){
        return view('website-enquiry2');
    }

    public function allwebsiteenquiry2()
    {
        $output = array('data' => array());
        $enquiry = DB::table('home_page_enquiry')
            ->orderBy('id', 'desc')
            ->get();

        $x = 1;
        foreach ($enquiry as $row)
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
                ucwords($row->pick_up_location),
                ucwords($row->drop_location),
                $row->phone,
                $row->type . (isset($row->package) ? ' ['.$row->package.']' : ''),
                date('d-m-Y H:i:s',strtotime($row->created_at)),
                $actionButton,
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

    public function removewebsiteenquiry2(Request $request){
        $enquiry = DB::table('home_page_enquiry')->where('id',$request->id)->delete();

        if($enquiry == TRUE) {
            $response['success'] = true;
            $response['messages'] = "Deleted Successfully";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error while Delete!";
        }
        echo json_encode( $response);
    }
    

    public function all_rides(){
        return view('all-ride.index');
    }

    public function get_all_rides(Request $request){
        $data=[];
        if($request->type=="All"){
            $local=$this->allCustomer($request);
             $rental=$this->allRentalEnq($request);
             $outstation=$this->allRental($request);
             $data=array_merge($data,$local->original['data']);
             $data=array_merge($data,$rental->original['data']);
             $data=array_merge($data,$outstation->original['data']);
             $data=['data'=>$data];
        }  
        if($request->type=="Local"){
            $data=$this->allCustomer($request);
        } 
        else if($request->type=="Rental"){
            $data=$this->allRentalEnq($request);
        }
        else if($request->type=="Outstation"){
            $data=$this->allRental($request);
        }
       return $data;
    }

    public function allCustomer(Request $request)
    {
        $output = array('data' => array());
		
		
	    $customer = DB::table('customer')
            ->join('customer_travel_linking', 'customer_travel_linking.customer_id', '=', 'customer.id')
            ->join('car_types', 'car_types.id', '=', 'customer_travel_linking.car_type_id')
			->join('driver_customer_linking', 'driver_customer_linking.customer_travel_id', '=', 'customer_travel_linking.id')
			->join('driver', 'driver.id', '=', 'driver_customer_linking.driver_id')
            ->select('customer.*',
					 'driver_customer_linking.id as driver_customer_linking_id',
					 'driver_customer_linking.otp as otp',
					 'customer_travel_linking.added_by as added_by',
					 'driver_customer_linking.status as customer_travel_status',
					 'driver_customer_linking.custoemr_amount as customer_travel_amount',
					 'driver_customer_linking.cancelled_by as cancelled_by',
					 'driver_customer_linking.reason as reason',
					 'driver.first_name as driver_first_name',
					 'driver.last_name as driver_last_name',
					 'driver_customer_linking.without_coupon_amount as without_coupon_amount',
					 'driver_customer_linking.custoemr_amount as custoemr_amount',
                	 'car_types.name as car_types_name',
					 'customer_travel_linking.ride_later_date as ride_later_date',
					 'customer_travel_linking.id as ctl_id',
					 'customer_travel_linking.ride_later_time as ride_later_time',
					 'customer_travel_linking.coupon as coupon_name',
                	 'customer_travel_linking.travel_type as travel_type',
                	 'customer_travel_linking.from_location',
                	 'customer_travel_linking.to_location',
                	 'customer_travel_linking.estimated_cost',
                	 'driver_customer_linking.distance_user_destination_km',
                	 'driver_customer_linking.without_coupon_amount',
                     )
			->whereNotIn('driver_customer_linking.status', ['rejected','pending'])
            ->orderBy('ride_later_date', 'DESC');
            
            if(isset($request->role) && $request->role!='1'){
                $customer=$customer->
                whereBetween('ride_later_date',[Carbon::today(), Carbon::today()->addDays(2)]);
            }
            $customer=$customer->get(); 
           
		
	//	 ->orderBy('customer.first_name', 'ASC')



        $x = 1;
        foreach ($customer as $row)
        {
			$statics = "RX1400";
			$refid =$statics.''.$row->ctl_id;

            $name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->first_name.' '.$row->last_name.' </span>';

            $destination_details='<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> From: '.$row->from_location.' <br>
            To: '.$row->to_location.'<br>
            </span>';
			

			$date_time = date('d-m-Y',strtotime($row->ride_later_date));
			
			

            $output['data'][] = array(
				$refid,
                '<STRONG>LOCAL<STRONG>',
				$date_time,
                $name,
                $row->mobile_no,
				$destination_details,
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

    public function allRentalEnq(Request $request)
    {
       $output = array('data' => array());
       $sos = DB::table('customer')
           ->join('customer_package_linking', 'customer.id', '=', 'customer_package_linking.customer_id')
           ->leftjoin('driver_package_linking', 'driver_package_linking.customer_package_id', '=', 'customer_package_linking.id')
           ->leftjoin('package_cartype_linking', 'package_cartype_linking.id', '=', 'customer_package_linking.pctl_id')
           ->leftjoin('package', 'package.id', '=', 'package_cartype_linking.package_id')
           ->leftjoin('car_types', 'car_types.id', '=', 'package_cartype_linking.cartype_id')
           ->leftjoin('driver', 'driver.id', '=', 'driver_package_linking.driver_id')
           ->select('customer.*',
                    'driver_package_linking.otp as otp',
                    'driver_package_linking.id as driver_package_linking_id',
                    'driver_package_linking.cancelled_by as ride_cancelled_by',
                    'driver_package_linking.reason as ride_reason',
                    'driver_package_linking.status as ride_status',
                    'package_cartype_linking.amount as amount',
                    'driver.first_name as driver_first_name',
                    'driver.last_name as driver_last_name',
                    'customer_package_linking.ride_later_date as ride_later_date',
                    'customer_package_linking.ride_later_time as ride_later_time',
                   'package.name as package_name',
                   'driver_package_linking.id as driver_package_linking_id',
                   'customer_package_linking.id as ref_id',
                   'car_types.name as cartype_name',
                   'driver_package_linking.without_coupon_amount as without_coupon_amount',
                   'driver_package_linking.custoemr_amount as custoemr_amount',
                   'customer_package_linking.coupon as coupon_name',
                    'customer_package_linking.start_time as start_time',
                   'customer_package_linking.end_time as end_time',
                   'customer_package_linking.toAdmin as toAdmin',
                   'customer_package_linking.pick_location',
                   'driver_package_linking.distance_user_destination_km',
                   'driver_package_linking.without_coupon_amount',
                   )
           //         		//	->whereNotIn('driver_package_linking.status', ['pending','rejected'])
           // ->where('customer_package_linking.toAdmin',1)
           // ->orderBy('customer_package_linking.id', 'DESC')
           // ->get();

           ->whereNotIn('driver_package_linking.status', ['pending'])
           //->where('customer_package_linking.toAdmin',1)
           ->orderBy('customer_package_linking.ride_later_date', 'DESC')
           ->groupBy('ref_id');
           if(isset($request->role) && $request->role!='1'){
               $sos=$sos->
               whereBetween('ride_later_date',[Carbon::today(), Carbon::today()->addDays(2)]);
           }

           $sos=$sos->get();
          
       $x = 1;
       foreach ($sos as $row)
       {

           $statics = "RX1400";
           $refid =$statics.''.$row->ref_id;
           
           $name='<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;">'.$row->first_name.' '.$row->last_name.'</span>';

           $date_time = date('d-m-Y',strtotime($row->ride_later_date));

                  $destination_details='<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Pick Location: '.$row->pick_location.'<br>
                  </span>';

               
           
          
           $status_admin = $row->toAdmin;

           if ($status_admin == 0)
           {
               $status_admin = '<span class="badge badge-success"> Admin </span>';
           }
           else if($status_admin == 1)
           {
               $status_admin = '<span class="badge badge-danger"> App </span>';
           }

           $output['data'][] = array(
               $refid,
               '<B>RENTAL<B>',
               $date_time,
               $name,
               $row->mobile_no,
               $destination_details,
              
           );
           $x++;
       }
       $data= response()->json($output);
       return $data;
    }

    public function allRental(Request $request){
        $output = array('data' => array());
        $rental = DB::table('outstation')
            ->leftJoin('car_types', 'car_types.id', '=', 'outstation.car_type_id')
            ->leftJoin('customer', 'customer.id', '=', 'outstation.customer_id')
            ->leftJoin('driver', 'driver.id', '=', 'outstation.driver_id')
            ->select('outstation.*',
                'customer.first_name as first_name',
                'customer.last_name as last_name',
				'customer.mobile_no as mobile_no',
                'driver.first_name as driver_first_name',
                'driver.mobile_no as driver_mobile_no',
                'driver.last_name as driver_last_name',
                'car_types.name as car_type_name')
            ->orderBy('outstation.date', 'DESC');
            if(isset($request->role) && $request->role!='1'){
                $rental=$rental->
                whereBetween('outstation.created_at',[Carbon::today(), Carbon::today()->addDays(2)]);
            }
            $rental=$rental->get();

        $x = 1;
        foreach ($rental as $row)
        {
			$statics = "RX1400";
			$refid =$statics.''.$row->id;

            $date=date('d-m-Y',strtotime($row->date));
            $name='<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;">'.$row->first_name.' '.$row->last_name.'<span>';




            $destination_details = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;">From: '.$row->from_origin.'<br> To: '.$row->to_destination.' </span>';

          

          



            $output['data'][] = array(
				$refid,
                '<b>OUTSTATION<B>',
				$date,
                $name,
				// $driver_name,
				$row->mobile_no,
                $destination_details,
		
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

    public function enquiry_section(){
        return view('enquiry-section.index');
    }

    public function enquiry_get_all_rides(Request $request){
        $data=[];
        if($request->type=="All"){
            $local=$this->enquiry_allCustomer($request);
             $rental=$this->enquiry_allRentalEnq($request);
             $outstation=$this->enquiry_allRental($request);
             $data=array_merge($data,$local->original['data']);
             $data=array_merge($data,$rental->original['data']);
             $data=array_merge($data,$outstation->original['data']);
             $data=['data'=>$data];
        }  
        if($request->type=="Local"){
            $data=$this->enquiry_allCustomer($request);
        } 
        else if($request->type=="Rental"){
            $data=$this->enquiry_allRentalEnq($request);
        }
        else if($request->type=="Outstation"){
            $data=$this->enquiry_allRental($request);
        }
       return $data;
    }

    public function enquiry_allCustomer(Request $request)
    {
        $output = array('data' => array());
		
		
	    $customer = DB::table('customer')
            ->join('temp_customer_travel_linking', 'temp_customer_travel_linking.customer_id', '=', 'customer.id')
            ->join('car_types', 'car_types.id', '=', 'temp_customer_travel_linking.car_type_id')
		  ->select('customer.*',
					 'temp_customer_travel_linking.added_by as added_by',
                	 'car_types.name as car_types_name',
					 'temp_customer_travel_linking.ride_later_date as ride_later_date',
					 'temp_customer_travel_linking.id as ctl_id',
					 'temp_customer_travel_linking.ride_later_time as ride_later_time',
					 'temp_customer_travel_linking.coupon as coupon_name',
                	 'temp_customer_travel_linking.travel_type as travel_type',
                	 'temp_customer_travel_linking.from_location',
                	 'temp_customer_travel_linking.to_location',
                	 'temp_customer_travel_linking.estimated_cost',
                	 'temp_customer_travel_linking.status',
                	 'temp_customer_travel_linking.id as local_id',
                	 'temp_customer_travel_linking.ref_id',
                     )
            ->orderBy('ride_later_date', 'DESC');
            
            if(isset($request->role) && $request->role!='1'){
                $customer=$customer->
                whereBetween('ride_later_date',[Carbon::today(), Carbon::today()->addDays(2)]);
            }
            $customer=$customer->get(); 
           
		
	//	 ->orderBy('customer.first_name', 'ASC')



        $x = 1;
        foreach ($customer as $row)
        {
			$statics = "RX1400";
			$refid =$statics.''.$row->ref_id;

            $name = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> '.$row->first_name.' '.$row->last_name.' </span>';

            $destination_details='<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> From: '.$row->from_location.' <br>
            To: '.$row->to_location.'<br>
            </span>';
			

			$date_time = date('d-m-Y',strtotime($row->ride_later_date));
            $delete_button='';
            if($request->role=='1'){
                $delete_button='<a href="#" data-toggle="modal" data-target="#removeModal" 
                onclick="removeItem('.$row->local_id.',1)">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>';
            }
            $actionButton = '
          <td>	
           
          <a href="#"  >
          <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 viewEnquiry" id="'.$row->local_id.'" ride_type="Local">
          <i class="fa fa-eye mt-0"></i>
      </button>
      </a> <a href="#" onclick="ConvertItem('.$row->local_id.')" >
      <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 ConvertEnquiry" id="'.$row->local_id.'" ride_type="Local" >
          <i class="fa fa-link mt-0"></i>
      </button>
  </a>  <a href="#"  >
  <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 EditEnquiry" id="'.$row->local_id.'" ride_type="Local">
  <i class="fa fa-pencil mt-0"></i>
</button>
</a>'.$delete_button.'            
            </td>';
			

            $output['data'][] = array(
				$refid,
                '<STRONG>LOCAL<STRONG>',
				$date_time,
                $name,
                $row->mobile_no,
				$destination_details,
                ucFirst($row->status),
                $actionButton,
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

    public function enquiry_allRentalEnq(Request $request)
    {
       $output = array('data' => array());
       $sos = DB::table('customer')
           ->join('temp_customer_package_linking', 'customer.id', '=', 'temp_customer_package_linking.customer_id')
         
           ->leftjoin('package_cartype_linking', 'package_cartype_linking.id', '=', 'temp_customer_package_linking.pctl_id')
           ->leftjoin('package', 'package.id', '=', 'package_cartype_linking.package_id')
           ->leftjoin('car_types', 'car_types.id', '=', 'package_cartype_linking.cartype_id')
           ->select('customer.*',
                   
                    'package_cartype_linking.amount as amount',
                  
                    'temp_customer_package_linking.ride_later_date as ride_later_date',
                    'temp_customer_package_linking.ride_later_time as ride_later_time',
                   'package.name as package_name',
                   'car_types.name as cartype_name',
                   'temp_customer_package_linking.coupon as coupon_name',
                    'temp_customer_package_linking.start_time as start_time',
                   'temp_customer_package_linking.end_time as end_time',
                   'temp_customer_package_linking.toAdmin as toAdmin',
                   'temp_customer_package_linking.pick_location',
                   'temp_customer_package_linking.status',
                   'temp_customer_package_linking.id as rental_id',
                   'temp_customer_package_linking.ref_id as refid',
                   )
           //         		//	->whereNotIn('driver_package_linking.status', ['pending','rejected'])
           // ->where('temp_customer_package_linking.toAdmin',1)
           // ->orderBy('temp_customer_package_linking.id', 'DESC')
           // ->get();

           //->where('temp_customer_package_linking.toAdmin',1)
           ->orderBy('temp_customer_package_linking.ride_later_date', 'DESC')
           ->groupBy('rental_id');
           if(isset($request->role) && $request->role!='1'){
               $sos=$sos->
               whereBetween('ride_later_date',[Carbon::today(), Carbon::today()->addDays(2)]);
           }

           $sos=$sos->get();
          
       $x = 1;
       foreach ($sos as $row)
       {

           $statics = "RX1400";
           $refid =$statics.''.$row->refid;
           
           $name='<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;">'.$row->first_name.' '.$row->last_name.'</span>';

           $date_time = date('d-m-Y',strtotime($row->ride_later_date));

                  $destination_details='<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;"> Pick Location: '.$row->pick_location.'<br>
                  </span>';

               
           
          
           $status_admin = $row->toAdmin;

           if ($status_admin == 0)
           {
               $status_admin = '<span class="badge badge-success"> Admin </span>';
           }
           else if($status_admin == 1)
           {
               $status_admin = '<span class="badge badge-danger"> App </span>';
           }
$delete_button='';
            if($request->role=='1'){
                $delete_button='<a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem('.$row->rental_id.',2)">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>';
            }
            $actionButton = '
          <td>	
           
          <a href="#" >
          <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 viewEnquiry" id="'.$row->rental_id.'" ride_type="Rental">
          <i class="fa fa-eye mt-0"></i>
      </button>
      </a> <a href="#" onclick="ConvertItem('.$row->rental_id.')" >
      <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 ConvertEnquiry" id="'.$row->rental_id.'" ride_type="Rental" >
          <i class="fa fa-link mt-0"></i>
      </button>
  </a> <a href="#"  >
  <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 EditEnquiry" id="'.$row->rental_id.'" ride_type="Rental">
  <i class="fa fa-pencil mt-0"></i>
</button>
</a>'.$delete_button.'            
            </td>';
           $output['data'][] = array(
               $refid,
               '<B>RENTAL<B>',
               $date_time,
               $name,
               $row->mobile_no,
               $destination_details,
               ucFirst($row->status),
                $actionButton,
           );
           $x++;
       }
       $data= response()->json($output);
       return $data;
    }

    public function enquiry_allRental(Request $request){
        $output = array('data' => array());
        $rental = DB::table('temp_outstation')
            ->leftJoin('car_types', 'car_types.id', '=', 'temp_outstation.car_type_id')
            ->leftJoin('customer', 'customer.id', '=', 'temp_outstation.customer_id')
            ->select('temp_outstation.*',
                'customer.first_name as first_name',
                'customer.last_name as last_name',
				'customer.mobile_no as mobile_no',
                'car_types.name as car_type_name')
            ->orderBy('temp_outstation.date', 'DESC');
            if(isset($request->role) && $request->role!='1'){
                $rental=$rental->
                whereBetween('temp_outstation.created_at',[Carbon::today(), Carbon::today()->addDays(2)]);
            }
            $rental=$rental->get();

        $x = 1;
        foreach ($rental as $row)
        {
			$statics = "RX1400";
			$refid =$statics.''.$row->ref_id;

            $date=date('d-m-Y',strtotime($row->date));
            $name='<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;">'.$row->first_name.' '.$row->last_name.'<span>';




            $destination_details = '<span class="badge badge-success" style="background: linear-gradient(to bottom, #f3ac1f , #ff0000 ); font-size: 12px;">From: '.$row->from_origin.'<br> To: '.$row->to_destination.' </span>';

          

          


$delete_button='';
            if($request->role=='1'){
                $delete_button='<a href="#" data-toggle="modal" data-target="#removeModal" onclick="removeItem('.$row->id.',3)">
                <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalConfirmDelete">
                    <i class="fa fa-trash mt-0"></i>
                </button>
            </a>';
            }
            $actionButton = '
          <td>	
           
          <a href="#"  >
          <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 viewEnquiry" id="'.$row->id.'" ride_type="Outstation">
              <i class="fa fa-eye mt-0"></i>
          </button>
      </a> <a href="#" onclick="ConvertItem('.$row->id.')" >
      <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 ConvertEnquiry" id="'.$row->id.'" ride_type="Outstation" >
          <i class="fa fa-link mt-0"></i>
      </button>
  </a> <a href="#"  >
  <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2 EditEnquiry" id="'.$row->id.'" ride_type="Outstation">
  <i class="fa fa-pencil mt-0"></i>
</button>
</a>'.$delete_button.'            
            </td>';
            $output['data'][] = array(
				$refid,
                '<b>OUTSTATION<B>',
				$date,
                $name,
				// $driver_name,
				$row->mobile_no,
                $destination_details,
                ucFirst($row->status),
                $actionButton,
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }
}
