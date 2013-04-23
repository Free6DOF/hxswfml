<?php

class format_ttf_CmapSubTable extends Enum {
	public static function Cmap0($header, $glyphIndexArray) { return new format_ttf_CmapSubTable("Cmap0", 0, array($header, $glyphIndexArray)); }
	public static function Cmap10($header, $glyphIndexArray, $startCharCode, $numChars) { return new format_ttf_CmapSubTable("Cmap10", 5, array($header, $glyphIndexArray, $startCharCode, $numChars)); }
	public static function Cmap12($header, $groups) { return new format_ttf_CmapSubTable("Cmap12", 6, array($header, $groups)); }
	public static function Cmap2($header, $glyphIndexArray, $subHeaderKeys, $subHeaders) { return new format_ttf_CmapSubTable("Cmap2", 1, array($header, $glyphIndexArray, $subHeaderKeys, $subHeaders)); }
	public static function Cmap4($header, $glyphIndexArray) { return new format_ttf_CmapSubTable("Cmap4", 2, array($header, $glyphIndexArray)); }
	public static function Cmap6($header, $glyphIndexArray, $firstCode) { return new format_ttf_CmapSubTable("Cmap6", 3, array($header, $glyphIndexArray, $firstCode)); }
	public static function Cmap8($header, $groups, $is32) { return new format_ttf_CmapSubTable("Cmap8", 4, array($header, $groups, $is32)); }
	public static function CmapUnk($header, $bytes) { return new format_ttf_CmapSubTable("CmapUnk", 7, array($header, $bytes)); }
	public static $__constructors = array(0 => 'Cmap0', 5 => 'Cmap10', 6 => 'Cmap12', 1 => 'Cmap2', 2 => 'Cmap4', 3 => 'Cmap6', 4 => 'Cmap8', 7 => 'CmapUnk');
	}
