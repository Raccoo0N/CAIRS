<?php
// 
//
// 
	class Plan extends Singleton { 
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
		public function edit( $d=array() ){ 
			$data = array(); 
			$cond = array(); 

			$id = isset( $d['id'] ) ? (int)$d['id'] : 0; 
			if( $id ){ $cond['id'] = $id; }
			$uid = ADMIN ? ( isset( $d['uid'] ) ? (int)$d['uid'] : 0 ) : UID; 
			if( $uid ){ 
				$cond['uid'] = $uid; 
				$data['uid'] = $uid; 
			}

			$parameters_id = isset( $d['parameters_id'] ) ? (int)$d['parameters_id'] : 0; 
			if( $parameters_id ){ $data['parameters_id'] = $parameters_id; } 
			$name = isset( $d['name'] ) ? App::text( $d['name'] ) : ""; 
			if( $name ){ $data['name'] = $name; } 
			$settings = isset( $d['settings'] ) ? json_encode( json_decode( $d['settings'], 1, 1024 ) ) : ""; 
			if( $settings ){ $data['settings'] = $settings; } 
			$status = isset( $d['status'] ) ? (int)$d['status'] : 0; 
			if( $status ){ $data['status'] = $status; } 

			if( $id ){
				$ex = $this->dbo->get("SELECT * FROM `". TABLE_PLAN ."` WHERE `id`='". $id ."' AND `uid`='". UID ."'"); 
				if( $ex ){
					$upd = $this->dbo->upd( TABLE_PLAN, $data, $cond ); 
					return $upd; 
				} 
				else { return array('error'=>1, 'msg'=>"Saved plan not found or user are not plans owner"); }
			}
			else {
				$data['uid'] = $uid ? $uid : UID; 
				$data['status'] = 2;   

				$params = isset( $d['params'] ) ? $d['params'] : array(); 
				if( $params ){
					$params['uid'] = $uid; 
					$PARAMS = Parameters::getInstance(); 
					$parameters_id = $PARAMS->edit( $params ); 
					if( $parameters_id ){ $data['parameters_id'] = $parameters_id; } 
				}

				$ins = $this->dbo->ins( TABLE_PLAN, $data ); 
				return $ins;
			}
		}
//
//===================================
		public function get( $d=array() ){
			$cond = array(); 
			$id = isset( $d['id'] ) ? (int)$d['id'] : 0; 
			if( $id ){ $cond[] = "`id`='". $id ."'"; } 
			if( $cond ){ 
				$Q = "SELECT * 
						FROM `". TABLE_PLAN ."` 
						WHERE ". implode(" AND ", $cond) ." 
						ORDER BY `id` DESC 
						LIMIT 1"; 
				$plan = $this->dbo->get($Q); 
				if( $plan ){
					//if( ADMIN || $plan['uid'] == UID ) { 
						$Q = "SELECT * 
								FROM `". TABLE_PARAMETERS ."` 
								WHERE `id`='". $plan['parameters_id'] ."' 
									AND `status`=2 
								ORDER BY `id` DESC 
								LIMIT 1"; 
						$plan['parameters'] = $this->dbo->get($Q); 
					//}
					//else { return array(); }
				}
				return $plan;
			}
			return false; 
		}
//
//=================================== 
		public function load( $d=array() ){
			$cond = array(); 
			$uid = ADMIN ? ( isset( $d['uid'] ) ? (int)$d['uid'] : 0 ) : UID; 
			if( $uid ){ $cond[] = "`uid`='". $uid ."'"; } 
			$status = isset( $d['status'] ) ? (int)$d['status'] : 0; 
			if( $status ){ $cond[] = "`status`='". $status ."'"; }
			if( $cond ){
				$Q = "SELECT * 
						FROM `". TABLE_PLAN ."` 
						WHERE ". implode(" AND ", $cond) ." 
						ORDER BY `id` ASC"; 
				$plans = $this->dbo->load($Q); 
				if( $plans ){
					foreach( $plans as &$row ){
						$Q = "SELECT * 
								FROM `". TABLE_PARAMETERS ."` 
								WHERE `id`='". $row['parameters_id'] ."' 
									AND `status`=2 
								ORDER BY `id` DESC 
								LIMIT 1";
						$row['parameters'] = $this->dbo->get($Q);
					}
				}
				return $plans; 
			}
			return false; 
		}
//
//=================================== 

	}
//
//
//