@extends('admin/master/master')

@section('content')

    <div class="clothes-overview">
        <h4>Overzicht Kleding</h4>
        <ul class="overview">
            @foreach($clothes as $garment)
                <li>
                    <div class="flex">
                        <img src="{{$garment->picture}}" alt="">
                        <div>
                            <h5>{{$garment->name}}</h5>
                            <p>Categorie: {{$garment->category->name}}</p>
                            <p>Prijs: {{$garment->price}}</p>
                            <p>Voorraad: {{$garment->stock}}</p>
                        </div>
                    </div>
                    <form method="get" action="{{action('clothingController@adminDetail', $garment->id)}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$garment->id}}">
                        <input class="view" type="image" src="../img/view.png">
                        <input type="submit" value="">
                    </form>
                </li>
            @endforeach
        </ul>
        {{$clothes->links()}}
    </div>

@endsection