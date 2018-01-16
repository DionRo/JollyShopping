<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/3571e1e4e4.js"></script>
    <title>Admin panel</title>
</head>
<body>
<div class="admin flex">
    <header>
        <div class="title">
            <h1>Jollyshopping</h1>
            <div class="container">
            <h2>Welkom,</h2>
            <h2>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h2>
            <p>{{Auth::user()->rank}}</p>
            </div>
        </div>
        <div class="navigation">
            <h3>Navigation</h3>
            <ul class="container">
                <li class="nav-home"><a href="/admin">Home</a></li>
                <li><a href="/admin/clothing">Overzicht kleding</a></li>
                <li><a href="/admin/accessories">Overzicht accessoires</a></li>
                <li><a href="{{action('clothingController@create')}}">Kleding toevoegen</a></li>
                <li><a href="{{action('accessoriesController@create')}}">Accessoire toevoegen</a></li>
                <li><a href="/admin/users">Overzicht gebruikers</a></li>
            </ul>
        </div>
        <div class="logout align-center">
            <form action="{{action('pagesController@index')}}">
                {{csrf_field()}}
                <input type="submit" value="Home">
            </form>
        </div>
    </header>
    <div class="main-content">
        <div class="container">

            @yield('content')

        </div>
    </div>

</div>
</body>
</html>