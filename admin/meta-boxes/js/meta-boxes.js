jQuery(document).ready(function($) {
	
	//global post id
	var post_ID = $('#post_ID').val();
	
	/*	Post formats change
	=========================*/
	function changeFormat(format){
		jQuery('#aq_format_0_container, #aq_format_quote_container, #aq_format_link_container, #aq_format_gallery_container, #aq_format_audio_container, #aq_format_video_container ').hide();
		jQuery('#aq_format_' + format + '_container').show();
	}
	
	var currFormat = jQuery('#post-formats-select').find(':checked').val();
	changeFormat(currFormat);
	
	jQuery('#post-formats-select').change(function() {
		var format = jQuery(this).find(':checked').val();
		changeFormat(format);
	});
	
	/*	Media Upload
	=========================*/
	var frame;
	// Build the choose from library frame.
	$('.aq_image_upload_button').click( function( event ) {
		var $el = $(this),
			$type = $el.attr('rel');

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( frame ) {
			frame.open();
			return;
		}

		// Create the media frame.
		frame = wp.media.frames.customHeader = wp.media({
			// Set the title of the modal.
			title: $el.data('choose'),

			// Tell the modal to show only images.
			library: {
				type: 'audio'
			},

			// Customize the submit button.
			button: {
				// Set the text of the button.
				text: $el.data('update'),
				// Tell the button not to close the modal, since we're
				// going to refresh the page when the image is selected.
				close: false
			}
		});

		// When an image is selected, run a callback.
		frame.on( 'select', function() {
			// Grab the selected attachment.
			var attachment = frame.state().get('selection').first(),
				link = $el.data('updateLink');

			// Tell the browser to navigate to the crop step.
			window.location = link + '&file=' + attachment.id;
		});

		frame.open();
	});

	// New image uploader
	$(document).on('click', '.aq_upload_button', function(event) {
		var $clicked = $(this), frame,
			input_id = $clicked.prev().attr('id'),
			media_type = $clicked.attr('rel');
			
		event.preventDefault();
		
		// If the media frame already exists, reopen it.
		if ( frame ) {
			frame.open();
			return;
		}
		
		// Create the media frame.
		frame = wp.media.frames.customHeader = wp.media({
			// Set the media type
			library: {
				type: media_type
			},
		});
		
		// When an image is selected, run a callback.
		frame.on( 'select', function() {
			// Grab the selected attachment.
			var attachment = frame.state().get('selection').first();
				$('#' + input_id).val(attachment.attributes.url);
				$('#' + input_id).parent().parent().parent().find('.screenshot img').attr('src', attachment.attributes.url);
		});

		frame.open();
	
	});
	
});
