<?php

class format_mp3_CChannelMode {
	public function __construct(){}
	static $CStereo = 0;
	static $CJointStereo = 1;
	static $CDualChannel = 2;
	static $CMono = 3;
	static function enum2Num($c) {
		return eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁 = (\$c);
			switch(\$퍁->index) {
			case 0:
			{
				\$팿 = 0;
			}break;
			case 1:
			{
				\$팿 = 1;
			}break;
			case 2:
			{
				\$팿 = format_mp3_CChannelMode::\$CDualChannel;
			}break;
			case 3:
			{
				\$팿 = format_mp3_CChannelMode::\$CMono;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
	}
	static function num2Enum($c) {
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$c) {
			case 0:{
				\$팿 = format_mp3_ChannelMode::\$Stereo;
			}break;
			case 1:{
				\$팿 = format_mp3_ChannelMode::\$JointStereo;
			}break;
			case format_mp3_CChannelMode::\$CDualChannel:{
				\$팿 = format_mp3_ChannelMode::\$DualChannel;
			}break;
			case format_mp3_CChannelMode::\$CMono:{
				\$팿 = format_mp3_ChannelMode::\$Mono;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
	}
	function __toString() { return 'format.mp3.CChannelMode'; }
}
