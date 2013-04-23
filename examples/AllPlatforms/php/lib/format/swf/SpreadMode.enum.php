<?php

class format_swf_SpreadMode extends Enum {
	public static $SMPad;
	public static $SMReflect;
	public static $SMRepeat;
	public static $SMReserved;
	public static $__constructors = array(0 => 'SMPad', 1 => 'SMReflect', 2 => 'SMRepeat', 3 => 'SMReserved');
	}
format_swf_SpreadMode::$SMPad = new format_swf_SpreadMode("SMPad", 0);
format_swf_SpreadMode::$SMReflect = new format_swf_SpreadMode("SMReflect", 1);
format_swf_SpreadMode::$SMRepeat = new format_swf_SpreadMode("SMRepeat", 2);
format_swf_SpreadMode::$SMReserved = new format_swf_SpreadMode("SMReserved", 3);
