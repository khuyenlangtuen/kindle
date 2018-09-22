<?php

class SiteHelper {
	const SEO_DELIMITER = '-';


	public static function generateSeoName($str, $object_type = '', $object_id = 0) {
		$d = self::SEO_DELIMITER;

		// Replace umlauts with their basic latin representation
		$chars = array(
				' ' => $d,
				'\'' => '',
				'"' => '',
				'\'' => '',
				'&' => $d.'and'.$d,
				"\xc3\xa5" => 'aa',
				"\xc3\xa4" => 'ae',
				"\xc3\xb6" => 'oe',
				"\xc3\x85" => 'aa',
				"\xc3\x84" => 'ae',
				"\xc3\x96" => 'oe',
		);

		$str = html_entity_decode($str, ENT_QUOTES, 'UTF-8'); // convert html special chars back to original chars
		$str = str_replace(array_keys($chars), $chars, $str);

		if (!empty($str)) {
			// $str = strtr($str, array("\xc3\xa1" => 'a', "\xc3\x81" => 'A', "\xc3\xa0" => 'a', "\xc3\x80" => 'A', "\xc3\xa2" => 'a', "\xc3\x82" => 'A', "\xc3\xa3" => 'a', "\xc3\x83" => 'A', "\xc2\xaa" => 'a', "\xc3\xa7" => 'c', "\xc3\x87" => 'C', "\xc3\xa9" => 'e', "\xc3\x89" => 'E', "\xc3\xa8" => 'e', "\xc3\x88" => 'E', "\xc3\xaa" => 'e', "\xc3\x8a" => 'E', "\xc3\xab" => 'e', "\xc3\x8b" =>'E', "\xc3\xad" => 'i', "\xc3\x8d" => 'I', "\xc3\xac" => 'i', "\xc3\x8c" => 'I', "\xc3\xae" => 'i', "\xc3\x8e" => 'I', "\xc3\xaf" => 'i', "\xc3\x8f" => 'I', "\xc3\xb1" => 'n', "\xc3\x91" => 'N', "\xc3\xb3" => 'o', "\xc3\x93" => 'O', "\xc3\xb2" => 'o', "\xc3\x92" => 'O', "\xc3\xb4" => 'o', "\xc3\x94" => 'O', "\xc3\xb5" => 'o', "\xc3\x95" => 'O', "\xd4\xa5" => 'o', "\xc3\x98" => 'O', "\xc2\xba" => 'o', "\xc3\xb0" => 'o', "\xc3\xba" => 'u', "\xc3\x9a" => 'U', "\xc3\xb9" => 'u', "\xc3\x99" => 'U', "\xc3\xbb" => 'u', "\xc3\x9b" => 'U', "\xc3\xbc" => 'u', "\xc3\x9c" => 'U', "\xc3\xbd" => 'y', "\xc3\x9d" => 'Y', "\xc3\xbf" => 'y', "\xc3\xa6" => 'a', "\xc3\x86" => 'A', "\xc3\x9f" => 's', '?' => '-', '.' => '-', ' ' => '-', '/' => '-', '&' => '-', '(' => '-', ')' => '-', '[' => '-', ']' => '-', '%' => '-', '#' => '-', ',' => '-', ':' => '-'));
			$str = self::url_title($str);

			if (!empty($object_type)) {
				$str .= $d . $object_type . $object_id;
			}

			$str = strtolower($str); // only lower letters
			$str = preg_replace("/($d){2,}/", $d, $str); // replace double (and more) dashes with one dash
			$str = preg_replace("/[^a-z0-9-\.]/", '', $str); // URL can contain latin letters, numbers, dashes and points only

			return trim($str, '-'); // remove trailing dash if exist
		}

		return '';
	}

	public static function  url_title($string, $separator = 'dash', $lowercase = TRUE) {
		if ($separator == 'dash') {
			$connector	= '-';
		} else {
			$connector	= '_';
		}
		if($string=="") return false;
		$string_unicode = 'é,è,ẻ,ẽ,ẹ,ê,ế,ề,ể,ễ,ệ,ý,ỳ,ỷ,ỹ,ỵ,ú,ù,ủ,ũ,ụ,ư,ứ,ừ,ử,ữ,ự,í,ì,ỉ,ĩ,ị,ó,ò,ỏ,õ,ọ,ô,ố,ồ,ổ,ỗ,ộ,ơ,ớ,ờ,ở,ỡ,ợ,á,à,ả,ã,ạ,â,ấ,ầ,ẩ,ẫ,ậ,ă,ắ,ằ,ẳ,ẵ,ặ,đ,É,È,Ẻ,Ẽ,Ẹ,Ê,Ế,Ề,Ể,Ễ,Ệ,Ý,Ỳ,Ỷ,Ỹ,Ỵ,Ú,Ù,Ủ,Ũ,Ụ,Ư,Ứ,Ừ,Ử,Ữ,Ự,Í,Ì,Ỉ,Ĩ,Ị,Ó,Ò,Ỏ,Õ,Ọ,Ô,Ố,Ồ,Ổ,Ỗ,Ộ,Ơ,Ớ,Ờ,Ở,Ỡ,Ợ,Á,À,Ả,Ã,Ạ,Â,Ấ,Ầ,Ẩ,Ẫ,Ậ,Ă,Ắ,Ằ,Ẳ,Ẵ,Ặ,Đ';
		$string_abc =  'e,e,e,e,e,e,e,e,e,e,e,y,y,y,y,y,u,u,u,u,u,u,u,u,u,u,u,i,i,i,i,i,o,o,o,o,o,o,o,o,o,o,o,o,o,o,o,o,o,a,a,a,a,a,a,a,a,a,a,a,a,a,a,a,a,a,d,E,E,E,E,E,E,E,E,E,E,E,Y,Y,Y,Y,Y,U,U,U,U,U,U,U,U,U,U,U,I,I,I,I,I,O,O,O,O,O,O,O,O,O,O,O,O,O,O,O,O,O,A,A,A,A,A,A,A,A,A,A,A,A,A,A,A,A,A,D';
		$string_special = "` ! @ # $ % ^ * \ / ; ' ( ) - = { } [ ] | : , . ? / & < >\"'";
		$string_connector = "&,+,_, ";
		$string_unicode_array = explode(",",$string_unicode);
		$string_abc_array = explode(",",$string_abc);
		$string_special_array = explode(" ",$string_special);
		$string_connector_array = explode(",",$string_connector);
		$string = trim($string);
		$string = str_replace($string_unicode_array, $string_abc_array, $string);
		$string = str_replace($string_special_array, " ", $string);
		$string = str_replace($string_connector_array, $connector, $string);
		$string = preg_replace("/($connector){2,}/", $connector, $string); // replace double (and more) dashes with one dash
		if ($lowercase === TRUE) {
			$string = strtolower($string);
		}
		return $string;
	}
}