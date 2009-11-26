<?php

class format_swf_ChannelMode extends Enum {
		public static $DualChannel;
		public static $JointStereo;
		public static $Mono;
		public static $Stereo;
	}
	format_swf_ChannelMode::$DualChannel = new format_swf_ChannelMode("DualChannel", 2);
	format_swf_ChannelMode::$JointStereo = new format_swf_ChannelMode("JointStereo", 1);
	format_swf_ChannelMode::$Mono = new format_swf_ChannelMode("Mono", 3);
	format_swf_ChannelMode::$Stereo = new format_swf_ChannelMode("Stereo", 0);
