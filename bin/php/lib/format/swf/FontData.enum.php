<?php

class format_swf_FontData extends Enum {
		public static function FDFont1($data) { return new format_swf_FontData("FDFont1", 0, array($data)); }
		public static function FDFont2($hasWideChars, $data) { return new format_swf_FontData("FDFont2", 1, array($hasWideChars, $data)); }
		public static function FDFont3($data) { return new format_swf_FontData("FDFont3", 2, array($data)); }
	}
