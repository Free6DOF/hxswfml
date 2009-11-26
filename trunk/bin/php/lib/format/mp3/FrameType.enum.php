<?php

class format_mp3_FrameType extends Enum {
		public static $FT_MP3;
		public static $FT_NONE;
	}
	format_mp3_FrameType::$FT_MP3 = new format_mp3_FrameType("FT_MP3", 0);
	format_mp3_FrameType::$FT_NONE = new format_mp3_FrameType("FT_NONE", 1);
