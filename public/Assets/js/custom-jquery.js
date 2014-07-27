$(function () {

	// global close
	$('body').click(function(event) {
		$('.select-box ul').hide(0);
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


	// lightbox function
	function alert(content, title) {
		var padding = ( content == null ) ? null : 'alert'; 
		var title = ( title == undefined ) ? '' : title; 
		$('body').append('<div class="lightbox-bg"><div class="close-button"></div><div class="vertical-helper"></div><div class="lightbox-container"><h2>' + title + '</h2><div class="lightbox-content ' + padding + '">' + content + '</div></div></div>');
		setTimeout(function(){
			$('.lightbox-bg .lightbox-container').addClass('opened');
		}, 1) 
	}

	// load content from different file
	$('body').on('click', '[data-lightbox]', function() {
		alert(null, $(this).attr('data-lightboxtitle'));
		$('.lightbox-bg .lightbox-content').load($(this).attr('data-lightbox'));
	});

	// close action
	$(document).on('click', '.lightbox-bg .close-button', function() {
		$('.lightbox-bg .lightbox-container').removeClass('opened');
		setTimeout(function(){
			$('.lightbox-bg').remove();
		}, 200)
	});


	// gender selet
	$('.bottom-bar .gender').click(function(event) {
		$('.dedikod-area input[name=gender]').val($(this).attr('name'));
		$('.bottom-bar .gender').removeClass('selected');
		$(this).addClass('selected');
	});

	// get comments
	$('.dedikod .toolbar .get-comments').click(function() {
		$(this).parents('.dedikod').find('.load-comments').load('post/'+ $(this).attr('data-id') +' #giveComments');
	});

	// session message
	jQuery(document).ready(function($) {
		if ( $('.session-message').length > 0 ) {
			setTimeout(function(){
				$('.session-message').fadeOut('200');
			}, 5000)
		}
	});


});