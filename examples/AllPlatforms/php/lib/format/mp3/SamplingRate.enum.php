<?php

class format_mp3_SamplingRate extends Enum {
	public static $SR_11025;
	public static $SR_12000;
	public static $SR_22050;
	public static $SR_24000;
	public static $SR_32000;
	public static $SR_44100;
	public static $SR_48000;
	public static $SR_8000;
	public static $SR_Bad;
	public static $__constructors = array(1 => 'SR_11025', 2 => 'SR_12000', 3 => 'SR_22050', 4 => 'SR_24000', 5 => 'SR_32000', 6 => 'SR_44100', 7 => 'SR_48000', 0 => 'SR_8000', 8 => 'SR_Bad');
	}
format_mp3_SamplingRate::$SR_11025 = new format_mp3_SamplingRate("SR_11025", 1);
format_mp3_SamplingRate::$SR_12000 = new format_mp3_SamplingRate("SR_12000", 2);
format_mp3_SamplingRate::$SR_22050 = new format_mp3_SamplingRate("SR_22050", 3);
format_mp3_SamplingRate::$SR_24000 = new format_mp3_SamplingRate("SR_24000", 4);
format_mp3_SamplingRate::$SR_32000 = new format_mp3_SamplingRate("SR_32000", 5);
format_mp3_SamplingRate::$SR_44100 = new format_mp3_SamplingRate("SR_44100", 6);
format_mp3_SamplingRate::$SR_48000 = new format_mp3_SamplingRate("SR_48000", 7);
format_mp3_SamplingRate::$SR_8000 = new format_mp3_SamplingRate("SR_8000", 0);
format_mp3_SamplingRate::$SR_Bad = new format_mp3_SamplingRate("SR_Bad", 8);
