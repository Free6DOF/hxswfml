<?php

class format_swf_ShapeRecord extends Enum {
		public static function SHRChange($data) { return new format_swf_ShapeRecord("SHRChange", 1, array($data)); }
		public static function SHRCurvedEdge($cdx, $cdy, $adx, $ady) { return new format_swf_ShapeRecord("SHRCurvedEdge", 3, array($cdx, $cdy, $adx, $ady)); }
		public static function SHREdge($dx, $dy) { return new format_swf_ShapeRecord("SHREdge", 2, array($dx, $dy)); }
		public static $SHREnd;
	}
	format_swf_ShapeRecord::$SHREnd = new format_swf_ShapeRecord("SHREnd", 0);
