<?php

class format_mp3_CChannelMode {
	public function __construct(){}
	static $CStereo = 0;
	static $CJointStereo = 1;
	static $CDualChannel = 2;
	static $CMono = 3;
	static function enum2Num($c) {
		return eval("if(isset(\$this)) \$�this =& \$this;\$�t = (\$c);
			switch(\$�t->index) {
			case 0:
			{
				\$�r = 0;
			}break;
			case 1:
			{
				\$�r = 1;
			}break;
			case 2:
			{
				\$�r = format_mp3_CChannelMode::\$CDualChannel;
			}break;
			case 3:
			{
				\$�r = format_mp3_CChannelMode::\$CMono;
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
	}
	static function num2Enum($c) {
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$c) {
			case 0:{
				\$�r = format_mp3_ChannelMode::\$Stereo;
			}break;
			case 1:{
				\$�r = format_mp3_ChannelMode::\$JointStereo;
			}break;
			case format_mp3_CChannelMode::\$CDualChannel:{
				\$�r = format_mp3_ChannelMode::\$DualChannel;
			}break;
			case format_mp3_CChannelMode::\$CMono:{
				\$�r = format_mp3_ChannelMode::\$Mono;
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
	}
	function __toString() { return 'format.mp3.CChannelMode'; }
}
