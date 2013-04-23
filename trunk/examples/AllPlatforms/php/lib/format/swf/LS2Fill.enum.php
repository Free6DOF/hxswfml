<?php

class format_swf_LS2Fill extends Enum {
	public static function LS2FColor($color) { return new format_swf_LS2Fill("LS2FColor", 0, array($color)); }
	public static function LS2FStyle($style) { return new format_swf_LS2Fill("LS2FStyle", 1, array($style)); }
	public static $__constructors = array(0 => 'LS2FColor', 1 => 'LS2FStyle');
	}
