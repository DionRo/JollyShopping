@extends('admin/master/master')

@section('content')

    <div class="clothes-overview">
        <h4>Overzicht Kleding</h4>
        <ul class="overview">
            @foreach($orders as $order)
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
                        <input class="view" type="image" src="../img/view.png">
                        <input type="submit" value="">
                    </form>
                </li>
            @endforeach
        </ul>
        {{$orders->links()}}
    </div>

@endsection