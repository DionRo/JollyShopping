@extends('admin.master.master')

@section('content')

    <div class="accessories-overview">
        <h4>Overzicht Sieraden</h4>
        <ul class="overview">
            @foreach($jewerlies as $jewerly)
                <li>
                    <div class="flex">
                        <img src="{{$jewerly->picture}}" alt="">
                        <div>
                            <h5>{{$jewerly->name}}</h5>
                            <p>Categorie: {{$jewerly->category->name}}</p>
                            <p>Prijs: {{$jewerly->price}}</p>
                            <p>Voorraad: {{$jewerly->stock}}</p>
                        </div>
                    </div>
                    <form method="get" action="{{action('jewerlyController@adminDetail', $jewerly->id)}}">
                        {{csrf_field()}}
                        <input class="view" type="image" src="../img/view.png">
                        <input type="submit" value="">
                    </form>
                </li>
            @endforeach
        </ul>
        {{$jewerlies->links()}}
    </div>

@endsection