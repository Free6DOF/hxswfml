<?php

class format_swf_SWFTag extends Enum {
		public static function TActionScript3($data, $context = null) { return new format_swf_SWFTag("TActionScript3", 13, array($data, $context)); }
		public static function TBackgroundColor($color) { return new format_swf_SWFTag("TBackgroundColor", 6, array($color)); }
		public static function TBinaryData($id, $data) { return new format_swf_SWFTag("TBinaryData", 21, array($id, $data)); }
		public static function TBitsJPEG($id, $data) { return new format_swf_SWFTag("TBitsJPEG", 19, array($id, $data)); }
		public static function TBitsLossless($data) { return new format_swf_SWFTag("TBitsLossless", 17, array($data)); }
		public static function TBitsLossless2($data) { return new format_swf_SWFTag("TBitsLossless2", 18, array($data)); }
		public static function TClip($id, $frames, $tags) { return new format_swf_SWFTag("TClip", 7, array($id, $frames, $tags)); }
		public static function TDefineButton2($id, $records) { return new format_swf_SWFTag("TDefineButton2", 26, array($id, $records)); }
		public static function TDefineEditText($id, $data) { return new format_swf_SWFTag("TDefineEditText", 27, array($id, $data)); }
		public static function TDefineScalingGrid($id, $splitter) { return new format_swf_SWFTag("TDefineScalingGrid", 29, array($id, $splitter)); }
		public static function TDoAction($data) { return new format_swf_SWFTag("TDoAction", 24, array($data)); }
		public static function TDoInitActions($id, $data) { return new format_swf_SWFTag("TDoInitActions", 12, array($id, $data)); }
		public static $TEnd;
		public static function TExportAssets($symbols) { return new format_swf_SWFTag("TExportAssets", 15, array($symbols)); }
		public static function TFont($id, $data) { return new format_swf_SWFTag("TFont", 4, array($id, $data)); }
		public static function TFontInfo($id, $data) { return new format_swf_SWFTag("TFontInfo", 5, array($id, $data)); }
		public static function TFrameLabel($label, $anchor) { return new format_swf_SWFTag("TFrameLabel", 11, array($label, $anchor)); }
		public static function TJPEGTables($data) { return new format_swf_SWFTag("TJPEGTables", 20, array($data)); }
		public static function TMetadata($data) { return new format_swf_SWFTag("TMetadata", 28, array($data)); }
		public static function TMorphShape($id, $data) { return new format_swf_SWFTag("TMorphShape", 3, array($id, $data)); }
		public static function TPlaceObject2($po) { return new format_swf_SWFTag("TPlaceObject2", 8, array($po)); }
		public static function TPlaceObject3($po) { return new format_swf_SWFTag("TPlaceObject3", 9, array($po)); }
		public static function TRemoveObject2($depth) { return new format_swf_SWFTag("TRemoveObject2", 10, array($depth)); }
		public static function TSandBox($v) { return new format_swf_SWFTag("TSandBox", 16, array($v)); }
		public static function TScriptLimits($maxRecursion, $timeoutSeconds) { return new format_swf_SWFTag("TScriptLimits", 25, array($maxRecursion, $timeoutSeconds)); }
		public static function TShape($id, $data) { return new format_swf_SWFTag("TShape", 2, array($id, $data)); }
		public static $TShowFrame;
		public static function TSound($data) { return new format_swf_SWFTag("TSound", 22, array($data)); }
		public static function TStartSound($id, $soundInfo) { return new format_swf_SWFTag("TStartSound", 23, array($id, $soundInfo)); }
		public static function TSymbolClass($symbols) { return new format_swf_SWFTag("TSymbolClass", 14, array($symbols)); }
		public static function TUnknown($id, $data) { return new format_swf_SWFTag("TUnknown", 30, array($id, $data)); }
	}
	format_swf_SWFTag::$TEnd = new format_swf_SWFTag("TEnd", 1);
	format_swf_SWFTag::$TShowFrame = new format_swf_SWFTag("TShowFrame", 0);
