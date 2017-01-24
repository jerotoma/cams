<?php

namespace App\Http\Controllers;

use App\ItemsCategories;
use Illuminate\Http\Request;

use App\Http\Requests;

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
    public function store(Request $request)
    {
        //
        $categories=new ItemsCategories;
        $categories->category_name=$request->category_name;
        $categories->status=$request->status;
        $categories->description=$request->description;
        $categories->save();
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
    public function update(Request $request)
    {
        //
        $categories=ItemsCategories::find($request->id);
        $categories->category_name=$request->category_name;
        $categories->description=$request->description;
        $categories->status=$request->status;
        $categories->save();
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
