// READY
jQuery(document).ready(function($) {

	// session message
	if ( $('.session-message').length > 0 ) {
		setTimeout(function(){
			$('.session-message').fadeOut('200');
		}, 5000)
	}

	// tag creator 
	$('.dedikod').each(function() {
		var str = $(this).find('.content').html(), regex = /(?:\s|^)(?:#(?!\d+(?:\s|$)))(\w+)(?=\s|$)/gi;
		function replacer(hash){
			var replacementString = $.trim(hash);
			return ' <a href="/kantini/public/search?q='+ replacementString.substr(1) +'" class="highlight">' + replacementString + '</a>';
		}
		$(this).find('.content').html( str.replace( regex , replacer ) );
	});

});


///////////////////////////////////////////////////
// GLOBAL FUNTIONS
///////////////////////////////////////////////////

// HTML5 image preview for upload
function previewImage(input) {
	var preview = document.getElementById('htmlImageApi');
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			preview.setAttribute('src', e.target.result);
			document.getElementById('event-image').value = e.target.result;
		}
		reader.readAsDataURL(input.files[0]);
	} else {
		preview.setAttribute('src', 'Assets/images/select-image.png');
	}
}

// get video url with regex
function videoId(data) {
    data.match(/http:\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be))\/(video\/|embed\/|watch\?v=)?([A-Za-z0-9._%-]*)(\&\S+)?/);
    return {
        url: RegExp.$2,
        id: RegExp.$5,
        site: RegExp.$2 == 'youtube.com' || RegExp.$2 == 'youtu.be' ? 'http://www.youtube-nocookie.com/embed/' : 'http://player.vimeo.com/video/',
        name: RegExp.$2 == 'youtube.com' || RegExp.$2 == 'youtu.be' ? 'youtube' : RegExp.$2 == 'vimeo.com' ? 'vimeo' : null
    }
}

// lightbox function
function alert(content, title) {
	var padding = ( content == null ) ? '' : 'alert'; 
	var title = ( title == undefined ) ? '' : title;
	$('body').append('<div class="lightbox-bg"><div class="close-button"></div><div class="vertical-helper"></div><div class="lightbox-loading"></div><div class="lightbox-container"><h2>' + title + '</h2><div class="lightbox-content ' + padding + '">' + content + '</div></div></div>');
	if ( content != null ) {
		setTimeout(function(){
			$('.lightbox-loading').remove();
			$('.lightbox-bg .lightbox-container').addClass('opened');
		}, 1) 
	}
}

// input mask in lightbox
function lbMask() {
	$('.add-event .detail input[name=event_date]').mask('00/00/0000');
	$('.add-event .detail input[name=event_time]').mask('00:00');
}

// lightbox opened effect
function lbOpened() {
	$('.lightbox-loading').remove();
	$('.lightbox-bg .lightbox-container').addClass('opened');
}

// close lightbox function 
function closeLightbox() {
	$('.lightbox-bg .lightbox-container').removeClass('opened');
	setTimeout(function(){
		$('.lightbox-bg').remove();
	}, 200)
}

// attachment image resize
function attachImg() {
	$('.dedikod-area .attachment img').each(function(index, el) {
		if ( $(this).height() < 55 ) {
			$(this).css({'height':'55px','width':'auto'});
		} else if ( $(this).width() < 55 ) {
			$(this).css({'width':'55px','height':'auto'});
		}
	});
}

///////////////////////////////////////////////////
// GLOBAL FUNTIONS #END
///////////////////////////////////////////////////


