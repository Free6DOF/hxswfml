<?php

class format_swf_FontData extends Enum {
	public static function FDFont1($data) { return new format_swf_FontData("FDFont1", 0, array($data)); }
	public static function FDFont2($hasWideChars, $data) { return new format_swf_FontData("FDFont2", 1, array($hasWideChars, $data)); }
	public static function FDFont3($data) { return new format_swf_FontData("FDFont3", 2, array($data)); }
	public static function FDFont4($data) { return new format_swf_FontData("FDFont4", 3, array($data)); }
	public static $__constructors = array(0 => 'FDFont1', 1 => 'FDFont2', 2 => 'FDFont3', 3 => 'FDFont4');
	}
