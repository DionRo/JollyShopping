@extends('admin/master/master')

@section('content')
    <div class="details">
        <div class="container">
            <div class="catalogus">
                <div class="status" style="display: flex;">
                    <form style="margin-right: 10px;" action="{{action('pagesController@orderProcess', $orders[0]->orderId)}}" method="GET">
                        {{csrf_field()}}
                        <input type="hidden" name="processValue" value="0">
                        <input type="submit" value="Nieuw" @if($orders[0]->isProcessed == 0) data-active="true" @endif>
                    </form>
                    <form style="margin-right: 10px;" action="{{action('pagesController@orderProcess', $orders[0]->orderId)}}" method="GET">
                        {{csrf_field()}}
                        <input type="hidden" name="processValue" value="1">
                        <input type="submit" value="Betaling in afwachting" @if($orders[0]->isProcessed == 1) data-active="true" @endif>
                    </form>
                    <form style="margin-right: 10px;" action="{{action('pagesController@orderProcess', $orders[0]->orderId)}}" method="GET">
                        {{csrf_field()}}
                        <input type="hidden" name="processValue" value="2">
                        <input type="submit" value="Betaald" @if($orders[0]->isProcessed == 2) data-active="true" @endif>
                    </form>
                    <form style="margin-right: 10px;" action="{{action('pagesController@orderProcess', $orders[0]->orderId)}}" method="GET">
                        {{csrf_field()}}
                        <input type="hidden" name="processValue" value="3">
                        <input type="submit" value="Verzonden" @if($orders[0]->isProcessed == 3) data-active="true" @endif>
                    </form>
                    <form class="order-delete" style="margin-right: 10px;" action="{{action('pagesController@orderProcess', $orders[0]->orderId)}}" method="GET">
                        {{csrf_field()}}
                        <input type="hidden" name="processValue" value="delete">
                        <input type="submit" value="Verwijder" @if($orders[0]->isProcessed == 3) data-active="true" @endif>
                    </form>
                </div>
                @foreach($orders as $order)
                    <div class="flex order-item">
                        <div>
                            <img src="{{$order->product->picture}}" alt="">
                        </div>
                        <div>
                            <ul>
                                <li>{{$order->product->name}}</li>
                                <li>Aantal: {{$order->amountOrder}}</li>
                                <li>Prijs per stuk:&#8364</li>
                                <li>Totaal:&#8364 {{$order->totalPrice}}</li>
                                <li>{{$order->specify}}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection