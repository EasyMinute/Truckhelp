jQuery(document).ready(function($) {
    var frame;

    $('.upload_icon_button').on('click', function(event) {
        event.preventDefault();

        var target = $(this).data('target');

        if (frame) {
            frame.open();
            return;
        }

        frame = wp.media({
            title: 'Select or Upload Media for Payment Icon',
            button: {
                text: 'Use this media'
            },
            multiple: false
        });

        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            $(target).val(attachment.url);
            $('#icon-preview-' + target.replace('#', '')).html('<img src="' + attachment.url + '" style="max-width:100px;" />');
        });

        frame.open();
    });
});
