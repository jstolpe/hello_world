document.addEventListener( 'DOMContentLoaded', function() { // document is ready
	logInForm = new formHelper( { // initialize form helper
		formClassPrefix: 'login'
	} );

	document.getElementsByClassName( 'button-login' )[0].addEventListener( 'click', function() { // on clicked
		// sign user up server side
		serverLogIn( logInForm );
	} );
} );

/**
 * Log the user in.
 *
 * @param object logInForm.
 * @return void
 */
function serverLogIn( logInForm ) {
	if ( logInForm.validate( 'frontend' ) ) { // valid front end form
		// server side validation
	}
}