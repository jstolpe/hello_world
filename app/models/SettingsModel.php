<?php
	/**
	 * Settings model.
	 *
	 * Settings functionality.
	 * 
	 * @package		hello_world/app
	 * @subpackage	models
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/hello_world
	 * @version     1.0.0
	 */
	class SettingsModel extends Model {
		/**
		 * Update settings.
		 *
		 * @param array $formData
		 * @return array
		 */
		public function update( $formData ) {
			// validate from
			$this->validateSettingsForm( $formData );

			if ( $formData['formIsValid'] ) { // update user info
				$updateData = array( // data to update with the array keys being the column names
					'email' => $formData['formElements']['email']['value'],
					'username' => $formData['formElements']['username']['value'],
					'first_name' => $formData['formElements']['first_name']['value'],
					'last_name' => $formData['formElements']['last_name']['value'],
				);

				if ( $formData['formElements']['change_password']['value'] ) { // updating password
					$updateData['password'] = $formData['formElements']['password']['value'];
				}

				// get use settings
				$sessionUserInfo = $this->session->getData( 'user_info' );

				// update user
				$this->UsersModel->updateUser( $sessionUserInfo['id'], $updateData );

				// get update user
				$updatedUser = $this->UsersModel->getUserWithColumnValue( UsersModel::COLUMN_NAME_ID, $sessionUserInfo['id'] );

				// set session data
				$this->session->setData( 'user_info', $updatedUser );
			}

			// return form data
			return $formData;
		}

		/**
		 * Validate settings.
		 *
		 * @param array $formData
		 * @return void
		 */
		public function validateSettingsForm( &$formData ) {
			// get use settings
			$session = $this->session->getData();

			// set user info
			$userInfo = $this->UsersModel->getUserWithColumnValue( 'id', $session['user_info']['id'] );

			if ( $userInfo['email'] != $formData['formElements']['email']['value'] ) { // user trying to update email address
				$this->validateFormUsersEmail( $userInfo, $formData['formElements']['email'] );
			}

			if ( $userInfo['username'] != $formData['formElements']['username']['value'] ) { // check username only if users trying to change it
				$this->validateFormUsername( $userInfo, $formData['formElements']['username'] );
			}

			// validate first name
			$this->validateFormName( $formData['formElements']['first_name'] );

			// validate last name
			$this->validateFormName( $formData['formElements']['last_name'] );

			if ( $formData['formElements']['change_password']['value'] ) { // only validate if changing password
				// validate password
				$this->validateFormPassword( $formData['formElements']['password'] );

				// validate confirm password
				$this->validateFormConfirmPassword( $formData['formElements']['confirm_password'], $formData['formElements']['password'] );
			}

			// set form is valid
			$formData['formIsValid'] = $this->FormHelperModel->isFormValid( $formData );
		}

		/**
		 * Validate password.
		 *
		 * @param array $formElement
		 * @return void
		 */
		public function validateFormPassword( &$formElement ) {
			// check length
			$formElement['isValid'] = $this->FormHelperModel->isValidPassword( $formElement['value'] );

			// set message
			$formElement['message'] = $formElement['isValid'] ? '' : FormHelperModel::$messages['password_invalid'];
		}

		/**
		 * Validate confirm password.
		 *
		 * @param array $formElement
		 * @return void
		 */
		public function validateFormConfirmPassword( &$formElement, $formElementPassword ) {
			// check if valid
			$formElement['isValid'] = $this->FormHelperModel->isValidPassword( $formElementPassword['value'] ) && $formElement['value'] == $formElementPassword['value'];

			// set message
			$formElement['message'] = $formElement['isValid'] ? '' : FormHelperModel::$messages['password_invalid'];
		}

		/**
		 * Validate name.
		 *
		 * @param array $formElement
		 * @return void
		 */
		public function validateFormName( &$formElement ) {
			// check if name is valid
			$formElement['isValid'] = $this->FormHelperModel->isValidName( $formElement['value'] );

			// set message
			$formElement['message'] = $formElement['isValid'] ? '' : FormHelperModel::$messages['name_invalid'];
		}

		/**
		 * Validate email.
		 *
		 * @param array $userInfo
		 * @param array $formElement
		 * @return void
		 */
		public function validateFormUsersEmail( $userInfo, &$formElement ) {
			if ( 
				(
					$userInfo['email'] != $formElement['value'] &&
					$this->UsersModel->getUserWithColumnValue( 'email', $formElement['value'] )
				) ||
				(
					!$this->FormHelperModel->isValidEmail( trim( $formElement['value'] ) )
				)
			) { // user is changing email and a user was found or email invalid
				$formElement['isValid'] = false;
			} else { // all good
				$formElement['isValid'] = true;
			}

			// set message
			$formElement['message'] = $formElement['isValid'] ? '' : FormHelperModel::$messages['email_invalid'];
		}

		/**
		 * Validate username.
		 *
		 * @param array $userInfo
		 * @param array $formElement
		 * @return void
		 */
		public function validateFormUsername( $userInfo, &$formElement ) {
			if ( 
				(
					$userInfo['username'] != $formElement['value'] &&
					$this->UsersModel->getUserWithColumnValue( 'username', $formElement['value'] )
				) ||
				(
					!$this->FormHelperModel->isValidUsername( trim( $formElement['value'] ) )
				)
			) { // user is changing username and a username was found or username invalid
				$formElement['isValid'] = false;
			} else { // all good
				$formElement['isValid'] = true;
			}

			// set message
			$formElement['message'] = $formElement['isValid'] ? '' : FormHelperModel::$messages['username_invalid'];
		}
	}
?>