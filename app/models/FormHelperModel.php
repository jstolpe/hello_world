<?php
	/**
	 * Form Helper model.
	 *
	 * Form Helper functionality.
	 * 
	 * @package		hello_world/app
	 * @subpackage	models
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/hello_world
	 * @version     1.0.0
	 */
	class FormHelperModel extends Model {
		/**
		 * Minimum password length.
		 *
		 * @var	string
		 */
		const PASSWORD_MIN_LENGTH = 8;

		/**
		 * Form messages.
		 *
		 * @var	array
		 */
		public static $messages = array(
			'email_invalid' => 'Email invalid or already registered.',
			'username_invalid' => 'Username invalid or taken. Min length 4. Alphanumeric only.',
			'password_invalid' => "Passwords don't match and or are not 8 characters long.",
			'name_invalid' => 'Invalid name.'
		);

		/**
		 * Check if email is valid.
		 *
		 * @param string $email value to check.
		 * @return boolean
		 */
		public function isValidEmail( $email ) {
			return filter_var( $email, FILTER_VALIDATE_EMAIL );
		}

		/**
		 * Check if usernamel is valid.
		 *
		 * @param string $userName value to check.
		 * @return boolean
		 */
		public function isValidUsername( $userName ) {
			return preg_match( '/^[0-9a-zA-Z]{4,}$/', $userName );
		}

		/**
		 * Check if name is valid.
		 *
		 * @param string $name value to check.
		 * @return boolean
		 */
		public function isValidName( $name ) {
			return $name ? true : false;
		}

		/**
		 * Check if password is valid.
		 *
		 * @param string $password value to check.
		 * @return boolean
		 */
		public function isValidPassword( $password ) {
			return self::PASSWORD_MIN_LENGTH > strlen( $password ) ? false : true;
		}

		/**
		 * Check if the form is valid.
		 *
		 * @param array $formData form elements.
		 * @return boolean
		 */
		public function isFormValid( $formData ) {
			return !in_array( false, array_column( $formData['formElements'], 'isValid' ) );
		}
	}
?>