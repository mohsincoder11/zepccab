<?php

define('API_ACCESS_KEY','AAAAGdGMkvo:APA91bGEIhwxQVCnVe1mY5E0Pc4gGOmuSm8FenhfBXVNSuA3n7bbFawHIWDUXiwygRchV0Wl_VVbH8xm4mxsEacUtrpJnHaFXmoUqdoHtuu05RAsuSycdZMCfPD-arYx6IirTRL6Tas9');
            $url = 'https://fcm.googleapis.com/fcm/send';
            // $registrationIds = array($_GET['id']);
            // prepare the message
            $message = array(
                'title'     => "Notification For Ride",
                'vibrate'   => true,
                'sound'      => 'sound.mp3'
                );

 		      $fields = array(
                            'data' => $message,
                            'notification'=>$message,
                            'to'=>'eqNRo0e6Rl8:APA91bG3YrOVOatAYlodC-_Yc3iZMtpf37V_W6eecr-4zkP1NrtiuxNFB8ZZHoeusAsmJa5ebJPFGsMLoZsYxxfiidfndK_g9_6GL2LHdLeChmwbXot2hM2q-3bUR3kshZgg0ghn5PQ-',
                            'data'=> array(
                            'paramType'     => 'driverRideNow',
                                'paramRideID'     =>'100'
                        )
                        );

                        $headers = array(
                            'Authorization: key='.API_ACCESS_KEY,
                            'Content-Type: application/json'
                        );
                        $ch = curl_init();
                        curl_setopt( $ch,CURLOPT_URL,$url);
                        curl_setopt( $ch,CURLOPT_POST,true);
                        curl_setopt( $ch,CURLOPT_HTTPHEADER,$headers);
                        curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
                        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false);
                        curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode($fields));
                        $result = curl_exec($ch);
                        curl_close($ch);
		
		
echo   $ch;
echo   123123;


?>