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
		 * Column name for username.
		 *
		 * @var	string
		 */
		const COLUMN_NAME_USERNAME = 'username';

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
	}
?>