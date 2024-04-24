<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendSmsController extends Controller
{
	 function test_sms(Request $req){
		
    $this->send_sms($req->six_digit,$req->to);
  }
    public function send_sms($six_digit,$to){
		
		
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://bulksms.webmediaindia.com/sendsms',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'uname=habitm1&pwd=habitm1&senderid=ZHEPCB&to='.$to.'&msg='.$six_digit.'%20is%20OTP%20for%20your%20Zhep%20Cab%20Account%20.%0A%20%20Do%20not%20share%20OTP%20with%20anyone%20due%20to%20security%20reasons&route=T&peid=1501478310000024700&tempid=1507161633922243528',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: PHPSESSID=0sd266ugc6hbgbc261tdi3st56; PHPSESSID=8b0a1568ftcsdivglkske2rr06'
          ),
        ));
                $response = curl_exec($curl);

curl_close($curl);



        return true;
    }
}
