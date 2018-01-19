@extends('admin/master/master')

@section('content')

    <div class="users-overview">
        <h4>Overzicht Nieuwsbrieven</h4>
        <ul class="overview">
            @foreach($newsletters as $newsletter)
                <li class="li-resize">
                    <h5>{{$newsletter->title}}</h5>
                    <p>Wanneer aangemaakt: {{$newsletter->created_at}}</p>
                    <form action="{{action('newsletterController@sendNewsletter', $newsletter->id)}}" method="get">
                        <input type="submit" value="Verstuur">
                    </form>
                </li>
            @endforeach
        </ul>
        {{$newsletters->links()}}
    </div>

@endsection