$(function () {

	// global close
	$('body').click(function(event) {
		// close selectbox
		$('.select-box ul').hide(0);

		//close lightbox
		closeLightbox();
	});

	// esc press down
	$(document).on('keydown', function(event){
		if ( event.which == 27 ) {
			closeLightbox();
		}
	});

	// selectbox
	$('.select-box').click(function(event) {
		event.stopPropagation();
		$(this).find('ul').show(0);
	});
	$('.select-box ul li').on('click', function(event){
		$(this).parents('.select-box').find('.text').text($(this).text());
		event.stopPropagation();
		$(this).parents('ul').hide(0);
	});

	// load content from different file
	$('body').on('click', '[data-lightbox]', function(event) {
		event.stopPropagation();
		alert(null, $(this).attr('data-lightboxtitle'));
		$('.lightbox-bg .lightbox-content').load($(this).attr('data-lightbox'), function(){
			lbOpened();
			lbMask();
		});
	});
	// close lightboxes
	$('body').on('click', '.lightbox-content', function(event) {
		event.stopPropagation();
	});
	$(document).on('click', '.lightbox-bg .close-button', function(event) {
		closeLightbox();
	});

	// gender selet
	$('.bottom-bar .gender').click(function(event) {
		$('.dedikod-area input[name=gender]').val($(this).attr('name'));
		$('.bottom-bar .gender').removeClass('selected');
		$(this).addClass('selected');
	});

	// get comments
	$('.dedikod .toolbar .get-comments').click(function() {
		$(this).parents('.dedikod').find('.load-comments').addClass('opened');
		$(this).parents('.dedikod').addClass('open').find('.load-comments').load($(this).attr('data-comments'));
	});

	// send dedikod with shift+p
	$('.dedikod-area textarea').on('keypress', function(event) {
		if ( event.shiftKey && event.which == 13 ) {
			$('.dedikod-area .send input').click();
		}
	});

	// ajax likes
	var ajax = null;
	$('.dedikod .toolbar').on('click', '.like .up, .like .down', function(event) {
		var $form = $(this).parents('form'), serializedData = $form.serialize();
		var likeNContainer = $(this).parents('.like').find('.result'), likeN = parseInt($(this).parents('.like').find('.result').text());

		var up = $(this).parents('.like').find('.up'), down = $(this).parents('.like').find('.down'), trans, way;
		if ( $(this).attr('class') == 'up' && down.attr('class') == 'down selected' ) {
			trans = likeN+2, way = '.up';
		} else if ( $(this).attr('class') == 'up' ) {
			trans = likeN+1, way = '.up';
		} else if ( $(this).attr('class') == 'up selected' ) {
			trans = likeN-1, way = null;
		} else if ( $(this).attr('class') == 'down' && up.attr('class') == 'up selected' ) {
			trans = likeN-2, way = '.down';
		} else if ( $(this).attr('class') == 'down' ) {
			trans = likeN-1, way = '.down';
		} else if ( $(this).attr('class') == 'down selected' ) {
			trans = likeN+1, way = null;
		}

		if( ajax ) { return false; }
        ajax = $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: serializedData,
            beforeSend: function() {
            	likeNContainer.parents('.like').find('.selected').removeClass('selected');
            	likeNContainer.addClass('loading').parents('.like').find(way).addClass('selected');
            }
        }).done(function(){
        	likeNContainer.text(trans).addClass('liked').removeClass('loading');
        	ajax = null;
        });
	});

	// event image 
	$('.dedikod .pic-upload').on('click', function(event) {
		event.stopPropagation();
		alert($(this).html());
	});

	// Dedikod Attachment
	$('body').on('click', '#addAttachment', function(event) {
		$('.dedikod-attachment-infos *').remove();
		$(this).parents('.lightbox-content').clone().appendTo('.dedikod-attachment-infos');
		closeLightbox();
		$('.dedikod-area .no-attachment').hide();
		$('.dedikod-area .textarea-container').addClass('added');
		if ( $(this).attr('data-type') == 'media' ) {
			var videoObj = videoId($('#mediaUrl').val());
			if ( videoObj.name == 'youtube' ) {
				$('input[name=post_type]').attr('value', 'video');
				$('.dedikod-area .attachment img').attr('src', 'http://img.youtube.com/vi/' + videoObj.id + '/default.jpg');
				$('#mediaUrl').val(videoObj.site + videoObj.id);
			} else if ( videoObj.name == 'vimeo' ) {
				$('input[name=post_type]').attr('value', 'video');
				$.get('http://vimeo.com/api/v2/video/' + videoObj.id + '.json', function(data) {
					$('.dedikod-area .attachment img').attr('src', data[0].thumbnail_large);
		        });
				$('#mediaUrl').val(videoObj.site + videoObj.id);
			} else {
				$('input[name=post_type]').attr('value', 'image');
				$('.dedikod-area .attachment img').attr('src', $('#mediaUrl').val());
			}
			$('.dedikod-area .media-attached').show();
			$('#addMedia .tab').remove();
			$('#addMedia .tab-content-item:not(.selected)').remove();
		} else if ( $(this).attr('data-type') == 'event' ) {
			$('.dedikod-area .event-attached').show();
			$('.dedikod-area .attachment img').attr('src', '/kantini/public/Assets/images/event-attached.png');
		}
		attachImg();
	});
	// Edit Attachment
	$('body').on('click', '[data-edit]', function(event) {
		event.stopPropagation();
		alert(null, $(this).attr('data-lightboxtitle'));
		$('.lightbox-container .lightbox-content').html('');
		$('.dedikod-attachment-infos .lightbox-content > *').clone().appendTo('.lightbox-container .lightbox-content');
		lbOpened();
		lbMask();
	});
	// Delete Attachment
	$('body').on('click', '.attachment .del-attach .icon', function(event) {
		$('.dedikod-attachment-infos').html('');
		$('.dedikod-area .no-attachment').show();
		$('.dedikod-area .attached').hide();
		$('.dedikod-area .textarea-container').removeClass('added');
	});



	// tab
	$('body').on('click', '.tab .item', function(event) {
		$(this).parents('.tab').find('.item').removeClass('selected');
		$(this).addClass('selected');
		$(this).parents('.tab').next('.tab-content').find('.tab-content-item').removeClass('selected');
		$(this).parents('.tab').next('.tab-content').find('.tab-content-item').eq($(this).index()).addClass('selected');
	});

});








































