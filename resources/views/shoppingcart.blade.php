@extends('master/master')
<style>
    input[type=text] {
        width: 50%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .alert {
       background-color: #4CAF50;
       color: white;
        font-size: 25px;
       text-align: center;
        }
</style>
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
                <p style="font-size: 20px;">Huidige verzendadres: {{Auth::user()->adress}} , {{Auth::user()->zipcode}} , {{Auth::user()->country}}</p>
                <p>Vul het alternatieve adres in als het huidge verzendadres niet klopt</p>
                <input id="buttonTotal" value="Totaal prijs: {{$totalPrice}}"readonly >
                <form action="{{action('pagesController@checkOut')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label style="font-size: 20px;" for="adres">Alternatief verzendadres</label>
                        <br>
                        <input type="text" name="adres" id="adres" value="Adres + Postcode!" required>
                    </div>
                    <input id="button" type="submit" value="Checkout">
                </form>
            </div>
        </div>
    @else
         <div class="catalogus">
             <br/>
             <div class="container" style="text-align: center">
                 @if (session('status-checkout'))
                     <div class=" alert closebtn" style="padding: 25px!important; border-radius: 10px;">
                         {{ session('status-checkout') }}
                     </div>
                 @endif
                 <h2 style="font-size: 40px;color: Gray;">Uw winkelwagen is leeg</h2>
                 <p>Ga deze snel vullen op de <a href="/products">PRODUCTEN</a> pagina</p>
             </div>
         </div>
        @endif
     </div>
 </div>
@endsection