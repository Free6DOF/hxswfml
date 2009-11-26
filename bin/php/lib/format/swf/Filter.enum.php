<?php

class format_swf_Filter extends Enum {
		public static function FBevel($data) { return new format_swf_Filter("FBevel", 3, array($data)); }
		public static function FBlur($data) { return new format_swf_Filter("FBlur", 1, array($data)); }
		public static function FColorMatrix($data) { return new format_swf_Filter("FColorMatrix", 5, array($data)); }
		public static function FDropShadow($data) { return new format_swf_Filter("FDropShadow", 0, array($data)); }
		public static function FGlow($data) { return new format_swf_Filter("FGlow", 2, array($data)); }
		public static function FGradientBevel($data) { return new format_swf_Filter("FGradientBevel", 6, array($data)); }
		public static function FGradientGlow($data) { return new format_swf_Filter("FGradientGlow", 4, array($data)); }
	}
