<?php

class format_png_Color extends Enum {
	public static function ColGrey($alpha) { return new format_png_Color("ColGrey", 0, array($alpha)); }
	public static $ColIndexed;
	public static function ColTrue($alpha) { return new format_png_Color("ColTrue", 1, array($alpha)); }
	public static $__constructors = array(0 => 'ColGrey', 2 => 'ColIndexed', 1 => 'ColTrue');
	}
format_png_Color::$ColIndexed = new format_png_Color("ColIndexed", 2);
