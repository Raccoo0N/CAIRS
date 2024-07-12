<?php
// 
//
// 
	class User extends Singleton { 
		public $dbo; 
//	
//===================================
		public function __construct( $d=array() ){
			$this->dbo = DBO::getInstance();
		}
//		
//-----------------------------------------------------
		public static function getInstance( $c=null, $name="", $params=array() ){
            return parent::getInstance( $c ? $c : __CLASS__ );
        }
//
//===================================
		public static function password( $p="" ){
			$pass = md5( SALT . $p );
			return $pass;
		} 
//
//===================================
		public static function logout(){
			foreach( $_SESSION as $k=>$v ){ unset( $_SESSION[ $k ] ); }
			$_SESSION = array();
			header('Location: /');
			exit();
		}
//
//===================================
		public function auth( $post=array() ){
			$user_email = isset( $post['username'] ) ? App::text( $post['username'] ) : ""; 
			$user_pass = isset( $post['password'] ) ? User::password( $post['password'] ) : ""; 
			$Q = "SELECT u.* 
					FROM `". TABLE_USERS ."` AS u 
					WHERE u.`user_email`='". $user_email ."' 
						AND u.`user_pass`='". $user_pass ."' ";
			$user = $this->dbo->get( preg_replace('/[\r\n\t]/', ' ', $Q) );  
			if( $user ){ 
				unset( $user['password'] );
				$_SESSION['ROBOT'] = false; 
				$_SESSION['AUTH'] = true; 
				$_SESSION['USER'] = $user; 
				return $user;
			} 
			else {
				return array('error'=>1, 'msg'=>"Wrong login or password", 'q'=>$Q);
			} 
		}
//
//===================================
		public function edit( $d=array() ){ 
			$results = array(); 
			$id = isset( $d['id'] ) ? (int)$d['id'] : 0; 
			$first_name = isset( $d['first_name'] ) ? App::text( $d['first_name'] ) : ""; 
			$last_name = isset( $d['last_name'] ) ? App::text( $d['last_name'] ) : ""; 
			$email = isset( $d['user_email'] ) ? preg_replace( '[^A-Za-z0-9\-\_\.\@]', '', $d['user_email'] ) : ""; 
			$password = isset( $d['user_pass'] ) ? User::password( $d['user_pass'] ) : ""; 
			$password2 = isset( $d['user_confirm_password'] ) ? User::password( $d['user_confirm_password'] ) : ""; 
			$code = isset( $d['user_code'] ) ? App::text( $d['user_code'] ) : ""; 
			$new_user = false; 

			if( !$id ){ 
				$new_user = true; 
				if( !$email ){ return array('error'=>1, 'msg'=>"Incorrect email"); }
				if( !$password || !$password2 || $password != $password2 ){ return array('error'=>1, 'msg'=>"Incorrect email"); } 
				$ex = $this->dbo->get("SELECT * FROM `". TABLE_USERS ."` WHERE `user_email`='". $email ."'"); 
				if( $ex ){ return array('error'=>1, 'msg'=>"User allready exists"); } 
				$id = $this->dbo->ins( TABLE_USERS, array('user_login'=>$email, 'user_email'=>$email, 'user_pass'=>$password, 'user_registered'=>date("Y-m-d H:i:s") ) ); 
				if( !$id ){ return array('error'=>1, 'msg'=>"Unable to create new user"); }
			}

			if( $first_name ){ 
				$ex = $this->dbo->get("SELECT * FROM `". TABLE_USERMETA ."` WHERE `user_id`='". $id ."' AND `meta_key`='first_name'"); 
				if( $ex ){ $res = $this->dbo->upd( TABLE_USERMETA, array('meta_value'=>$first_name), array('meta_key'=>'first_name', 'user_id'=>$id) ); }
				else { $res = $this->dbo->ins( TABLE_USERMETA, array('user_id'=>$id, 'meta_key'=>"first_name", 'meta_value'=>$first_name) ); } 
				$results['first_name'] = $res; 
			}
			if( $last_name ){ 
				$ex = $this->dbo->get("SELECT * FROM `". TABLE_USERMETA ."` WHERE `user_id`='". $id ."' AND `meta_key`='last_name'"); 
				if( $ex ){ $res = $this->dbo->upd( TABLE_USERMETA, array('meta_value'=>$last_name), array('meta_key'=>'last_name', 'user_id'=>$id ) ); }
				else { $res = $this->dbo->ins( TABLE_USERMETA, array('user_id'=>$id, 'meta_key'=>'last_name', 'meta_value'=>$last_name) ); } 
				$results['last_name'] = $res; 
			} 
			if( $code ){ 
				$ex = $this->dbo->get("SELECT * FROM `". TABLE_USERMETA ."` WHERE `user_id`='". $id ."' AND `meta_key`='". $code ."'"); 
				if( $ex ){ $res = $this->dbo->upd( TABLE_USERMETA, array('meta_value'=>$code), array('meta_key'=>'code', 'user_id'=>$id) ); }
				else { $res = $this->dbo->ins( TABLE_USERMETA, array('user_id'=>$id, 'meta_key'=>'code', 'meta_value'=>$code) ); } 
				$results['code'] = $res; 
			} 

			if( $email ){ 
				$res = $this->dbo->upd( TABLE_USERS, array('user_email'=> $email), array('ID'=>$id) ); 
				$results['email'] = $res; 
			} 
			if( $password ){ 
				$res = $this->dbo->upd( TABLE_USERS, array('user_pass'=> $password), array('ID'=>$id) ); 
				$results['password'] = $res; 
			}

			if( $new_user ){
				$this->auth( array( 'username'=>$email, 'password'=>$password ) );
			}

			return $results; 
		}
//
//===================================
		public function get( $d=array() ){ 
			$cond = array(); 
			$uid = isset( $d['uid'] ) ? App::uid( $d['uid'] ) : ""; 
			if( $uid ){ $cond[] = "`u.`ID`='". $uid ."'"; } 
			$email = isset( $d['email'] ) ? preg_replace( '[^A-Za-z0-9\-\_\.\@]', '', $d['email'] ) : ""; 
			if( $email ){ $cond[] = "u.`user_email`='". $email ."'"; }
			if( $cond ){
				$Q = "SELECT u.* 
						FROM `". TABLE_USERS ."` AS u 
						WHERE ". implode(" AND ", $cond) ." 
						ORDER BY u.`id` DESC 
						LIMIT 1";
				$user = $this->dbo->get( $Q );
				return $user; 
			} 
			return false; 
		}
//
//=================================== 
		public function load( $d=array() ){
			if( ADMIN || MODERATOR ){ 
				$Q = "SELECT u.* 
						FROM `". TABLE_USERS ."` AS u 
						WHERE u.`status` NOT IN (5)  
						ORDER BY u.`status` ASC, 
							u.`id` DESC";
				$users = $this->dbo->load( $Q );
				return $users; 
			}
			return false; 
		}
//
//=================================== 
		public function retrieve( $d=array() ){
			$email = isset( $d['email'] ) ? preg_replace( '[^A-Za-z0-9\-\_\.\@]', '', $d['email'] ) : ""; 
			if( $email ){ 
				$ex = $this->dbo->get("SELECT * FROM `". TABLE_USERS ."` WHERE `user_email`='". $email ."'");  
				if( !$ex ){ return array('error'=>1, 'msg'=>"User not found"); }
				$data = array(
					'email'=> $email, 
					'code'=> md5( "retrieve_". $email ."_". time() ), 
					'status'=> 2
				); 
				$ins = $this->dbo->ins( TABLE_RETRIEVE, $data ); 
				if( $ins ){ 
					$link = 'http://rebuildnormals.online/retrieve/'. $data['code'];
					$headers = "From: support@cairsplan.com\r\n".
							    "Reply-To: support@cairsplan.com\r\n".
							    "Content-Type: text/html; charset=UTF-8\r\n".
							    'X-Mailer: PHP/' . phpversion();
					@mail( $email, "Retrieve account CAIRS-PLAN", 'To retrieve account follow <a href="'. $link .'" terget="_blank">'. $link .'</a>', $headers);
					return $data['code']; 
				} 
				else {
					return array('error'=>1, 'msg'=>"Unable to create retrieve code"); 
				}
			} 
			else {
				return array('error'=>1, 'msg'=>"Incorrect email"); 
			}
		}
//
//=================================== 
		public function check_retrieve( $d=array() ){
			$code = isset( $d['code'] ) ? App::uid( $d['code'] ) : "";  
			if( !$code ){ 
				return false; 
			}
			$ex = $this->dbo->get("SELECT * FROM `". TABLE_RETRIEVE ."` WHERE `code`='". $code ."' AND `status`=2"); 
			return $ex ? $ex['email'] : false; 
		}
//
//=================================== 
		public function chpass( $d=array() ){ 
			$code = isset( $d['code'] ) ? App::uid( $d['code'] ) : "";
			$uid = isset( $d['uid'] ) ? App::uid( $d['uid'] ) : "";
			$p1 = isset( $d['password_1'] ) ? User::password( $d['password_1'] ) : "";
			$p2 = isset( $d['password_2'] ) ? User::password( $d['password_2'] ) : "";
			if( !$uid ){ 
				return array('error'=>1, 'msg'=>"Incorrect user data", 'post'=>$d); 
			} 
			$user = $this->dbo->get("SELECT * FROM `". TABLE_USERS ."` WHERE MD5(`ID`)='". $uid ."'"); 
			if( !$user ){ 
				return array('error'=>2, 'msg'=>"User not found", 'post'=>$d); 
			}
			//(8 char.min, at least one capital letter, number, special char)
			if( !$p1 || !$p2 ){ 
				return array('error'=>3, 'msg'=>"Incorrect password"); 
			} 
			if( $p1 != $p2 ){ 
				return array('error'=>4, 'msg'=>"Password and confirm are not equal"); 
			} 
			$this->dbo->upd( TABLE_RETRIEVE, array('status'=>5), array('code'=>$code) ); 
			
			$upd = $this->dbo->upd( TABLE_USERS, array('user_pass'=>$p1), "`ID`='". $user['ID'] ."'" ); 
			return $upd ? 1 : array('error'=>1, 'msg'=>"DB error"); 
		}
//
//=================================== 

	}
//
//
//