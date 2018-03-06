@extends('master/master')

@section('content')
    @if(Session::has('cart'))
 <div class="main-content">
     <div class="container">
         <h2 style="font-size: 40px;">Uw winkelwagen</h2>
        <div class="catalogus">
            <ul>
                @foreach($products as $product)
                 <div style="display: flex; padding-top: 10px;" >
                        <img src="{{$product['item']['picture']}}" alt="" style="width: 200px; height: 200px;">
                        <ul style="margin-left: 20px;">
                            <li style="font-size: 20px">{{$product['item']['name']}}</li>
                            <li style="font-size: 20px">Aantal: {{$product['qty']}}</li>
                            @if($product['qty'] > 1)
                                <li style="font-size: 20px">Prijs per stuk:&#8364 {{$product['item']['price']}}</li>
                            @endif
                            <li style="font-size: 20px">Totaal:&#8364 {{$product['price']}}</li>
                            <li>
                                <a href="{{action('pagesController@addUpProduct' , $product['item']['id'])}}">
                                    <i style="font-size: 20px" class="fas fa-arrow-up"></i>
                                </a>
                                @if($product['qty'] == 1)
                                    <a style="display: none;" href="{{action('pagesController@removeSingle' , $product['item']['id'])}}">
                                        <i style="font-size: 20px" class="fas fa-arrow-down"></i>
                                    </a>
                                @else
                                    <a  href="{{action('pagesController@removeSingle' , $product['item']['id'])}}">
                                        <i style="font-size: 20px" class="fas fa-arrow-down"></i>
                                    </a>
                                @endif
                                <a href="{{action('pagesController@removeProduct' , $product['item']['id'])}}">
                                    <i  style="font-size: 20px" class="far fa-trash-alt"></i>
                                </a>
                            </li>
                        </ul>
                 </div>
                @endforeach
            </ul>
            <div class="" style="float: right;">
                <strong>Total: {{$totalPrice}}</strong>
                <a href="">Checkout</a>
            </div>
        </div>
    @else
        <div class="">
            <strong><h2>No item in cart</h2></strong>
        </div>
    @endif
     </div>
 </div>
@endsection