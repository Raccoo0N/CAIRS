<?php 
	class Clean {
//
//======================================================
		private static function _prepare( $value ){
			$value = strval($value);
			$value = stripslashes($value);
			$value = str_ireplace(array("\0", "\a", "\b", "\v", "\e", "\f"), ' ', $value);
			$value = htmlspecialchars_decode($value, ENT_QUOTES);	
			return $value;
		}
//
//======================================================
		public static function bool( $value, $default = 0 ){
			$value = self::_prepare($value);
			$value = mb_ereg_replace('[\s]', '', $value);
			$value = str_ireplace(array('-', '+', 'false', 'null', 'off'), '', $value);
			return (empty($value)) ? $default : 1;
		}
//
//======================================================
		public static function boolArray( $value, $default = 0 ){
			$res = array();
			foreach ((array) $value as $row) {
				$res[] = self::bool($row, $default);
			}
			return $res;
		}
//
//======================================================
		public static function boolList( $value, $default = 0, $separator = ',' ){
			return implode($separator, self::boolArray($value, $default));		
		}
//
//======================================================
		public static function int( $value, $default = 0 ){
			$value = self::_prepare($value);
			$value = mb_ereg_replace('[\s]', '', $value);	
			$value = abs(intval($value));
			return (empty($value)) ? $default : $value;
		}
//
//======================================================
		public static function intArray( $value, $default = 0 ){
			$res = array();
			foreach ((array) $value as $row) {
				$res[] = self::int($row, $default);
			}
			return $res;
		} 
//
//======================================================
		public static function intList( $value, $default = 0, $separator = ',' ){
			return implode($separator, self::intArray($value, $default));
		}
//
//======================================================
		public static function float( $value, $default = 0 ){
			$value = self::_prepare($value);
			$value = mb_ereg_replace('[\s]', '', $value);	
			$value = str_replace(',', '.', $value);
			$value = floatval($value);
			return (empty($value)) ? $default : $value;
		}
//
//======================================================
		public static function floatArray( $value, $default = 0 ){
			$res = array();
			foreach ((array) $value as $row) {
				$res[] = self::float($row, $default);
			}
			return $res;
		}	
//
//======================================================
		public static function floatList( $value, $default = 0, $separator = ',' ){
			return implode($separator, self::floatArray($value, $default));
		} 
//
//======================================================
		public static function price( $value, $default = 0 ){
			$value = self::_prepare($value);
			$value = mb_ereg_replace('[^0-9\.,]', '', $value);	
			$value = mb_ereg_replace('[,]+', ',', $value);	
			$value = mb_ereg_replace('[.]+', '.', $value);			
			$pos_1 = mb_strpos($value, '.');
			$pos_2 = mb_strpos($value, ',');		
			if ($pos_1 && $pos_2) {
				$value = mb_substr($value . '00', 0, $pos_1 + 3);
				$value = str_replace(',', '', $value);
			} 
			elseif ($pos_1) {
				$value = mb_substr($value . '00', 0, $pos_1 + 3);
			} 
			elseif ($pos_2) {
				if ((mb_strlen($value) - $pos_2) == 3) {
					$value = str_replace(',', '.', $value);
				} 
				else {
					$value = str_replace(',', '', $value) . '.00';
				}
			} 
			elseif (mb_strlen($value) == 0) {
				return $default;
			} 
			else {
				$value = $value . '.00';
			}
			return ($value == '0.00') ? 0 : $value;
		}
//
//======================================================
		public static function priceArray( $value, $default = 0 ){
			$res = array();
			foreach ((array) $value as $row) {
				$res[] = self::price($row, $default);
			}
			return $res;
		} 
//
//======================================================
		public static function priceList( $value, $default = 0, $separator = ',' ){
			return implode($separator, self::priceArray($value, $default));
		} 
//
//======================================================
		public static function text( $value, $default = '' ){
			$value = self::_prepare($value);
			$value = str_ireplace(array("\t"), ' ', $value);			
			$value = preg_replace(array(
				'@<\!--.*?-->@s',
				'@\/\*(.*?)\*\/@sm',
				'@<([\?\%]) .*? \\1>@sx',
				'@<\!\[CDATA\[.*?\]\]>@sx',
				'@<\!\[.*?\]>.*?<\!\[.*?\]>@sx',	
				'@\s--.*@',
				'@<script[^>]*?>.*?</script>@si',
				'@<style[^>]*?>.*?</style>@siU', 
				'@<[\/\!]*?[^<>]*?>@si',			
			), ' ', $value);		
			$value = strip_tags($value); 		
			$value = str_replace(array('/*', '*/', ' --', '#__'), ' ', $value); 
			$value = preg_replace('/[ ]+/', ' ', $value);			
			$value = trim($value);
			$value = htmlspecialchars($value, ENT_QUOTES);	
			return (strlen($value) == 0) ? $default : $value;
		}
//
//======================================================
		public static function textArray( $value, $default = '' ){
			$res = array();
			foreach ((array) $value as $row) {
				$res[] = self::text($row, $default);
			}
			return $res;
		}
//
//======================================================
		public static function textList ($value, $default = '', $separator = ',' ){
			return implode($separator, self::textArray($value, $default));
		}
//
//======================================================
		public static function str( $value, $default = '' ){
			$value = self::text($value);
			$value = str_ireplace(array("\r", "\n"), ' ', $value);
			$value = mb_ereg_replace('[\s]+', ' ', $value);			
			$value = trim($value);
			return (mb_strlen($value) == 0) ? $default : $value;
		}
//
//======================================================
		public static function strArray( $value, $default = '' ){
			$res = array();
			foreach ((array) $value as $row) {
				$res[] = self::str($row, $default);
			}
			return $res;
		} 
//
//======================================================
		public static function strList( $value, $default = '', $separator = ',' ){
			return implode($separator, self::strArray($value, $default));
		}
//
//======================================================
		public static function html( $value, $default = '' ){
			$value = self::_prepare($value);
			$value = mb_ereg_replace('[ ]+', ' ', $value);
			$value = trim($value);		
			$value = addslashes($value);
			return (mb_strlen($value) == 0) ? $default : $value;
		} 	
//
//======================================================
		public static function htmlArray( $value, $default = '' ){
			$res = array();
			foreach ((array) $value as $row) {
				$res[] = self::html($row, $default);
			}
			return $res;
		}
//
//======================================================
		public static function sef( $value, $default = '' ){
			$value = self::str($value, '');
			if (empty($value)) {
				$value = $default;
			}
			$value = mb_strtolower($value);	
			$converter = array(
				'а' => 'a',   'б' => 'b',   'в' => 'v',   'г' => 'g',   'д' => 'd',   'е' => 'e',
				'ё' => 'e',   'ж' => 'zh',  'з' => 'z',   'и' => 'i',   'й' => 'y',   'к' => 'k',
				'л' => 'l',   'м' => 'm',   'н' => 'n',   'о' => 'o',   'п' => 'p',   'р' => 'r',
				'с' => 's',   'т' => 't',   'у' => 'u',   'ф' => 'f',   'х' => 'h',   'ц' => 'c',
				'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch', 'ь' => '',    'ы' => 'y',   'ъ' => '',
				'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
			);
			$value = strtr($value, $converter);
			$value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
			$value = mb_ereg_replace('[-]+', '-', $value);
			$value = trim($value, '-');			
			return $value;
		}
//
//======================================================
		public static function sefArray( $value, $default = '' ){
			$res = array();
			foreach ((array) $value as $row) {
				$res[] = self::sef($row, $default);
			}
			return $res;
		}
//
//======================================================
		public static function sefList( $value, $default = '', $separator = ',' ){
			return implode($separator, self::sefArray($value, $default));
		}
//
//======================================================
		public static function filename( $value, $default = '' ){
			$value = self::str($value, $default);
			$value = str_replace(array('/', '|', '\\', '?', ':', ';', '\'', '"', '<', '>', '*'), '', $value);
			$value = mb_ereg_replace('[.]+', '.', $value);
			return (mb_strlen($value) == 0) ? $default : $value;
		} 
//
//======================================================
		public static function filenameArray( $value, $default = '' ){
			$res = array();
			foreach ((array) $value as $row) {
				$res[] = self::filename($row, $default);
			}
			return $res;
		} 
//
//======================================================
		public static function filenameList( $value, $default = '', $separator = ',' ){
			return implode($separator, self::filenameArray($value, $default));
		} 
//
//======================================================
		public static function time( $value, $default = 0 ){
			$value = self::str($value, $default);
			$value = strtotime($value);
			return (empty($value)) ? $default : $value;
		}
//
//======================================================
		public static function timeArray( $value, $default = 0 ){
			$res = array();
			foreach ((array) $value as $row) {
				$res[] = self::time($row, $default);
			}
			return $res;
		} 
//
//======================================================
		public static function timeList( $value, $default = 0, $separator = ',' ){
			return implode($separator, self::timeArray($value, $default));
		}
	}



?>