<?php
	/**
	 * Hello World model.
	 *
	 * Global model for the site.
	 *
	 * @package		hello_world/app
	 * @subpackage	models
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/hello_world
	 * @version     1.0.0
	 */
	class HelloWorldModel extends Model {
		/**
		 * Site display name.
		 *
		 * @var	string
		 */
		const SITE_DISPLAY_NAME = SITE_DISPLAY_NAME;

		/**
		 * Default key length.
		 *
		 * @var	integer
		 */
		const DEFAULT_KEY_VALUE_LENGTH = 15;

		/**
		 * Get html site name.
		 *
		 * Return string for the html title.
		 *
		 * @param string $string Appended onto the site display name.
		 * @return string site name.
		 */
		public function getHtmlTitle( $string ) {
			return self::SITE_DISPLAY_NAME . ' | ' . $this->escapeHtml( $string );
		}

		/**
		 * Get new key.
		 *
		 * Get a new key for use in the key_value column of the database tables. Purpose is for a non auto increment unique column in the database tables.
		 *
		 * @param integer $length length of key.
		 * @return string
		 */
		public function getNewKey( $length ) {
			// shuffle the md5 hash on the current time and return the first 15 characters from the resulting string
			$string = str_shuffle( md5( time() ) );

			for ( $i = 0; $i < $length; $i++ ) {
				$string .= str_shuffle( md5( time() ) );
			}

			return substr( str_shuffle( $string ), 0, $length );
		}
	}
?>