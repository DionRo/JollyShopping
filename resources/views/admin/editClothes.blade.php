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
            <form class="flex flex-between" action="{{action('clothingController@update', $product->id)}}" method="post">
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
                        <label for="color">Kleur:</label>
                        <select name="color" id="color">
                            @for($i = 0; $i < count($colors); $i++)
                                <option value="{{$colors[$i]}}" @if($product->color == $colors[$i]) selected @endif>{{$colors[$i]}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group flex flex-between align-center">
                        <label for="gender">Man / Vrouw</label>
                        <select name="gender" id="gender">
                            @for($i = 0; $i < count($genders); $i++))
                                <option @if($genders[$i] == $product->gender) selected="selected" @endif value="{{$genders[$i]}}">{{$genders[$i]}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group flex flex-between align-center">
                        <label for="stock">Voorraad</label>
                        <input type="text" name="stock" id="stock" value="{{$product->stock}}" required>
                    </div>
                </div>
                <div>
                    <div class="sizes">
                        <h5>Maten</h5>
                        <div class="form-group flex align-center">
                            <label for="sizeS">S</label>
                            <input type="checkbox" id="sizeS" name="sizeS" @if(isset($sizeS[0])) checked @endif>
                        </div>
                        <div class="form-group flex align-center">
                            <label for="sizeM">M</label>
                            <input type="checkbox" id="sizeM" name="sizeM" @if(isset($sizeM[0])) checked @endif>
                        </div>
                        <div class="form-group flex align-center">
                            <label for="sizeL">L</label>
                            <input type="checkbox" id="sizeL" name="sizeL" @if(isset($sizeL[0])) checked @endif>
                        </div>
                        <div class="form-group flex align-center">
                            <label for="sizeXL">XL</label>
                            <input type="checkbox" id="sizeXL" name="sizeXL" @if(isset($sizeXL[0])) checked @endif>
                        </div>
                    </div>
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