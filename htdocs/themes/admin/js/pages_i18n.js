$(document).ready(function() {

    // Load Page preview
	$('a[rel=modal]').on('click', function(evt) {
		evt.preventDefault();
		var modal = $('#modal-preview').modal();
		var adr = $(this).attr('href');
		modal
			.find('.modal-body')
			.load(adr+' '+'#container', function (responseText, textStatus) {
				if ( textStatus === 'success' || 
					 textStatus === 'notmodified') 
				{
					modal.show();
				}
		});
	});

});
