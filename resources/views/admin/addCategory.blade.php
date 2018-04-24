@extends('admin/master/master')

@section('content')

    <div class="add-product">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        <h4>Categorie toevoegen</h4>
        <div class="form">
            <form class="flex flex-between" action="{{action('categoryController@store')}}" method="post">
                {{csrf_field()}}
                <div>
                    <div class="form-group flex flex-between">
                        <label for="name">Naam</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group flex flex-between">
                        <label for="category">Categorie Type</label>
                        <select name="category" id="category">
                            <!--<option value="Clothing">Kleren</option>-->
                            <option value="Accessory">Accesories</option>
                            <option value="Jewelry">Sieraden</option>
                        </select>
                    </div>
                    <input type="submit" value="Save" class="save">
                </div>
            </form>
        </div>
    </div>

@endsection