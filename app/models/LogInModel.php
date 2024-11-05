<?php
	/**
	 * Log in model.
	 *
	 * Log in functionality.
	 * 
	 * @package		hello_world/app
	 * @subpackage	models
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/hello_world
	 * @version     1.0.0
	 */
	class LogInModel extends Model {
		/**
		 * Log a user in.
		 *
		 * @param array $formData
		 * @return array
		 */
		public function user( $formData ) {
			// validate the form
			$validate = $this->validateLogInForm( $formData );

			if ( $formData['formIsValid'] ) { // all good
				// save user id for the session
				$this->session->setSessUserId( $validate['user_info']['id'] );
				
				// get the new users info and save it to the session
				$this->session->setData( 'user_info', $validate['user_info'] );
			}

			// return form data
			return $formData;
		}

		/**
		 * Validate log in form.
		 *
		 * @param array $formData array of form elements.
		 * @return void
		 */
		public function validateLogInForm( &$formData ) {
			// get user info based on email
			$userInfoWithEmail = $this->UsersModel->getUserWithColumnValue( 'email', $formData['formElements']['email']['value'] );

			if ( $userInfoWithEmail && password_verify( $formData['formElements']['password']['value'], $userInfoWithEmail['password'] ) ) { // user info exists and passwords match
				$isLogInFormValid = true;
			} else { // no user info or passwords do not match
				$isLogInFormValid = false;
			}

			// set email password form elements accordingly
			$formData['formElements']['email']['isValid'] = $isLogInFormValid;
			$formData['formElements']['password']['isValid'] = $isLogInFormValid;

			// set form is valid based on if there are an is not valid form elements
			$formData['formIsValid'] = $this->FormHelperModel->isFormValid( $formData );

			return array( // return validation info
				'user_info' => $userInfoWithEmail
			);
		}
	}
?>