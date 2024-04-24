<?php

namespace App\Http\Controllers;

use App\Mail\NewUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailNodeController extends Controller
{
    public function emailSentCab(Request $request)
    {
        $msg = $request['message'];
        $email = $request['email'];
        $content = array(
            'message' => $msg
        );

        try {
            Mail::to($email)->send(new NewUserMail($content));

        } catch (\Exception $e) {
            echo 'Error - '.$e;
        }

        return json_encode(array("status"=>true));

    }
}
