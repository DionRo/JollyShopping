@extends('admin/master/master')

@section('content')
    <div class="details">
        {{dd($orders)}}
        <div class="container">
            <div class="catalogus">
                <h2 style="font-size: 40px;">Uw winkelwagen ()</h2>
                @foreach($orders as $order)
                    <div style="padding: 10px 20px; margin: 10px 0; background-color: #ffffff; border-radius: 20px;">
                        <div class="flex">
                            <img src="{{$product['item']['picture']}}" alt="" style="width: 200px; height: 200px;">
                            <ul>
                                <li style="font-size: 25px; font-weight: bold;">{{$product['item']['name']}}</li>
                                <li style="font-size: 20px">Aantal: {{$product['qty']}}</li>
                                @if($product['qty'] > 1)
                                    <li style="font-size: 20px">Prijs per stuk:&#8364 {{$product['item']['price']}}</li>
                                @endif
                                <li style="font-size: 20px">Totaal:&#8364 {{$product['price']}}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection