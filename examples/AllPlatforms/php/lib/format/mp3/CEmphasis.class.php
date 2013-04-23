<?php

class format_mp3_CEmphasis {
	public function __construct(){}
	static function enum2Num($c) {
		return format_mp3_CEmphasis_0($c);
	}
	static function num2Enum($c) {
		return format_mp3_CEmphasis_1($c);
	}
	function __toString() { return 'format.mp3.CEmphasis'; }
}
function format_mp3_CEmphasis_0(&$c) {
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
		return 3;
	}break;
	case 3:
	{
		return 2;
	}break;
	}
}
function format_mp3_CEmphasis_1(&$c) {
	switch($c) {
	case 0:{
		return format_mp3_Emphasis::$NoEmphasis;
	}break;
	case 1:{
		return format_mp3_Emphasis::$Ms50_15;
	}break;
	case 3:{
		return format_mp3_Emphasis::$CCIT_J17;
	}break;
	case 2:{
		return format_mp3_Emphasis::$InvalidEmphasis;
	}break;
	}
}
