<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Role;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $users = array();

    //These middleware will protect the rest of functions from unauthenticated users 
    public function __construct()
    {
        $this->middleware('auth',['except' => ['login','postLogin']]);
    }
    
    public function index()
    {
        $users =  User::all();
       
       return view('users.index', ['users' =>  $users  ] );
    }


    public function login()
    {
        if(Auth::guest())
        {
            return view('users.login');
        }
        else
        {
            return redirect('home');
        }
    }
      
    //Post login for Authenticating users
    public function postLogin(Request $request)
     {
         
        $username=strtolower($request->username);
        $password=$request->password;
        
        if (Auth::attempt(['username' => $username, 'password' => $password]))
        {
            if(Auth::user()->blocked ==1 || Auth::user()->status=="Inactive")
            {

                Auth::logout();
                return redirect()->back()->with('message', 'Login Failed you don\'t have Access to login please  Contact support team');
            }
            else
            {

                $user= User::find(Auth::user()->id);
                $user->last_success_login=date("Y-m-d h:i:s");
                $user->save();

                // //Audit log
                return redirect()->intended('home');

            }

        }
        else {

            return redirect()->back()->with('message', 'Login Failed,Invalid username or password');
        }

    }
    public function logout()
    {
        if (Auth::check())
        {
            $user= User::find(Auth::user()->id);
            $user->last_logout=date("Y-m-d h:i:s");
            $user->save();

        }
        Auth::logout();
        return redirect('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'status' => 'required',
                'role_id' => 'required',
                'phone' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect('post/create')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $user = new User;
                $user->full_name = $request->full_name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->password = bcrypt($request->pass);
                $user->department_id = $request->department_id;
                $user->designation = $request->designation;
                $user->status = $request->status;
                $user->username = $request->username;
                $user->save();
                $user->roles()->attach($request->role_id);
                $user->save();
            }
            return "Success";
        }
        catch (\Exception $ex)
        {
            return "Failed".$ex.getMessage();
        }
       
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorfail($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorfail($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        $this->validate($request, [
            'full_name' => 'required',
            'username'  => 'required|unique:users',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|minn:8',
            'status'      => 'required',
            'role_id'      => 'required',
            'phone'    => 'required',
        ]);

        $user= User::findorfail($id);
        $user->full_name=$request->full_name;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->password=bcrypt($request->pass);
        $user->department_id=$request->department_id;
        $user->designation=$request->designation;
        $user->status=$request->status;
        $user->username=$request->username;
        $user->save();
        $user->roles()->attach($request->role_id);
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
	{
           $user = User::find($id);
           $user ->delete();
    }
}
