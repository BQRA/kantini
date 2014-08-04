<div class="filter-bar">
	<div class="left">
		<div class="select-box">
			<span class="text">Türe göre filtrele</span>
			<ul>
				@if(isset($_GET['orderBy']))
					<li><a href="{{URL::to(URL::current().'?orderBy='.$_GET['orderBy'].'&type=dedikod')}}">Dedikodlar</a></li>
					<li><a href="{{URL::to(URL::current().'?orderBy='.$_GET['orderBy'].'&type=event')}}">Etkinlikler</a></li>
					<li><a href="{{URL::to(URL::current().'?orderBy='.$_GET['orderBy'].'&type=photo')}}">Fotoğraflar</a></li>
					<li><a href="{{URL::to(URL::current().'?orderBy='.$_GET['orderBy'].'&type=video')}}">Videolar</a></li>
				@else
					<li><a href="{{URL::to(URL::current().'?type=dedikod')}}">Dedikodlar</a></li>
					<li><a href="{{URL::to(URL::current().'?type=event')}}">Etkinlikler</a></li>
					<li><a href="{{URL::to(URL::current().'?type=photo')}}">Fotoğraflar</a></li>
					<li><a href="{{URL::to(URL::current().'?type=video')}}">Videolar</a></li>
				@endif
			</ul>
		</div>
	</div>

	<div class="right">
		<div class="select-box">
			<span class="text">İçeriğe göre filtrele</span>
			<ul>
				@if(isset($_GET['type']))
					<li><a href="{{URL::to(URL::current().'?type='.$_GET['type'].'&orderBy=DESC')}}">En yeniler</a></li>
					<li><a href="{{URL::to(URL::current().'?type='.$_GET['type'].'&orderBy=ASC')}}">En eskiler</a></li>
				@else
					<li><a href="{{URL::to(URL::current().'?orderBy=DESC')}}">En yeniler</a></li>
					<li><a href="{{URL::to(URL::current().'?orderBy=ASC')}}">En eskiler</a></li>
				@endif
			</ul>
		</div>
	</div>
</div>