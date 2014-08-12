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
	var padding = ( content == null ) ? null : 'alert'; 
	var title = ( title == undefined ) ? '' : title; 
	$('body').append('<div class="lightbox-bg"><div class="close-button"></div><div class="vertical-helper"></div><div class="lightbox-container"><h2>' + title + '</h2><div class="lightbox-content ' + padding + '">' + content + '</div></div></div>');
	setTimeout(function(){
		$('.lightbox-bg .lightbox-container').addClass('opened');
	}, 1) 
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
		// close selctbox
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

	// open comments
	$('.dedikod .toolbar .button, .dedikod .toolbar .comment').click(function(){
		$(this).parents('.dedikod').addClass('open');
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
			// form masks
			$('.add-event .detail input[name=org_date]').mask('00/00/0000');
			$('.add-event .detail input[name=org_time]').mask('00:00');
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
		$(this).parents('.dedikod').find('.load-comments').load($(this).attr('data-comments'));
	});

	// send dedikod with shift+p
	$('.dedikod-area textarea').on('keypress', function(event) {
		if ( event.shiftKey && event.which == 13 ) {
			$('.dedikod-area .send input').click();
		}
	});

	// ajax likes
	$('.dedikod .toolbar').on('click', '.like:not(.selected)', function(event) {
		var $form = $(this).next('form'), serializedData = $form.serialize();
		var likeNContainer = $(this), likeN = parseInt($(this).text());
        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: serializedData,
            beforeSend: function() {
            	likeNContainer.addClass('loading');
            }
        }).done(function(){
        	likeNContainer.text(likeN+1).addClass('selected liked').removeClass('loading');
            likeNContainer.next('form').attr('action', 'http://localhost:8888/kantini/public/dislike');
        });
	});

	$('.dedikod .toolbar').on('click', '.like.selected', function(event) {
		var $form = $(this).next('form'), serializedData = $form.serialize();
		var likeNContainer = $(this), likeN = parseInt($(this).text());
        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: serializedData,
            beforeSend: function() {
            	likeNContainer.addClass('loading');
            }
        }).done(function(){
        	likeNContainer.text(likeN-1).removeClass('selected liked').removeClass('loading');
            likeNContainer.next('form').attr('action', 'http://localhost:8888/kantini/public/like');
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
		} else if ( $(this).attr('data-type') == 'event' ) {
			$('.dedikod-area .attachment img').attr('src', '/kantini/public/Assets/images/event-attached.png');
		}
		attachImg();
	});

});








































