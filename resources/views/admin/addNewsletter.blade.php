@extends('admin/master/master')

@section('content')

    <div class="add-product">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        <h4>Nieuwsbrief toevoegen</h4>
        <div class="form">
            <form class="flex flex-between" action="{{action('newsletterController@store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div>
                    <div class="form-group flex flex-between">
                        <label for="name">Naam</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group flex flex-column">
                        <label for="description">Beschrijving</label>
                        <textarea name="description" id="description" cols="45" rows="5" required></textarea>
                    </div>
                <div>
                    <div class="form-group flex flex-between upload">
                        <label for="pdf">Upload PDF</label>
                        <input type="file" name="pdf" id="pdf" accept="application/pdf" required>
                    </div>
                    <input type="submit" value="Save" class="save">
                </div>
            </form>
        </div>
    </div>

@endsection