@extends('admin/master/master')

@section('content')
    <div class="edit">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        <h4>Bewerk {{$product->name}}</h4>
        <div class="form">
            <form class="flex flex-between" action="{{action('accessoriesController@update', $product->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('put')}}
                <div>
                    <div class="form-group flex flex-between align-center">
                        <label for="name">Naam:</label>
                        <input type="text" id="name" name="name" value="{{$product->name}}" required>
                    </div>
                    <div class="form-group flex flex-between align-center">
                        <label for="category">Categorie:</label>
                        <select name="category" id="category">
                            @for($i = 0; $i < count($categories); $i++)
                                <option @if($product->category == $categories[$i]->name) selected="selected" @endif value="{{$categories[$i]->id}}">{{$categories[$i]->name}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group flex flex-between align-center">
                        <label for="price">Prijs:</label>
                        <input type="text" id="price" name="price" value="{{$product->price}}" required>
                    </div>
                    <div class="form-group flex flex-between align-center">
                        <label for="discount">Korting:</label>
                        <input type="text" id="discount" name="discount" value="{{$product->discount}}">
                    </div>
                    <div class="form-group flex flex-between align-center">
                        <label for="stock">Voorraad</label>
                        <input type="text" name="stock" id="stock" value="{{$product->stock}}" required>
                    </div>
                </div>
                <div>
                    <div class="form-group flex flex-column">
                        <label for="description">Beschrijving</label>
                        <textarea name="description" id="description" cols="45" rows="5" required>{{$product->description}}</textarea>
                    </div>
                    <input type="submit" value="Save" class="save">
                </div>
            </form>
        </div>
    </div>
@endsection