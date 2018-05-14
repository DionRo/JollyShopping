@extends('master/master')

@section('content')
    @if(Session::has('cart'))
 <div class="main-content">
     <div class="container">
        <div class="shopping-cart">
            <h2 style="font-size: 40px;">Uw winkelwagen</h2>
            <ul>
                @foreach($products as $product)
                 <li class="cart-item">
                     <div class="flex">
                        <img src="{{$product['item']['picture']}}" alt="" style="width: 200px; height: 200px;">
                        <ul>
                            <li style="font-size: 25px; font-weight: bold;">{{$product['item']['name']}}</li>
                            <li style="font-size: 20px">Aantal: {{$product['qty']}} @if($product['qty'] > 1)
                               p.p.s(&#8364 {{$product['item']['price']}})
                                @endif
                            </li>
                            <li style="font-size: 20px">Totaal:&#8364 {{$product['price']}}</li>
                            <div style="display: flex;">
                                <li><a href="{{action('pagesController@addUpProduct' , $product['item']['id'])}}"></li>
                                <li><i class="fas fa-arrow-up"></i></li>
                            </a>
                            @if($product['qty'] == 1)
                                <li><a style="display: none;" href="{{action('pagesController@removeSingle' , $product['item']['id'])}}">
                                    <i class="fas fa-arrow-down"></i>
                                </a></li>
                            @else
                                <li><a href="{{action('pagesController@removeSingle' , $product['item']['id'])}}">
                                    <i  class="fas fa-arrow-down"></i>
                                </a></li>
                            @endif
                                <li><a href="{{action('pagesController@removeProduct' , $product['item']['id'])}}">
                                    <i class="far fa-trash-alt"></i>
                                </a></li>
                            </div>
                        </ul>
                     </div>
                 </li>
                @endforeach
            </ul>
            <div style="text-align: center">
                <input id="buttonTotal" value="Totaal prijs: {{$totalPrice}}"readonly >
                <form action="{{action('pagesController@checkOut')}}" method="post">
                    <input id="button" type="submit" value="Checkout">
                </form>
            </div>
        </div>
    @else
         <div class="catalogus">
             <div class="container" style="text-align: center">
                 <h2 style="font-size: 40px;">Uw winkelwagen is leeg</h2>
                 <p>Ga deze snel vullen op de <a href="/products">PRODUCTEN</a> pagina</p>
             </div>
         </div>
        @endif
     </div>
 </div>
@endsection