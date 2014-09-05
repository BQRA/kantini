<div class="toolbar">
	<div class="left">
		@if(!empty($user))
			<a class="username" data-lightbox="{{ URL::action('show.profile', $user->username) }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">
			{{ $dummy->username }}
			</a>
		@else
			<span class="username">{{ $dummy->username }}</span>
		@endif
							
		<span class="date tooltip" data-content="Dedikod detayına git"><a href="{{ URL::action('show.post', $post_id) }}">{{date('d.m.Y',strtotime($dummy->created_at))}}</a></span>
		<div class="select-box custom">
			<div class="text">
				<span class="icon more">&#61703</span>
			</div>
			<ul>
				<li><a href="javascript:;">Facebook'ta Paylas</a></li>
				<li><a href="javascript:;">Twiter'da Paylas</a></li>
				
				<!-- Gönderi Raporlama -->
				{{ Form::open(['action' => ['FlagsController@flag', $post_id]]) }}
				{{ Form::submit() }}
				{{ Form::close() }}
				<!-- Gönderi Raporlama -->

				@if(Auth::check())
					@if(Auth::user()->username == $dummy->username)
					<li><a href="#">Düzenle</a></li>
					<li><a class="danger" href="{{ URL::route('user.delete.dedikod', $dummy->id) }}">Sil</a></li>
					@endif
				@endif
			</ul>
		</div>
	</div>
							
	<div class="right">
		<span class="comment get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post_id }} #giveComments">{{$dummy->comments_count}}</span>
		<!-- <span class="button sm r green get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post_id }} #giveComments">Yorum Yaz</span> -->
		<span class="like">
			{{ Form::open(['action' => ['RatesController@rate', $post_id]]) }}
			{{ Form::hidden('rate', 'up') }}
			@if(Auth::check())
				@if(!Vote::where('post_id', $post_id)->where('value', 'up')->where('rater', Auth::user()->username)->count()>0)	
					<span class="up"><span class="tooltip" data-content="+1">&nbsp;</span></span>
				@elseif(Vote::where('post_id', $post_id)->where('value', 'up')->where('rater', Auth::user()->username)->count()>0)
					<span class="up selected"><span class="tooltip" data-content="+1'inizi kaldırın">&nbsp;</span></span>
				@endif
			@else
				@if(!Vote::where('post_id', $post_id)->where('value', 'up')->where('rater', guest_username())->count()>0)
					<span class="up"><span class="tooltip" data-content="+1">&nbsp;</span></span>
				@elseif(Vote::where('post_id', $post_id)->where('value', 'up')->where('rater', guest_username())->count()>0)
					<span class="up selected"><span class="tooltip" data-content="+1'inizi kaldırın">&nbsp;</span></span>
				@endif
			@endif
			{{ Form::close() }}
			{{ Form::open(['action' => ['RatesController@rate', $post_id]]) }}
			{{ Form::hidden('rate', 'down') }}
			@if(Auth::check())
				@if(!Vote::where('post_id', $post_id)->where('value', 'down')->where('rater', Auth::user()->username)->count()>0)
					<span class="down"><span class="tooltip" data-content="-1">&nbsp;</span></span>
				@elseif(Vote::where('post_id', $post_id)->where('value', 'down')->where('rater', Auth::user()->username)->count()>0)
					<span class="down selected"><span class="tooltip" data-content="-1'inizi kaldırın">&nbsp;</span></span>
				@endif
			@else
				@if(!Vote::where('post_id', $post_id)->where('value', 'down')->where('rater', guest_username())->count()>0)
					<span class="down"><span class="tooltip" data-content="-1">&nbsp;</span></span>
				@elseif(Vote::where('post_id', $post_id)->where('value', 'down')->where('rater', guest_username())->count()>0)
					<span class="down selected"><span class="tooltip" data-content="-1'inizi kaldırın">&nbsp;</span></span>
				@endif
			@endif
			{{ Form::close() }}
			<span class="result">{{$dummy->votes_count}}</span>
		</span>
	</div>
	
</div>