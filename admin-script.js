jQuery(document).ready(function($) {
    $(document).on('click', '.custom_media_upload', function(e) {
        e.preventDefault();

        var custom_uploader = wp.media({
            title: 'Seleziona immagine',
            button: {
                text: 'Usa questa immagine'
            },
            multiple: false
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $(e.target).parent().find('.custom_media_image').attr('src', attachment.url).show();
            $(e.target).parent().find('.custom_media_url').val(attachment.url);
        })
        .open();
    });

    $(document).on('click', '.custom_media_remove', function(e) {
        e.preventDefault();
        $(e.target).parent().find('.custom_media_image').attr('src', '').hide();
        $(e.target).parent().find('.custom_media_url').val('');
    });
});