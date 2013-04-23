<?php

class format_swf_LineJoinStyle extends Enum {
	public static $LJBevel;
	public static function LJMiter($limitFactor) { return new format_swf_LineJoinStyle("LJMiter", 2, array($limitFactor)); }
	public static $LJRound;
	public static $__constructors = array(1 => 'LJBevel', 2 => 'LJMiter', 0 => 'LJRound');
	}
format_swf_LineJoinStyle::$LJBevel = new format_swf_LineJoinStyle("LJBevel", 1);
format_swf_LineJoinStyle::$LJRound = new format_swf_LineJoinStyle("LJRound", 0);
