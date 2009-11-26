<?php

class format_swf_Emphasis extends Enum {
		public static $CCIT_J17;
		public static $InvalidEmphasis;
		public static $Ms50_15;
		public static $NoEmphasis;
	}
	format_swf_Emphasis::$CCIT_J17 = new format_swf_Emphasis("CCIT_J17", 2);
	format_swf_Emphasis::$InvalidEmphasis = new format_swf_Emphasis("InvalidEmphasis", 3);
	format_swf_Emphasis::$Ms50_15 = new format_swf_Emphasis("Ms50_15", 1);
	format_swf_Emphasis::$NoEmphasis = new format_swf_Emphasis("NoEmphasis", 0);
