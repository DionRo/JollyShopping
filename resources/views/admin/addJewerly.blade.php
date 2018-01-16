@extends('admin/master/master')

@section('content')

    <div class="add-product">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        <h4>Sieraad toevoegen</h4>
        <div class="form">
            <form class="flex flex-between" action="{{action('accessoriesController@store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div>
                    <div class="form-group flex flex-between">
                        <label for="name">Naam</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group flex flex-between">
                        <label for="category">Categorie</label>
                        <select name="category" id="category">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group flex flex-between">
                        <label for="price">Prijs</label>
                        <input type="text" name="price" id="price" required>
                    </div>
                    <div class="form-group flex flex-between">
                        <label for="stock">Voorraad</label>
                        <input type="text" name="stock" id="stock" required>
                    </div>
                </div>
                <div>
                    <div class="form-group flex flex-column">
                        <label for="description">Beschrijving</label>
                        <textarea name="description" id="description" cols="45" rows="5" required></textarea>
                    </div>
                    <div class="form-group flex flex-between upload">
                        <label for="image">Upload Foto</label>
                        <input type="file" name="image" id="image" required>
                    </div>
                    <input type="submit" value="Save" class="save">
                </div>
            </form>
        </div>
    </div>

@endsection