/**
 * Global admin functions
 */
$(document).ready(function() {

    /**
     * Enable Summernote WYSIWYG editor on any textareas with the 'editor' class
     */
	var lang = $('html').attr('lang');
    if ($('textarea.editor').length) {
        $('textarea.editor').each(function() {
            var id = $(this).attr('id');
            $('#' + id).summernote({
                height: 300,
				lang: lang
            });
        });
    }

});
