<?php

class format_mp3_Emphasis extends Enum {
	public static $CCIT_J17;
	public static $InvalidEmphasis;
	public static $Ms50_15;
	public static $NoEmphasis;
	public static $__constructors = array(2 => 'CCIT_J17', 3 => 'InvalidEmphasis', 1 => 'Ms50_15', 0 => 'NoEmphasis');
	}
format_mp3_Emphasis::$CCIT_J17 = new format_mp3_Emphasis("CCIT_J17", 2);
format_mp3_Emphasis::$InvalidEmphasis = new format_mp3_Emphasis("InvalidEmphasis", 3);
format_mp3_Emphasis::$Ms50_15 = new format_mp3_Emphasis("Ms50_15", 1);
format_mp3_Emphasis::$NoEmphasis = new format_mp3_Emphasis("NoEmphasis", 0);