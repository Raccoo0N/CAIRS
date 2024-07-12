<?php 
    $link = "";
	if( isset( $_REQUEST['route'] ) && $_REQUEST['route'] ){
		$link = explode('?', $_REQUEST['route']);
		$link = explode('/', preg_replace('/^\//', '', $link[0] ) );
	} 
	$body =  $link ? $link : array(""); 

	if( $body[0] == "api" ){ 
		define('ISAPI', true );
		define('CONTROLLER', isset( $body[1] ) ? $body[1] : "" );
		define('ACTION', isset( $body[2] ) ? $body[2] : "" ); 
		define('ITEM_ID',  isset( $body[3] ) ? App::uid( $body[3] ) : ( isset( $body[2] ) ? App::uid($body[2]) : "" ) );
		define('ITEM_PARAM', isset( $body[4] ) ? App::uid( $body[4] ) : ( isset( $body[3] ) ? App::uid( $body[3] ) : ( isset( $body[2] ) ? App::uid($body[2]) : "" ) ) );
		define('ITEM_ADD', isset( $body[4] ) ? App::uid( $body[4] ) : ( isset( $body[3] ) ? App::uid( $body[3] ) : ( isset( $body[2] ) ? App::uid($body[2]) : "" ) ) );
	}
	else {
		define('ISAPI', false);
		define('CONTROLLER', ( $body[0] ? $body[0] : "main" ) );
		define('ACTION', isset( $body[1] ) ? $body[1] : "" ); 
		define('ITEM_ID', isset( $body[2] ) ? App::uid( $body[2] ) : ( isset( $body[1] ) ? App::uid($body[1]) : "" ) );
		define('ITEM_PARAM', isset( $body[3] ) ? App::uid( $body[3] ) : ( isset( $body[2] ) ? App::uid( $body[2] ) : ( isset( $body[1] ) ? App::uid($body[1]) : "" ) ) );
		define('ITEM_ADD', isset( $body[4] ) ? App::uid( $body[4] ) : ( isset( $body[3] ) ? App::uid( $body[3] ) : ( isset( $body[2] ) ? App::uid($body[2]) : "" ) ) );
	}

	if( ISAPI ){ header("Content-Type: text/json; charset=utf-8"); } 
	else { header("Content-Type: text/html; charset=utf-8"); } 

    if( !ISAPI ){ 
        if( defined('CONTROLLER') ){ 
            $controller = TPL_DIR . CONTROLLER . INC_EXT;
            if( is_file( $controller ) ){ 
                include_once $controller; 
            }
            if( CONTROLLER ){ 
                switch( CONTROLLER ){ 
                    case "about": define('TPL', "about"); break; 
                    case "auth": define('TPL', AUTH ? "main" : "auth" ); break; 
                    case "cairs-plan-tool": define('TPL', "cairs-plan-tool"); break; 
                    case "captcha": include_once BASE_DIR ."captcha.inc.php"; exit(); break;  
                    case "image": Image::get( ACTION ); exit(); break;  
                    case "logout": foreach( $_SESSION as $k=>$v ){ unset( $_SESSION[ $k ] ); } $_SESSION = array(); header('Location: /'); exit(); break; 
                    case "main": define('TPL', "main"); break; 
                    case "my-account": 
                    	switch( ACTION ){
                    		case "parameters": define('TPL', "parameters"); break; 
                    		case "saved-plans": define('TPL', "saved-plans"); break; 
                    		default: define('TPL', "my-account"); break; 
                    	}
                    	break; 
                    case "retrieve": define('TPL', "retrieve"); break; 
                    case "upload": include_once BASE_DIR ."upload.php"; exit(); break;  
                    case "why-cairs": define('TPL', "why-cairs"); break; 
                    case "admin": 
                    	if( ADMIN ){
                    		switch( ACTION ){
                    			case "plans": define('TPL', "admin/plans"); break; 
                    			case "users": define('TPL', "admin/users"); break; 
                    			default: define('TPL', "admin/main"); break; 
                    		}
                    	}	
                    	else {
                    		define('TPL', "404");
                    	}
                    	break;  
                } 
            }
            else { 
                define('TPL', "main" );
            }
        } 
        else {
            define('CONTROLLER', "main");
            define('TPL', "main" );
        } 
    }


