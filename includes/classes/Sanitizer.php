<?php
class Sanitizer {
	public static function sanitize_for_db($string) {
		return Database::getInstance()->real_escape_string($string);
	}
}
?>