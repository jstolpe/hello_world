document.addEventListener( 'DOMContentLoaded', function() { // document is ready
	document.getElementById( 'hello_world' ).addEventListener( 'pointerdown', function() { // pointer down for hello button
		// show the earth_day image
		document.getElementsByClassName( 'day' )[0].style.display = 'block';
		
		// hide the earth_night image
		document.getElementById( 'night' ).style.display = 'none';

		// send ga event of button click
		gaHelper.buttonClick( 'btn_hw_earth', 'earth', 1 );
	} );

	document.getElementById( 'hello_world' ).addEventListener( 'pointerup', function() { // pointer up for hello button
		// hide the earth_day image
		document.getElementsByClassName( 'day' )[0].style.display = 'none';
		
		// show the earth_night image
		document.getElementById( 'night' ).style.display = 'block';
	} );
} );