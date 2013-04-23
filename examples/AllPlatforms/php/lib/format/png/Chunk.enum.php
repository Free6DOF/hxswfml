<?php

class format_png_Chunk extends Enum {
	public static function CData($b) { return new format_png_Chunk("CData", 2, array($b)); }
	public static $CEnd;
	public static function CHeader($h) { return new format_png_Chunk("CHeader", 1, array($h)); }
	public static function CPalette($b) { return new format_png_Chunk("CPalette", 3, array($b)); }
	public static function CUnknown($id, $data) { return new format_png_Chunk("CUnknown", 4, array($id, $data)); }
	public static $__constructors = array(2 => 'CData', 0 => 'CEnd', 1 => 'CHeader', 3 => 'CPalette', 4 => 'CUnknown');
	}
format_png_Chunk::$CEnd = new format_png_Chunk("CEnd", 0);
