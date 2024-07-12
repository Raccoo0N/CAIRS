<?php
// 
//
// 
	class Parameters extends Singleton { 
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
			$cond = array(); 
			$id = isset( $d['id'] ) ? (int)$d['id'] : ""; 
			if( $id ){ $cond['id'] = $id;  } 
			$data = array(); 
			$name = isset( $d['name'] ) ? App::text( $d['name'] ) : ""; 
			if( $name ){ $data['name'] = $name; }
			$tunnel_inner_diameter = isset( $d['tunnel_inner_diameter'] ) ? (float)$d['tunnel_inner_diameter'] : 0;  
			if( $tunnel_inner_diameter ){ $data['tunnel_inner_diameter'] = $tunnel_inner_diameter; }
			$tunnel_outer_diameter = isset( $d['tunnel_outer_diameter'] ) ? (float)$d['tunnel_outer_diameter'] : 0; 
			if( $tunnel_outer_diameter ){ $data['tunnel_outer_diameter'] = $tunnel_outer_diameter; }
			$tunnel_depth = isset( $d['tunnel_depth'] ) ? (float)$d['tunnel_depth'] : 0; 
			if( $tunnel_depth ){ $data['tunnel_depth'] = $tunnel_depth; }
			$donor_cut_1_diameter = isset( $d['donor_cut_1_diameter'] ) ? (float)$d['donor_cut_1_diameter'] : 0; 
			if( $donor_cut_1_diameter ){ $data['donor_cut_1_diameter'] = $donor_cut_1_diameter; }
			$donor_cut_1_depth = isset( $d['donor_cut_1_depth'] ) ? (float)$d['donor_cut_1_depth'] : 0; 
			if( $donor_cut_1_depth ){ $data['donor_cut_1_depth'] = $donor_cut_1_depth; }
			$donor_cut_2_diameter = isset( $d['donor_cut_2_diameter'] ) ? (float)$d['donor_cut_2_diameter'] : 0; 
			if( $donor_cut_2_diameter ){ $data['donor_cut_2_diameter'] = $donor_cut_2_diameter; }
			$donor_cut_2_depth = isset( $d['donor_cut_2_depth'] ) ? (float)$d['donor_cut_2_depth'] : 0; 
			if( $donor_cut_2_depth ){ $data['donor_cut_2_depth'] = $donor_cut_2_depth; }
			$segment_width = isset( $d['segment_width'] ) ? (float)$d['segment_width'] : 0; 
			if( $segment_width ){ $data['segment_width'] = $segment_width; }
			$segment_depth = isset( $d['segment_depth'] ) ? (float)$d['segment_depth'] : 0; 
			if( $segment_depth ){ $data['segment_depth'] = $segment_depth; } 
			$status = isset( $d['status'] ) ? (int)$d['status'] : 0; 
			if( $status ){ $data['status'] = $status; }
			if( $data ){ 
				if( $id ){ 
					$ex = $this->dbo->get("SELECT * FROM `". TABLE_PARAMETERS ."` WHERE `id`='". $id ."' AND `uid`='". UID ."'"); 
					if( $ex ){ 
						$upd = $this->dbo->upd( TABLE_PARAMETERS, $data, $cond ); 
						return $upd; 
					} 
					else {
						return array('error'=>1, 'msg'=>"Parameters not found or user are not parameters owner"); 
					}
				} 
				else {
					$data['uid'] = UID; 
					$data['status'] = 2; 
					$ins = $this->dbo->ins( TABLE_PARAMETERS, $data ); 
					return $ins; 
				} 
			}
			return array('error'=>1, 'msg'=>"Wrong data format"); 
		}
//
//===================================
		public function get( $d=array() ){
			$cond = array(  ); 
			$id = isset( $d['id'] ) ? (int)$d['id'] : 0; 
			if( $id ){ $cond[] = "p.`id`='". $id ."'"; }
			$uid = ADMIN ? ( isset( $d['uid'] ) ? (int)$d['uid'] : 0 ) : UID; 
			if( $uid ){ $cond[] = "p.`uid`='". $uid ."'"; }
			$status = isset( $d['status'] ) ? (int)$d['status'] : 2; 
			if( $status ){ $cond[] = "p.`status`='". $status ."'"; }
			$Q = "SELECT p.* 
					FROM `". TABLE_PARAMETERS ."` AS p  
					WHERE ". implode(" AND ", $cond) ."
					LIMIT 1"; 
			$params = $this->dbo->get($Q);
			return $params;  
		}
//
//=================================== 
		public function load( $d=array() ){ 
			$cond = array( 
				"p.`uid`='". ( ADMIN ?( isset( $d['uid'] ) ? (int)$d['uid'] : 0 ) : UID ) ."'", 
				"p.`status`='". ( isset( $d['status'] ) ? (int)$d['status'] : 2 ) ."'"  
			); 
			$Q = "SELECT p.* 
					FROM `". TABLE_PARAMETERS ."` AS p  
					WHERE ". implode(" AND ", $cond) ." 
					ORDER BY p.`id` ASC"; 
			//var_dump( $Q );
			$params = $this->dbo->load($Q);
			return $params; 
		}
//
//=================================== 

	}
//
//
//