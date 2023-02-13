document.addEventListener( 'DOMContentLoaded', function() {
	signUpForm = new formHelper( {
		formClassPrefix: 'signup'
	} );

	document.getElementsByClassName( 'button-signup' )[0].addEventListener( 'click', function() {
		serverSignUp( signUpForm );
	} );
} );

function serverSignUp( signUpForm ) {
	if ( signUpForm.validate() ) {

	}
}