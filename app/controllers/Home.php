<?php
	/**
	 * iarecoding page.
	 *
	 * Handle functionality for iarecoding page.
	 *
	 * @package		iarecoding/app
	 * @subpackage	controllers
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/iarecoding
	 * @version     1.0.0
	 */
	class Home extends Controller {
		/**
		 * Index function.
		 *
		 * Load the home view.
		 *
		 * @return void
		 */
		public function index() {
			$data['controller'] = strtolower( __CLASS__ );
			
			// html page title
			$data['html_title'] = $this->HelloWorldModel->getHtmlTitle( __CLASS__ );

			$data['html_head'] = $this->Model->getViewHtml( $data['controller'] . '/html_head', $data );

			$data['html_body'] = $this->Model->getViewHtml( $data['controller'] . '/html_body', $data );

			// load view
			$this->loadView( 'templates/default/html', $data );
		}
	}
?>