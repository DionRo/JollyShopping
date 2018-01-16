@extends('admin/master/master')

@section('content')

    <div class="add-product">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        </ul>
        <h4>Kleding toevoegen</h4>
        <div class="form">
            <form class="flex flex-between" action="{{action('clothingController@store')}}" method="post" enctype="multipart/form-data">
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
                    <div class="form-group flex flex-between align-center">
                        <label for="color">Kleur:</label>
                        <select name="color" id="color">
                            <option value="" selected hidden>Kleur</option>
                            @for($i = 0; $i < count($colors); $i++)
                                <option value="{{$colors[$i]}}">{{$colors[$i]}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group flex flex-between">
                        <label for="gender">Man / Vrouw</label>
                        <select name="gender" id="gender">
                            @foreach($genders as $gender)
                                <option value="{{$gender}}">{{$gender}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group flex flex-between">
                        <label for="stock">Voorraad</label>
                        <input type="text" name="stock" id="stock" required>
                    </div>
                </div>
                <div>
                    <div class="sizes">
                        <h5>Maten</h5>
                        <div class="form-group flex align-center">
                            <label for="sizeS">S</label>
                            <input type="checkbox" id="sizeS" name="sizeS">
                        </div>
                        <div class="form-group flex align-center">
                            <label for="sizeM">M</label>
                            <input type="checkbox" id="sizeM" name="sizeM">
                        </div>
                        <div class="form-group flex align-center">
                            <label for="sizeL">L</label>
                            <input type="checkbox" id="sizeL" name="sizeL">
                        </div>
                        <div class="form-group flex align-center">
                            <label for="sizeXL">XL</label>
                            <input type="checkbox" id="sizeXL" name="sizeXL">
                        </div>
                    </div>
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