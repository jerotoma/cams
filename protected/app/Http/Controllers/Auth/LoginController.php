<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\User;
use DB;

class LoginController extends Controller {
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login() {
        if(Auth::guest()) {
            return view('auth.login');
        } else {
            return $this->redirectTo;
        }
    }
    //Post login for Authenticating users
    public function postLogin(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $username = strtolower($request->username);
        $password = $request->password;

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            if(Auth::user()->blocked == 1 || Auth::user()->status == "Inactive") {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Login Failed you don\'t have Access to login please  Contact support team'
                ], 401);
            } else {
                $user = User::find(Auth::user()->id);
                $user->last_success_login=date("Y-m-d h:i:s");
                $user->save();
                //Audit trail
                AuditRegister("LoginController","Success Loged in to the system",$username);
                return response()->json([
                    'success' => true,
                    'message' => 'Success Loged in to the system'
                ], 200);
            }
        } else {
            return response()->json([
                    'success' => false,
                    'message' => 'Login Failed,Invalid username or password'
            ], 422);
        }
    }

	public function logout() {
        if (Auth::check()) {
            $user= User::find(auth()->user()->id);
            $user->last_logout=date("Y-m-d h:i:s");
            $user->save();
        }
        //Audit trail
        AuditRegister("LoginController","Success Loged out of system","");
        Auth::logout();
        return redirect('login');
    }
}
