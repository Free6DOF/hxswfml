<?php

class format_mp3_CLayer {
	public function __construct(){}
	static $LReserved = 0;
	static $LLayer3 = 1;
	static $LLayer2 = 2;
	static $LLayer1 = 3;
	static function enum2Num($l) {
		return eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁 = (\$l);
			switch(\$퍁->index) {
			case 1:
			{
				\$팿 = format_mp3_CLayer::\$LLayer3;
			}break;
			case 2:
			{
				\$팿 = format_mp3_CLayer::\$LLayer2;
			}break;
			case 3:
			{
				\$팿 = format_mp3_CLayer::\$LLayer1;
			}break;
			case 0:
			{
				\$팿 = format_mp3_CLayer::\$LReserved;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
	}
	static function num2Enum($l) {
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$l) {
			case format_mp3_CLayer::\$LLayer3:{
				\$팿 = format_mp3_Layer::\$Layer3;
			}break;
			case format_mp3_CLayer::\$LLayer2:{
				\$팿 = format_mp3_Layer::\$Layer2;
			}break;
			case format_mp3_CLayer::\$LLayer1:{
				\$팿 = format_mp3_Layer::\$Layer1;
			}break;
			default:{
				\$팿 = format_mp3_Layer::\$LayerReserved;
			}break;
			}
			return \$팿;
		");
	}
	function __toString() { return 'format.mp3.CLayer'; }
}
