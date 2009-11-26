<?php

class format_swf_BlendMode extends Enum {
		public static $BAdd;
		public static $BAlpha;
		public static $BDarken;
		public static $BDifference;
		public static $BErase;
		public static $BHardLight;
		public static $BInvert;
		public static $BLayer;
		public static $BLighten;
		public static $BMultiply;
		public static $BNormal;
		public static $BOverlay;
		public static $BScreen;
		public static $BSubtract;
	}
	format_swf_BlendMode::$BAdd = new format_swf_BlendMode("BAdd", 6);
	format_swf_BlendMode::$BAlpha = new format_swf_BlendMode("BAlpha", 10);
	format_swf_BlendMode::$BDarken = new format_swf_BlendMode("BDarken", 5);
	format_swf_BlendMode::$BDifference = new format_swf_BlendMode("BDifference", 8);
	format_swf_BlendMode::$BErase = new format_swf_BlendMode("BErase", 11);
	format_swf_BlendMode::$BHardLight = new format_swf_BlendMode("BHardLight", 13);
	format_swf_BlendMode::$BInvert = new format_swf_BlendMode("BInvert", 9);
	format_swf_BlendMode::$BLayer = new format_swf_BlendMode("BLayer", 1);
	format_swf_BlendMode::$BLighten = new format_swf_BlendMode("BLighten", 4);
	format_swf_BlendMode::$BMultiply = new format_swf_BlendMode("BMultiply", 2);
	format_swf_BlendMode::$BNormal = new format_swf_BlendMode("BNormal", 0);
	format_swf_BlendMode::$BOverlay = new format_swf_BlendMode("BOverlay", 12);
	format_swf_BlendMode::$BScreen = new format_swf_BlendMode("BScreen", 3);
	format_swf_BlendMode::$BSubtract = new format_swf_BlendMode("BSubtract", 7);
