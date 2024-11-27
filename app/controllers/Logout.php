<?php
	/**
	 * Log out page.
	 *
	 * Handle functionality for log out page.
	 *
	 * @package		hello_world/app
	 * @subpackage	controllers
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/hello_world
	 * @version     1.0.0
	 */
	class Logout extends Controller {
		/**
		 * Index function.
		 *
		 * Load the sign up view.
		 * @return void
		 */
		public function index() {
			// log user out
			$this->UsersModel->logUserOut();
		}
	}