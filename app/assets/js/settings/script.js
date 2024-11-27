document.addEventListener( 'DOMContentLoaded', function() { // document is ready
	settingsForm = new formHelper( { // initialize form helper
		formClassPrefix: 'settings'
	} );

	document.getElementsByClassName( 'button-update' )[0].addEventListener( 'click', function() { // on clicked
		// update settings
		serverUpdateSettings( settingsForm );
	} );

	document.getElementsByClassName( 'change-password' )[0].addEventListener( 'click', function() { // on clicked
		// show/hide change password inputs based on checkbox
		document.getElementsByClassName( 'change-password-container' )[0].style.display = this.checked ? 'block' : 'none';

		if ( this.checked ) { // change password checked
			// update form element to require password check
			settingsForm.setFormElementCheck( 'password', 'password' );

			// update form element to require confirm password check
			settingsForm.setFormElementCheck( 'confirm_password', 'confirm_password' );
		} else {
			// update form element to require password check
			settingsForm.setFormElementCheck( 'password', '' );

			// update form element to require confirm password check
			settingsForm.setFormElementCheck( 'confirm_password', '' );
		}
	} );
} );

/**
 * Update user settings.
 *
 * @param object settingsForm.
 * @return void
 */
function serverUpdateSettings( settingsForm ) {
	if ( settingsForm.validate( 'frontend' ) ) { // valid front end form
		// show loader
		helloWorldLoader.show();

		helloWorld.ajax( { // make call to server endpoint
			type: 'POST',
			url: helloWorld.baseUrl + 'settings/update',
			data: {
				formData: settingsForm.getPostData()
			},
			success : function( data ) { // we have a response
				if ( settingsForm.validateResponseData( data ) ) { // valid form data
					// redirect user
					window.location.href = helloWorld.baseUrl;
				} else {
					// hide the loader
					helloWorldLoader.hide();
				}
			}
		} );
	}
}