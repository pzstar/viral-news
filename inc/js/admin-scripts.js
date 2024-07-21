function viral_news_upload_media_image(selector) {
    // ADD IMAGE LINK
    jQuery('body').on('click', selector, function (event) {
        event.preventDefault();

        var imgContainer = jQuery(this).closest('.attachment-media-view').find('.thumbnail-image'),
            placeholder = jQuery(this).closest('.attachment-media-view').find('.placeholder'),
            imgIdInput = jQuery(this).siblings('.upload-id');

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Image',
            button: {
                text: 'Use Image'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();

            // Send the attachment URL to our custom image input field.
            imgContainer.html('<img src="' + attachment.url + '" style="max-width:100%;"/>');
            placeholder.addClass('hidden');
            imgIdInput.val(attachment.url).trigger('change');
        });

        // Finally, open the modal on click
        frame.open();

    });
}

function viral_news_delete_media_image(selector) {
    // DELETE IMAGE LINK
    jQuery('body').on('click', selector, function (event) {

        event.preventDefault();
        var imgContainer = jQuery(this).closest('.attachment-media-view').find('.thumbnail-image'),
            placeholder = jQuery(this).closest('.attachment-media-view').find('.placeholder'),
            imgIdInput = jQuery(this).siblings('.upload-id');

        // Clear out the preview image
        imgContainer.find('img').remove();
        placeholder.removeClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val('').trigger('change');

    });
}

jQuery(document).ready(function (jQuery) {
    viral_news_upload_media_image('.viral-news-upload-button');
    viral_news_delete_media_image('.viral-news-delete-button');
});
