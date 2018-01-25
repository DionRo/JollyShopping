<body style="background: url({{asset('img/bg.png')}}); padding: 10px 50px 10px 50px">
<h1>OPGELET! {{$newsletter->title}}</h1>

<p>{{$newsletter->description}}</p>

<p>Klik op de PDF om onze weekelijkse aanbiedingen te zien.
    <br>Moeite met het openen van de PDF? download dan <a href="https://get.adobe.com/nl/reader/">Acrobat Reader</a></p>

<p><b>Veel kijk plezier!</b><br>
    Met Vriendelijke groet,<br>
    Team JollyShopping</p>
<p>Wilt u lever geen nieuwsbrieven meer ontvangen klik dan <a href="https://jollyshopping.nl/unsubscribe/{{$user->email}}/{{$user->id}}">hier</a></p>
</body>
