<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Image;
use Illuminate\Pagination\LengthAwarePaginator;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('admin.only');
    }

    public function index()
    {
        $categories = \App\Category::paginate(17);

        return view('admin/categoriesOverview')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = \App\Admin::find(1);

        return view('admin/addCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required'
        ]);

        $category = new \App\Category();

        $category->name = $request->name;
        $category->type = $request->category;
        $category->save();

        return redirect('admin');
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
        $request->validate([
            'name' => 'required|max:50',
            'category' => 'required|max:50',
            'price' => 'required',
            'color' => 'required|string',
            'gender' => 'required|string',
            'stock' => 'required|integer',
            'description' => 'required',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $clothing = \App\Product::findOrFail($id);
//        $clothing->delete();
//
//        $product = \App\Size::where('clothing_id', $id);
//        $product->delete();
//
//        return redirect('admin');

    }
}
