<?php

class format_swf_ColorModel extends Enum {
	public static $CM15Bits;
	public static $CM24Bits;
	public static $CM32Bits;
	public static function CM8Bits($ncolors) { return new format_swf_ColorModel("CM8Bits", 0, array($ncolors)); }
	public static $__constructors = array(1 => 'CM15Bits', 2 => 'CM24Bits', 3 => 'CM32Bits', 0 => 'CM8Bits');
	}
format_swf_ColorModel::$CM15Bits = new format_swf_ColorModel("CM15Bits", 1);
format_swf_ColorModel::$CM24Bits = new format_swf_ColorModel("CM24Bits", 2);
format_swf_ColorModel::$CM32Bits = new format_swf_ColorModel("CM32Bits", 3);
