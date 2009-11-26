<?php

class format_swf_Morph2LineStyle extends Enum {
		public static function M2LSFill($fill, $data) { return new format_swf_Morph2LineStyle("M2LSFill", 1, array($fill, $data)); }
		public static function M2LSNoFill($startColor, $endColor, $data) { return new format_swf_Morph2LineStyle("M2LSNoFill", 0, array($startColor, $endColor, $data)); }
	}
