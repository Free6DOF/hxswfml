<?php

class format_mp3_ChannelMode extends Enum {
		public static $DualChannel;
		public static $JointStereo;
		public static $Mono;
		public static $Stereo;
	}
	format_mp3_ChannelMode::$DualChannel = new format_mp3_ChannelMode("DualChannel", 2);
	format_mp3_ChannelMode::$JointStereo = new format_mp3_ChannelMode("JointStereo", 1);
	format_mp3_ChannelMode::$Mono = new format_mp3_ChannelMode("Mono", 3);
	format_mp3_ChannelMode::$Stereo = new format_mp3_ChannelMode("Stereo", 0);
