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
            	likeNContainer.text(likeN+1).addClass('selected liked');
            },
            success: function() {
                
            }
        });
	});

	// event image 
	$('.dedikod .pic-upload').on('click', function(event) {
		event.stopPropagation();
		alert($(this).html());
	});

	// Dedikod Attachment 
	$('body').on('click', '#addAttachment', function(event) {
		$(this).parents('.lightbox-content').clone().appendTo('.dedikod-attachment-infos');
		closeLightbox();
	});

});








































