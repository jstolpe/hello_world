<?php
	/**
	 * Settings page.
	 *
	 * Handle functionality for settings page.
	 *
	 * @package		hello_world/app
	 * @subpackage	controllers
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/hello_world
	 * @version     1.0.0
	 */
	class Settings extends Controller {
		/**
		 * Index function.
		 *
		 * Load the sign up view.
		 * @return void
		 */
		public function index() {
			// controller name
			$data['controller'] = strtolower( __CLASS__ );

			// get use settings
			$data['session'] = $this->session->getData();

			// set user info
			$data['user_info'] = $this->UsersModel->getUserWithColumnValue( 'id', $data['session']['user_info']['id'] );
			
			// html page title
			$data['html_title'] = $this->HelloWorldModel->getHtmlTitle( __CLASS__ );

			// html head content
			$data['html_head'] = $this->Model->getViewHtml( $data['controller'] . '/html_head', $data );
			
			// html head content
			$data['html_body'] = $this->Model->getViewHtml( $data['controller'] . '/html_body', $data );

			// load view
			$this->loadView( 'templates/default/html', $data );
		}

		/**
		 * Update a user with the $_POST data from the form on the signup page.
		 *
		 * @return void
		 */
		public function update() {
			// get form data from post
			$formData = json_decode( $_POST['formData'], true );

			// update user settings
			$formData = $this->SettingsModel->update( $formData );

			echo json_encode( // json encode for response
				array( // send form data
					'formData' => $formData
				) 
			);
		}
	}