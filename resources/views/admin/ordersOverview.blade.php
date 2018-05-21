@extends('admin/master/master')

@section('content')

    <div class="clothes-overview">
        <h4>Overzicht nieuwe orders</h4>
        <ul class="overview">
            @foreach($ordersNew as $order)
                <li>
                    <div class="flex">
                        <div>
                            <h5>Bestelling van: {{$order->user->firstname}} {{$order->user->lastname}}</h5>
                            <p>Totaalprijs: {{$order->totalPrice}}</p>
                            <p>Status: @switch($order->isProcessed) @case(1) Betaling in afwachting @break @case(2) Betaald @break @case(3) Verzonden @break @default Nieuw @break  @endswitch</p>
                        </div>
                    </div>
                    <form method="get" action="{{action('pagesController@adminDetail', $order->orderId)}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$order->orderId}}">
                        <input type="hidden" name="userId" value="{{$order->user_id}}">
                        <input class="view" type="image" src="../img/view.png">
                        <input type="submit" value="">
                    </form>
                </li>
            @endforeach
        </ul>
        {{$ordersNew->links()}}
        <h4>Overzicht gefactureerd &amp; niet betaalde orders</h4>
        <ul class="overview">
            @foreach($ordersUnpayed as $orderUnpayed)
                <li>
                    <div class="flex">
                        <div>
                            <h5>Bestelling van: {{$orderUnpayed->user->firstname}} {{$orderUnpayed->user->lastname}}</h5>
                            <p>Totaalprijs: {{$orderUnpayed->totalPrice}}</p>
                            <p>Status: @switch($orderUnpayed->isProcessed) @case(1) Betaling in afwachting @break @case(2) Betaald @break @case(3) Verzonden @break @default Nieuw @break  @endswitch</p>
                        </div>
                    </div>
                    <form method="get" action="{{action('pagesController@adminDetail', $orderUnpayed->orderId)}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$orderUnpayed->orderId}}">
                        <input type="hidden" name="userId" value="{{$orderUnpayed->user_id}}">
                        <input class="view" type="image" src="../img/view.png">
                        <input type="submit" value="">
                    </form>
                </li>
            @endforeach
        </ul>
        {{$ordersUnpayed->links()}}
        <h4>Overzicht gefactureerd &amp; betaalde orders</h4>
        <ul class="overview">
            @foreach($ordersPayed as $orderPayed)
                <li>
                    <div class="flex">
                        <div>
                            <h5>Bestelling van: {{$orderPayed->user->firstname}} {{$orderPayed->user->lastname}}</h5>
                            <p>Totaalprijs: {{$orderPayed->totalPrice}}</p>
                            <p>Status: @switch($orderPayed->isProcessed) @case(1) Betaling in afwachting @break @case(2) Betaald @break @case(3) Verzonden @break @default Nieuw @break  @endswitch</p>
                        </div>
                    </div>
                    <form method="get" action="{{action('pagesController@adminDetail', $orderPayed->orderId)}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$orderPayed->orderId}}">
                        <input type="hidden" name="userId" value="{{$orderPayed->user_id}}">
                        <input class="view" type="image" src="../img/view.png">
                        <input type="submit" value="">
                    </form>
                </li>
            @endforeach
        </ul>
        {{$ordersPayed->links()}}
        <h4>Overzicht verzonden orders</h4>
        <ul class="overview">
            @foreach($ordersSend as $orderSend)
                <li>
                    <div class="flex">
                        <div>
                            <h5>Bestelling van: {{$orderSend->user->firstname}} {{$orderSend->user->lastname}}</h5>
                            <p>Totaalprijs: {{$orderSend->totalPrice}}</p>
                            <p>Status: @switch($orderSend->isProcessed) @case(1) Betaling in afwachting @break @case(2) Betaald @break @case(3) Verzonden @break @default Nieuw @break  @endswitch</p>
                        </div>
                    </div>
                    <form method="get" action="{{action('pagesController@adminDetail', $orderSend->orderId)}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$orderSend->orderId}}">
                        <input type="hidden" name="userId" value="{{$orderSend->user_id}}">
                        <input class="view" type="image" src="../img/view.png">
                        <input type="submit" value="">
                    </form>
                </li>
            @endforeach
        </ul>
        {{$ordersSend->links()}}
    </div>
@endsection