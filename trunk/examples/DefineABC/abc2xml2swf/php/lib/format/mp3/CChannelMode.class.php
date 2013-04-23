<?php

class format_mp3_CChannelMode {
	public function __construct(){}
	static $CDualChannel = 2;
	static $CMono = 3;
	static function enum2Num($c) {
		return format_mp3_CChannelMode_0($c);
	}
	static function num2Enum($c) {
		return format_mp3_CChannelMode_1($c);
	}
	function __toString() { return 'format.mp3.CChannelMode'; }
}
function format_mp3_CChannelMode_0(&$c) {
	$__hx__t = ($c);
	switch($__hx__t->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	{
		return format_mp3_CChannelMode::$CDualChannel;
	}break;
	case 3:
	{
		return format_mp3_CChannelMode::$CMono;
	}break;
	}
}
function format_mp3_CChannelMode_1(&$c) {
	switch($c) {
	case 0:{
		return format_mp3_ChannelMode::$Stereo;
	}break;
	case 1:{
		return format_mp3_ChannelMode::$JointStereo;
	}break;
	case format_mp3_CChannelMode::$CDualChannel:{
		return format_mp3_ChannelMode::$DualChannel;
	}break;
	case format_mp3_CChannelMode::$CMono:{
		return format_mp3_ChannelMode::$Mono;
	}break;
	}
}
