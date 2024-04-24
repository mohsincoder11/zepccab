<?php

namespace App\Http\Controllers\MemberAuth;

use App\Http\Controllers\Controller;
use App\Mail\NewUserMail;
use App\Mail\ReferMail;
use App\Member;
use App\Student;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/member/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('member.guest', ['except' => 'logout']);
    }


    public function attemptLogin(Request $request)
    {
        $request['status'] = true;

        $data = $this->guard()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'status' =>$request->input('status')]);

        return $data;
    }

    protected function hasTooManyLoginAttempts ($request) {
        $maxLoginAttempts = 2;
        $lockoutTime = 5; // 5 minutes
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $maxLoginAttempts, $lockoutTime
        );
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('member.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('member');
    }


    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback($service)
    {
        try {
            $user = Socialite::driver($service)->user();
        } catch (Exception $e) {
            return redirect('auth/'.$service);
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::guard('member')->login($authUser, true);

        return view ( 'member.home' )->withDetails ( $authUser )->withService ( $service );
    }

    private function findOrCreateUser($User)
    {
        $authUser = Member::where('provider_id', $User->id)->first();

        if ($authUser == null)
        {
            $authUser = Member::where('email',$User->email)->first();

            if ($authUser != null)
            {
                $authUser->provider_id = $User->id;
                $authUser->avatar = $User->avatar;
                $authUser->save();

                return $authUser;
            }
        }

        if ($authUser){
            return $authUser;
        }

        $digit = mt_rand(1000, 9999);
        $referal = substr($User->name,0,4).''.$digit;
        $date = date('Y-m-d', strtotime("+30 days"));

        $stud = new Student();
        $stud->first_name = str_before($User->name,' ');
        $stud->last_name = str_after($User->name,' ');;
        $stud->email = $User->email;
        $stud->plan_id = 2;

        $stud->referral_code = $referal;
        $stud->end_date = $date;

        $query =$stud->save();

        $password = $stud->randomPass($stud->first_name,$digit);

        $plan = $stud->plan_id ;

        if($plan == 1)
        {
            $plan = "SILVER";
        }
        else
        {
            $plan = "GOLD";
        }

        $content = array(
            'name' => $User->name,
            'email' => $User->email,
            'password' => $password,
            'plan' => $plan,
            'referal' => $referal
        );


        if ($query)
        {
            try {
                Mail::to($User->email)->send(new NewUserMail($content));

            } catch (\Exception $e) {
                echo 'Error - '.$e;
            }

            try {
                Mail::to($User->email)->send(new ReferMail($content));

            } catch (\Exception $e) {
                echo 'Error - '.$e;
            }
        }

        return Member::create([
            'name' => $User->name,
            'email' => $User->email,
            'provider_id' => $User->id,
            'student_id' => $stud->id,
            'status' => true,
            'password' => bcrypt($password),
            'avatar' => $User->avatar
        ]);
    }
}
