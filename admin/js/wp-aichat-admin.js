jQuery(document).ready(function($) {
    // Logo upload
    $('#wp_aichat_upload_logo').on('click', function(e) {
        e.preventDefault();

        var logoInput = $('#wp_aichat_logo_url');
        var logoPreview = $('.wp-aichat-logo-preview');
        var removeButton = $('#wp_aichat_remove_logo');

        var frame = wp.media({
            title: 'Select Chat Logo',
            button: {
                text: 'Use this logo'
            },
            multiple: false
        });

        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            logoInput.val(attachment.url);
            logoPreview.html('<img src="' + attachment.url + '" style="max-width: 100px; max-height: 100px;">');
            removeButton.show();
        });

        frame.open();
    });

    // Logo remove
    $('#wp_aichat_remove_logo').on('click', function(e) {
        e.preventDefault();

        var logoInput = $('#wp_aichat_logo_url');
        var logoPreview = $('.wp-aichat-logo-preview');
        var removeButton = $(this);

        logoInput.val('');
        logoPreview.empty();
        removeButton.hide();
    });
}); 