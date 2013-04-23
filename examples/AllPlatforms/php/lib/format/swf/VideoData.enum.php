<?php

class format_swf_VideoData extends Enum {
	public static $H263videoPacket;
	public static $SCREENV2videoPacket;
	public static $SCREENvideoPacket;
	public static $VP6SWFALPHAvideoPacket;
	public static $VP6SWFvideoPacket;
	public static $__constructors = array(0 => 'H263videoPacket', 4 => 'SCREENV2videoPacket', 1 => 'SCREENvideoPacket', 3 => 'VP6SWFALPHAvideoPacket', 2 => 'VP6SWFvideoPacket');
	}
format_swf_VideoData::$H263videoPacket = new format_swf_VideoData("H263videoPacket", 0);
format_swf_VideoData::$SCREENV2videoPacket = new format_swf_VideoData("SCREENV2videoPacket", 4);
format_swf_VideoData::$SCREENvideoPacket = new format_swf_VideoData("SCREENvideoPacket", 1);
format_swf_VideoData::$VP6SWFALPHAvideoPacket = new format_swf_VideoData("VP6SWFALPHAvideoPacket", 3);
format_swf_VideoData::$VP6SWFvideoPacket = new format_swf_VideoData("VP6SWFvideoPacket", 2);
