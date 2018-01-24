<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class jewerlyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('admin.only')->except(['adminDetail' , 'show']);
    }

    public function index()
    {
        $products = \App\Product::where('type', '=', 'jewerly')->paginate(9);
        $categories = \App\Category::select('*')
            ->where('type', '=', 'jewerly')
            ->get();
        $type = 'jewerly';

        return view('products')
            ->with('products', $products)
            ->with('categories', $categories)
            ->with('type', $type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = \App\Admin::find(1);
        $categories = \App\Category::select('*')
            ->where('type', '=', 'Jewelry')
            ->get();

        return view('admin/addJewerly')
            ->with('admin', $admin)
            ->with('categories', $categories);
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
            'name' => 'required|max:50',
            'category' => 'required|max:50',
            'price' => 'required',
            'stock' => 'required|integer',
            'description' => 'required',
            'image' => 'required'
        ]);

        if(strpos($request->price, ',') == true){
            $errors = ['Gebruik een punt i.p.v een komma bij de prijs alstublieft!'];
            return back()->withErrors($errors);
        }

        $accessories = new \App\Product();

        $accessories->name = $request->name;
        $accessories->category_id = $request->category;
        $accessories->price = $request->price;
        $accessories->stock = $request->stock;
        $accessories->description = $request->description;
        $accessories->type = 'jewerly';

        $path = $request->file('image');

        // File and new size
        $filename = $path;

        // Content type
        header('Content-Type: image/jpeg');

        // Get new sizes
        list($width, $height) = getimagesize($filename);
        $newwidth = 1000;
        $newheight = 1000;

        // Load
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($path);

        // Resize
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        $test = public_path("img");
        // Output
        imagejpeg($thumb , "img/{$request->file('image')->hashName()}");

        $accessories->picture = "/img/".$request->file('image')->hashName();

        $accessories->save();
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
        $product = \App\Product::find($id);
        $discount = number_format($product->price * (1 - ($product->discount / 100)), 2);

        $product->views += 1;
        $product->save();

        return view('/product')
            ->with('product', $product)
            ->with('discount', $discount);
    }

    /**
     * @param $id
     * @return $this
     */
    public function adminDetail($id)
    {
        $admin = \App\Admin::find(1);
        $product = \App\Product::find($id);
        $discount = number_format($product->price * (1 - ($product->discount / 100)), 2);

        return view('/admin/showJewerly')
            ->with('admin', $admin)
            ->with('product', $product)
            ->with('discount', $discount);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = \App\Admin::find(1);
        $product = \App\Product::find($id);
        $categories = \App\Category::select('*')->where('type', '=', 'Jewelry')->get();

        return view('/admin/editJewerly')
            ->with('admin', $admin)
            ->with('product', $product)
            ->with('categories', $categories);
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
            'stock' => 'required|integer',
            'description' => 'required',
        ]);

        if(strpos($request->price, ',') == true){
            $errors = ['Gebruik een punt i.p.v een komma bij de prijs alstublieft!'];
            return back()->withErrors($errors);
        }

        $accessories = \App\Product::find($id);

        if($accessories->name != $request->name){
            $request->validate([
                'name' => 'unique:products,name'
            ]);
        }

        $accessories->name = $request->name;
        $accessories->category_id = $request->category;
        $accessories->price = $request->price;
        $accessories->stock = $request->stock;
        $accessories->description = $request->description;

        if($request->discount > 0)
        {
            $accessories->discount = $request->discount;
            $accessories->save();
            return redirect('admin');
        }
        else
        {
            $accessories->save();
            return redirect('admin');
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
        $clothing = \App\Product::findOrFail($id);
        $clothing->delete();

        return redirect('admin/jewerlies');
    }
}
