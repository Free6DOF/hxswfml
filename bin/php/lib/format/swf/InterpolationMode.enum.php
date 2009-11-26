<?php

class format_swf_InterpolationMode extends Enum {
		public static $IMLinearRGB;
		public static $IMNormalRGB;
		public static $IMReserved1;
		public static $IMReserved2;
	}
	format_swf_InterpolationMode::$IMLinearRGB = new format_swf_InterpolationMode("IMLinearRGB", 1);
	format_swf_InterpolationMode::$IMNormalRGB = new format_swf_InterpolationMode("IMNormalRGB", 0);
	format_swf_InterpolationMode::$IMReserved1 = new format_swf_InterpolationMode("IMReserved1", 2);
	format_swf_InterpolationMode::$IMReserved2 = new format_swf_InterpolationMode("IMReserved2", 3);
