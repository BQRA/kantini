<div class="toolbar">
	<div class="left">
		@if(!empty($user))
			<a class="username" data-lightbox="{{ URL::action('show.profile', $user->username) }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">
			{{ $dummy->username }}
			</a>
		@else
			<span class="username">{{ $dummy->username }}</span>
		@endif
							
		<span class="date tooltip" data-content="Dedikod detayına git"><a href="{{ URL::action('show.post', $post_id) }}">{{date('d.m.Y H:m',strtotime($dummy->created_at))}}</a></span>
		<div class="select-box custom">
			<div class="text">
				<span class="icon more">&#61703</span>
			</div>
			<ul>
				<li><a href="javascript:;">Facebook'ta Paylas</a></li>
				<li><a href="javascript:;">Twiter'da Paylas</a></li>
				
				@if(Auth::check())
					@if(!Flag::where('post_id', $dummy->id)->where('user_id', Auth::user()->id)->count()>0)
						{{ Form::open(['action' => ['FlagsController@flag', $post_id]]) }}
						<li class="post-flag"><a href="javascript:;">Bu Gönderiyi Raporla</a></li>
						{{ Form::close() }}
					@endif
				@else 
					<li data-lightbox="{{ URL::action('home') }}/authorization #authorization"><a href="javascript:void(0);">Bu Gönderiyi Raporla</a></li>
				@endif
				
				@if(Auth::check())
					@if(Auth::user()->username == $dummy->username)
						<li class="hr"></li>
						<li class="edit-dedikod"><a href="javascript:;">Düzenle</a></li>
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