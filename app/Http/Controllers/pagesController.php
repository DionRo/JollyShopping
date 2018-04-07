<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class pagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin.only')->except(['index' , 'products' , 'about' , 'contact', 'filterProducts','sendEmail','getAddToCart', 'getCart', 'addUpProduct'
            , 'removeSingle', 'removeProduct', 'getAddToCartMain', 'getAddToCartDetail','checkOut']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkOut(Request $request)
    {
        $request->validate([
            'specify' => 'required'
        ]);

        if(!Session::has('cart'))
        {
            return view('shoppingcart');
        }
        $cart = Session::get('cart');

        $order =  \App\Order::All();
        if ($order->count() == 0)
        {
            $orderId = 1;
        }
        else
        {
            $orderId = $order->last()->orderId;
            $orderId += 1;

        }
        foreach ($cart->items as $item)
        {
           $newOrder = new \App\Order();
           $newOrder->orderId = $orderId;
           $newOrder->user_id = Auth::user()->id;
           $newOrder->user_email = Auth::user()->email;
           $newOrder->product_id = $item["item"]->id;
           $newOrder->amountOrder = $item["qty"];
           $newOrder->totalPrice = $cart->totalPrice;
           $newOrder->specify = $request->specify;

           $newOrder->save();

        }
        session()->forget('cart');
        return 'hi';
    }
    public function getCart(Request $request)
    {
        if(!Session::has('cart'))
        {
            return view('shoppingcart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('shoppingcart')
            ->with('products' , $cart->items)
            ->with('totalPrice', $cart->totalPrice );
    }
    public function getAddToCartMain(Request $request, $id)
    {
        $product = \App\Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect('/');

    }
    public function getAddToCartDetail(Request $request, $id)
    {
        $product = \App\Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return back();

    }
    public function getAddToCart(Request $request, $id)
    {
        $product = \App\Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return back();

    }
    public function addUpProduct (Request $request, $id)
    {

        $product = \App\Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect('shopping-cart');
    }
    public function removeSingle(Request $request, $id)
    {
        $product = \App\Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->remove($product, $product->id);


        $request->session()->put('cart', $cart);
        return redirect('shopping-cart');
    }
    public function removeProduct(Request $request, $id)
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;

        $cartClean = new Cart($cart);
        $cartClean->removeTotal($id);

        $request->session()->put('cart', $cartClean);

        return redirect('shopping-cart');
    }

    public function index()
    {
        $clothing = \App\Product::where('type', '=', 'clothing')->orderByDesc('created_at')->get();
        $accessories = \App\Product::where('type', '=', 'accessory')->orderByDesc('created_at')->get();
        $jewerlies = \App\Product::where('type', '=', 'jewerly')->orderByDesc('created_at')->get();

        return view('home')
            ->with('clothing', $clothing)
            ->with('accessories', $accessories)
            ->with('jewerlies' , $jewerlies);
    }

    public function sendEmail()
    {
       if(isset($_POST))
       {
            $Name = $_POST["name"];
            $Pnum  = $_POST["phonenumb"];
            $email = $_POST["email"];
            $sub = $_POST['subject'];
            $message = $_POST["text"];
       }
        $to = "info@jollyshopping.nl";
        $subject = $sub;
        $txt = "Beste Jolanda,
        U heeft zojuist een bericht ontvangen via het contact formulier op uw website.

        Het bericht bevat de volgende boodschap:
        '$message'

        Het bericht is verstuurd door $Name met het mailadres: $email
        Het nummer van $Name is $Pnum";

        $headers = "FROM: ". $email;

        mail($to,$subject,$txt,$headers);
        
        return view('/contact');
        
    }
    /**
     * @return string
     */
    public function products()
    {
        $products = \App\Product::orderByDesc('created_at')->paginate(9);

        return view('products')
            ->with('products', $products);
    }

    /**
     * @param Request $request
     */
    public function filterProducts(Request $request)
    {
        $full = [['type', '=', $request->type]];
        $sizesList = [];

        $genders = ['Vrouw', 'Man'];
        $colors = ['Zwart', 'Wit', 'Rood', 'Groen', 'Blauw', 'Bruin', 'Geel', 'Oranje', 'Grijs'];

        switch ($request->type) {
            case ('allClothing'):
                $type = 'clothing';
                $products = \App\Product::where('type', '=', 'clothing')->paginate(9);
                $categories = \App\Category::where('type', '=', 'clothing')->get();

                return view('products')
                    ->with('products', $products)
                    ->with('categories', $categories)
                    ->with('genders', $genders)
                    ->with('colors', $colors)
                    ->with('type', $type);

                break;

            case ('allAccessories'):
                $type = 'accessories';
                $products = \App\Product::where('type', '=', 'accessory')->paginate(9);
                $categories = \App\Category::where('type', '=', 'accessory')->get();

                return view('products')
                    ->with('products', $products)
                    ->with('categories', $categories)
                    ->with('colors', $colors)
                    ->with('type', $type);

            case ('allJewerlies'):
                $type = 'jewerly';
                $products = \App\Product::where('type', '=', 'jewerly')->paginate(9);
                $categories = \App\Category::where('type', '=', 'jewerly')->get();

                return view('products')
                    ->with('products', $products)
                    ->with('categories', $categories)
                    ->with('type', $type);

                break;

            case ('clothing'):
                $type = 'clothing';
                $categories = \App\Category::where('type', '=', 'clothing')->get();

                $clothing = new \App\Product;
                $sizes = new \App\Size;

                if ($request->categories != null) {
                    $full = $clothing::filterClothes(['category_id', '=', $request->categories], $full);
                }
                if ($request->gender != null) {
                    $full = $clothing::filterClothes(['gender', '=', $request->gender], $full);
                }
                if ($request->color != null) {
                    $full = $clothing::filterClothes(['color', '=', $request->color], $full);
                }
                if ($request->minPrice != '0') {
                    $full = $clothing::filterClothes(['price', '>=', (int)$request->minPrice], $full);
                }
                if ($request->maxPrice != '500') {
                    $full = $clothing::filterClothes(['price', '<=', (int)$request->maxPrice], $full);
                }
                if($request->sizeS == "on"){
                    $filterSizes = $sizes::where('size', '=', 'S')->get();
                    $amountSizes = $filterSizes->count();
                    $i = 1;
                    
                    if($amountSizes > 0){
                        foreach($filterSizes as $filterSize){
                            array_push($sizesList, 'id', '=', $filterSize['clothing_id']);
    
                            if($i != $amountSizes){
                                array_push($sizesList, '||');
                            }
    
                            $i++;
                        }

                        if($request->sizeM == "on" || $request->sizeL == "on" || $request->sizeXL == "on"){ array_push($sizesList, '||'); };
                        
                        $full = $clothing::filterClothes($sizesList, $full);
                    }

                }

                if($request->sizeM == "on"){
                    $filterSizes = $sizes::where('size', '=', 'M')->get();
                    $amountSizes = $filterSizes->count();
                    $i = 1;
                    
                    if($amountSizes > 0){

                        if($request->sizeS == "on"){ array_push($sizesList, '||'); };                        
                        
                        foreach($filterSizes as $filterSize){
                            array_push($sizesList, 'id', '=', $filterSize['clothing_id']);
    
                            if($i != $amountSizes){
                                array_push($sizesList, '||');
                            }
    
                            $i++;
                        }
    
                        if($request->sizeL == "on" || $request->sizeXL == "on"){ array_push($sizesList, '||'); };
                        
                        $full = $clothing::filterClothes($sizesList, $full);
                    }
                }
                if($request->sizeL == "on"){
                    $filterSizes = $sizes::where('size', '=', 'L')->get();
                    $amountSizes = $filterSizes->count();
                    $i = 1;
                    
                    if($amountSizes > 0){
                        
                        if($request->sizeS == "on" || $request->sizeM == "on"){ array_push($sizesList, '||'); };                        
                        
                        foreach($filterSizes as $filterSize){
                            array_push($sizesList, 'id', '=', $filterSize['clothing_id']);
    
                            if($i != $amountSizes){
                                array_push($sizesList, '||');
                            }
    
                            $i++;
                        }
                        
                        $full = $clothing::filterClothes($sizesList, $full);
                    }
                }
                if($request->sizeXL == "on"){
                    $filterSizes = $sizes::where('size', '=', 'XL')->get();
                    $amountSizes = $filterSizes->count();
                    $i = 1;
                    
                    if($amountSizes > 0){

                        if($request->sizeS == "on" || $request->sizeM == "on" || $request->sizeL == "on"){ array_push($sizesList, '||'); };                        
                        
                        foreach($filterSizes as $filterSize){
                            array_push($sizesList, 'id', '=', $filterSize['clothing_id']);
    
                            if($i != $amountSizes){
                                array_push($sizesList, '||');
                            }
    
                            $i++;
                        }
                        $full = $clothing::filterClothes($sizesList, $full);
                    }
                }

                if ($full != null) {
                    $products = \App\Product::select('*')
                        ->where($full)
                        ->paginate(9);
                } else {
                    $products = \App\Product::where('type', '=', 'clothing');
                }   
//dd($products);
                break;

            case('accessory'):
                $type = 'accessories';
                $categories = \App\Category::where('type', '=', 'accessory')->get();

                $accessories = new \App\Product;

                if($request->categories != null){
                    $full = $accessories::filterClothes(['category_id', '=', $request->categories], $full);
                }
                if ($request->color != null) {
                    $full = $accessories::filterClothes(['color', '=', $request->color], $full);
                }
                if ($request->minPrice != '0') {
                    $full = $accessories::filterClothes(['price', '>=', (int)$request->minPrice], $full);
                }
                if ($request->maxPrice != '500') {
                    $full = $accessories::filterClothes(['price', '<=', (int)$request->maxPrice], $full);
                }

                if ($full != null) {
                    $products = \App\Product::select('*')
                        ->where($full)
                        ->paginate(9);
                } else {
                    $products = \App\Product::where('type', '=', 'accessory');
                }

                break;
            case('jewerly'):
                $type = 'jewerly';
                $categories = \App\Category::where('type', '=', 'Jewerly')->get();

                $accessories = new \App\Product;

                if($request->categories != null){
                    $full = $accessories::filterClothes(['category_id', '=', $request->categories], $full);
                }
                if ($request->minPrice != '0') {
                    $full = $accessories::filterClothes(['price', '>=', (int)$request->minPrice], $full);
                }
                if ($request->maxPrice != '500') {
                    $full = $accessories::filterClothes(['price', '<=', (int)$request->maxPrice], $full);
                }

                if ($full != null) {
                    $products = \App\Product::select('*')
                        ->where($full)
                        ->paginate(9);
                } else {
                    $products = \App\Product::where('type', '=', 'Jewerly');
                }

                break;
            default:
                return back();
        }

        return view('products')
            ->with('products', $products)
            ->with('type', $type)
            ->with('categories', $categories)
            ->with('genders', $genders)
            ->with('colors', $colors)
            ->with('request', $request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('about');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * @return $this
     */
    public function admin()
    {
        $admin = Auth::user();

        $amountUsers = \App\Admin::All()->count();
        $amountMale = \App\Admin::where('gender', '=', 'Man')->count();
        $amountFemale = \App\Admin::where('gender', '=', 'Vrouw')->count();

        $totalViewsClothes = \App\Product::where('type', '=', 'clothing')->sum('views');
        $totalViewsAccessories = \App\Product::where('type', '=', 'accessory')->sum('views');
        $totalViewsJewerlies = \App\Product::where('type', '=', 'jewerly')->sum('views');
        $totalViews = $totalViewsClothes + $totalViewsAccessories + $totalViewsJewerlies;

        $totalFavoredClothes = \App\Product::where('type', '=', 'clothing')->sum('favored');
        $totalFavoredAccessories = \App\Product::where('type', '=', 'accessory')->sum('favored');
        $totalFavoredJewerlies = \App\Product::where('type', '=', 'jewerly')->sum('favored');
        $totalFavored = $totalFavoredClothes + $totalFavoredAccessories + $totalFavoredJewerlies;

        $clothingViews = \App\Product::where('type', '=', 'clothing')->orderByDesc('views')->get();
        $clothingFavored = \App\Product::where('type', '=', 'clothing')->orderByDesc('favored')->get();
        $accessoriesViews = \App\Product::where('type', '=', 'accessory')->orderByDesc('views')->get();
        $accessoriesFavored = \App\Product::where('type', '=', 'accessory')->orderByDesc('favored')->get();
        $jewerliesViews = \App\Product::where('type', '=', 'jewerly')->orderByDesc('views')->get();
        $jewerliesFavored = \App\Product::where('type', '=', 'jewerly')->orderByDesc('favored')->get();


        return view('admin/home')
            ->with('admin', $admin)
            ->with('amountUsers', $amountUsers)
            ->with('amountMale', $amountMale)
            ->with('amountFemale', $amountFemale)
            ->with('totalViews', $totalViews)
            ->with('totalFavored', $totalFavored)
            ->with('clothingViews', $clothingViews)
            ->with('clothingFavored', $clothingFavored)
            ->with('accessoriesViews', $accessoriesViews)
            ->with('accessoriesFavored', $accessoriesFavored)
            ->with('jewerliesViews', $jewerliesViews)
            ->with('jewerliesFavored', $jewerliesFavored);
    }

    /**
     *
     */
    public function clothingOverview()
    {
        $admin = \App\Admin::find(1);
        $clothes = \App\Product::where('type', '=', 'clothing')->paginate(6);

        return view('admin/clothingOverview')
            ->with('admin', $admin)
            ->with('clothes', $clothes);
    }


    /**
     *
     */
    public function accessoriesOverview()
    {
        $admin = \App\Admin::find(1);
        $accessories = \App\Product::where('type', '=', 'accessory')->paginate(6);

        return view('admin/accessoriesOverview')
            ->with('admin', $admin)
            ->with('accessories', $accessories);
    }

    /**
     *
     */
    public function orderOverview()
    {
        $admin = \App\Admin::find(1);
        $warehouseProducts = \App\Order::
        select('orderId','user_id', 'totalPrice')
            ->groupBy('orderId', 'user_id', 'totalPrice')
            ->paginate(6);

        return view('admin/ordersOverview')
            ->with('admin', $admin)
            ->with('orders', $warehouseProducts);
    }
    public function adminDetail($id)
    {
        $admin = \App\Admin::find(1);
        $orders = \App\Order::select('*')->where('orderId', '=', $id)->get();

        return view('/admin/showOrder')
            ->with('admin', $admin)
            ->with('orders', $orders);
    }

    public function jewerliesOverview()
    {
        $admin = \App\Admin::find(1);
        $jewerlies = \App\Product::where('type', '=', 'jewerly')->paginate(6);

        return view('admin/jewerliesOverview')
            ->with('admin', $admin)
            ->with('jewerlies', $jewerlies);
    }
}