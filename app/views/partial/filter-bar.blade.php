{{ Form::open() }}
<div class="filter-bar">
	<div class="left">
		<div class="select-box">
			<span class="text">Türe göre filtrele</span>
			<ul>
				<li>Dedikodla</li>
				<li>Etkinlikler</li>
				<li><a href="{{ URL::to('all-photos') }}">Fotoğraflar</a></li>
				<li><a href="{{ URL::to('all-videos') }}">Videolar</a></li>
			</ul>
		</div>
	</div>

	<div class="right">
		<div class="select-box">
			<span class="text">İçeriğe göre filtrele</span>
			<ul>
				<li>{{Link_to_route('home','En yeniler', array('sortby' => 'created_at', 'order' => 'DESC')) }}</li>
				<li>{{Link_to_route('home','En eskiler', array('sortby' => 'created_at', 'order' => 'ASC')) }}</li>
			</ul>
		</div>
	</div>
</div>
{{ Form::close() }}