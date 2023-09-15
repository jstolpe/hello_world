<?php
	/**
	 * Sign Up model.
	 *
	 * Sign up functionality.
	 * 
	 * @package		hello_world/app
	 * @subpackage	models
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/hello_world
	 * @version     1.0.0
	 */
	class SignUpModel extends Model {
		/**
		 * Sign a user up.
		 *
		 * @param array $formData
		 * @return array
		 */
		public function user( $formData ) {
			// validate the form
			$this->validateSignUpForm( $formData );

			if ( $formData['formIsValid'] ) { // all good
				$newUserData = array( // new user info
					'email' => $formData['formElements']['email']['value'],
					'username' => $formData['formElements']['username']['value'],
					'first_name' => $formData['formElements']['first_name']['value'],
					'last_name' => $formData['formElements']['last_name']['value'],
					'password' => $formData['formElements']['password']['value']
				);

				// insert the user with the form data
				$newUserId = $this->UsersModel->insertUser( $newUserData );

				// get new user
				$newUser = $this->UsersModel->getUserWithColumnValue( UsersModel::COLUMN_NAME_ID, $newUserId );

				// display new user from db
				echo '<pre>';
				print_r( $newUser );
				die();
			}

			// return form data
			return $formData;
		}

		/**
		 * Validate sign up form.
		 *
		 * @param array $formData array of form elements.
		 * @return void
		 */
		public function validateSignUpForm( &$formData ) {
			// validate email
			$this->validateFormUsersEmail( $formData['formElements']['email'] );

			// validate username
			$this->validateFormUsername( $formData['formElements']['username'] );

			// validate first name
			$this->validateFormName( $formData['formElements']['first_name'] );

			// validate last name
			$this->validateFormName( $formData['formElements']['last_name'] );

			// validate password
			$this->validateFormPassword( $formData['formElements']['password'] );

			// validate confirm password
			$this->validateFormConfirmPassword( $formData['formElements']['confirm_password'], $formData['formElements']['password'] );

			// set form is valid based on if there are an is not valid form elements
			$formData['formIsValid'] = $this->FormHelperModel->isFormValid( $formData );
		}

		/**
		 * Validate the users email.
		 *
		 * @param array $formElement data on the form element.
		 * @return void
		 */
		public function validateFormUsersEmail( &$formElement ) {
			// get user info based on email
			$userInfoWithEmail = $this->UsersModel->getUserWithColumnValue( UsersModel::COLUMN_NAME_EMAIL, $formElement['value'] );

			if ( $userInfoWithEmail || !$this->FormHelperModel->isValidEmail( $formElement['value'] ) ) { // user with email already exists or invalid email
				$formElement['isValid'] = false;
			} else { // no user exists with the email and the email is valid
				$formElement['isValid'] = true;
			}

			// set message
			$formElement['message'] = $formElement['isValid'] ? '' : FormHelperModel::$messages['email_invalid'];
		}

		/**
		 * Validate the username.
		 *
		 * @param array $formElement data on the form element.
		 * @return void
		 */
		public function validateFormUsername( &$formElement ) {
			// get user info based on email
			$userInfoWithUsername = $this->UsersModel->getUserWithColumnValue( UsersModel::COLUMN_NAME_USERNAME, $formElement['value'] );

			if ( $userInfoWithUsername || !$this->FormHelperModel->isValidUsername( $formElement['value'] ) ) { // username already exists or invalid username
				$formElement['isValid'] = false;
			} else { // no user exists with the username and the username is valid
				$formElement['isValid'] = true;
			}

			// set message
			$formElement['message'] = $formElement['isValid'] ? '' : FormHelperModel::$messages['username_invalid'];
		}

		/**
		 * Validate the name.
		 *
		 * @param array $formElement data on the form element.
		 * @return void
		 */
		public function validateFormName( &$formElement ) {
			// check for name
			$formElement['isValid'] = $this->FormHelperModel->isValidName( $formElement['value'] );
			
			// set message
			$formElement['message'] = $formElement['isValid'] ? '' : FormHelperModel::$messages['name_invalid'];
		}

		/**
		 * Validate the password.
		 *
		 * @param array $formElement data on the form element.
		 * @return void
		 */
		public function validateFormPassword( &$formElement ) {
			// check length
			$formElement['isValid'] = $this->FormHelperModel->isValidPassword( $formElement['value'] );
			
			// set message
			$formElement['message'] = $formElement['isValid'] ? '' : FormHelperModel::$messages['password_invalid'];
		}

		/**
		 * Validate the confirm password.
		 *
		 * @param array $formElement data on the form element.
		 * @param array $formElementPassword data on the form element.
		 * @return void
		 */
		public function validateFormConfirmPassword( &$formElement, $formElementPassword ) {
			// check password against confirm
			$formElement['isValid'] = $this->FormHelperModel->isValidPassword( $formElementPassword['value'] ) && $formElement['value'] == $formElementPassword['value'];
			
			// set message
			$formElement['message'] = $formElement['isValid'] ? '' : FormHelperModel::$messages['password_invalid'];
		}
	}
?>