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
			return ' <a href="/kantini/public/search?q=%23'+ replacementString.substr(1) +'" class="highlight">' + replacementString + '</a>';
		}
		$(this).find('.content').html( str.replace( regex , replacer ) );
	});

});


///////////////////////////////////////////////////
// GLOBAL FUNTIONS
///////////////////////////////////////////////////

// validator function
var validator = function (a) {
    var errors = 0;
    a.parents('.req').find('[data-valid=required]').map(function(){
         if( $(this).val() == '' || $(this).val() == $(this).attr('data-select') || $(this).val() == null ) {
              $(this).parent().addClass('not-valid').find('span.validation-msg').remove();
              $(this).parent().append( $(document.createElement('span')).addClass('validation-msg tooltip').attr( 'data-content', $(this).attr('data-message') ).html('<span class="icon">&#61730</span>') );
              $(this).parents('form').addClass('not-valid');
              errors++;
        } else if ( $(this).val() != '' ) {
              $(this).parent().removeClass('not-valid').find('span.validation-msg').remove();
              $(this).parents('form').removeClass('not-valid');
        }   
    });
    if ( errors > 0 ) {
    	if ( a[0].tagName == 'BUTTON' || a[0].tagName == 'FORM' ) {
    		return false;
    	} else {
    		stopImmediatePropagation();
    		return false;
    	}
    }
}

// HTML5 image preview for upload
function previewImage(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('form.image-upload input[name=image]').val(e.target.result);
			var $form = $('form.image-upload'), serializedData = $form.serialize();
			$.ajax({
				url: $form.attr('action'),
				type: 'POST',
				cache: false,
				data: serializedData,
				beforeSend: function(){
					$(input).prev('img').remove();
					$(input).before('<div class="loading"/>');
				}
			}).done(function(e) { 
				$('form.image-upload input[name=data-imagetype]').val($(input).data('imagetype'));
				$(input).prev('img').remove();
				$(input).prev('.loading');
				$(input).before(e);
				$(input).parents('.add-event').find('.event-bg-image').html(e);
			});
			
		}
		reader.readAsDataURL(input.files[0]);
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
	$('body').addClass('no-scroll').append('<div class="lightbox-bg"><div class="close-button"></div><div class="vertical-helper"></div><div class="lightbox-loading"></div><div class="lightbox-container"><h2>' + title + '</h2><div class="lightbox-content ' + padding + '">' + content + '</div></div></div>');
	if ( content != null ) {
		setTimeout(function(){
			$('.lightbox-loading').remove();
			$('.lightbox-bg .lightbox-container').addClass('opened');
		}, 1) 
	}
}

// input mask in lightbox
function lbMask() {
	$('.add-event .detail input[name=event_date]').mask('00.00.0000');
	$('.add-event .detail input[name=event_time]').mask('00:00');
}

// lightbox opened effect
function lbOpened() {
	$('.lightbox-loading').remove();
	$('.lightbox-bg .lightbox-container').addClass('opened');
}

