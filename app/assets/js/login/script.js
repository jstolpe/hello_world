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
		// show loader
		helloWorldLoader.show();

		helloWorld.ajax( { // make call to server endpoint
			type: 'POST',
			url: helloWorld.baseUrl + 'login/user',
			data: {
				formData: logInForm.getPostData(),
				hello: 'world'
			},
			success : function( data ) { // we have a response
				if ( logInForm.validateResponseData( data ) ) { // valid form data
					alert('valid');

					// hide the loader
					helloWorldLoader.hide();
				} else {
					// hide the loader
					helloWorldLoader.hide();
				}
			}
		} );
	}
}