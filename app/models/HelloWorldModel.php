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
	}
?>