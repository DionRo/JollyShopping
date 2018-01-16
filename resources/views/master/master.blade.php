<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JollyShopping</title>
    <link rel="stylesheet" href="../css/main.css">
    <meta name="viewport" content="width=device-width"/>
    <script src="../js/jquery.js"></script>
    <script src="https://use.fontawesome.com/3571e1e4e4.js"></script>
    <meta name="google-site-verification" content="nZjliQF8W3kaZe_OFICzIDElc3G7xaXt50zoiQBBrLM" />
    
    <style>
        @if(Auth::check() == true && Auth::user()->userLevel > 0)
        .header-top nav ul {
            width: 650px;
            height: 120px;
            position: relative;
        }

        .header-top nav li {
            height: 120px;
            width: 120px;
            border-radius: 100%;
            position: absolute;
        }

        .header-top .red {
            background: rgba(200, 0, 0, 0.7);
            left: 0;
        }

        .header-top .yellow {
            background: rgba(255, 180, 0, 0.7);
            left: 105px;
        }

        .header-top .pink {
            background: rgba(216, 62, 123, 0.7);
            left: 210px;
        }

        .header-top .orange {
            background: rgba(255, 116, 0, 0.7);
            right: 215px;
        }

        .header-top .blue {
            background: rgba(11, 80, 135, 0.7);
            right: 110px;
        }

        .header-top .gray {
            background: rgba(221, 221, 221, 1);
            right: 0px;
        }

        @else
        .header-top nav ul {
            width: 540px;
            height: 120px;
            position: relative;
        }

        .header-top nav li {
            height: 120px;
            width: 120px;
            border-radius: 100%;
            position: absolute;
        }

        .header-top .red {
            background: rgba(200, 0, 0, 0.7);
            left: 0;
        }

        .header-top .yellow {
            background: rgba(255, 180, 0, 0.7);
            left: 105px;
        }

        .header-top .pink {
            background: rgba(216, 62, 123, 0.7);
            left: 210px;
        }

        .header-top .orange {
            background: rgba(255, 116, 0, 0.7);
            right: 105px;
        }

        .header-top .blue {
            background: rgba(11, 80, 135, 0.7);
            right: 0px;
        }

        .header-top .gray {
            background: rgba(221, 221, 221, 0.7);
            right: 0px;
        }
        @endif

    </style>

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
        <ul class="flex flex-between">
            <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
        </ul>
        <div class="copyright">
            <p>Jolly Shopping &copy; 2017 - <a href="https://crucialdesigns.nl" target="_blank">Crucial Designs</a></p>
        </div>
    </div>
</footer>
<script src="../js/dropdown.js"></script>
</body>
</html>