// close lightbox function 
function closeLightbox() {
	$('body').removeClass('no-scroll');
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

// notifications delete after 3 sec
function delNotif() {
	if ( $('.notification.info').length > 0 ) {
		setTimeout(function(){
			$('.notification.info').hide(0);
		}, 3000)
	}
}

///////////////////////////////////////////////////
// GLOBAL FUNTIONS #END
///////////////////////////////////////////////////

var ajax = null;

$(function () {

	// validator action
	$('body').on('submit', 'form', function(event) {
		return validator($(this));
	});
	$('body').on('click', '[data-validator]', function(event) {
        return validator($(this));
    }); 

	// global close
	$('body').click(function(event) {
		// close selectbox
		$('.select-box ul').hide(0).parents('.select-box').removeClass('opened');


		//close lightbox
		closeLightbox();
	});

	// esc press down
	$(document).on('keydown', function(event){
		if ( event.which == 27 ) {
			closeLightbox();
		}
	});

	// notif delete
	delNotif();

	// selectbox
	$('.select-box:not(.opened) .text').click(function(event) {
		event.stopPropagation();
		$('.select-box ul').hide(0).parents('.select-box').removeClass('opened');
		$(this).parent().addClass('opened').find('ul').show(0);
	});
	$('.select-box ul li').on('click', function(event){
		$(this).parents('ul').hide(0).parents('.select-box').removeClass('opened');
	});
	$('.select-box:not(.custom) ul li').on('click', function(event){
		$(this).parents('.select-box').find('.text').text($(this).text());
		event.stopPropagation();
		$(this).parents('ul').hide(0).parents('.select-box').removeClass('opened');
	});

	// load content from different file
	$('body').on('click', '[data-lightbox]', function(event) {
		event.stopPropagation();
		alert(null, $(this).attr('data-lightboxtitle'));
		$('.lightbox-bg .lightbox-content').load($(this).attr('data-lightbox'), function(){
			lbOpened();
			lbMask();
			$('.lightbox-content input[type=text]:eq(0)').trigger('focus');
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
	$('.dedikod .toolbar').on('click', '.like .up, .like .down', function(event) {
		var that = $(this), $form = that.parents('form'), serializedData = $form.serialize();
		var likeNContainer = that.parents('.like').find('.result'), likeN = parseInt(that.parents('.like').find('.result').text());

		var up = that.parents('.like').find('.up'), down = that.parents('.like').find('.down'), trans, way, dataC, dataC_;
		if ( that.attr('class') == 'up' && down.attr('class') == 'down selected' ) {
			trans = likeN+2, way = '.up', dataC = "+1'inizi kaldırın", dataC_ = '-1';
		} else if ( that.attr('class') == 'up' ) {
			trans = likeN+1, way = '.up', dataC = "+1'inizi kaldırın";
		} else if ( that.attr('class') == 'up selected' ) {
			trans = likeN-1, way = null, dataC = "+1";
		} else if ( that.attr('class') == 'down' && up.attr('class') == 'up selected' ) {
			trans = likeN-2, way = '.down', dataC = "-1'inizi kaldırın", dataC_ = '+1';
		} else if ( that.attr('class') == 'down' ) {
			trans = likeN-1, way = '.down', dataC = "-1'inizi kaldırın";
		} else if ( that.attr('class') == 'down selected' ) {
			trans = likeN+1, way = null, dataC = "-1";
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
        	that.find('.tooltip').data('content', dataC);
        	$form.next('form').find('.tooltip').data('content', dataC_);
        	$form.prev('form').find('.tooltip').data('content', dataC_);
        	ajax = null;
        });
	});

	// event image 
	$('.dedikod .pic-upload').on('click', function(event) {
		event.stopPropagation();
		alert($(this).html());
	});

	// Dedikod Attachment
	$('body').on('keypress', '#addMedia input, #addEvent input', function(e) {
		if ( e.which == 13 ) {
			$(this).parents('.lightbox-content').find('#addAttachment').click();
		}
	});
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

	// ajax comment
	$('body').on('submit', '.dedikod .write-area form', function(event) {
		event.preventDefault();
		if ( $(this).find('[data-valid]').val().length < 5 ) {
			return false;
		} else {
			var $form = $(this), serializedData = $form.serialize(), writeA = $form.parents('.write-comment');
			$.ajax({
				url: $form.attr('action'),
				type: 'POST',
				cache: false,
				data: serializedData,
				beforeSend: function() {
					console.log('gonderiliyor... ')
				}
			})
			.done(function(e) {
				writeA.parents('.comments').find('.no-comment').remove();
				writeA.after('<div class="comment"><div class="avatar"><img src="' + writeA.find('.avatar img').attr('src') + '" alt="" /></div>' + $form.find('.ajax-comment-values').html() + '</div>');
				writeA.next('.comment').find('.comment-content').html(writeA.find('input[name=comment]').val());
				writeA.next('.comment').find('.date').text(e);
				writeA.find('input[name=comment]').val('');
				writeA.parents('.dedikod').find('.right .comment').text(parseInt( writeA.parents('.dedikod').find('.right .comment').text() ) + 1);
			});
		}
	})
	
	// tooltip
	$('body').on('mouseover', '.tooltip', function(event) {
		$(this).prepend('<span class="tooltip-content"><span>' + $(this).data('content') + '</span></span>');
	});
	$('body').on('mouseout', '.tooltip', function(event) {
		$('.tooltip-content').remove();
	});

	// tab
	$('body').on('click', '.tab .item', function(event) {
		$(this).parents('.tab').find('.item').removeClass('selected');
		$(this).addClass('selected');
		$(this).parents('.tab').next('.tab-content').find('.tab-content-item').removeClass('selected');
		$(this).parents('.tab').next('.tab-content').find('.tab-content-item').eq($(this).index()).addClass('selected');
	});

	// post report
	$('.post-flag a').click(function(event) {
		var $form = $(this).parents('form');
		$.ajax({
			url: $form.attr('action'),
			type: 'POST',
			data: $form.serialize(),
			beforeSend: function(){
				$form.parents('.dedikod').addClass('reported').prepend('<span class="reporting">Rapor Ediliyor...</span>');
			}
		}).done(function() {
			$form.parents('.dedikod').find('span.reporting').text('Raporlandı');
		});		
	});

	// edit dedikod
	$('.edit-dedikod').click(function(event) {
		$(this).parents('.dedikod').addClass('editing').find('textarea.edit').select();
	});
	$('body').on('click', 'span.cancel-edit', function(event) {
		$(this).parents('.dedikod').removeClass('editing');
	});

});








































