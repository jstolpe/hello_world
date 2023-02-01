<?php
	// include includes!
	include __DIR__ . '/../../includes/hello_world_global_includes.php';

	if ( ENVIRONMENT == 'development' ) { // development env specific things
		// display all errors
		error_reporting( -1 );
		ini_set( 'display_errors', 1 );
	} else { // production env specific things
		// hide all errors
		error_reporting( 0 );
		ini_set( 'display_errors', 0 );
	}

	// require autoloader
	require_once 'core/Autoloader.php';

	$autoloaderParmas = array( // autoloader parmas
		'database' => array( // database info
			'load' => USE_DATABASE, // should we load the database
			'creds' => array( // database creds
				'hostname' => '',
				'username' => '',
				'password' => '',
				'database' => ''
			)
		),
		'session' => array( // use session helper and save in database
			'load' => USE_SESSION, // load session
			'sess_name' => 'iarecoding', // name of the session
			'sess_id_time_to_regen' => 300, // number of seconds before a new session id should be regenerated
			'secs_till_expire' => 86400 * 60, // number of seconds user needs to be inactive expiration
			'database_table_name' => 'sessions' // table name in the database
		)
	);

	// run the autoloader so our files get loaded
	$autoloader = new Autoloader( $autoloaderParmas );

	$routerParams = array( // params for rounter instantiation
		'default_controller' => 'Home',
		'default_method' => 'index'
	);

	// calculate route based on the query string
	$router = new Router( $routerParams );

	// load the calculated route
	$router->go( $autoloader );
?>