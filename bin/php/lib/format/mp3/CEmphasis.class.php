<?php

class format_mp3_CEmphasis {
	public function __construct(){}
	static $ENone = 0;
	static $EMs50_15 = 1;
	static $EReserved = 2;
	static $ECCIT_J17 = 3;
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
				\$팿 = 3;
			}break;
			case 3:
			{
				\$팿 = 2;
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
				\$팿 = format_mp3_Emphasis::\$NoEmphasis;
			}break;
			case 1:{
				\$팿 = format_mp3_Emphasis::\$Ms50_15;
			}break;
			case 3:{
				\$팿 = format_mp3_Emphasis::\$CCIT_J17;
			}break;
			case 2:{
				\$팿 = format_mp3_Emphasis::\$InvalidEmphasis;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
	}
	function __toString() { return 'format.mp3.CEmphasis'; }
}
