<?php 
	$post = $_REQUEST; 
	$input = json_decode( file_get_contents('php://input'), 1, 1024 ); 
	$return = array('error'=>1, 'msg'=>"UNAUTHORIZED"); 

	$DBO = DBO::getInstance();  
	
	$errors = array(
		"",										// 0
		"unauthorized", 						// 1
		"administrative function",				// 2
		"not api function", 					// 3
		"uncorrect data fields",				// 4
		"link inactive", 						// 5
		"user not found", 						// 6
		"action not found",						// 7
		"report not found",						// 8 
		"report not found or has wron owner",	// 9 
		"controller not found",					// 10 
		"wrong id",								// 11
		"wrong captcha"							// 12
	);
//
// VARIABLES
//
	function cmp_function($a, $b, $c){ return ($a[$c] > $b[$c]); } // ASC  uasort($array, 'cmp_function');
	function cmp_function_desc($a, $b, $c){ return ($a[$c] < $b[$c]); } // DESC  uasort($array, 'cmp_function_desc');

	switch( CONTROLLER ){ 
//?
//? USER ---------------------------------------------------------
//?
		case "user": 
			$USER = User::getInstance(); 
			$code = isset($post['code']) ? (int)$post['code'] : "";
			switch( ACTION ){ 
				case "antibot": 																						// ROBOT 
					if( $code == $_SESSION['captcha_keystring'] ){ 
						$_SESSION['ROBOT'] = false;  
						$return = array('success'=>1);
					} 
					else { $return = array('error'=>1); }
					break;
				case "auth": 																							// AUTH
					//if( $code == $_SESSION['captcha_keystring'] ){ 
						$user = $USER->auth( $post ); 
						$return = !$user || isset( $user['error'] ) ? 
									array( 'error'=>1, 'msg'=>isset( $user['msg'] ) ? $user['msg'] : "User not found", 'user'=>$user ) : 
									array( 'success'=>1, 'user'=>$user ); 
					//} 
					//else { $return = array( 'error'=>12, 'msg'=>"wrong code"); }
					break;
				case "edit": 
				case "reg": 																							// REG 
					//if( $code != $_SESSION['captcha_keystring'] ){ 
					//	$return = array('error'=>1, 'msg'=>"wrong code");
					//} 
					//else {
						$user = $USER->edit( $post ); 
						$return = !$user || isset( $user['error'] ) ? 
										array( 'error'=>1, 'msg'=>isset( $user['msg'] ) ? $user['msg'] : "User not found" ) : 
										array( 'success'=>1, 'data'=>$user ); 
					//}
					break; 
				case "retrieve": 
					$res = $USER->retrieve( $post );
					$return = !$res || isset( $res['error'] ) ? 
										array('error'=>1, 'msg'=>( isset($res['msg']) ? $res['msg'] : '' )) : 
										array('success'=>1, 'code'=>$res);  
					break; 
				case "chpass": 
					$res = $USER->chpass( $post );
					$return = !$res || isset($res['error']) ? 
										array('error'=>1, 'msg'=>( isset( $res['msg'] ) ? $res['msg'] : '' ), 'data'=>$res) : 
										array('success'=>1); 
					break;
				default: 
					$return = array('error'=>6, 'msg'=>$errors[6]); 
					break;
			}
			break; 
//? 
//? PARAMETERS ----------------------------------------------------
//?
			case "parameters": 
				$PARAMS = Parameters::getInstance(); 
				switch( ACTION ){
					case "edit": 
						$res = $PARAMS->edit($post); 
						$return = !$res | isset( $res['error'] ) ? 
										array('error'=>1, 'msg'=>( isset( $res['msg'] ) ? $res['msg'] : '' ), 'data'=>$res) : 
										array('success'=>1, 'data'=>$res); 
						break; 
					case "load": 
						$res = $PARAMS->load( $post );
						$return = $res ? array('success'=>1, 'data'=>$res) : array('error'=>1); 
						break; 
					case "get": 
						$res = $PARAMS->get( $post );
						$return = $res ? array('success'=>1, 'data'=>$res) : array('error'=>1); 
						break; 
				}
				break;
//?
//? PLAN ----------------------------------------------------------
//?			
			case "plan": 
				$PLAN = Plan::getInstance(); 
				switch( ACTION ){
					case "edit": 
						$res = $PLAN->edit($post); 
						$return = !$res || isset( $res['error'] ) ? 
										array('error'=>1, 'msg'=>( isset( $res['msg'] ) ? $res['msg'] : 'DB error' ) ) : 
										array('success'=>1); 
						break; 
					case "load": 
						$res = $PLAN->load( $post );
						$return = $res ? array('success'=>1, 'data'=>$res) : 
										array('error'=>1, 'msg'=>"Saved plans not found"); 
						break; 
					case "get": 
						$res = $PLAN->get( $post );
						$return = !$res || isset( $res['error'] ) ? 
										array('error'=>1, 'msg'=>( isset($res['msg']) ? $res['msg']: '')) : 
										array('success'=>1, 'data'=>$res); 
						break; 
				}
				break; 
		}

	echo json_encode( $return );
	exit(); 



