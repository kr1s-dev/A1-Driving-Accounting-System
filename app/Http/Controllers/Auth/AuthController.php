<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins,UtilityHelper;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected static $redirectPath = '/user';
    protected $redirectAfterLogout = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:60|confirmed',
            'mobile_number' => 'required|min:11|max:13',
            'telephone_number' => 'required|min:7|max:11',
            'address' => 'required|max:255',
            'last_name' => 'required|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'telephone_number' => $data['telephone_number'],
            'address' => $data['address'],
            'password' => bcrypt($data['password']),
            'user_type_id'=>1,
            'is_active'=>1,
        ]);
    }

    public static function setRedirect(){
        if(Auth::check()){
            if(Auth::user()->userType->type==='Accountant')
                return redirect('/students');
            elseif(Auth::user()->userType->type==='Administrator')
                return redirect('/user');

        }
    }

    /*
    *   Override Vendor Functions 
    *   List of Overriden Functions:
    *       - getLogin()
    *
    */

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $user = $this->searchUserNotLogin(null);
        return view('auth.login',
                        compact('user'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);
        $user = $this->getLastRecord('User',array('email'=>$request->input('email')));
        if(count($user) && $user->is_active){
            $credentials = $this->getCredentials($request);
        }else{
            $credentials = array('email'=>'','password'=>'');
        }

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        return $this->setRedirect();
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $user = $this->searchUserNotLogin(null);
        if(count($user)===0)
            return view('auth.register');
        else
            return view('errors.503');
        
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $confirmation_code = array('confirmation_code'=>str_random(30));
        $this->create($request->all());
        $this->sendEmailVerification($request->input('email'),
                                        $request->input('first_name') . ' ' . $request->input('last_name'),
                                        $confirmation_code);
        flash()->success('Congratulations. You\'ve Successfully Registered. An email is sent to your email to verify your account.');
        return redirect('/login');
    }

    
}
