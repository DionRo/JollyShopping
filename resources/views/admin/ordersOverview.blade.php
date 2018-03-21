@extends('admin/master/master')

@section('content')

    <div class="clothes-overview">
        <h4>Overzicht Kleding</h4>
        <ul class="overview">
            @foreach($orders as $order)
                <li>
                    <div class="flex">
                        <div>
                            <h5>Order #{{$order->orderId}}</h5>
                            <p>Totaalprijs: {{$order->totalPrice}}</p>
                            <p>Besteld door KlantNr: {{$order->user_id}}</p>
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