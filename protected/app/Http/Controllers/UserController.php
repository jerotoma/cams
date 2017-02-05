<?php

namespace App\Http\Controllers;

use App\User;
use DB;
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
    public $users = array();
    
    public function  __construct(){
        $this->middleware('auth');
        $this->users = DB::table('users')->get();
         
    }
    
    public function index()
    {
        $users =  $this->users; 
       
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
          
         $this->validate($request, [
                        'first_name' => 'bail|required|max:255',
                        'last_name'  => 'bail|required|max:255',
                        'email'      => 'bail|required|max:255',
                        'username'   => 'bail|required|max:255',
                        'password'   => 'bail|required|max:255',
                        'phone'      => 'bail|required|max:255',
                        'address'    => 'bail|required',
                                    ]);

        $user              = new User();
        $request->status   = 'Active';
        $user->full_name   = $request->first_name .' '. $request->last_name;
        $user->email       = $request->email;
        $user->username    = $request->username;
        $user->password    = bcrypt($request->password);       //  
        $user->phone       = $request->phone;
        $user->address     = $request->address;      //;
        $user->status      = $request->status;

        if ( $request->ajax() && $request->isMethod('post') ) {
              
                $user->save();
                $user->roles()->attach($request->id);
          
            return response()->json([ 'success'   => true ]); 
                  
          }else{
                $user->save();
                $user->roles()->attach($request->id);
           
          // return response()->json([ 'success'   => false ]);    

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
        $users = DB::table('users')->where('id', '=', $id )->get();
     
    return view('users.show')->with(array("users"=>$users));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $users = DB::table('users')->where('id', '=', $id )->get();
     
    return view('users.edit')->with(array("users"=>$users));
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
                        'full_name' => 'bail|required|max:255',
                        'email'      => 'bail|required|max:255',
                        'username'   => 'bail|required|max:255',
                        'password'   => 'bail|required|max:255',
                        'phone'      => 'bail|required|max:255',
                        'address'    => 'bail|required',
                                    ]);

         $args   =        [ 
                             'full_name'   => $request->full_name,
                             'email'       => $request->email,
                             'username'    => $request->username,
                             'password'    => bcrypt($request->password),       //  
                             'phone'       => $request->phone,
                             'address'     => $request->address,      //;
                           ];
        
        // var_dump( $args );exit;
          if ( $request->ajax() && $request->isMethod('post') ) {      
                  
             //update user with  $id id    
             $rs= DB::table('users')->where('id', $id)->update($args);
              
              return response()->json([ 'success'   => $rs ]);  
          
          
          }else{
             //update user with  $id id 
              $rs    =  DB::table('users')->where('id', $id)->update($args);
           
			  //get Updated users
              $users =  DB::table('users')->get();
          
             return view('users.index', ['users' =>  $users  ] );  
          } 
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
          //get Updated users
           $users =  DB::table('users')->get();
           return view('users.index', ['users' =>  $users  ] );
    }
}
