@extends('master/master')

@section('content')

    <style>
        .alert {
            background-color: #4CAF50;
            color: white;
            font-size: 20px;
            text-align: center;
        }


    </style>
<div class="main-content detail-content">
    @if (session('succes'))
        <div class="container alert closebtn" style="padding: 10px!important; border-radius: 10px;">
            {{ session('succes') }}
        </div>
    @endif
    <div class="container flex ">
        <img class="product-img" src="{{$product->picture}}" alt="product">
        <div class="product-info">
            <h2>{{$product->name}}</h2>
            <p>{{$product->category->name}}  @if($product->color != NULL) - {{$product->color}} @else @endif</p>
            <p><span class="@if($product->discount > 0) old-price @endif">&#8364;{{$product->price}}</span> @if($product->discount > 0)/ &#8364;{{$discount}} @endif </p>
            @if($product->stock == 0)
                <p class="stock">Dit product is tijdelijk uitverkocht!</p>
            @elseif($product->stock == 1)
                <p class="stock">Er is nog 1 product op voorraad</p>
            @else
                <p class="stock">Er zijn nog {{$product->stock}} stuks op voorraad</p>
            @endif
            @if($product->isSendable == 0)
                <p class="stock">Dit product wordt niet verzonden!</p>
            @elseif($product->isSendable == 1)
                <p class="stock">Dit product wordt wel verzonden!</p>
            @endif
            @if(isset($sizes))
                <h3 class="size">Maten</h3>
                <ul class="sizes flex">
                    @foreach($sizes as $size)
                        <li>
                        <input id="size-{{$size->size}}" name="size" type="radio" data-id="{{$size->id}}" @if($sizes[0]->id == $size->id) data-checked="true" checked @else data-checked="false" @endif>
                        <label for="size-{{$size->size}}" class="size-{{$size->size}}">{{$size->size}}</label>
                        </li>
                    @endforeach

                </ul>
            @endif
            <h3 class="description">Beschrijving</h3>
            <p>{{$product->description}}</p>
            <br>
            <div class="addCartContainer">
                <form action="{{action('pagesController@products')}}">
                    <input type="submit" class="addCartDetail" value="Ga Terug" >
                </form>
            </div>
        </div>
    </div>
    @if(Auth::Check() == True && $product->stock > 0)
        <div class="addCartContainer">
            <form action="{{action('pagesController@getAddToCartDetail', $product->id)}}">
                @if(isset($sizes))
                    <input type="hidden" id="size-id" name="size-id" value="clothing">
                    <input type="hidden" id="product-id" name="product-id" value="{{$product->id}}">
                @endif
                <input type="submit" class="addCartDetail" value="Bestel Nu" >
            </form>
        </div>
    @endif
</div>
@endsection