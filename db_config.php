<?php
	//
	// DATABASE
	//
	define('DBHOST', "localhost"); 
	define('DBUSER', "db_user"); 
	define('DBPASSWD', "db_password");
	define('DBNAME', "db_name"); 
	//
	// TABLES
	//
	define('TABLE_USERS', "users");	
		// ID 
		// user_login 
		// user_pass 
		// user_nicename 
		// user_email 
		// user_url 
		// user_registered 
		// user_activation_key 
		// user_status 
		// display_name 
	define('TABLE_PARAMETERS', "parameters");
		// id 
		// uid 
		// name 
		// tunnel_inner_diameter
		// tunnel_outer_diameter
		// tunnel_depth
		// donor_cut_1_diameter
		// donor_cut_1_depth
		// donor_cut_2_diameter
		// donor_cut_2_depth
		// segment_width
		// segment_depth  	
		// status
	define('TABLE_PICTURES', "pictures");	
		// id 
		// resource 
		// type 
		// file
	define('TABLE_PLAN', "plan");	
		// id 
		// uid
		// parameters_id 
		// name 
		// settings 
		// status 
		// date 
	define('TABLE_RETRIEVE', "retrieve"); 
		// id 
		// email 
		// code 
		// status 
		// date
	define('TABLE_STATUSES', "statuses");
		// id 
		// name 
		// info  
	define('TABLE_USERMETA', "usermeta"); 
		// umeta_id 
		// user_id 
		// meta_key 
		// meta_value






