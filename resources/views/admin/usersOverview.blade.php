@extends('admin/master/master')

@section('content')

    <div class="users-overview">
        <h4>Overzicht Gebuikers</h4>
        <ul class="overview">
            @foreach($users as $user)
                <li class="li-resize">
                    <h5>{{$user->rank}}</h5>
                    <p>Voornaam: {{$user->firstname}}</p>
                    <p>Achternaam: {{$user->lastname}}</p>
                    <p>Geslacht: {{$user->gender}}</p>
                    <form method="POST" action="{{action('userController@edit', $user->id)}}">
                        {{csrf_field()}}
                        <input class="view" type="image" src="../img/view.png">
                        <input type="submit" value="">
                    </form>
                </li>
            @endforeach
        </ul>
        {{$users->links()}}
    </div>

@endsection