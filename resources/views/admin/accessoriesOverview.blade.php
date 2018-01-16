@extends('admin.master.master')

@section('content')

    <div class="accessories-overview">
        <h4>Overzicht Accessoires</h4>
        <ul class="overview">
            @foreach($accessories as $accessory)
                <li>
                    <div class="flex">
                        <img src="../{{$accessory->picture}}" alt="">
                        <div>
                            <h5>{{$accessory->name}}</h5>
                            <p>Categorie: {{$accessory->category->name}}</p>
                            <p>Prijs: {{$accessory->price}}</p>
                            <p>Voorraad: {{$accessory->stock}}</p>
                        </div>
                    </div>
                    <form method="get" action="{{action('accessoriesController@adminDetail', $accessory->id)}}">
                        {{csrf_field()}}
                        <input class="view" type="image" src="../img/view.png">
                        <input type="submit" value="">
                    </form>
                </li>
            @endforeach
        </ul>
        {{$accessories->links()}}
    </div>

@endsection