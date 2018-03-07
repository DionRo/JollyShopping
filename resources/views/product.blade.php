@extends('master/master')

@section('content')

<div class="main-content detail-content">
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
            @if(isset($sizes))
                <h3 class="size">Maten</h3>
                <ul class="sizes flex">
                    @foreach($sizes as $size)
                        <li>{{$size->size}}</li>
                    @endforeach
                </ul>
            @endif
            <h3 class="description">Beschrijving</h3>
            <p>{{$product->description}}</p>
        </div>
    </div>
    @if(Auth::Check() == True)
        <a class="addCartDetail" href="{{action('pagesController@getAddToCartDetail', $product->id)}}" role="button"><i class="fas fa-cart-plus"></i></a>
    @endif
</div>
@endsection