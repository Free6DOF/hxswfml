<?php

class format_flv_Data extends Enum {
	public static function FLVAudio($data, $time) { return new format_flv_Data("FLVAudio", 0, array($data, $time)); }
	public static function FLVMeta($data, $time) { return new format_flv_Data("FLVMeta", 2, array($data, $time)); }
	public static function FLVVideo($data, $time) { return new format_flv_Data("FLVVideo", 1, array($data, $time)); }
	public static $__constructors = array(0 => 'FLVAudio', 2 => 'FLVMeta', 1 => 'FLVVideo');
	}
