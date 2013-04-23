<?php

class format_swf_JPEGData extends Enum {
	public static function JDJPEG1($data) { return new format_swf_JPEGData("JDJPEG1", 0, array($data)); }
	public static function JDJPEG2($data) { return new format_swf_JPEGData("JDJPEG2", 1, array($data)); }
	public static function JDJPEG3($data, $mask) { return new format_swf_JPEGData("JDJPEG3", 2, array($data, $mask)); }
	public static $__constructors = array(0 => 'JDJPEG1', 1 => 'JDJPEG2', 2 => 'JDJPEG3');
	}
