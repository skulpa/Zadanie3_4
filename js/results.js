$(document).ready(function() {
	var searchButton = $('.szukaj');
	function doMagic() {
		console.log('Do magic!');
	}

	searchButton.on('keypress', function(event) {
		var code = event.keyCode || event.which;

		// Funkcja klawisza Enter
		if(code == 13) {
			// jeżeli naciśnięto - nie wykonuj akcji domyślnej
			// (czyli przeładowania strony z przekazaniem parametru GET)
			event.preventDefault();
			doMagic();
		}

	});
	console.log('DOM CONTENT LOADED!');
});