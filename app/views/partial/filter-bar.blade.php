<div class="filter-bar">
@if(Route::currentRouteName() == 'show.users.all.posts' || Route::currentRouteName() == 'home')
	<div class="left">
		<div class="select-box">
			<span class="text">Türe göre filtrele</span>
			<ul>
				<li><a href="{{URL::to(URL::current().'?sort=dedikods')}}">Dedikodlar</a></li>
				<li><a href="{{URL::to(URL::current().'?sort=organizations')}}">Etkinlikler</a></li>
				<li><a href="{{URL::to(URL::current().'?sort=photos')}}">Fotoğraflar</a></li>
				<li><a href="{{URL::to(URL::current().'?sort=videos')}}">Videolar</a></li>
			</ul>
		</div>
	</div>
@endif

	<div class="right">
		<div class="select-box">
			<span class="text">İçeriğe göre filtrele</span>
			<ul>
				<li><a href="{{URL::to(URL::current().'?orderBy=DESC')}}">En yeniler</a></li>
				<li><a href="{{URL::to(URL::current().'?orderBy=ASC')}}">En eskiler</a></li>
			</ul>
		</div>
	</div>
</div>