<?php

class format_swf_LineCapStyle extends Enum {
		public static $LCNone;
		public static $LCRound;
		public static $LCSquare;
	}
	format_swf_LineCapStyle::$LCNone = new format_swf_LineCapStyle("LCNone", 1);
	format_swf_LineCapStyle::$LCRound = new format_swf_LineCapStyle("LCRound", 0);
	format_swf_LineCapStyle::$LCSquare = new format_swf_LineCapStyle("LCSquare", 2);
