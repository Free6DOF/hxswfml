<?php

class format_swf_MorphShapeData extends Enum {
	public static function MSDShape1($data) { return new format_swf_MorphShapeData("MSDShape1", 0, array($data)); }
	public static function MSDShape2($data) { return new format_swf_MorphShapeData("MSDShape2", 1, array($data)); }
	public static $__constructors = array(0 => 'MSDShape1', 1 => 'MSDShape2');
	}
