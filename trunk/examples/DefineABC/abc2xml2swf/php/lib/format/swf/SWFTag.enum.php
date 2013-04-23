<?php

class format_swf_SWFTag extends Enum {
	public static function TActionScript3($data, $context = null) { return new format_swf_SWFTag("TActionScript3", 13, array($data, $context)); }
	public static function TBackgroundColor($color) { return new format_swf_SWFTag("TBackgroundColor", 6, array($color)); }
	public static function TBinaryData($id, $data) { return new format_swf_SWFTag("TBinaryData", 22, array($id, $data)); }
	public static function TBitsJPEG($id, $data) { return new format_swf_SWFTag("TBitsJPEG", 20, array($id, $data)); }
	public static function TBitsLossless($data) { return new format_swf_SWFTag("TBitsLossless", 18, array($data)); }
	public static function TBitsLossless2($data) { return new format_swf_SWFTag("TBitsLossless2", 19, array($data)); }
	public static function TClip($id, $frames, $tags) { return new format_swf_SWFTag("TClip", 7, array($id, $frames, $tags)); }
	public static function TDefineButton2($id, $records) { return new format_swf_SWFTag("TDefineButton2", 31, array($id, $records)); }
	public static function TDefineEditText($id, $data) { return new format_swf_SWFTag("TDefineEditText", 32, array($id, $data)); }
	public static function TDefineScalingGrid($id, $splitter) { return new format_swf_SWFTag("TDefineScalingGrid", 34, array($id, $splitter)); }
	public static function TDefineVideoFrame($id, $frameNum, $data) { return new format_swf_SWFTag("TDefineVideoFrame", 27, array($id, $frameNum, $data)); }
	public static function TDefineVideoStream($id, $data) { return new format_swf_SWFTag("TDefineVideoStream", 26, array($id, $data)); }
	public static function TDoAction($data) { return new format_swf_SWFTag("TDoAction", 29, array($data)); }
	public static function TDoInitActions($id, $data) { return new format_swf_SWFTag("TDoInitActions", 12, array($id, $data)); }
	public static $TEnd;
	public static function TExportAssets($symbols) { return new format_swf_SWFTag("TExportAssets", 16, array($symbols)); }
	public static function TFont($id, $data) { return new format_swf_SWFTag("TFont", 4, array($id, $data)); }
	public static function TFontInfo($id, $data) { return new format_swf_SWFTag("TFontInfo", 5, array($id, $data)); }
	public static function TFrameLabel($label, $anchor) { return new format_swf_SWFTag("TFrameLabel", 11, array($label, $anchor)); }
	public static function TImportAssets($url) { return new format_swf_SWFTag("TImportAssets", 15, array($url)); }
	public static function TJPEGTables($data) { return new format_swf_SWFTag("TJPEGTables", 21, array($data)); }
	public static function TMetadata($data) { return new format_swf_SWFTag("TMetadata", 33, array($data)); }
	public static function TMorphShape($id, $data) { return new format_swf_SWFTag("TMorphShape", 3, array($id, $data)); }
	public static function TPlaceObject2($po) { return new format_swf_SWFTag("TPlaceObject2", 8, array($po)); }
	public static function TPlaceObject3($po) { return new format_swf_SWFTag("TPlaceObject3", 9, array($po)); }
	public static function TRemoveObject2($depth) { return new format_swf_SWFTag("TRemoveObject2", 10, array($depth)); }
	public static function TSandBox($v) { return new format_swf_SWFTag("TSandBox", 17, array($v)); }
	public static function TScriptLimits($maxRecursion, $timeoutSeconds) { return new format_swf_SWFTag("TScriptLimits", 30, array($maxRecursion, $timeoutSeconds)); }
	public static function TShape($id, $data) { return new format_swf_SWFTag("TShape", 2, array($id, $data)); }
	public static $TShowFrame;
	public static function TSound($data) { return new format_swf_SWFTag("TSound", 23, array($data)); }
	public static function TSoundStreamBlock($samplesCount, $seekSamples, $data) { return new format_swf_SWFTag("TSoundStreamBlock", 24, array($samplesCount, $seekSamples, $data)); }
	public static function TSoundStreamHead2($data) { return new format_swf_SWFTag("TSoundStreamHead2", 25, array($data)); }
	public static function TStartSound($id, $soundInfo) { return new format_swf_SWFTag("TStartSound", 28, array($id, $soundInfo)); }
	public static function TSymbolClass($symbols) { return new format_swf_SWFTag("TSymbolClass", 14, array($symbols)); }
	public static function TUnknown($id, $data) { return new format_swf_SWFTag("TUnknown", 35, array($id, $data)); }
	public static $__constructors = array(13 => 'TActionScript3', 6 => 'TBackgroundColor', 22 => 'TBinaryData', 20 => 'TBitsJPEG', 18 => 'TBitsLossless', 19 => 'TBitsLossless2', 7 => 'TClip', 31 => 'TDefineButton2', 32 => 'TDefineEditText', 34 => 'TDefineScalingGrid', 27 => 'TDefineVideoFrame', 26 => 'TDefineVideoStream', 29 => 'TDoAction', 12 => 'TDoInitActions', 1 => 'TEnd', 16 => 'TExportAssets', 4 => 'TFont', 5 => 'TFontInfo', 11 => 'TFrameLabel', 15 => 'TImportAssets', 21 => 'TJPEGTables', 33 => 'TMetadata', 3 => 'TMorphShape', 8 => 'TPlaceObject2', 9 => 'TPlaceObject3', 10 => 'TRemoveObject2', 17 => 'TSandBox', 30 => 'TScriptLimits', 2 => 'TShape', 0 => 'TShowFrame', 23 => 'TSound', 24 => 'TSoundStreamBlock', 25 => 'TSoundStreamHead2', 28 => 'TStartSound', 14 => 'TSymbolClass', 35 => 'TUnknown');
	}
format_swf_SWFTag::$TEnd = new format_swf_SWFTag("TEnd", 1);
format_swf_SWFTag::$TShowFrame = new format_swf_SWFTag("TShowFrame", 0);
