@extends('master/master')

@section('content')

<div class="main-content catalogus">
    <div class="container">
        <div class="flex">
            <div class="filter align-center">
                <ul>
                    @if(!isset($type))
                        <li>
                            <form action="{{action('pagesController@filterProducts')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="type" value="allClothing">
                                <input type="submit" value="Kleren">
                            </form>
                        </li>
                        <li>
                            <form action="{{action('pagesController@filterProducts')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="type" value="allAccessories">
                                <input type="submit" value="Accessoires">
                            </form>
                        </li>
                        <li>
                            <form action="{{action('pagesController@filterProducts')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="type" value="allJewerlies">
                                <input type="submit" value="Sieraden">
                            </form>
                        </li>
                    @elseif($type == 'clothing')
                        <form class="product-filter" action="{{action('pagesController@filterProducts')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="type" value="allClothing">
                            <input type="submit" value="Kleren">
                        </form>
                        <form action="{{action('pagesController@filterProducts')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="categories"></label>
                                <select name="categories" id="categories" value="{{old('categories')}}">
                                    <option value="" @if(!isset($request->categories)) selected @endif hidden>Categorie</option>
                                    @for($i = 0; $i < count($categories); $i++)
                                        <option value="{{$categories[$i]->id}}" @if(isset($request->categories)) @if(($request->categories) == $categories[$i]->id) selected @endif @endif>{{$categories[$i]->name}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gender"></label>
                                <select name="gender" id="gender">
                                    <option value="" @if(!isset($request->gender)) selected @endif hidden>Man / Vrouw</option>
                                    @for($i = 0; $i < count($genders); $i++)
                                        <option value="{{$i}}" @if(isset($request->gender)) @if($request->gender == $i) selected="selected" @endif @endif>{{$genders[$i]}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="color"></label>
                                <select name="color" id="color">
                                    <option value="" @if(!isset($request->color)) selected @endif hidden>Kleur</option>
                                    @for($i = 0; $i < count($colors); $i++)
                                        <option value="{{$colors[$i]}}" @if(isset($request->color)) @if($request->color == $colors[$i]) selected @endif @endif>{{$colors[$i]}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group flex">
                                <div>
                                    <label for="minPrice">Min Prijs</label>
                                    <input type="number" name="minPrice" id="minPrice" min="0" max="499" @if(isset($request->minPrice)) value="{{$request->minPrice}}" @else value="0" @endif>
                                </div>
                                <div>
                                    <label for="maxPrice">Max Prijs</label>
                                    <input type="number" name="maxPrice" id="maxPrice" min="1" max="500" @if(isset($request->maxPrice)) value="{{$request->maxPrice}}" @else value="500" @endif>
                                </div>
                            </div>
                            <input type="hidden" name="type" value="clothing">
                            <input type="submit" value="Save" class="submit">
                        </form>
                        <li>
                            <form action="{{action('pagesController@products')}}">
                                {{csrf_field()}}
                                <input type="submit" value="Ga terug">
                            </form>
                        </li>
                    @elseif($type == 'accessories')
                        <form class="product-filter" action="{{action('pagesController@filterProducts')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="type" value="allAccessories">
                            <input type="submit" value="Accessoires">
                        </form>
                        <form action="{{action('pagesController@filterProducts')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="categories"></label>
                                <select name="categories" id="categories" value="{{old('categories')}}">
                                    <option value="" @if(!isset($request->categories)) selected @endif hidden>Categorie</option>
                                    @for($i = 0; $i < count($categories); $i++)
                                        <option value="{{$categories[$i]->id}}" @if(isset($request->categories)) @if(($request->categories) == $categories[$i]->id) selected @endif @endif>{{$categories[$i]->name}} </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="color"></label>
                                <select name="color" id="color">
                                    <option value="" @if(!isset($request->color)) selected @endif hidden>Kleur</option>
                                    @for($i = 0; $i < count($colors); $i++)
                                        <option value="{{$colors[$i]}}" @if(isset($request->color)) @if($request->color == $colors[$i]) selected @endif @endif>{{$colors[$i]}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group flex">
                                <div>
                                    <label for="minPrice">Min Prijs</label>
                                    <input type="number" name="minPrice" id="minPrice" min="0" max="499" @if(isset($request->minPrice)) value="{{$request->minPrice}}" @else value="0" @endif>
                                </div>
                                <div>
                                    <label for="maxPrice">Max Prijs</label>
                                    <input type="number" name="maxPrice" id="maxPrice" min="1" max="500" @if(isset($request->maxPrice)) value="{{$request->maxPrice}}" @else value="500" @endif>
                                </div>
                            </div>
                            <input type="hidden" name="type" value="accessory">
                            <input type="submit" value="Save" class="submit">
                        </form>
                        <li>
                            <form action="{{action('pagesController@products')}}">
                                {{csrf_field()}}
                                <input type="submit" value="Ga terug">
                            </form>
                        </li>
                    @elseif($type == 'jewerly')
                        <li>
                            <form action="{{action('pagesController@filterProducts')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="type" value="allJewerlies">
                                <input type="submit" value="Sieraden">
                            </form>
                        </li>
                        <form action="{{action('pagesController@filterProducts')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="categories"></label>
                                <select name="categories" id="categories" value="{{old('categories')}}">
                                    <option value="" @if(!isset($request->categories)) selected @endif hidden>Categorie</option>
                                    @for($i = 0; $i < count($categories); $i++)
                                        <option value="{{$categories[$i]->id}}" @if(isset($request->categories)) @if(($request->categories) == $categories[$i]->id) selected @endif @endif>{{$categories[$i]->name}} </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group flex">
                                <div>
                                    <label for="minPrice">Min Prijs</label>
                                    <input type="number" name="minPrice" id="minPrice" min="0" max="499" @if(isset($request->minPrice)) value="{{$request->minPrice}}" @else value="0" @endif>
                                </div>
                                <div>
                                    <label for="maxPrice">Max Prijs</label>
                                    <input type="number" name="maxPrice" id="maxPrice" min="1" max="500" @if(isset($request->maxPrice)) value="{{$request->maxPrice}}" @else value="500" @endif>
                                </div>
                            </div>
                            <input type="hidden" name="type" value="jewerly">
                            <input type="submit" value="Save" class="submit">
                        </form>
                        <li>
                            <form action="{{action('pagesController@products')}}">
                                {{csrf_field()}}
                                <input type="submit" value="Ga terug">
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="products">
                <ul>
                    @foreach($products as $product)
                        <li class="new-product align-center">
                            <img src="{{$product->picture}}" alt="product">
                            <h3>{{$product->name}}</h3>
                            @if(Auth::Check() == True)
                            <a href="{{action('pagesController@getAddToCart', $product->id)}}" role="button">Voeg toe aan winkelwagen</a>
                            @endif
                            <p class="price-tag">&#8364;{{$product->price}}</p>
                            @if($product->stock == 0)
                                <p class="outofstock-tag">OUT OF STOCK</p>
                            @elseif($product->discount > 0)
                                <p class="onsale-tag">ON SALE</p>
                            @endif
                            <form class="view-product" method="get" action="@if($product->type === 'clothing'){{action('clothingController@show', $product->id)}}
                                                                            @elseif($product->type === 'accessory') {{action('accessoriesController@show', $product->id)}}
                                                                            @else {{action('jewerlyController@show', $product->id)}} @endif">
                                {{csrf_field()}}
                                <input class="view" type="image" src="img/view.png">
                                <input type="submit" value="">
                            </form>
                        </li>
                    @endforeach
                </ul>
                         {{$products->appends($_GET)->links()}}
            </div>
        </div>
    </div>
</div>
@endsection