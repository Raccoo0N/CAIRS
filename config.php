<?php
	if( !defined('BASE_DIR') ){
		define('BASE_DIR', dirname(__FILE__) ."/");
	}
	define('SAVESERVER', false);
	define('ONREPAIR', false);
	define('SYSTIME', time() );
	define('SITE_URL', isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : "" );
	define('ORDER_EMAIL', "contact@email.com");
	define('BASE_SITE', SITE_URL ); 
	define('BASE_TITLE', "CAIRS PLAN – The first and best tool for planning CAIRS surgery."); 
	define('VER', "LCST v.0.1b" );
	define('MAX_WHILE', 256);
	define('MAX_PHOTOSIZE', 3145728);
	define('SALT', "HIDDEN_WORDS"); 

	define('TRACE_MYSQL', false );
	define('DEBUG_MODE', false ); 
	//
	// NAVIGATION
	//
	define('CLASS_DIR', BASE_DIR ."classes/");
	define('TPL_DIR', BASE_DIR ."templates/"); 
	define('TPL_EXT', ".tpl.php");
	define('INC_DIR', BASE_DIR ."controllers/"); 
	define('INC_EXT', ".inc.php"); 
	define('UPLOADS_DIR', BASE_DIR ."uploads/");
	//
	// DATABASE
	//
	require_once BASE_DIR ."db_config.php"; 
	//
	// SETTINGS
	//
	define('ROBOT', isset( $_SESSION['ROBOT'] ) ? false : true );
	define('AUTH', isset( $_SESSION['AUTH'] ) && $_SESSION['AUTH'] ? true : false ); 
	define('UID', ( isset( $_SESSION['UID'] )  ? $_SESSION['UID'] : ( isset( $_SESSION['USER']['ID'] ) ? $_SESSION['USER']['ID'] : false ) ) );  
	//
	//
	if( isset( $_SESSION['ADMIN'] ) ){ define('ADMIN', $_SESSION['ADMIN'] ); } 
	else {
		if( isset( $_SESSION['USER']['role'] ) && $_SESSION['USER']['role'] == "ADMIN" ){ 
			$_SESSION['ADMIN'] = true;
			define('ADMIN', true ); 
		} 
		else { define('ADMIN', false ); }
	}  
	//
	// 
	define('LOREM', "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");











