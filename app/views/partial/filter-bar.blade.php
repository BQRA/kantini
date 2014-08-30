<div class="filter-bar">
	<div class="left">
		<div class="select-box">
			<span class="text">Türe göre filtrele</span>
			<ul>

			@if(Input::has('q'))
				@if(Input::has('orderBy'))
					<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&orderBy='.$_GET['orderBy'].'&type=dedikod')}}">Dedikodlar</a></li>
					<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&orderBy='.$_GET['orderBy'].'&type=event')}}">Etkinlikler</a></li>
					<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&orderBy='.$_GET['orderBy'].'&type=image')}}">Fotoğraflar</a></li>
					<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&orderBy='.$_GET['orderBy'].'&type=video')}}">Videolar</a></li>
				@else
					<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&type=dedikod')}}">Dedikodlar</a></li>
					<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&type=event')}}">Etkinlikler</a></li>
					<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&type=image')}}">Fotoğraflar</a></li>
					<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&type=video')}}">Videolar</a></li>
				@endif
			@else
				@if(Input::has('orderBy'))
					<li><a href="{{URL::to(URL::current().'?orderBy='.$_GET['orderBy'].'&type=dedikod')}}">Dedikodlar</a></li>
					<li><a href="{{URL::to(URL::current().'?orderBy='.$_GET['orderBy'].'&type=event')}}">Etkinlikler</a></li>
					<li><a href="{{URL::to(URL::current().'?orderBy='.$_GET['orderBy'].'&type=image')}}">Fotoğraflar</a></li>
					<li><a href="{{URL::to(URL::current().'?orderBy='.$_GET['orderBy'].'&type=video')}}">Videolar</a></li>
				@else
					<li><a href="{{URL::to(URL::current().'?type=dedikod')}}">Dediksdasd asdas dsaodlar</a></li>
					<li><a href="{{URL::to(URL::current().'?type=event')}}">Etkinlikler</a></li>
					<li><a href="{{URL::to(URL::current().'?type=image')}}">Fotoğraflar</a></li>
					<li><a href="{{URL::to(URL::current().'?type=video')}}">Videolar</a></li>
				@endif
			@endif
			</ul>
		</div>
	</div>

	<div class="right">
		<div class="select-box">
			<span class="text">İçeriğe göre filtrele</span>
			<ul>
				@if(Input::has('q'))
					@if(Input::has('type'))
						<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&type='.$_GET['type'].'&orderBy=DESC')}}">En yeniler</a></li>
						<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&type='.$_GET['type'].'&orderBy=ASC')}}">En eskiler</a></li>
					@else
						<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&orderBy=DESC')}}">En yeniler</a></li>
						<li><a href="{{URL::to(URL::current().'?q='.$_GET['q'].'&orderBy=ASC')}}">En eskiler</a></li>
					@endif
				@else
					@if(Input::has('type'))
						<li><a href="{{URL::to(URL::current().'?type='.$_GET['type'].'&orderBy=DESC')}}">En yeniler</a></li>
						<li><a href="{{URL::to(URL::current().'?type='.$_GET['type'].'&orderBy=ASC')}}">En eskiler</a></li>
					@else
						<li><a href="{{URL::to(URL::current().'?orderBy=DESC')}}">En yeniler</a></li>
						<li><a href="{{URL::to(URL::current().'?orderBy=ASC')}}">En eskiler</a></li>
					@endif
				@endif
			</ul>
		</div>
	</div>
</div>