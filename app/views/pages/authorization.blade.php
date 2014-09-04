@extends('layouts.master')

@section('content')

<div id="authorization">
	<div class="text-center">
		<img src="{{ URL::route('home') }}/Assets/images/logo-b.png" alt="Kantini Logo">
	
		<div class="clearfix mt30"></div>

		<h2><div class="icon">&#61756</div> &nbsp;&nbsp; Bu işlem üyelik gerektiriyor</h2>
		<p>
			Kantini.com’u, size geçici olarak verdiğimiz kullanıcı adıyla kulanmaya devam 
			edebilirsiniz. Ancak bu ve bunun gibi karşınıza çıkacak olan diğer 
			özellikleri kullanabilmeniz için üye olmanız veya giriş yapmanız gerekmektedir. 
			<br><br>
			Şimdi üye olup veya giriş yapıp bu özellikleri kullanmaya 
			başlayabilirsiniz. <br>
			<b>İyi Eğlenceler!</b>
		</p>

		<div class="clearfix mt50"></div>

		<a href="{{ URL::route('user.register') }}" class="button green">KAYIT OL</a> &nbsp;&nbsp;
		<a href="javascript:closeLightbox();" class="button blue">GİRİŞ YAP</a> 
	</div>
</div>

@stop