document.addEventListener( 'DOMContentLoaded', function() {
	
	document.getElementById( 'hello_world' ).addEventListener( 'pointerdown', function() {
		document.getElementsByClassName( 'day' )[0].style.display = 'block';
	
		document.getElementById( 'night' ).style.display = 'none';
	} );

	document.getElementById( 'hello_world' ).addEventListener( 'pointerup', function() {
		document.getElementsByClassName( 'day' )[0].style.display = 'none';
	
		document.getElementById( 'night' ).style.display = 'block';
	} );

} );