( function( $ ) {
	$(document).ready(function () {
		// handles the carousel thumbnails
		$('[id^=carousel-selector-]').click(function() {
			let id_selector = $(this).attr('id');
			let id = parseInt( id_selector.substr(id_selector.lastIndexOf('-') + 1) );
			$('#mp-gallery-main').carousel(id);
		});

		// when the carousel slides, auto update
		$('#mp-gallery-main').on('slide.bs.carousel', function(e) {
			let id = parseInt( $(e.relatedTarget).attr('data-slide-number') );
			$('[id^=carousel-selector-]').removeClass('selected');
			$('[id=carousel-selector-'+id+']').addClass('selected');
		});
	});
} )( jQuery );