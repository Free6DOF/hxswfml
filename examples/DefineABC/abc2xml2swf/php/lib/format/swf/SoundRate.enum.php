<?php

class format_swf_SoundRate extends Enum {
	public static $SR11k;
	public static $SR22k;
	public static $SR44k;
	public static $SR5k;
	public static $__constructors = array(1 => 'SR11k', 2 => 'SR22k', 3 => 'SR44k', 0 => 'SR5k');
	}
format_swf_SoundRate::$SR11k = new format_swf_SoundRate("SR11k", 1);
format_swf_SoundRate::$SR22k = new format_swf_SoundRate("SR22k", 2);
format_swf_SoundRate::$SR44k = new format_swf_SoundRate("SR44k", 3);
format_swf_SoundRate::$SR5k = new format_swf_SoundRate("SR5k", 0);
