<?php

class format_mp3_CLayer {
	public function __construct(){}
	static $LReserved = 0;
	static $LLayer3 = 1;
	static $LLayer2 = 2;
	static $LLayer1 = 3;
	static function enum2Num($l) {
		return format_mp3_CLayer_0($l);
	}
	static function num2Enum($l) {
		return format_mp3_CLayer_1($l);
	}
	function __toString() { return 'format.mp3.CLayer'; }
}
function format_mp3_CLayer_0(&$l) {
	$__hx__t = ($l);
	switch($__hx__t->index) {
	case 1:
	{
		return format_mp3_CLayer::$LLayer3;
	}break;
	case 2:
	{
		return format_mp3_CLayer::$LLayer2;
	}break;
	case 3:
	{
		return format_mp3_CLayer::$LLayer1;
	}break;
	case 0:
	{
		return format_mp3_CLayer::$LReserved;
	}break;
	}
}
function format_mp3_CLayer_1(&$l) {
	switch($l) {
	case format_mp3_CLayer::$LLayer3:{
		return format_mp3_Layer::$Layer3;
	}break;
	case format_mp3_CLayer::$LLayer2:{
		return format_mp3_Layer::$Layer2;
	}break;
	case format_mp3_CLayer::$LLayer1:{
		return format_mp3_Layer::$Layer1;
	}break;
	default:{
		return format_mp3_Layer::$LayerReserved;
	}break;
	}
}
