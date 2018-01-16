@extends('master/master')

@section('content')
<div class="main-content contact">
    <div class="container flex flex-between">
        <div>
            <h2>Contact</h2>
            <ul>
                <li>Telefoon: +31 6 51 37 29 51 <li>
                <li>Email: info@jollyshopping.nl </li>
                <li>Straat + Huisnummer: Oosterhoutseweg 43</li>
                <li>Postcode: 4847 TB, Teteringen</li>
            </ul>
            <h3>Openingstijden</h3>
            <ul>
                <li>Maandag: Op afspraak</li>
                <li>Dinsdag: Op afspraak</li>
                <li>Woensdag: 11:00 tot 18:00</li>
                <li>Donderdag: 11:00 tot 21:00</li>
                <li>Vrijdag: Op afspraak </li>
                <li>Zaterdag: Op afspraak </li>
                <li>Zondag: Op afspraak </li>
                <li>Check ook onze facebook, voor actuele openingstijden</li>
            </ul>
        </div>
        <form class="flex flex-column" method="post" action="/sendmail">
            {{csrf_field()}}
            <input class="contact-input" type="text" placeholder="Naam: *" id="name" name="name" required>
            <input class="contact-input" type="email" placeholder="Email: *" id="email" name="email" required>
            <input class="contact-input" type="text" placeholder="Telefoon:" id="phone" name="phonenumb" required>
            <input class="contact-input" type="text" placeholder="Subject: *" id="subject" name="subject">
            <textarea placeholder="Bericht: *" id="message" name="text" required></textarea>
            <input type="submit" id="submit" value="Verzend" required>
        </form>
    </div>
</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2478.069616100266!2d4.813477815592018!3d51.603613011485216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c69f404e9d7a33%3A0x7d7bee5dedd64064!2sOosterhoutseweg+43%2C+4847+TB+Teteringen!5e0!3m2!1snl!2snl!4v1512927922825" allowfullscreen></iframe>
@endsection