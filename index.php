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
		'database' => $database,
		'session' => $session
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