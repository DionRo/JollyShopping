<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Image;

class clothingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('admin.only')->except(['adminDetail']);
    }

    public function index()
    {
        $products = \App\Product::where('type', '=', 'clothing')->paginate(9);
        $categories = \App\Category::select('*')
            ->where('type', '=', 'Clothing')
            ->get();
        $type = 'clothing';
        $genders = ['Female', 'Male'];

        return view('products')
            ->with('products', $products)
            ->with('categories', $categories)
            ->with('type', $type)
            ->with('genders', $genders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = \App\Admin::find(1);
        $colors = ['Zwart', 'Wit', 'Rood', 'Groen', 'Blauw', 'Bruin', 'Geel', 'Oranje', 'Grijs'];
        $categories = \App\Category::select('*')
                        ->where('type', '=', 'Clothing')
                        ->get();
        $genders = ['Man', 'Vrouw'];

        return view('admin/addClothing')
            ->with('admin', $admin)
            ->with('categories', $categories)
            ->with('genders', $genders)
            ->with('colors', $colors);
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
            'name' => 'required|max:50|unique:products,name',
            'category' => 'required|max:50',
            'price' => 'required',
            'color' => 'required|string',
            'gender' => 'required|string',
            'stock' => 'required|integer',
            'description' => 'required',
            'image' => 'required'
        ]);

        if(strpos($request->price, ',') == true){
            $errors = ['Gebruik een punt i.p.v een komma bij de prijs alstublieft!'];
            return back()->withErrors($errors);
        }

        $clothing = new \App\Product();

        $clothing->name = $request->name;
        $clothing->category_id = $request->category;
        $clothing->price = $request->price;
        $clothing->color = $request->color;
        $clothing->type = 'clothing';

        if($request->gender == 'Man'){
            $clothing->gender = 1;
        }
        else{
            $clothing->gender = 0;
        }

        $clothing->stock = $request->stock;

        $clothing->description = $request->description;

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
    
        $clothing->picture = "/img/".$request->file('image')->hashName();

        $clothing->save();

        $product = \App\Product::select('*')->where('name', '=', $request->name)->where('type', '=', 'clothing')->get();

        if($request->sizeS == 'on'){
            $size = new \App\Size();

            $size->clothing_id = $product[0]->id;
            $size->size = 'S';

            $size->save();
        }
        if($request->sizeM == 'on'){
            $size = new \App\Size();

            $size->clothing_id = $product[0]->id;
            $size->size = 'M';

            $size->save();
        }
        if($request->sizeL == 'on'){
            $size = new \App\Size();

            $size->clothing_id = $product[0]->id;
            $size->size = 'L';

            $size->save();
        }
        if($request->sizeXL == 'on'){
            $size = new \App\Size();

            $size->clothing_id = $product[0]->id;
            $size->size = 'XL';

            $size->save();
        }

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
        $sizes = \App\Size::select('*')->where('clothing_id', '=', $id)->get();
        $discount = number_format($product->price * (1 - ($product->discount / 100)), 2);
        
        $product->views += 1;
        $product->save();

        return view('/product')
            ->with('product', $product)
            ->with('sizes', $sizes)
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
        $sizes = \App\Size::select('*')->where('clothing_id', '=', $id)->get();
        $discount = number_format($product->price * (1 - ($product->discount / 100)), 2);

        return view('/admin/showClothes')
            ->with('admin', $admin)
            ->with('product', $product)
            ->with('discount', $discount)
            ->with('sizes', $sizes);
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
        $categories = \App\Category::select('*')->where('type', '=', 'Clothing')->get();
        $sizeS = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'S')->get();
        $sizeM = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'M')->get();
        $sizeL = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'L')->get();
        $sizeXL = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'XL')->get();
        $colors = ['Zwart', 'Wit', 'Rood', 'Groen', 'Blauw', 'Bruin', 'Geel', 'Oranje', 'Grijs'];
        $genders = ['Man', 'Vrouw'];

        return view('/admin/editClothes')
            ->with('admin', $admin)
            ->with('product', $product)
            ->with('categories', $categories)
            ->with('sizeS', $sizeS)
            ->with('sizeM', $sizeM)
            ->with('sizeL', $sizeL)
            ->with('sizeXL', $sizeXL)
            ->with('colors', $colors)
            ->with('genders', $genders);
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

        if(strpos($request->price, ',') == true){
            $errors = ['Gebruik een punt i.p.v een komma bij de prijs alstublieft!'];
            return back()->withErrors($errors);
        }

        $clothing = \App\Product::find($id);

        if($clothing->name != $request->name){
            $request->validate([
               'name' => 'unique:products,name'
            ]);
        }

        $clothing->name = $request->name;
        $clothing->category_id = $request->category;
        $clothing->price = $request->price;
        $clothing->color = $request->color;

        if($request->gender == 'Man'){
            $clothing->gender = 1;
        }
        else{
            $clothing->gender = 0;
        }

        $clothing->stock = $request->stock;

        if($request->sizeS == 'on'){
            $sizeS = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'S')->get();
            if(!isset($sizeS[0])){
                $size = new \App\Size();

                $size->clothing_id = $id;
                $size->size = 'S';

                $size->save();
            }
        }
        else{
            $sizeS = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'S')->get();
            if(isset($sizeS)){
                $sizeS = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'S')->delete();
            }
        }

        if($request->sizeM == 'on'){
            $sizeM = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'M')->get();
            if(!isset($sizeM[0])){
                $size = new \App\Size();

                $size->clothing_id = $id;
                $size->size = 'M';

                $size->save();
            }
        }
        else{
            $sizeM = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'M')->get();
            if(isset($sizeM)){
                $sizeM = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'M')->delete();
            }
        }

        if($request->sizeL == 'on'){
            $sizeL = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'L')->get();
            if(!isset($sizeL[0])){
                $size = new \App\Size();

                $size->clothing_id = $id;
                $size->size = 'L';

                $size->save();
            }
        }
        else{
            $sizeL = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'L')->get();
            if(isset($sizeL)){
                $sizeL = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'L')->delete();
            }
        }

        if($request->sizeXL == 'on'){
            $sizeXL = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'XL')->get();
            if(!isset($sizeXL[0])){
                $size = new \App\Size();

                $size->clothing_id = $id;
                $size->size = 'XL';

                $size->save();
            }
        }
        else{
            $sizeXL = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'XL')->get();
            if(isset($sizeXL)){
                $sizeXL = \App\Size::select('*')->where('clothing_id', '=', $id)->where('size', '=', 'XL')->delete();
            }
        }

        $clothing->description = $request->description;

        if($request->discount > 0)
        {
            $clothing->discount = $request->discount;
            $clothing->save();
            return redirect('admin');
        }
        else
        {
            $clothing->save();
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
        
        $product = \App\Size::where('clothing_id', $id);
        $product->delete();
        
        return redirect('admin');
        
    }
}
