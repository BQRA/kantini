{{ Form::open(['action' => 'RatesController@rate']) }}
<p>
@if(!Up::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)	
				
	{{ Form::hidden('post_type', $post->type) }}
	{{ Form::hidden('post_id', $post_id) }}
	{{ Form::hidden('rate', 'up') }}

	{{ Form::submit('Up') }}

@elseif(Up::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
	
	{{ Form::hidden('post_type', $post->type) }}
	{{ Form::hidden('post_id', $post_id) }}
	{{ Form::hidden('rate', 'up') }}

	{{ Form::submit('Up') }}

@endif
{{Form::close()}}
</p>

{{ Form::open(['action' => 'RatesController@rate']) }}
<p>
@if(!Down::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
						
				
	{{ Form::hidden('post_type', $post->type) }}
	{{ Form::hidden('post_id', $post_id) }}
	{{ Form::hidden('rate', 'down') }}

	{{ Form::submit('Down') }}


@elseif(Down::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
		
	{{ Form::hidden('post_type', $post->type) }}
	{{ Form::hidden('post_id', $post_id) }}
	{{ Form::hidden('rate', 'down') }}

	{{ Form::submit('Down') }}

@endif
</p>
{{ Form::close() }}