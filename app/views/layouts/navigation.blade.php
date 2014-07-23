<a href="{{ URL::route('home') }}">Ana Sayfa</a> | 
<a href="{{ URL::route('kantini') }}">Kantini</a> | 
<a href="{{ URL::route('contact.us') }}">Kontak</a> | 
<a href="{{ URL::route('ad') }}">Reklam</a> | 
<a href="{{ URL::route('about.us') }}">Hakkımızda</a> | 
<a href="{{ URL::route('u.dont.know') }}">Bilmedikleriniz</a> 

<br><br>
@if(!Sentry::check())
<a href="{{ URL::route('register') }}">Kayıt</a> | 
<a href="{{ URL::route('login') }}">Giriş</a>
@else
<a href="{{ URL::to('user/profile/'.Sentry::getUser()->username)}}">Profil</a>
<a href="{{ URL::route('logout') }}">Çıkış</a>
@endif
<hr>