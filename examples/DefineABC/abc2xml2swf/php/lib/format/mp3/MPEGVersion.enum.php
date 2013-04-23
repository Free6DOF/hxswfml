<?php

class format_mp3_MPEGVersion extends Enum {
	public static $MPEG_Reserved;
	public static $MPEG_V1;
	public static $MPEG_V2;
	public static $MPEG_V25;
	public static $__constructors = array(3 => 'MPEG_Reserved', 0 => 'MPEG_V1', 1 => 'MPEG_V2', 2 => 'MPEG_V25');
	}
format_mp3_MPEGVersion::$MPEG_Reserved = new format_mp3_MPEGVersion("MPEG_Reserved", 3);
format_mp3_MPEGVersion::$MPEG_V1 = new format_mp3_MPEGVersion("MPEG_V1", 0);
format_mp3_MPEGVersion::$MPEG_V2 = new format_mp3_MPEGVersion("MPEG_V2", 1);
format_mp3_MPEGVersion::$MPEG_V25 = new format_mp3_MPEGVersion("MPEG_V25", 2);
