<?php
	/**
	 * iarecoding model.
	 *
	 * Get data for the iarecoding page.
	 *
	 * @package		iarecoding/app
	 * @subpackage	models
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/iarecoding
	 * @version     1.0.0
	 */
	class HelloWorldModel extends Model {
		const SITE_DISPLAY_NAME = SITE_DISPLAY_NAME;

		public function getHtmlTitle( $string ) {
			return self::SITE_DISPLAY_NAME . ' | ' . $this->escapeHtml( $string );
		}
	}
?>