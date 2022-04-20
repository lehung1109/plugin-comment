// Webpack Imports
import 'bootstrap';


( function ( $ ) {
	'use strict';

	// Focus input if Searchform is empty
	$( '.search-form' ).on( 'submit', function ( e ) {
		var search = $( this ).find( 'input' );
		if ( search.val().length < 1 ) {
			e.preventDefault();
			search.trigger( 'focus' );
		}
	} );

	// Random banner
	$('.banner__inner').each(function () {
		let countLink = $(this).find('.banner__link').length;
		let randomNbr = Math.floor(Math.random() * (countLink+1));
		if (randomNbr === 0) { randomNbr = 1;}

		$(this).find('.banner__link:nth-child(' + randomNbr + ')').removeClass('d-none').addClass('d-block');
	});

	// Random suggestion
	$('.suggestion__inner').each(function () {
		let countLink = $(this).find('.suggestion__link').length;
		let randomNbr = Math.floor(Math.random() * (countLink+1));
		if (randomNbr === 0) { randomNbr = 1;}

		$(this).find('.suggestion__link:nth-child(' + randomNbr + ')').removeClass('d-none').addClass('d-block');
	});

	// Add number fo best selling
	$('.best-selling__items > div').each(function () {
		$(this).find('.best-selling__item .best-selling__number').prepend($(this).index() + 1);
	});

	// Submit google form
	$.fn.serializeJSON = function () {
		let o = {};
		let a = this.serializeArray();
		$.each(a, function () {
			if (o[this.name]) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};

	$(".js-google-form").submit(function (e) {
		e.preventDefault();

		// Submit form
		let form = $(this);
		let url = form.attr('action');
		let data = form.serializeJSON();

		$.ajax({
			type: "POST",
			dataType: "xml",
			url: url,
			data: data,
			xhrFields: {
				withCredentials: true
			},
			statusCode: {
				0: function () { // 0 is when Google gives a CORS error, don't worry it went through
					form.hide();
					form.prev().show();
				},
				200: function () { // 200 is a success code. it went through!
					form.hide();
					form.prev().show();
				},
				403: function () { // 403 is when something went wrong and the submission didn't go through
					console.log('Oh no! something went wrong. we should check our code to make sure everything matches with Google');
				}
			}
		});
	});

}( jQuery ) );
