<?php

class format_ttf_Platform extends Enum {
	public static function Macintosh($enc) { return new format_ttf_Platform("Macintosh", 1, array($enc)); }
	public static function Microsoft($enc) { return new format_ttf_Platform("Microsoft", 3, array($enc)); }
	public static $Reserved;
	public static function Unicode($enc) { return new format_ttf_Platform("Unicode", 0, array($enc)); }
	public static $__constructors = array(1 => 'Macintosh', 3 => 'Microsoft', 2 => 'Reserved', 0 => 'Unicode');
	}
format_ttf_Platform::$Reserved = new format_ttf_Platform("Reserved", 2);
