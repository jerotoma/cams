<?php

namespace App\Http\Controllers;

use App\ItemsCategories;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ItemsCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=ItemsCategories::all();
        return view('inventory.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('inventory.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function onFlyCategory(Request $request)
    {
        try {
            if (!count(ItemsCategories::where('category_name', '=', ucwords(strtolower($request->category_name)))->get()) > 0
                && $request->category_name !="") {
                $category = new ItemsCategories;
                $category->category_name = $request->category_name;
                $category->status = $request->status;
                $category->description = $request->description;
                $category->save();
                return response()->json([
                    'success' => true,
                    'id' => $category->id,
                    'category_name' => $category->category_name,
                ], 200);
            } else {
                $id = "";
                $id = ItemsCategories::where('category_name', '=', ucwords(strtolower($request->category_name)))->get()->first()->id;
                return response()->json([
                    'success' => true,
                    'id' => $id
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
    public function store(Request $request)
    {
        //
        try {
            $validator = Validator::make($request->all(), [
                'category_name' => 'required|unique:items_categories',
                'status' => 'required'
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $category = new ItemsCategories;
                $category->category_name = $request->category_name;
                $category->status = $request->status;
                $category->description = $request->description;
                $category->save();
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
        $categories=ItemsCategories::find($id);
        return view('inventory.categories.show',compact('categories'));
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
        $categories=ItemsCategories::find($id);
        return view('inventory.categories.edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        try {
            $validator = Validator::make($request->all(), [
                'category_name' => 'required|unique:items_categories,category_name,'.$id,
                'status' => 'required'
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $category =  ItemsCategories::find($id);
                $category->category_name = $request->category_name;
                $category->status = $request->status;
                $category->description = $request->description;
                $category->save();
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
        //
        $categories=ItemsCategories::find($id);
        if(is_object($categories->items) && $categories->items != null)
        {
            foreach ($categories->items  as $items)
            {
                $items->delete();
            }
        }
        $categories->delete();
    }
}
