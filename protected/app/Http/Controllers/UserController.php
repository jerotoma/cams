<?php

namespace App\Http\Controllers;

use App\RoleUser;
use App\User;
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

    //This middleware protects unauthenticated users
    public function __construct()
    {
      $this->middleware(array('auth','role:admin'),['except' => ['login','postLogin']]);

    }

    public function index()
    {
        $users =  User::all();

       return view('users.index', ['users' =>  $users  ] );
    }

    //Get profile
    public function getProfile()
    {
        $user =  User::findorfail(Auth::user()->id);
        return view('users.profile', compact('user') );
    }
    public function getSettings()
    {
        $user =  User::findorfail(Auth::user()->id);
        return view('users.settings.profile',compact('user'));
    }
    public function showChangePassword()
    {
        $user =  User::findorfail(Auth::user()->id);
        return view('users.settings.password',compact('user'));
    }
    public function postChangePassword(Request $request)
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
                $user = User::find(Auth::user()->id);
                $user->password = bcrypt($request->userpass);
                $user->save();
                //Audit log
                $auditMsg = "Changed password for " . $user->username . " with status " . $user->status;
                return response()->json([
                    'success' => true,
                    'message' => "<h3><span class='text-info'><i class='fa fa-info'></i> Your have changed your password</span><h3>"
                ], 200);
            }
        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' =>"Password change failed"
            ), 400); // 400 being the HTTP code for an invalid request.
        }

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
     public function createUser(Request $request)
	 {
		        $user = new User;
                $user->full_name = 'Otoman Godfrey';
                $user->phone = 2897751667;
                $user->email = 'otomang@hotmail.com';
                $user->password = bcrypt('cams');
                $user->department_id = 24;
                $user->designation = 'Kigoma';
                $user->username = 'otuman';
                $user->status = "Active";
                $user->save();

		 return 'User Created';
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
                $user->password = bcrypt($request->password);
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
        try {

            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'username' => 'required|unique:users,id,' . $id,
                'email' => 'required|email|unique:users,email,' . $id,
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
                if ($request->password != "") {
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

        } catch (\Exception $ex) {
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
