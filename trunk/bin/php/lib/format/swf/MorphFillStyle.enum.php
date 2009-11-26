<?php

class format_swf_MorphFillStyle extends Enum {
		public static function MFSBitmap($cid, $startMatrix, $endMatrix, $repeat, $smooth) { return new format_swf_MorphFillStyle("MFSBitmap", 3, array($cid, $startMatrix, $endMatrix, $repeat, $smooth)); }
		public static function MFSLinearGradient($startMatrix, $endMatrix, $gradients) { return new format_swf_MorphFillStyle("MFSLinearGradient", 1, array($startMatrix, $endMatrix, $gradients)); }
		public static function MFSRadialGradient($startMatrix, $endMatrix, $gradients) { return new format_swf_MorphFillStyle("MFSRadialGradient", 2, array($startMatrix, $endMatrix, $gradients)); }
		public static function MFSSolid($startColor, $endColor) { return new format_swf_MorphFillStyle("MFSSolid", 0, array($startColor, $endColor)); }
	}
