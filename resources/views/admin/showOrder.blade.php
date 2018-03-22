@extends('admin/master/master')

@section('content')
    <div class="details">
        <div class="container">
            <div class="catalogus">
                <div class="status" style="display: flex;">
                    <form style="margin-right: 10px;" action="" method="POST">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="submit" value="Status ontvangen == 0 ">
                    </form>
                    <form style="margin-right: 10px;" action="" method="POST">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="submit" value="Status Betaald == 1">
                    </form>
                    <form style="margin-right: 10px;" action="" method="POST">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="submit" value="Status verstuurd == 2">
                    </form>
                    <form style="margin-right: 10px;" action="" method="POST">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="submit" value="Status afgerond == 3">
                    </form>
                </div>
                @foreach($orders as $order)
                    <h2 style="font-size: 40px;">Ordernummer #{{$order->orderId}}</h2>
                    <p>Besteld door</p>
                    <div style="padding: 10px 20px; margin: 10px 0; background-color: #ffffff; border-radius: 20px;">
                        <div class="flex">
                            <img src="" alt="hier moet een afbeelding" style="width: 200px; height: 200px;">
                            <ul>
                                <li style="font-size: 25px; font-weight: bold;">Naam Product</li>
                                <li style="font-size: 20px">Aantal: {{$order->amountOrder}}</li>
                                <li style="font-size: 20px">Prijs per stuk:&#8364</li>
                                <li style="font-size: 20px">Totaal:&#8364 {{$order->totalPrice}}</li>
                            </ul>
                        </div>
                        <p>Uw huidige orderstatus is {{$order->isProcessed}}</p>
                        <p> {{$order->specify}} </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection