@extends('master/master')

@section('header-class')
    home-page
@endsection

@section('content')
    <div class="banner flex flex-center align-center">

        @if(Auth::Check() == true)
            <h1>Welcome,<br> {{Auth::user()->firstname}} {{Auth::user()->lastname}}</h1>
        @else
            <h1>Welcome to <span>JOLLYSHOPPING</span></h1>
        @endif

    </div>
    <div class="product-nav flex flex-center">
        <nav>
            <ul class="flex flex-between">
                <li id="accessories"><div class="product-overlay flex flex-center align-center">
                        <form action="{{action('pagesController@filterProducts')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="type" value="allAccessories">
                            <input type="submit" value="Accessoires">
                        </form>
                    </div>
                </li>
                <li id="gallery"><div class="product-overlay flex flex-center align-center">
                        <form action="{{action('pagesController@filterProducts')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="type" value="allClothing">
                            <input type="submit" value="Kleding">
                        </form>
                    </div></li>
                <li id="most-viewed"><div class="product-overlay flex flex-center align-center">
                        <form action="{{action('pagesController@products')}}">
                            <input type="submit" value="Nieuwe Producten">
                        </form>
                    </div></li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <div class="new-products">
            <div class="container">
                <div class="clothes">
                    <div class="flex flex-between">
                        <h2>Nieuwste Kleding</h2>
                        <form action="{{action('pagesController@filterProducts')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="type" value="allClothing">
                            <input class="show-all" type="submit" value="Show All">
                        </form>
                    </div>
                    <ul class="flex flex-between">
                        @for($i = 0 ; $i < count($clothing) ; $i++)
                            @if ($i < 3)
                                <li class="new-product align-center">
                                    <img src="{{$clothing[$i]->picture}}" alt="product">
                                    <h3>{{$clothing[$i]->name}}</h3>
                                    <p class="price-tag">&#8364;{{$clothing[$i]->price}}</p>
                                    @if($clothing[$i]->stock == 0)
                                        <p class="outofstock-tag">OUT OF STOCK</p>
                                    @elseif($clothing[$i]->discount > 0)
                                        <p class="onsale-tag">ON SALE!</p>
                                    @endif
                                    <form class="view-product" method="get" action="{{action('clothingController@show', $clothing[$i]->id)}}">
                                        {{csrf_field()}}
                                        <input class="view" type="image" src="img/view.png">
                                        <input type="submit" value="">
                                    </form>
                                </li>
                            @endif
                        @endfor
                    </ul>
                </div>
                <div class="accessories">
                    <div class="flex flex-between">
                        <h2>Nieuwste Accessiores</h2>
                        <form action="{{action('pagesController@filterProducts')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="type" value="allAccessories">
                            <input class="show-all" type="submit" value="Show All">
                        </form>
                    </div>
                    <ul class="flex flex-between">
                        @for($i = 0 ; $i < count($accessories) ; $i++)
                            @if ($i < 3)
                                <li class="new-product align-center">
                                    <img src="{{$accessories[$i]->picture}}" alt="product">
                                    <h3>{{$accessories[$i]->name}}</h3>
                                    <p class="price-tag">&#8364;{{$accessories[$i]->price}}</p>
                                    @if($accessories[$i]->stock == 0)
                                        <p class="outofstock-tag">OUT OF STOCK</p>
                                    @elseif($accessories[$i]->discount > 0)
                                        <p class="onsale-tag">ON SALE</p>
                                    @endif
                                    <form class="view-product" method="get" action="{{action('accessoriesController@show', $accessories[$i]->id)}}">
                                        {{csrf_field()}}
                                        <input class="view" type="image" src="img/view.png">
                                        <input type="submit" value="">
                                    </form>
                                </li>
                            @endif
                        @endfor
                    </ul>
                </div>
                <div class="accessories">
                    <div class="flex flex-between">
                        <h2>Nieuwste Sieraden</h2>
                        <form action="{{action('pagesController@filterProducts')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="type" value="allJewerlies">
                            <input class="show-all" type="submit" value="Show All">
                        </form>
                    </div>
                    <ul class="flex flex-between">
                        @for($i = 0 ; $i < count($jewerlies) ; $i++)
                            @if ($i < 3)
                                <li class="new-product align-center">
                                    <img src="{{$jewerlies[$i]->picture}}" alt="product">
                                    <h3>{{$jewerlies[$i]->name}}</h3>
                                    <p class="price-tag">&#8364;{{$jewerlies[$i]->price}}</p>
                                    @if($jewerlies[$i]->stock == 0)
                                        <p class="outofstock-tag">OUT OF STOCK</p>
                                    @elseif($jewerlies[$i]->discount > 0)
                                        <p class="onsale-tag">ON SALE</p>
                                    @endif
                                    <form class="view-product" method="get" action="{{action('jewerlyController@show', $jewerlies[$i]->id)}}">
                                        {{csrf_field()}}
                                        <input class="view" type="image" src="img/view.png">
                                        <input type="submit" value="">
                                    </form>
                                </li>
                            @endif
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection