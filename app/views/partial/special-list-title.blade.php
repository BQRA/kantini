<div class="special-list-title">
	<span><a href="javascript:;" data-lightbox="{{ URL::action('show.profile', $user->username) }} #profileBox" data-lightboxtitle="Profil Kartı">{{ $user->username }}</a> kullanıcısının</span>
	<div class="select-box">
		<span class="text"> @yield('select-box-selected') </span>
		<ul>
			<li><a href="{{ URL::to('user/profile/'.$user->username).'/all-posts' }}">yazdığı</a></li>
			<li><a href="{{ URL::to('user/profile/'.$user->username).'/all-comments' }}">yorum yaptığı</a></li>
			<li><a href="{{ URL::to('user/profile/'.$user->username).'/all-likes' }}">beğendiği</a></li>
		</ul>
	</div>
	<span>gönderiler listeleniyor</span>
</div>