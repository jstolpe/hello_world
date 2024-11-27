<?php
	/**
	 * Users model.
	 *
	 * Users functionality.
	 * 
	 * @package		hello_world/app
	 * @subpackage	models
	 * @author		Justin Stolpe
	 * @link		https://github.com/jstolpe/hello_world
	 * @version     1.0.0
	 */
	class UsersModel extends Model {
		/**
		 * Table name for the model.
		 *
		 * @var	string
		 */
		const TABLE_NAME = 'users';

		/**
		 * Column name for user email address.
		 *
		 * @var	string
		 */
		const COLUMN_NAME_EMAIL = 'email';

		/**
		 * Column name for user id.
		 *
		 * @var	string
		 */
		const COLUMN_NAME_ID = 'id';

		/**
		 * Column name for username.
		 *
		 * @var	string
		 */
		const COLUMN_NAME_USERNAME = 'username';

		/**
		 * Class constructor.
		 *
		 * Do things upon construction of the model.
		 *
		 * @param array $autoloader Instance of the autoloader class.
		 * @return void
		 */
		public function __construct( $autoloader ) {
			parent::__construct( $autoloader );

			// load other models for use
			$this->loadModel( 'HelloWorldModel' );
		}

		/**
		 * Get user info with a column name and value.
		 *
		 * @param string $columnName Column name to search in.
		 * @param string $value      Value to look for in the specified column name..
		 * @return array User info.
		 */
		public function getUserWithColumnValue( $columnName, $value ) {
			// custom select
			$select = '*';

			// specify database table
			$this->database->table( self::TABLE_NAME );

			// set where
			$this->database->where( 'users.' . $columnName, $value );

			// set fetch mode
			$this->database->fetch( Database::PDO_FETCH_SINGLE );

			// get results
			$userInfo = $this->database->runSelectQuery( $select );

			// return results
			return $userInfo;
		}

		/**
		 * Insert a new user into the database.
		 *
		 * @param array $info User info to be inserted.
		 *		$info (
		 *			'email'      => string Users email address.
		 *			'first_name' => string Users first name.
		 *			'last_name'  => string Users last name.
		 *			'password'   => string Users password.
		 *		)
		 * @return integer Row id that was inserted.
		 */
		public function insertUser( $info ) {
			$insertData = array( // data to insert with the array keys being the column names
				'key_value' => $this->HelloWorldModel->getNewKey( HelloWorldModel::DEFAULT_KEY_VALUE_LENGTH ),
				'email' => trim( $info['email'] ),
				'username' => trim( $info['username'] ),
				'first_name' => trim( $info['first_name'] ),
				'last_name' => trim( $info['last_name'] ),
				'password' => password_hash( $info['password'], PASSWORD_DEFAULT )
			);

			// specify database table
			$this->database->table( self::TABLE_NAME );

			// return results
			return $this->database->runInsertQuery( $insertData );	
		}

		/**
		 * Is logged in.
		 *
		 * Determine if a user is logged in by checking things.
		 * @return boolean
		 */
		public function isLoggedIn() {
			// get user id from session
			return $this->session->getData( 'user_id' );
		}

		/**
		 * Log user out.
		 *
		 * @return void
		 */
		public function logUserOut() {
			// save user id for the session
			$this->session->setSessUserId( 0 );
				
			// unset the user info
			$this->session->unsetData( 'user_info' );

			// redirect
			header( 'Location: ' . HREF_BASE_URL . '/login' );
		}

		/**
		 * Update a new user into the database.
		 *
		 * @param string $userId
		 * @param array $info
		 * @return void
		 */
		public function updateUser( $userId, $info ) {
			$updateData = array( // data to update with the array keys being the column names
				'email' => trim( $info['email'] ),
				'username' => trim( $info['username'] ),
				'first_name' => trim( $info['first_name'] ),
				'last_name' => trim( $info['last_name'] )
			);

			if ( isset( $info['password'] ) ) { // add on password
				$updateData['password'] = password_hash( $info['password'], PASSWORD_DEFAULT );
			}	

			// specify database table
			$this->database->table( self::TABLE_NAME );

			// set where
			$this->database->where( self::COLUMN_NAME_ID, $userId );

			// return results
			$this->database->runUpdateQuery( $updateData );
		}
	}
?>