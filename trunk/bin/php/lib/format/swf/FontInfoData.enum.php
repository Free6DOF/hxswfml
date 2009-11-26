<?php

class format_swf_FontInfoData extends Enum {
		public static function FIDFont1($shiftJIS, $isANSI, $hasWideCodes, $data) { return new format_swf_FontInfoData("FIDFont1", 0, array($shiftJIS, $isANSI, $hasWideCodes, $data)); }
		public static function FIDFont2($language, $data) { return new format_swf_FontInfoData("FIDFont2", 1, array($language, $data)); }
	}
