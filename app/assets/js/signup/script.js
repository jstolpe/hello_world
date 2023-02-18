document.addEventListener( 'DOMContentLoaded', function() { // document is ready
	signUpForm = new formHelper( { // initialize form helper
		formClassPrefix: 'signup'
	} );

	document.getElementsByClassName( 'button-signup' )[0].addEventListener( 'click', function() { // on clicked
		// sign user up server side
		serverSignUp( signUpForm );
	} );
} );

/**
 * Sign the user up.
 *
 * @param object signUpForm.
 * @return void
 */
function serverSignUp( signUpForm ) {
	if ( signUpForm.validate( 'frontend' ) ) { // valid front end form
		helloWorld.ajax( { // make call to server endpoint
			type: 'POST',
			url: 'http://localhost/hello_world/signup/user',
			data: {
				formData: signUpForm.getPostData(),
				hello: 'world'
			},
			success : function( data ) { // we have a response
				if ( signUpForm.validateResponseData( data ) ) { // valid form data
					alert('valid');
				} else {
					alert('not valid');
				}
			}
		} );
	}
}