<?php

class format_mp3_CLayer {
	public function __construct(){}
	static $LReserved = 0;
	static $LLayer3 = 1;
	static $LLayer2 = 2;
	static $LLayer1 = 3;
	static function enum2Num($l) {
		return eval("if(isset(\$this)) \$�this =& \$this;\$�t = (\$l);
			switch(\$�t->index) {
			case 1:
			{
				\$�r = format_mp3_CLayer::\$LLayer3;
			}break;
			case 2:
			{
				\$�r = format_mp3_CLayer::\$LLayer2;
			}break;
			case 3:
			{
				\$�r = format_mp3_CLayer::\$LLayer1;
			}break;
			case 0:
			{
				\$�r = format_mp3_CLayer::\$LReserved;
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
	}
	static function num2Enum($l) {
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$l) {
			case format_mp3_CLayer::\$LLayer3:{
				\$�r = format_mp3_Layer::\$Layer3;
			}break;
			case format_mp3_CLayer::\$LLayer2:{
				\$�r = format_mp3_Layer::\$Layer2;
			}break;
			case format_mp3_CLayer::\$LLayer1:{
				\$�r = format_mp3_Layer::\$Layer1;
			}break;
			default:{
				\$�r = format_mp3_Layer::\$LayerReserved;
			}break;
			}
			return \$�r;
		");
	}
	function __toString() { return 'format.mp3.CLayer'; }
}
