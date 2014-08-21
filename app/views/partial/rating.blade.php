<p>
@if(!Up::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
						
	{{ Form::open(['action' => 'RatesController@up']) }}
				
	{{ Form::hidden('post_type', $post->type) }}
	{{ Form::hidden('post_id', $post_id) }}

	{{ Form::submit('Up') }}
	{{ Form::close() }}

@endif

@if(Up::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
				
	{{ Form::open(['action' => 'RatesController@up']) }}
				
	{{ Form::hidden('post_type', $post->type) }}
	{{ Form::hidden('post_id', $post_id) }}

	{{ Form::submit('Up') }}
	{{ Form::close() }}

@endif
</p>
<p>
@if(!Down::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
						
	{{ Form::open(['action' => 'RatesController@down']) }}
				
	{{ Form::hidden('post_type', $post->type) }}
	{{ Form::hidden('post_id', $post_id) }}

	{{ Form::submit('Down') }}
	{{ Form::close() }}

@endif

@if(Down::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
						
	{{ Form::open(['action' => 'RatesController@down']) }}
			
	{{ Form::hidden('post_type', $post->type) }}
	{{ Form::hidden('post_id', $post_id) }}

	{{ Form::submit('Down') }}
	{{ Form::close() }}

@endif
</p>