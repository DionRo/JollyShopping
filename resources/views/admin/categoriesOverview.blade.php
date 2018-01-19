@extends('admin/master/master')

@section('content')

    <div class="users-overview">
        <h4>Overzicht Categorien</h4>
        <ul class="overview">
            @foreach($categories as $category)
                <li class="li-resize">
                    <h5>{{$category->name}}</h5>
                    <p>Wanneer aangemaakt: {{$category->created_at}}</p>
                    <form action="{{action('categoryController@destroy', $category->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button onclick="usure()" >Verwijder</button>
                    </form>
                </li>
            @endforeach
        </ul>
        {{$categories->links()}}
        <script>
            function usure() {

                var answer = confirm ("Ben je er zeker van dat je wilt verwijderen?")
                if (!answer)
                    window.location="http://localhost:8000/admin/categories"
            }
        </script>
    </div>

@endsection