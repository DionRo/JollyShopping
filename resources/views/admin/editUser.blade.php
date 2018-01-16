@extends('/admin/master/master')

@section('content')
    <div class="edit">
        <h4>{{$user->firstname}} {{$user->lastname}}</h4>
        <div class="form">
            <form action="{{action('userController@update', $user->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="form-group flex flex-between">
                    <label for="firstname">Voornaam: </label>
                    <input type="text" value="{{$user->firstname}}" id="firstname" name="firstname">
                </div>
                <div class="form-group flex flex-between">
                    <label for="lastname">Achternaam: </label>
                    <input type="text" value="{{$user->lastname}}" id="lastname" name="lastname">
                </div>
                <div class="form-group flex flex-between">
                    <label for="gender">Geslacht:</label>
                    <select name="gender" id="gender">
                        @for($i = 0; $i < count($genders); $i++)
                            <option @if($user->gender == $genders[$i]) selected="selected" @endif value="{{$genders[$i]}}">{{$genders[$i]}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group flex  flex-between">
                    <label for="userLevel">Gebruiker Type:</label>
                        <select name="userLevel" id="userLevel">
                            <option @if($user->userLevel == 0) selected="selected" @endif value="0">Klant</option>
                            <option @if($user->userLevel == 1) selected="selected" @endif value="1">Werknemer</option>
                            <option @if($user->userLevel == 2) selected="selected" @endif value="2">Beheerder</option>
                            <option @if($user->userLevel == 3) selected="selected" @endif value="3">Eigenaar</option>
                        </select>
                </div>
                <input type="submit" value="Save" class="save">
            </form>
            <form action="{{action('userController@destroy', $user->id)}}" method="post">
                 {{csrf_field()}}
                {{method_field('delete')}}
                <input type="submit" value="Verwijder" class="delete">
            </form>
        </div>
    </div>
@endsection