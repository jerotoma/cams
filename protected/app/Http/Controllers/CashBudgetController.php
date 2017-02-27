<?php

namespace App\Http\Controllers;

use App\BudgetActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CashBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $activities=BudgetActivity::all();
        return view('cash.budget.index',compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cash.budget.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $validator = Validator::make($request->all(), [
                'activity_name' => 'required|unique:budget_activities',
                'amount' => 'required|numeric',
                'status' => 'required',
                'currency' => 'required',
                'provision_limit' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $activity = new BudgetActivity;
                $activity->activity_name = strtoupper(strtolower($request->activity_name));
                $activity->description = $request->description;
                $activity->amount = $request->amount;
                $activity->currency = $request->currency;
                $activity->remarks = $request->remarks;
                $activity->provision_limit = $request->provision_limit;
                $activity->status = $request->status;
                $activity->created_by = Auth::user()->username;
                $activity->save();
                return response()->json([
                    'success' => true,
                    'message' => "<h3><span class='text-info'><i class='fa fa-info'></i> Record saved</span><h3>"
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $activity=BudgetActivity::find($id);
        return view('cash.budget.show',compact('activity'));
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
        $activity=BudgetActivity::find($id);
        return view('cash.budget.edit',compact('activity'));
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
        try {
            $validator = Validator::make($request->all(), [
                'activity_name' => 'required|unique:budget_activities,activity_name,'.$id,
                'amount' => 'required|numeric',
                'status' => 'required',
                'currency' => 'required',
                'provision_limit' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $activity =  BudgetActivity::find($id);
                $activity->activity_name = strtoupper(strtolower($request->activity_name));
                $activity->description = $request->description;
                $activity->amount = $request->amount;
                $activity->currency = $request->currency;
                $activity->remarks = $request->remarks;
                $activity->provision_limit = $request->provision_limit;
                $activity->status = $request->status;
                $activity->updated_by = Auth::user()->username;
                $activity->save();
                return response()->json([
                    'success' => true,
                    'message' => "<h3><span class='text-info'><i class='fa fa-info'></i> Record updated</span><h3>"
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
        //
        $activity = BudgetActivity::find($id)->delete();
    }
}
