<?php
	/**
	 * Sign Up page.
	 *
	 * Handle functionality for sign up page.
	 *
	 * @package		hello_world/app
	 * @subpackage	controllers
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/hello_world
	 * @version     1.0.0
	 */
	class Signup extends Controller {
		/**
		 * Index function.
		 *
		 * Load the sign up view.
		 * @return void
		 */
		public function index() {
			// controller name
			$data['controller'] = strtolower( __CLASS__ );
			
			// html page title
			$data['html_title'] = $this->HelloWorldModel->getHtmlTitle( 'Sign Up' );

			// html head content
			$data['html_head'] = $this->Model->getViewHtml( $data['controller'] . '/html_head', $data );
			
			// html head content
			$data['html_body'] = $this->Model->getViewHtml( $data['controller'] . '/html_body', $data );

			// load view
			$this->loadView( 'templates/default/html', $data );
		}

		/**
		 * Sign a user up.
		 *
		 * @return void
		 */
		public function user() {
			// get form data from post
			$formData = json_decode( $_POST['formData'], true );

			// sign user up
			$formData = $this->SignUpModel->user( $formData );

			echo json_encode( // json encode for response
				array( // send form data
					'formData' => $formData
				) 
			);
		}
	}