<?php

namespace App\Http\Controllers;

use App\RoleUser;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Role;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $users = array();
<<<<<<< HEAD
    
    public function  __construct(){
        //$this->middleware('auth');
        $this->users = DB::table('users')->get();
         
=======

    //These middleware will protect the rest of functions from unauthenticated users 
    public function __construct()
    {
        $this->middleware('auth',['except' => ['login','postLogin']]);
>>>>>>> d49c6ff9d99ca31d76d15f55e4642d8c6cc35871
    }
    
    public function index()
    {
        $users =  User::all();
       
       return view('users.index', ['users' =>  $users  ] );
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
                'role_id' => 'required',
                'phone' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
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
                $user->status = "Active";
                $user->save();
                $user->roles()->attach($request->role_id);
                $user->save();
            }
            return response()->json([
                'success' => true,
                'message' => "<h3><span class='text-info'><i class='fa fa-info'></i> Record saved</span><h3>"
            ], 200);
        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
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
/*<<<<<<< HEAD
         $this->validate($request, [
                        'full_name'  => 'bail|required|max:255',
                        'email'      => 'bail|required|max:255',
                        'username'   => 'bail|required|max:255',
                        //'password'   => 'bail|required|max:255',
                        'phone'      => 'bail|required|max:255',
                        'address'    => 'bail|required',
                                    ]);

         $args   =        [ 
                             'full_name'   => $request->full_name,
                             'email'       => $request->email,
                             'username'    => $request->username,
                             //'password'    => bcrypt($request->password),       //  
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
=======   */
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'username' => 'required|unique:users,id,'.$id,
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'min:8',
                'role_id' => 'required',
                'phone' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()

                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $user = User::findorfail($id);
                $user->full_name = $request->full_name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                if($request->password != ""){
                $user->password = bcrypt($request->password);
                }
                $user->department_id = $request->department_id;
                $user->designation = $request->designation;
                $user->status = $request->status;
                $user->locked = $request->locked;
                $user->save();


                return response()->json([
                    'success' => true,
                    'message' => "<h3><span class='text-info'><i class='fa fa-info'></i> Record Updated</span><h3>"
                ], 200);
            }

        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' => $ex->getMessage()

            ), 400); // 400 being the HTTP code for an invalid request.
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
    }
}
