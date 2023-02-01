<?php
	/**
	 * Home page.
	 *
	 * Handle functionality for home page.
	 *
	 * @package		hello_world/app
	 * @subpackage	controllers
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/hello_world
	 * @version     1.0.0
	 */
	class Home extends Controller {
		/**
		 * Index function.
		 *
		 * Load the home view.
		 * @return void
		 */
		public function index() {
			// controller name
			$data['controller'] = strtolower( __CLASS__ );
			
			// html page title
			$data['html_title'] = $this->HelloWorldModel->getHtmlTitle( __CLASS__ );

			// html head content
			$data['html_head'] = $this->Model->getViewHtml( $data['controller'] . '/html_head', $data );
			
			// html head content
			$data['html_body'] = $this->Model->getViewHtml( $data['controller'] . '/html_body', $data );

			// load view
			$this->loadView( 'templates/default/html', $data );
		}
	}
?>