@extends('admin/master/master')

@section('content')
    <div class="details">
        <h4>{{$product->name}}</h4>
        <div class="flex">
            <img src="{{$product->picture}}" alt="">
            <div class="product-info">
                <p>{{$product->category->name}} - {{$product->color}}</p>
                <p><span class="@if($product->discount > 0) old-price @endif">&#8364;{{$product->price}}</span> @if($product->discount > 0)/ &#8364;{{$discount}} @endif </p>
                <h3 class="description">Beschrijving</h3>
                <p>{{$product->description}}</p>
                <form action="{{action('jewerlyController@edit', $product->id)}}">
                    {{csrf_field()}}
                    <input type="submit" value="Bewerk">
                </form>
                <br>
                   <form action="{{action('jewerlyController@destroy', $product->id)}}" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <input type="submit" value="Verwijder">
                </form>
            </div>
        </div>
    </div>
@endsection