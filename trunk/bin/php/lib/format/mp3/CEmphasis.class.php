<?php

class format_mp3_CEmphasis {
	public function __construct(){}
	static $ENone = 0;
	static $EMs50_15 = 1;
	static $EReserved = 2;
	static $ECCIT_J17 = 3;
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
				\$�r = 3;
			}break;
			case 3:
			{
				\$�r = 2;
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
				\$�r = format_mp3_Emphasis::\$NoEmphasis;
			}break;
			case 1:{
				\$�r = format_mp3_Emphasis::\$Ms50_15;
			}break;
			case 3:{
				\$�r = format_mp3_Emphasis::\$CCIT_J17;
			}break;
			case 2:{
				\$�r = format_mp3_Emphasis::\$InvalidEmphasis;
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
	}
	function __toString() { return 'format.mp3.CEmphasis'; }
}
