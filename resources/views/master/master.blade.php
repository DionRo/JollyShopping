<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JollyShopping</title>
    <link rel="stylesheet" href="../css/main.css">
    <meta name="viewport" content="width=device-width"/>
    <script src="../js/jquery.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <meta name="google-site-verification" content="nZjliQF8W3kaZe_OFICzIDElc3G7xaXt50zoiQBBrLM" />
</head>
<body>
<header class="@yield('header-class')">
    <div class="header-top">
        <div class="container flex flex-between align-center">
            <h1 style="display: none">Jollyshopping</h1>
            <a href="/"><img src="{{URL::asset('img/logo.png')}}" alt=""></a>
            <nav>
                <ul class="flex">
                    <li class="flex align-center flex-center red"><a href="/">Home</a></li>
                    <li class="flex align-center flex-center yellow"><a href="/products">Products</a></li>
                    <li class="flex align-center flex-center pink"><a href="/about">About</a></li>
                    <li class="flex align-center flex-center orange"><a href="/contact">Contact</a></li>

                    @if(Auth::Check() == True)
                        @if(Auth::user()->userLevel > 0 )
                            <li class="flex align-center flex-center gray"><a href="/admin">Dashboard</a></li>
                        @else
                            <li class="flex align-center flex-center gray">
                                <a href="{{route('getCart')}}">
                                    <i  style="font-size: 3em; color: white;">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</i>
                                </a>
                            </li>
                        @endif
                        <li class="flex align-center flex-center blue" style="display: flex">
                            <a class="logout" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li style="display: none" class="flex align-center flex-center blue"><a href="/login">Login/Register</a>
                        </li>
                    @else
                        <li class="flex align-center flex-center blue"><a href="/login">Login/Register</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    <nav class="mobile-nav container">
        <ul class="flex flex-between">
            <li><a href="/">Home</a></li>
            <li><a href="/products">Producten</a></li>
            <li><a href="/about">Over</a></li>
            <li><a href="/contact">Contact</a></li>
            @if(Auth::Check() == True)
                @if(Auth::user()->userLevel > 0 )

                    <li><a href="/admin">Dashboard</a></li>
                @endif
                <li style="display: flex">
                    <a class="logout" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                <li style="display: none"><a href="/login">Login/Register</a>
                </li>
            @else
                <li><a href="/login">Login/Register</a></li>
            @endif
        </ul>
    </nav>
</header>

@yield('content')

<footer>
    <div class="container flex flex-column align-center flex-center">
        @if (session('status'))
            <div class="alert alert-success">
                <p>{{ session('status') }}</p>
            </div>
        @endif
        @if(Auth::check() == true && Auth::user()->isSubscribed == null )
            <form class="subscribeForm" method="post" action="{{ action('userController@subscribe')}}">
                {{csrf_field()}}
                <input class="email" type="email" name="email" placeholder="Vul hier uw email in"><br>
                <input class="button-downing" type="submit" value="Meld aan voor de nieuwsbrief">
            </form>
        @endif
        <ul class="flex flex-between">
            <li><a href=""><i class="fab fa-facebook-f" aria-hidden="true" style="color: #EB807D;"></i></a></li>
            <li><a href=""><i class="fab fa-twitter" aria-hidden="true" style="color: #EB807D;"></i></a></li>
            <li><a href=""><i class="fab fa-linkedin-in" aria-hidden="true" style="color: #EB807D;"></i></a></li>
        </ul>
        <div class="copyright">
            <p>Jolly Shopping &copy; 2017 - <a href="https://crucialdesigns.nl" target="_blank">Crucial Designs</a></p>
        </div>
    </div>
</footer>
<script src="../js/dropdown.js"></script>
</body>
</html>