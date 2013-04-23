<?php

class format_swf_ShapeData extends Enum {
	public static function SHDShape1($bounds, $shapes) { return new format_swf_ShapeData("SHDShape1", 0, array($bounds, $shapes)); }
	public static function SHDShape2($bounds, $shapes) { return new format_swf_ShapeData("SHDShape2", 1, array($bounds, $shapes)); }
	public static function SHDShape3($bounds, $shapes) { return new format_swf_ShapeData("SHDShape3", 2, array($bounds, $shapes)); }
	public static function SHDShape4($data) { return new format_swf_ShapeData("SHDShape4", 3, array($data)); }
	public static $__constructors = array(0 => 'SHDShape1', 1 => 'SHDShape2', 2 => 'SHDShape3', 3 => 'SHDShape4');
	}
