@extends('admin/master/master')

@section('content')

    <div class="users-overview">
        <h4>Overzicht Categorien</h4>
        <ul class="overview">
            @foreach($categories as $category)
                <li class="li-resize">
                    <h5>{{$category->name}}</h5>
                    <p>Wanneer aangemaakt: {{$category->created_at}}</p>
                </li>
            @endforeach
        </ul>
        {{$categories->links()}}
    </div>

@endsection