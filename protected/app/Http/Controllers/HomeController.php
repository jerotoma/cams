<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');
    }
    //

    public function index()
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('authorizer') || Auth::user()->can('reports')) {

            return view('site.dashboard');
        }
        else
        {
            return redirect('account/profile');
        }
    }


}
