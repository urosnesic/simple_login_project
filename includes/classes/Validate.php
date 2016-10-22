<?php
class Validate {

	public static function presence($items = array()) {
		foreach ($items as $item) {
			if (!isset($item) || $item === "") {
				return false;
			} 
		}
		return true;			
	}

	public static function is_it_equal($first, $second) {
		if ($first === $second) {
			return true;
		} else {
			return false;
		}
	}

	public static function min_length($item) {
		if ($item == $_POST['password']) {
			if (strlen($item) >= 8) {
				return true;
			} else {
				return false;
			}
		}
	}

	public static function max_length($item) {
		if ($item == $_POST['username']) {
			if (strlen(trim($item)) <= 20) {
				return true;
			} else {
				return false;
			}
		}
	}

}

?>