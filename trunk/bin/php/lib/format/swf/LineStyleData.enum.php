<?php

class format_swf_LineStyleData extends Enum {
		public static function LS2($data) { return new format_swf_LineStyleData("LS2", 2, array($data)); }
		public static function LSRGB($rgb) { return new format_swf_LineStyleData("LSRGB", 0, array($rgb)); }
		public static function LSRGBA($rgba) { return new format_swf_LineStyleData("LSRGBA", 1, array($rgba)); }
	}
