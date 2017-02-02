<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Role;
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
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
    //Add users view
    public function getAddUser(){
        return view('users.add_user');
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
          if ( $request->ajax() && $request->isMethod('post') ) {
              
          
          
            return response()->json([  
                                     'firstname' => $request->first_name,
                                     'response'  => 'This is post method',
                                     'success'   => 'true'
                                    ]); 
                  
          }else{
                $user              = new User();
                $request->status   = 'Active';
                $user->full_name   = $request->first_name .' '. $request->last_name;
                $user->email       = $request->email;
                $user->username    = $request->username;
                $user->password    = bcrypt($request->password);       //  
                $user->phone       = $request->phone;
                $user->address     = $request->address;      //;
                $user->status      = $request->status;
                $user->save();
                $user->roles()->attach($request->id);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
