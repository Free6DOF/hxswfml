<?php

class format_swf_FillStyle extends Enum {
	public static function FSBitmap($cid, $mat, $repeat, $smooth) { return new format_swf_FillStyle("FSBitmap", 5, array($cid, $mat, $repeat, $smooth)); }
	public static function FSFocalGradient($mat, $grad) { return new format_swf_FillStyle("FSFocalGradient", 4, array($mat, $grad)); }
	public static function FSLinearGradient($mat, $grad) { return new format_swf_FillStyle("FSLinearGradient", 2, array($mat, $grad)); }
	public static function FSRadialGradient($mat, $grad) { return new format_swf_FillStyle("FSRadialGradient", 3, array($mat, $grad)); }
	public static function FSSolid($rgb) { return new format_swf_FillStyle("FSSolid", 0, array($rgb)); }
	public static function FSSolidAlpha($rgb) { return new format_swf_FillStyle("FSSolidAlpha", 1, array($rgb)); }
	public static $__constructors = array(5 => 'FSBitmap', 4 => 'FSFocalGradient', 2 => 'FSLinearGradient', 3 => 'FSRadialGradient', 0 => 'FSSolid', 1 => 'FSSolidAlpha');
	}
