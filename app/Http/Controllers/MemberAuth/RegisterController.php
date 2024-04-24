<?php

namespace App\Http\Controllers\MemberAuth;

use App\Mail\NewUserMail;
use App\Mail\ReferMail;
use App\Member;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/member/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('member.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $referral_code = $data['referral_code'];

        if ($referral_code != null)
        {
            $referral_id = Student::select('id')->where('referral_code',$referral_code)->first();

            if ($referral_id != null)
            {
                $student = Student::find($referral_id)->first();
                $end_date =  $student->end_date;

                $next_due_date = date('Y-m-d', strtotime($end_date. ' +30 days'));
                $student->end_date = $next_due_date;
                $student->save();
            }
            else
            {
                $message = "Invalid Promo Code";
                echo "<script type='text/javascript'>alert('$message');</script>";

                $validator = Validator::make($data, [
                    'invalid_promo_code' => 'required'
                ]);

                return $validator;
            }
        }

        $validator = Validator::make($data, [
            'class_id' => 'required|max:255',
            'pincode' => 'required|max:255',
            'gender' => 'required|max:255',
            'collage' => 'required|max:255',
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'plan_id' => 'required|max:255',
            'board_id' => 'required|max:255',
            'mobile_no' => 'required|max:255',
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'type_id' => 'required|max:255',
            'email' => 'required|email|max:255|unique:members',
            'password' => 'required|min:6|confirmed',
        ]);

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Member
     */
    protected function create(array $data)
    {
        $digit = mt_rand(1000, 9999);
        $referal = $data['first_name'].''.$digit;
        $referal = strtoupper($referal);

        if ($data['plan_id'] == 2)
        {
            $date = date('Y-m-d', strtotime("+30 days"));
        }
        else
        {
            $date = date('Y-m-d');
        }

        $referral_code = $data['referral_code'];
        $referral_from = Student::select('id')->where('referral_code',$referral_code)->first();

        if ($referral_from != null)
        {
            $referral_id = $referral_from->id;
        }
        else
        {
            $referral_id = null;
        }

        $student_id = Student::insertGetId([
            'class_id'=> $data['class_id'],
            'pincode'=> $data['pincode'],
            'gender'=> $data['gender'],
            'collage'=> $data['collage'],
            'city'=> $data['city'],
            'address'=> $data['address'],
            'plan_id'=> $data['plan_id'],
            'board_id'=> $data['board_id'],
            'email'=> $data['email'],
            'mobile_no'=> $data['mobile_no'],
            'last_name'=> $data['last_name'],
            'first_name'=> $data['first_name'],
            'type_id'=> $data['type_id'],
            'referral_code'=> $referal,
            'referral_from'=> $referral_id,
            'end_date'=> $date,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);

        $user_name = $data['first_name'].' '.$data['last_name'];
        $user_email = $data['email'];
        $password = $data['password'];
        $plan = $data['plan_id'];

        if($plan == 1)
        {
            $plan = "GOLD";
        }
        else
        {
            $plan = "SILVER";
        }

        $content = array(
            'name' => $user_name,
            'email' => $user_email,
            'password' => $password,
            'plan' => $plan,
            'referal' => $referal
        );


        if ($student_id > 0)
        {
            try {
                Mail::to($user_email)->send(new NewUserMail($content));

            } catch (\Exception $e) {
                echo 'Error - '.$e;
            }

            try {
                Mail::to($user_email)->send(new ReferMail($content));

            } catch (\Exception $e) {
                echo 'Error - '.$e;
            }
        }
        return Member::create([
            'name' => $data['first_name'].' '.$data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'student_id' => $student_id
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('member.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('member');
    }


}
