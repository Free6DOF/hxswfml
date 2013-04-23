<?php

class format_swf_SoundFormat extends Enum {
	public static $SFADPCM;
	public static $SFLittleEndianUncompressed;
	public static $SFMP3;
	public static $SFNativeEndianUncompressed;
	public static $SFNellymoser;
	public static $SFNellymoser16k;
	public static $SFNellymoser8k;
	public static $SFSpeex;
	public static $__constructors = array(1 => 'SFADPCM', 3 => 'SFLittleEndianUncompressed', 2 => 'SFMP3', 0 => 'SFNativeEndianUncompressed', 6 => 'SFNellymoser', 4 => 'SFNellymoser16k', 5 => 'SFNellymoser8k', 7 => 'SFSpeex');
	}
format_swf_SoundFormat::$SFADPCM = new format_swf_SoundFormat("SFADPCM", 1);
format_swf_SoundFormat::$SFLittleEndianUncompressed = new format_swf_SoundFormat("SFLittleEndianUncompressed", 3);
format_swf_SoundFormat::$SFMP3 = new format_swf_SoundFormat("SFMP3", 2);
format_swf_SoundFormat::$SFNativeEndianUncompressed = new format_swf_SoundFormat("SFNativeEndianUncompressed", 0);
format_swf_SoundFormat::$SFNellymoser = new format_swf_SoundFormat("SFNellymoser", 6);
format_swf_SoundFormat::$SFNellymoser16k = new format_swf_SoundFormat("SFNellymoser16k", 4);
format_swf_SoundFormat::$SFNellymoser8k = new format_swf_SoundFormat("SFNellymoser8k", 5);
format_swf_SoundFormat::$SFSpeex = new format_swf_SoundFormat("SFSpeex", 7);
